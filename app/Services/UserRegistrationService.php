<?php

namespace App\Services;

use App\Http\Requests\UserRegisterRequest;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRegistrationService
{
    public static function registerUser(UserRegisterRequest $request)
    {
        $userData = $request->all();

        if (!User::validateCPF($userData['cpf'])) {
            throw new \Exception('CPF inválido');
        }

        if (self::userExists($userData['cpf'], $userData['email'])) {
            throw new \Exception('Usuário já cadastrado');
        }

        $certExists = self::validateCertificate($userData['certificate']);

        if (!$certExists) {
            throw new \Exception('Certificado inválido');
        }

        return DB::transaction(function () use ($userData, $certExists) {
            $user = self::createUser($userData);

            self::associateUserToCertificate($user, $certExists);
            self::createUserAddress($user, $userData);
            self::createUserPersonalData($user, $userData);
            self::createUserContact($user, $userData);
            self::attachDeficiencies($user, $userData);
            self::createUserStep($user);

            return $user;
        });
    }

    public static function associateUserToCertificate($user, $certificate)
    {
        $certificate->user()->associate($user);
        $certificate->save();
    }

    private static function userExists($cpf, $email)
    {
        return User::existsByCPF($cpf) || User::isEmailTaken($email);
    }

    private static function validateCertificate($certificate)
    {
        $certExists = (new Certificate())->findByHash($certificate);

        if (!$certExists) {
            return null; // Certificate not found
        }
    
        if ($certExists->user_id) {
            return null; // Certificate already used
        }
    
        return $certExists; // Valid certificate
    }

    private static function createUser($userData)
    {

        $cpf = preg_replace( '/[^0-9]/is', '', $userData['cpf']);

        return User::create([
            'name' => $userData['name'],
            'cpf' => $cpf,
            'birth_date' => $userData['birthdate'],
            'is_pcd' => $userData['isPCD'],
            'email' => $userData['email'],
            'password' => bcrypt($userData['password']),
        ]);
    }

    private static function createUserAddress($user, $userData)
    {
        $user->address()->create([
            'cep' => preg_replace('/[^0-9]/is', '', $userData['cep']),
            'street' => $userData['street'],
            'number' => $userData['number'],
            'city' => $userData['city'],
            'state' => $userData['state'],
            'neighborhood' => $userData['neighbor'],
        ]);
    }

    private static function createUserPersonalData($user, $userData)
    {
        $user->personal()->create([
            'sex' => $userData['sex'],
            'skin_id' => $userData['skin'],
            'gender_id' => $userData['gender'] ?? 'Pnr',
            'nacionality' => $userData['nacionality'],
        ]);
    }

    private static function createUserContact($user, $userData)
    {
        $phone = preg_replace('/[^0-9]/is', '', $userData['phone']);
        $ddd = substr($phone, 0, 2);
        $phone = substr($phone, 2);

        $user->contact()->create([
            'phone' => $phone,
            'ddd' => $ddd,
        ]);
    }

    private static function attachDeficiencies($user, $userData)
    {
        if ($userData['isPCD']) {
            foreach ($userData['deficiency'] as $deficiency) {
                $user->deficiences()->attach($deficiency);
            }
        }
    }

    private static function createUserStep($user)
    {
        $user->steps()->create([
            'hasCurriculum' => false,
        ]);
    }

    
}