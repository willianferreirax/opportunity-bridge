<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\Company;
use App\Models\User;
use App\Services\UserRegistrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function registerUser(UserRegisterRequest $request){

        try{
            $user = UserRegistrationService::registerUser($request);

            Auth::login($user);
            return redirect()->route('user.dashboard');
        }
        catch(\Exception $e){
            return back()->withErrors($e->getMessage());
        }

    }

    public function registerCompany(Request $request) {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required|string|max:255',
            'phone' => 'required|string|max:255|min:11',
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required|string|min:8',
            
            'fantasyName' => 'required|string|max:255',
            'companyName' => 'required|string|max:255',
            'cnpj' => 'required|string|max:255',
            'workersNumber' => 'required|string|max:255',
            'companyArea' => 'required|string|max:255',
            'companyDescription' => 'required|string|max:255',

            'cep' => 'required|string|max:9',
            'street' => 'required|string|max:255',
            'neighbor' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'number' => 'required|string|max:255',
        ]);

        $request->merge([
            "cnpj" => preg_replace( '/[^0-9]/is', '', $request->cnpj)
        ]);

        //verify cnpj validation
        if(!(new Company())->validateCNPJ($request->cnpj)){
            return back()->withErrors('CNPJ inválido');
        }

        //verify if company already exists
        if((new User())->existsByEmail($request->email)){
            return back()->withErrors('Email já cadastrado');
        }

        $user = DB::transaction(function () use ($request){
                
            $company = Company::create([
                'fantasy_name' => $request->fantasyName,
                'company_name' => $request->companyName,
                'cnpj' => $request->cnpj,
                'workers_number' => $request->workersNumber,
                'company_area' => $request->companyArea,
                'description' => $request->companyDescription
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => bcrypt($request->password),
                'type' => 'company',
                'company_id' => $company->id
            ]);

            //add address
            $company->address()->create([
                'cep' => preg_replace( '/[^0-9]/is', '', $request->cep),
                'street' => $request->street,
                'number' => $request->number,
                'city' => $request->city,
                'state' => $request->state,
                'neighborhood' => $request->neighbor
            ]);

            $phone = preg_replace( '/[^0-9]/is', '', $request->phone);

            $ddd = substr($phone, 0, 2);

            $phone = substr($phone, 2);

            //add contact
            $user->contact()->create([
                'phone' => $phone,
                'ddd' => $ddd
            ]);

            $user->save();

            return $user;

        } );
        

        //authenticates user
        Auth::login($user);

        return redirect()->route('company.dashboard');

    }


}
