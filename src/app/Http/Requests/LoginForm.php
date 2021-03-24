<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class LoginForm extends FormRequest
{

    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

}
