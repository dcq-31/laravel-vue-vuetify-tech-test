<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

final class CreateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'name' => ['required', 'string'],
           'last_name' => ['required', 'string'],
           'gender' => ['required', 'in:Masculino,Femenino'],
           'age' => ['required', 'integer', 'min:0'],
           'email' => ['required', 'email', 'unique:users,email']
        ];
    }
}
