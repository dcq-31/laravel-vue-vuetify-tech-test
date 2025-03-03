<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
          'name' => ['sometimes', 'string'],
          'last_name' => ['sometimes', 'string'],
          'gender' => ['sometimes', 'in:Masculino,Femenino'],
          'age' => ['sometimes', 'integer', 'min:0'],
        ];
    }
}
