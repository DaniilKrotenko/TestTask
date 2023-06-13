<?php

namespace app\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'shelter_id' => 'required|exists:shelters,id',
            'position' => 'required|min:3',
            'email' => 'required|min:3|email:rfc,dns',
            'birthday' => 'required|date',
        ];
    }
}
