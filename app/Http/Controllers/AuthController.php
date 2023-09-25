<?php

namespace App\Http\Controllers;

use App\Enums\Sex;
use App\Models\Certificate;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;

class AuthController extends Controller
{

    public function registerUser(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:15',
            'certificate' => 'required|string|max:255',
            'birthdate' => 'required|date|before:today',
            'phone' => 'required|string|max:255|min:11',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required|string|min:8',
            'cep' => 'required|string|max:9',
            'street' => 'required|string|max:255',
            'neighbor' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'sex' => [new Enum(Sex::class), 'required'],
            'skin' => "nullable|sometimes|exists:skins,id",
            'gender' => "nullable|sometimes|exists:genders,id",
            'isPCD' => 'required|boolean',
            'deficiency' => 'required_if:isPCD,1|nullable|array|max:255',
        ]);

        //verify cpf validation
        if(!User::validateCPF($request->cpf)){
            return back()->withErrors('CPF inválido');
        }

        $request->merge([
           "cpf" => preg_replace( '/[^0-9]/is', '', $request->cpf)
        ]);
        
        //verify if user already exists
        if(User::existsByCPF($request->cpf)){
            return back()->withErrors('Usuário já cadastrado');
        }

        //check email
        if(User::isEmailTaken($request->email)){
            return back()->withErrors('Email já cadastrado');
        }

        //verify if certificate exists (it must exist)
        $certExists = (new Certificate)->findByHash($request->certificate);

        if(!$certExists){
            return back()->withErrors('Certificado inválido');
        }

        //verify if certificate is already used
        if($certExists->user_id){
            return back()->withErrors('Certificado inválido');
        }

        $user = DB::transaction(function () use ($request, $certExists){

            $user = User::create([
                'name' => $request->name,
                'cpf' => $request->cpf,
                'birth_date' => $request->birthdate,
                'is_pcd' => $request->isPCD,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $certExists->user()->associate($user);

            $certExists->save();

            //add address
            $user->address()->create([
                'cep' => preg_replace( '/[^0-9]/is', '', $request->cep),
                'street' => $request->street,
                'number' => $request->number,
                'city' => $request->city,
                'state' => $request->state,
                'neighborhood' => $request->neighbor
            ]);

            //add personal data
            $user->personal()->create([
                'sex' => $request->sex, 
                'skin_id' => $request->skin,
                'gender_id' => $request->gender ?? 'Pnr',
                'nacionality' => $request->nacionality
            ]);

            $phone = preg_replace( '/[^0-9]/is', '', $request->phone);

            $ddd = substr($phone, 0, 2);

            $phone = substr($phone, 2);

            //add contact
            $user->contact()->create([
                'phone' => $phone,
                'ddd' => $ddd
            ]);

            //add deficiences
            if($request->isPCD){
                //attach deficiences
                foreach($request->deficiency as $deficiency){
                    $user->deficiences()->attach($deficiency);
                }
            }

            //add user step
            $user->steps()->create([
                'hasCurriculum' => false
            ]);

            $user->save();

            return $user;

        } );

        //authenticates user
        Auth::login($user);

        return redirect()->route('user.dashboard');

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
