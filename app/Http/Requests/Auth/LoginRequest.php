<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\MainRequest;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends MainRequest
{
    public function rules(): array
    {
        return [
            'email' => 'string|required|email',
            'password' => 'string|required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => "Email Zorunludur!",
            'email.string' => "Email String Bir Değer Olmalıdır!",
            'email.email' => "Email Geçerli Bir Email Adresi Olmalıdır!",
            'password.required' => "Şifre Zorunludur!",
            'password.string' => "Şifre String Bir Değer Olmalıdır!",
            'password.min' => "Şifreniz En Az 6 Karakter Olmalıdır!",
        ];
    }
}
