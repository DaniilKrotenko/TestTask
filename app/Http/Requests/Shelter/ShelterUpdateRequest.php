<?php

namespace App\Http\Requests\Shelter;

use Illuminate\Foundation\Http\FormRequest;

class ShelterUpdateRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'min:3',
            'address' => 'min:3|unique:shelters'
        ];
    }
}
