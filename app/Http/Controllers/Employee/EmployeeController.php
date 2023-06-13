<?php

namespace app\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\EmployeeRequest;
use App\Http\Requests\Employee\EmployeeUpdateRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getEmployees()
    {
        return Employee::all();
    }

    public function addEmployee(EmployeeRequest $request)
    {
        Employee::create([
            'name' => $request->input('name'),
            'shelter_id' => $request->input('shelter_id'),
            'position' => $request->input('position'),
            'email' => $request->input('email'),
            'birthday' => $request->input('birthday'),
        ]);

        return response()->json([
            'Request' => 'Employee successfully created'
        ]);
    }

    public function updateEmployee(EmployeeUpdateRequest $request)
    {
        $id = $request['employee_id'];
        $employee = Employee::all()->find($id);

        if (isset($employee)) {
            $employee->name = $request->input('name', $employee->name);
            $employee->shelter_id = $request->input('shelter_id', $employee->shelter_id);
            $employee->position = $request->input('position', $employee->position);
            $employee->email = $request->input('email', $employee->email);
            $employee->birthday = $request->input('birthday', $employee->birthday);
            $employee->save();

            return response()->json([
                'Request' => 'Employee successfully updated',
            ]);
        } else {
            return response()->json([
                'Error' => 'ID Employee not found',
            ]);
        }
    }

    public function deleteEmployee(Request $request)
    {
        $id = $request['employee_id'];
        if (Employee::where('id', $id)->exists()) {
            Employee::find($id)->delete();
            return response()->json([
                'Request' => 'Employee successfully deleted',
            ]);
        } else {
            return response()->json([
                'Error' => 'There is no such Employee.',
            ]);
        }
    }
}
