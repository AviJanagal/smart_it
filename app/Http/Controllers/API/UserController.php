<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\otp;
use DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    //

    public function register(Request $req)
     {
         
         $rules = [
             

            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'phone_number' => 'required|max:10|unique:users',


           ];
            $validator = Validator::make($req->all(), $rules);
             if ($validator->fails()) 
             {
               return response()->json(['status' => false,'message' => $validator->errors()->first()]);
             }
             else
             {
         $user = User::create([
             'first_name' => $req->first_name,
             'last_name' => $req->last_name,
             'email' => $req->email,
             'password' => bcrypt($req->password),
             'phone_number' => $req->phone_number,
             'role' => "admin",

         ]);



         $user['token'] =  $user->createToken($req->email)->accessToken;
 
         if($user){
         return response()->json(['status'=>true,'message'=>'Thanks for registering with us.','payload'=>$user]);
         }else{
         return response()->json(['status'=>false,'message'=>'Something error while registering! Try after some time!.']);
         }
 
     }
 }
 
    public function login(Request $req)
    { 
      $rules = ['email'=>'required|string|email','password'=>'required|string|min:6',];
      $validator = Validator::make($req->all(), $rules);
      if ($validator->fails()) 
      {
        return response()->json(['status' => false,'message' => $validator->errors()->first()]);
      }
      else
      {

      if(Auth::attempt(['email' => request('email'), 'password' => request('password')]))
      {
        $user = Auth::user();
        $success['token'] =  $user->createToken($req->email)->accessToken;

        
    //   return response()->json(['success' => $success], 200);
      return response()->json(['status'=> true,'message'=>'Thanks for login with us.','payload'=>$success]);
      }
      else
      {
        return response()->json(['status'=>false,'message' => 'These credentials do not match our records.']);
      }

    }
  
     }


     public function add_employee(Request $request)
     {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'phone_number' => 'required|max:10|unique:users',
            'dob' => 'required',
            'a' => 'required',
            'employee_id' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'job_title' => 'required',
            'employee_type' => 'required',
            'date_of_joining' => 'required',
            'ctc' => 'required',
            'bank_name' => 'required',
            'city' => 'required',
            'branch_name' => 'required',
            'ifsc_code' => 'required',
            'account_number' => 'required',



        ]);
        
        $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) 
    {
      return response()->json(['status' => false,'message' => $validator->errors()->first()]);
    }
    else
    {


        $user = new \App\User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->phone_number  = $request->phone_number;
        $user->role = "employee";
        $user->save();
       


        $employee_info = new \App\EmployeeInformation;
        $employee_info->user_id = $user->id;
        $employee_info->dob = $request->dob;
        $employee_info->gender = $request->a;
        $employee_info->employee_id  = $request->employee_id;
        $employee_info->department = $request->department;
        $employee_info->designation = $request->designation;
        $employee_info->job_title = $request->job_title;
        $employee_info->employee_type = $request->employee_type;
        $employee_info->date_of_joining = $request->date_of_joining;
        $employee_info->save();

        $employee_account = new \App\EmployeeAccount;
        $employee_account->user_id = $user->id;
        $employee_account->ctc     = $request->ctc;
        $employee_account->bank_name  = $request->bank_name;
        $employee_account->city = $request->city;
        $employee_account->branch_name = $request->branch_name;
        $employee_account->ifsc_code = $request->ifsc_code;
        $employee_account->account_number  = $request->account_number;
        $employee_account->save();


           
        if ($employee_account->save()) {
            return response()->json(['status' => true,'message' => 'Employee Added Successfully.', 'user_id'=> $user_id, 'payload'=>$user]);
        }
        else{

        return response()->json(['status' => false,'message' => 'Something went wrong.']);
        }
    }




     }













     










}
