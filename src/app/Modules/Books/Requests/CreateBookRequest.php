<?php


namespace App\Modules\Books\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }
}
