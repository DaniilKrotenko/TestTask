<?php

namespace app\Http\Requests\Cat;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CatRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|unique:cats',
            'shelter_id' => 'required|numeric|exists:shelters,id',
            'health' => ['required', Rule::in(['Ok', 'No'])],
            'arrival' => 'required|date',
            'departure' => 'date|after:arrival',
        ];
    }
}
