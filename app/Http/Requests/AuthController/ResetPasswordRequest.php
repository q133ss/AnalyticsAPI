<?php

namespace App\Http\Requests\AuthController;

use App\Models\ResetCodePassword;
use Closure;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:255',
            're_password' => function(string $attribute, mixed $value, Closure $fail): void {
                if($this->password != $value){
                    $fail('Пароли не совпадают');
                }
            },
            'code' => [
                'required',
                'string',
                function(string $attribute, mixed $value, Closure $fail): void {
                    $code = ResetCodePassword::where('email', $this->email)->orderBy('created_at','desc')->pluck('code')->first();
                    if($code != $value){
                        $fail('Неверный код');
                    }
                }
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Укажите email',
            'email.email' => 'Неверный формат email',
            'password.required' => 'Введите пароль',
            'password.string' => 'Пароль должен быть строкой',
            'password.min' => 'Пароль должен состоять, как минимум из 8 символов',
            'password.max' => 'Пароль не может быть больше 255 символов',
            'code.required' => 'Введите код',
            'code.string' => 'Код должен быть строкой'
        ];
    }
}
