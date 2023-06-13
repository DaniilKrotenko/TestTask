<?php

namespace app\Http\Requests\Cat;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CatUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'min:3|unique:cats',
            'shelter_id' => 'required|min:1|numeric',
            'health' => ['required', Rule::in(['Ok', 'No'])],
            'arrival' => 'date',
            'departure' => 'date|after:arrival'
        ];
    }
}
