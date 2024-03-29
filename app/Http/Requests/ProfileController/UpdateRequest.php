<?php

namespace App\Http\Requests\ProfileController;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => 'sometimes|string|max:255',
            'name' => 'sometimes|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'patronymic' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => [
                'sometimes',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth()->id())
            ],
            'password' => 'sometimes|string|min:8|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'login.string' => 'Поле логин должно быть строкой',
            'name.string' => 'Поле имя должно быть строкой',
            'lastname.string' => 'Поле фамилия должно быть строкой',
            'patronymic.string' => 'Поле отчество должно быть строкой',
            'company.string' => 'Поле компания должно быть строкой',
            'email.email' => 'Поле email должно быть действительным адресом электронной почты',
            'email.unique' => 'Указанный email уже зарегистрирован',
            'password.string' => 'Поле пароль должно быть строкой',
            'password.min' => 'Пароль должен содержать минимум 8 символов',
        ];
    }
}
