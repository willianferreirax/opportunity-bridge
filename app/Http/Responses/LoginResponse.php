<?php
 
namespace App\Http\Responses;
 
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
 
class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {

        if(auth()->user()->type == 'company'){
            $home = '/company/dashboard';
        }

        else if(auth()->user()->type == 'admin'){
            $home = '/admin/dashboard';
        }

        else{
            $home = '/user/dashboard';
        }

 
        return redirect()->intended($home);
    }
}