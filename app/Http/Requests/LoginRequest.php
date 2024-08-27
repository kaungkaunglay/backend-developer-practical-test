<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'    => ['required', 'email', 'min:6'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }
<<<<<<< HEAD
    // give the message to user 
    public function messages()
    {
        return [
            'username.required' => 'Username is required',
            'username.min' => 'Username must be at least 3 characters long',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters long',
        ];
    }
=======
>>>>>>> d4530912313f03b9d3f0d0c2393e76f1544d51cc
}
