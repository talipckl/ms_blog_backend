<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\MainRequest;

class RegisterRequest extends MainRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required |string | unique:users,email',
            'password' => 'required |string',
        ];
    }
    public function messages()
    {
        return parent::messages(); // TODO: Change the autogenerated stub
    }
}
