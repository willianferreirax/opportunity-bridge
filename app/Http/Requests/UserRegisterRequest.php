<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Sex;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
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
            'deficiency' => 'required_if:isPCD,1|nullable|array',
        ];
    }
}
