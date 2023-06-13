<?php

namespace app\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
            'shelter_id' => 'exists:shelters,id',
            'position' => 'min:3',
            'email' => 'min:3|email:rfc,dns',
            'birthday' => 'date',
        ];
    }
}
