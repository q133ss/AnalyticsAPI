<?php

namespace App\Services\AuthController;

use App\Models\ResetCodePassword;
use Illuminate\Support\Facades\Mail;

class SendCodeService
{
    public function sendCode(array $data): \Illuminate\Http\JsonResponse
    {
        $code = rand(1000,9999);
        ResetCodePassword::create([
            'email' => $data['email'],
            'code' => $code
        ]);
        Mail::send('mails.reset', ['code' => $code], function($message) use ($data) {
            $message->to($data['email'])->subject
            ('Восстановление пароля');
            $message->from('info@gmail.com','Analytics');
        });
        return Response()->json(['message' => 'Код успешно отправлен']);
    }
}
