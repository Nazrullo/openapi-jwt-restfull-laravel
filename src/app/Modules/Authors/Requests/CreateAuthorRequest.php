<?php


namespace App\Modules\Authors\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CreateAuthorRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'full_name' => 'required|string',
            'birth_date' => 'required|date',
            'about' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }
}
