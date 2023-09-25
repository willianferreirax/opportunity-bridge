<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\OpportunityUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Jenssegers\Agent\Agent;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Http\Controllers\Inertia\Concerns\ConfirmsTwoFactorAuthentication;
use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Contracts\ProfileInformationUpdatedResponse;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class CompanyController extends Controller
{

    use ConfirmsTwoFactorAuthentication;

    public function dashboard(){
        
        //fetch the last two applications to an opportunity
        $appliedUsers = OpportunityUser::with('user')
            ->with('opportunity')
            ->whereHas('opportunity', function ($query) {
                $query->where('company_id', auth()->user()->company->id);
            })
            ->orderBy('created_at', 'desc')
            ->limit(2); 


        $opportunities = \App\Models\Opportunity::withCount('appliedUsers')
            ->where('company_id', auth()->user()->company->id)
            ->orderBy('created_at', 'desc')
            ->limit(2);

        return Inertia::render('Company/Dashboard', [
            'opportunities' => $opportunities->get(),
            'appliedUsers' => $appliedUsers->get(),
        ]);
    }

    public function profile(Request $request){
        $this->validateTwoFactorAuthenticationState($request);

        return Jetstream::inertia()->render($request, 'Company/Profile/Show', [
            'confirmsTwoFactorAuthentication' => Features::optionEnabled(Features::twoFactorAuthentication(), 'confirm'),
            'sessions' => $this->sessions($request)->all(),
        ]);
    }

     /**
     * Get the current sessions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function sessions(Request $request)
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return collect(
            DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                    ->where('user_id', $request->user()->getAuthIdentifier())
                    ->orderBy('last_activity', 'desc')
                    ->get()
        )->map(function ($session) use ($request) {
            $agent = $this->createAgent($session);

            return (object) [
                'agent' => [
                    'is_desktop' => $agent->isDesktop(),
                    'platform' => $agent->platform(),
                    'browser' => $agent->browser(),
                ],
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === $request->session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    /**
     * Create a new agent instance from the given session.
     *
     * @param  mixed  $session
     * @return \Jenssegers\Agent\Agent
     */
    protected function createAgent($session)
    {
        return tap(new Agent(), function ($agent) use ($session) {
            $agent->setUserAgent($session->user_agent);
        });
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return \Laravel\Fortify\Contracts\ProfileInformationUpdatedResponse
     */
    public function updateProfile(Request $request,
                           UpdatesUserProfileInformation $updater)
    {
        $updater->update($request->user(), $request->all());

        if(!$request->photo){
            return app(ProfileInformationUpdatedResponse::class);
        }

        $path = $request->photo->storePublicly(
            'company-photos', ['disk' => 'public']
        );

        $company = Company::find(auth()->user()->company->id);

        $company->update([
            'profile_photo_path' => $path,
        ]);        

        return app(ProfileInformationUpdatedResponse::class);
    }
}
