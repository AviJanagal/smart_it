<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function add()
    {
        $type = 1;
        return view("admin/add", compact('type'));
    }

    public function add_employee(Request $request)
    {

        $rules = [
            'email' => 'required|string|email|max:255|unique:users',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $employee = new \App\User;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->password = Hash::make($request->password);
            $employee->description = $request->designation;
            $employee->role = "employee";
            if ($employee->save()) {
                return redirect()->back()->with(['alert' => 'success', 'message' => 'Employee has been saved successfully!.']);
            } else {
                return redirect()->back()->with(['alert' => 'danger', 'message' => 'Employee has not been saved!.']);
            }
        }
    }
}
