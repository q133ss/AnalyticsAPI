<?php

namespace App\Http\Requests\AuthController;

use App\Models\User;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
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
            'login' => 'required|string',
            'password' => [
                'required',
                'string',
                function(string $attribute, mixed $value, Closure $fail): void {
                    $user = User::where('login', $this->login);
                    if(!$user->exists() || !Hash::check($value, $user->pluck('password')->first())){
                        $fail('Неверный логин или пароль');
                    }
                }
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => 'Введите логин',
            'login.string' => 'Логин должен быть строкой',

            'password.required' => 'Введите пароль',
            'password.string' => 'Пароль должен быть строкой'
        ];
    }
}
