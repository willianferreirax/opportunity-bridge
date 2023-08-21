<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function registerUser(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|integer|max:2',
            'birth_date' => 'required|date',
            'certificate' => 'required|string|max:255',
            'phone' => 'required|string|max:255|min:11',
        ]);

        dd($request->all());

    }

    
    public function registerUserStepOne(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|integer',
            'birth_date' => 'required|date',
            'certificate' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        //verify cpf validation
        if(!User::validateCPF($request->cpf)){
            return back()->with('error', 'CPF inválido');
        }

        //verify if user already exists
        if(!User::existsByCPF($request->cpf)){
            return back()->with('error', 'Usuário já cadastrado');
        }

        //verify if certificate exists (it must exist)
        $certExists = (new Certificate)->findByHash($request->certificate);

        if(!$certExists){
            return back()->with('error', 'Certificado inválido');
        }

        //verify if certificate is already used
        if($certExists->user_id){
            return back()->with('error', 'Certificado inválido');
        }

        User::create([
            'name' => $request->name,
            'cpf' => $request->cpf,
            'birth_date' => $request->birth_date
        ]);




    }

}
