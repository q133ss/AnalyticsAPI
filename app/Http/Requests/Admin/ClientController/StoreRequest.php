<?php

namespace App\Http\Requests\Admin\ClientController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'login' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'patronymic' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => 'Поле логин обязательно для заполнения',
            'name.required' => 'Поле имя обязательно для заполнения',
            'lastname.required' => 'Поле фамилия обязательно для заполнения',
            'patronymic.string' => 'Поле отчество должно быть строкой',
            'company.string' => 'Поле компания должно быть строкой',
            'email.required' => 'Поле email обязательно для заполнения',
            'email.email' => 'Поле email должно быть действительным адресом электронной почты',
            'email.unique' => 'Указанный email уже зарегистрирован',
            'password.required' => 'Поле пароль обязательно для заполнения',
            'password.min' => 'Пароль должен содержать минимум 8 символов',
        ];
    }
}
