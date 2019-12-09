<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        return response()->json(
            [
                'status' => 'success',
                'employees' => $employees->toArray()
            ],
            200
        );
    }

    public function show(Request $request, $id)
    {
        $employee = Employee::find($id);

        return response()->json(
            [
                'status' => 'success',
                'employee' => $employee->toArray()
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'bank_account_number' => 'required',
            'age' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'shelter_id' => 'required'
        ]);
        $employee = Employee::create($request->all());
        return response()->json($employee, 201);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'bank_account_number' => 'required',
            'age' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'shelter_id' => 'required'
        ]);
        $employee->update($request->all());
        return response()->json(
            [
                'status' => 'success',
                'employee' => $employee->toArray()
            ],
            200
        );
    }

    public function delete($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json(['message' => 'Deleted successfully.'], 200);
    }
}
