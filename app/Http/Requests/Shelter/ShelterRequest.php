<?php

namespace App\Http\Requests\Shelter;

use Illuminate\Foundation\Http\FormRequest;

class ShelterRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'address' => 'required|min:3|unique:shelters'
        ];
    }
}
