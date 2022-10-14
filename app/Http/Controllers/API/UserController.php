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
    if ($validator->fails()) {
      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    } else {
      $user = User::create([
        'first_name' => $req->first_name,
        'last_name' => $req->last_name,
        'email' => $req->email,
        'password' => bcrypt($req->password),
        'phone_number' => $req->phone_number,
        'role' => "admin",
      ]);

      $user['token'] =  $user->createToken($req->email)->accessToken;
      if ($user) {
        return response()->json(['status' => true, 'message' => 'Thanks for registering with us.', 'payload' => $user]);
      } else {
        return response()->json(['status' => false, 'message' => 'Something error while registering! Try after some time!.']);
      }
    }
  }

  public function login(Request $req)
  {
    $rules = ['email' => 'required|string|email', 'password' => 'required|string|min:6',];
    $validator = Validator::make($req->all(), $rules);
    if ($validator->fails()) {
      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    } else {

      if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
        $user = Auth::user();
        $success['token'] =  $user->createToken($req->email)->accessToken;

        //   return response()->json(['success' => $success], 200);
        return response()->json(['status' => true, 'message' => 'Thanks for login with us.', 'payload' => $success]);
      } else {
        return response()->json(['status' => false, 'message' => 'These credentials do not match our records.']);
      }
    }
  }



  public function logout(Request $request)
  {

    $user = \App\User::find($request->user()->id);
    if ($user->save()) {

      $request->user()->token()->revoke();

      return response()->json(['status' => true, 'message' => 'You are successfully logged out!.']);
    } else {
      return response()->json(['status' => false, 'message' => "Something went wrong."]);
    }
  }


  public function get_superadmin()
  {
    $get_superadmin = \App\User::where('role','admin')->get();
    if ($get_superadmin) {
      return response()->json(['status' => true, 'payload' =>  $get_superadmin]);
    } else {
      return response()->json(['status' => true, 'payload' => [], 'message' => 'No Data found']);
    }
  }


  public function get_employee()
  {
    $get_employee = \App\User::where('role','employee')->with('emp_info')->with('emp_account')->get();
    if ($get_employee) {
      return response()->json(['status' => true, 'payload' => $get_employee]);
    } else {
      return response()->json(['status' => true, 'payload' => [], 'message' => 'No Data found']);
    }
  }



  public function get_single_emp(Request $request)
  {

    $user = \App\User::where('role','employee')->with('emp_info')->with('emp_account')->find($request->id);
    if ($user) {
      return response()->json(['status' => true, 'payload' => $user]);
    } else {
      return response()->json(['status' => true, 'payload' => [], 'message' => 'No Data found']);
    }

  }


  public function add_employee(Request $request)
  {

    $rules = [
      'first_name' => 'required',
      'last_name' => 'required',
      'email' => 'required|unique:users',
      'password' => 'required',
      'phone_number' => 'required|max:10|unique:users',
      'dob' => 'required',
      'gender' => 'required',
      'employee_id' => 'required|unique:employee_information',
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
      'account_number' => 'required|unique:employee_accounts',

    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    } else {

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
      $employee_info->gender = $request->gender;
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
        return response()->json(['status' => true, 'message' => 'Employee Added Successfully.', 'user_id' => $user->id, 'payload' => $user, $employee_info, $employee_account]);
      } else {

        return response()->json(['status' => false, 'message' => 'Something went wrong.']);
      }
    }
  }


  public function edit_employee(Request $request)
  {

    $user = \App\User::find($request->user()->id);

    $rules = [
      'first_name' => 'required',
      'last_name' => 'required',
      'email' => 'required',
      'password' => 'required',
      'phone_number' => 'required|max:10|',
      'dob' => 'required',
      'gender' => 'required',
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

    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    } else {

      $user->first_name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->email = $request->email;
      $user->password = \Hash::make($request->password);
      $user->phone_number  = $request->phone_number;
      $user->role = "employee";
      $user->save();
      $user->emp_info->dob = $request->dob;
      $user->emp_info->gender = $request->gender;
      $user->emp_info->employee_id  = $request->employee_id;
      $user->emp_info->department = $request->department;
      $user->emp_info->designation = $request->designation;
      $user->emp_info->job_title = $request->job_title;
      $user->emp_info->employee_type = $request->employee_type;
      $user->emp_info->date_of_joining = $request->date_of_joining;
      $user->emp_info->save();
      $user->emp_account->ctc     = $request->ctc;
      $user->emp_account->bank_name  = $request->bank_name;
      $user->emp_account->city = $request->city;
      $user->emp_account->branch_name = $request->branch_name;
      $user->emp_account->ifsc_code = $request->ifsc_code;
      $user->emp_account->account_number  = $request->account_number;
      $user->emp_account->save();
    }

    if (!is_null($user)) :
      return response()->json(['status' => true, 'message' => 'Empoyee updated successfully.']);
    else :
      return response()->json(['status' => false, 'message' => 'Employee not found.']);
    endif;
  }


  public function delete_employee(Request $request)
  {
    $del_emp = \App\User::where('role', 'employee')->find($request->user()->id);

    if (!is_null($del_emp)) :
      $del_emp->delete();
      return response()->json(['status' => true, 'message' => 'Employee Deleted Successfully.']);
    else :
      return response()->json(['status' => false, 'message' => 'Data Not Found.']);
    endif;
  }




  public function add_client(Request $request)
  {

    $rules = [
      'name' => 'required',
      'email' => 'required|unique:users',

    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    } else {

      $client = new \App\Client;
      $client->name = $request->name;
      $client->email = $request->email;
      if ($client->save()) {
        return response()->json(['status' => true, 'message' => 'Client Added Successfully.', 'client_id' => $client->id, 'payload' => $client]);
      } else {

        return response()->json(['status' => false, 'message' => 'Something went wrong.']);
      }
    }
  }


  public function edit_client(Request $request)
  {

    $client =  \App\Client::find($request->id);


    $rules = [
      'name' => 'required',
      'email' => 'required',

    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    } else {

      $client->name = $request->name;
      $client->email = $request->email;
      if ($client->save()) {
        return response()->json(['status' => true, 'message' => 'Client Updated Successfully.', 'client_id' => $client->id, 'payload' => $client]);
      } else {

        return response()->json(['status' => false, 'message' => 'Something went wrong.']);
      }
    }
  }



  public function delete_client(Request $request)
  {
    $del_client = \App\Client::find($request->id);

    if (!is_null($del_client)) :
      $del_client->delete();
      return response()->json(['status' => true, 'message' => 'Client Deleted Successfully.']);
    else :
      return response()->json(['status' => false, 'message' => 'Data Not Found.']);
    endif;
  }





  public function get_clients()
  {
    $get_client = \App\Client::get();
    if ($get_client) {
      return response()->json(['status' => true, 'payload' =>  $get_client]);
    } else {
      return response()->json(['status' => true, 'payload' => [], 'message' => 'No Data found']);
    }
  }



  public function add_project(Request $request)
  {

    $rules = [
      'project_name' => 'required',
      'client' => 'required',

    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    } else {

      $project = new \App\Project;
      $project->project_name = $request->project_name;
      $project->client = $request->client;

      if ($project->save()) {
        return response()->json(['status' => true, 'message' => 'Project Added Successfully.', 'project_id' => $project->id, 'payload' => $project]);
      } else {

        return response()->json(['status' => false, 'message' => 'Something went wrong.']);
      }
    }
  }




  public function edit_project(Request $request)
  {

    $project =  \App\Project::find($request->id);


    $rules = [
      'project_name' => 'required',
      'client' => 'required',

    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    } else {
      $project->project_name = $request->project_name;
      $project->client = $request->client;
      if ($project->save()) {
        return response()->json(['status' => true, 'message' => 'Project Updated Successfully.', 'project_id' => $project->id, 'payload' => $project]);
      } else {

        return response()->json(['status' => false, 'message' => 'Something went wrong.']);
      }
    }
  }



  public function delete_project(Request $request)
  {
    $del_project = \App\Project::find($request->id);

    if (!is_null($del_project)) :
      $del_project->delete();
      return response()->json(['status' => true, 'message' => 'Project Deleted Successfully.']);
    else :
      return response()->json(['status' => false, 'message' => 'Data Not Found.']);
    endif;
  }




  public function get_projects()
  {
    $get_project = \App\Project::get();
    if ($get_project) {
      return response()->json(['status' => true, 'payload' =>  $get_project]);
    } else {
      return response()->json(['status' => true, 'payload' => [], 'message' => 'No Data found']);
    }
  }






  public function add_project_assign(Request $request)
  {
    $rules = [
      'project_id' => 'required',
      'developer_id' => 'required',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    } else {

      $project = new \App\ProjectAssign;
      $project->project_id = $request->project_id;
      $project->developer_id = $request->developer_id;

      if ($project->save()) {
        return response()->json(['status' => true, 'message' => 'Project Assigned Successfully.', 'project_assign_id' => $project->id, 'payload' => $project]);
      } else {

        return response()->json(['status' => false, 'message' => 'Something went wrong.']);
      }
    }
  }



  public function delete_project_assign(Request $request)
  {
    $del_project = \App\ProjectAssign::find($request->id);

    if (!is_null($del_project)) :
      $del_project->delete();
      return response()->json(['status' => true, 'message' => 'Assigned Project Deleted Successfully.']);
    else :
      return response()->json(['status' => false, 'message' => 'Data Not Found.']);
    endif;
  }



  public function get_projects_assigned()
  {
    $get_project = \App\ProjectAssign::get();
    if ($get_project) {
      return response()->json(['status' => true, 'payload' =>  $get_project]);
    } else {
      return response()->json(['status' => true, 'payload' => [], 'message' => 'No Data found']);
    }
  }


}
