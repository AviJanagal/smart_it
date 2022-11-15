<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\otp;
use DB;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Carbon\Carbon;



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
    $get_superadmin = \App\User::where('role', 'admin')->get();
    if ($get_superadmin) {
      return response()->json(['status' => true, 'payload' =>  $get_superadmin]);
    } else {
      return response()->json(['status' => true, 'payload' => [], 'message' => 'No Data found']);
    }
  }


  public function get_employee()
  {
    $get_employee = \App\User::where('role', 'employee')->with('emp_info')->with('emp_account')->get();
    if ($get_employee) {
      return response()->json(['status' => true, 'payload' => $get_employee]);
    } else {
      return response()->json(['status' => true, 'payload' => [], 'message' => 'No Data found']);
    }
  }



  public function get_single_emp(Request $request)
  {
    $user = \App\User::where('role', 'employee')->with('emp_info')->with('emp_account')->find($request->id);
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
      if ($request->has('image')) {
        $image = $request->file('image');
        $img_ext = $image->getClientOriginalName();
        $filename = 'service-image-' . time() . '.' . $img_ext;
        $filePath = '/images/smart-it/' . $filename;
        Storage::disk('s3')->put($filePath, file_get_contents($image));
        $url = config('services.base_url') . "/images/smart-it/" . $filename;
        $employee_info->image =  $url;
      }
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

    $user = \App\User::find($request->id);
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
      if ($request->has('image')) {
        $image = $request->file('image');
        $img_ext = $image->getClientOriginalName();
        $filename = 'service-image-' . time() . '.' . $img_ext;
        $filePath = '/images/smart-it/' . $filename;
        Storage::disk('s3')->put($filePath, file_get_contents($image));
        $url = config('services.base_url') . "/images/smart-it/" . $filename;
        $user->emp_info->image =  $url;
      }
      $user->emp_info->employee_type = $request->employee_type;
      $user->emp_info->date_of_joining = $request->date_of_joining;
      $user->emp_info->save();
      $user->emp_account->ctc = $request->ctc;
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
    $del_emp = \App\User::where('role', 'employee')->find($request->id);

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

    foreach($get_project as $data)
    {
      
      $clients = \App\Client::where('id',$data->client)->first();
      if(!is_null ($clients))
      {
        $data->client = $clients->name;
      }
    }
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


      foreach( $request->developer_id as $val)
      {
        $project = new \App\ProjectAssign;
        $project->project_id = $request->project_id;
        $project->developer_id = $val;
        $project->save();

      }


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
    foreach($get_project as $data)
    {
      $projects = \App\Project::where('id',$data->project_id)->first();
      $data->project_id = $projects->project_name;
      $developers = \App\User::where('role', 'employee')->where('id',$data->developer_id)->first();
      $data->developer_id =   $developers->first_name . ' ' . $developers->last_name;

    }
    if ($get_project) {
      return response()->json(['status' => true, 'payload' =>  $get_project]);
    } else {
      return response()->json(['status' => true, 'payload' => [], 'message' => 'No Data found']);
    }
  }


  public function add_department(Request $request)
  {
    $rules = [
      'name' => 'required',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    } else {
      $department = new \App\Department;
      $department->name = $request->name;
      if ($department->save()) {
        return response()->json(['status' => true, 'message' => 'Department Added Successfully.', 'department_id' => $department->id, 'payload' => $department]);
      } else {
        return response()->json(['status' => false, 'message' => 'Something went wrong.']);
      }
    }
  }


  public function edit_department(Request $request)
  {
    $department =  \App\Department::find($request->id);
    $rules = [
      'name' => 'required',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    } else {
      $department->name = $request->name;
      if ($department->save()) {
        return response()->json(['status' => true, 'message' => 'Depaartment Updated Successfully.', 'department_id' => $department->id, 'payload' => $department]);
      } else {
        return response()->json(['status' => false, 'message' => 'Something went wrong.']);
      }
    }
  }


  public function get_departments()
  {
    $get_department = \App\Department::get();
    if ($get_department) {
      return response()->json(['status' => true, 'payload' =>  $get_department]);
    } else {
      return response()->json(['status' => true, 'payload' => [], 'message' => 'No Data found']);
    }
  }



  public function delete_department(Request $request)
  {
    $del_department = \App\Department::find($request->id);

    if (!is_null($del_department)) :
      $del_department->delete();
      return response()->json(['status' => true, 'message' => 'Department Deleted Successfully.']);
    else :
      return response()->json(['status' => false, 'message' => 'Data Not Found.']);
    endif;
  }



  public function show_employee_leaves()
  {

    $employee_leaves = \App\ApplyLeave::orderBy('start_date', 'asc')->get();
    foreach ($employee_leaves as $item) {
      $item->employee = \App\User::where('role', 'employee')->where('id', $item->employee_id)->first();
    }
    if (!is_null($employee_leaves)) :
      return response()->json(['status' => true, 'payload' =>  $employee_leaves]);
    else :
      return response()->json(['status' => false, 'message' => 'Data Not Found.']);
    endif;
  }


  public function leave_approvel(Request $request)
  {
    $data = \App\ApplyLeave::where('employee_id', $request->employee_id)->first();
    $data->status = $request->status;
    $data->update();
    return response()->json(['status' => true, 'message' => 'Status Updated Successfully.']);
  }

  
  public function add_holiday(Request $request)
  {
    $rules = [
      'title' => 'required',
      'date' => 'required',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    } else {
      $holiday = new \App\Calender;
      $holiday->title = $request->title;
      $holiday->date = $request->date;
      if ($holiday->save()) {
        return response()->json(['status' => true, 'message' => 'Holiday Added Successfully.', 'holiday_id' => $holiday->id, 'payload' => $holiday]);
      } else {
        return response()->json(['status' => false, 'message' => 'Something went wrong.']);
      }
    }
  }


  public function edit_holiday(Request $request)
  {
    $holiday =  \App\Calender::find($request->id);
    $rules = [
      'title' => 'required',
      'date' => 'required',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    } else {
      $holiday->title = $request->title;
      $holiday->date = $request->date;
      if ($holiday->save()) {
        return response()->json(['status' => true, 'message' => 'Holiday Updated Successfully.', 'holiday_id' => $holiday->id, 'payload' => $holiday]);
      } else {
        return response()->json(['status' => false, 'message' => 'Something went wrong.']);
      }
    }
  }


  public function get_holidays()
  {
    $get_holidays = \App\Calender::get();
    if ($get_holidays) {
      return response()->json(['status' => true, 'payload' =>  $get_holidays]);
    } else {
      return response()->json(['status' => true, 'payload' => [], 'message' => 'No Data found']);
    }
  }



  public function delete_holidays(Request $request)
  {
    $del_holiday = \App\Calender::find($request->id);
    if (!is_null($del_holiday)) :
      $del_holiday->delete();
      return response()->json(['status' => true, 'message' => 'Holiday Deleted Successfully.']);
    else :
      return response()->json(['status' => false, 'message' => 'Data Not Found.']);
    endif;
  }


  public function dashboard(Request $request)
  {
    $total_employees = \App\User::where('role', 'employee')->count();
    $total_clients = \App\Client::count();
    $total_projects = \App\Project::count();
    $employee = \App\User::where('role', 'employee')->orderBy('id', 'desc')->get();
    $current_date = Carbon::now('Asia/Kolkata')->format('Y-m-d');
    foreach ($employee as $data)
    {
        $emp_activity = \App\DailyActivity::where('employee_id', $data->id)->orderBy('id', 'desc')->first();
        $employee_status = \App\DailyActivity::where('employee_id', $data->id)->where('date', $current_date)->whereNotNull('end_time')->orderBy('id', 'desc')->first();
        if (!is_null($emp_activity)) { 
            if (!is_null($employee_status)) {
                $data->emp_status = "Available";
            } else {
                $data->emp_status = "Not Available";
            }
        }
        else{
            $data->emp_status = "Available";
        }
    }
      $projects = \App\ProjectAssign::whereNull('deadline')->orderBy('id','desc')->get();
        $get_projects = \App\Project::orderBy('id','desc')->get();
        foreach($projects as $data)
        {
            $project = \App\Project ::find($data->project_id);
            $data->project_name = $project->project_name;
            $developer = \App\User::where('role','employee')->find($data->developer_id);
            {
                if(!is_null($developer) && !is_null($developer->emp_info) && !is_null($developer->emp_info->image))
                {
                    $data->id = $developer->id;
                    $data->first_name = $developer->first_name.' '.$developer->last_name;
                    $data->email = $developer->email;
                    $data->image = $developer->emp_info->image;
                }
            }
        }
        $employee_leaves = \App\Leave::where('date',$current_date)->orderBy('id','desc')->get();
        foreach($employee_leaves as $item)
      {
          $item->employee = \App\User::where('role', 'employee')->where('id',$item->employee_id )->first();
      }
          $employee_present = \App\User::where('role', 'employee')->orderBy('id', 'desc')->pluck('id')->toArray();
          $absent_employees = \App\EmployeeAttendance::where('date',$current_date)->whereNotNull('start_time')->orderBy('id','desc')->pluck('employee_id')->toArray();
           $array_diff= array_diff($employee_present, $absent_employees);
           $item = array_values($array_diff);
           $employee_absent = \App\User::where('role', 'employee')->whereIn('id',$item)->get();

           $array = array(['available_employee' =>$employee ,'emp_work_on_projects' => $projects, 'employees_on_leave' => $employee_leaves, 'absent_employees' => $employee_absent]);
    if($employee)
    {
      return response()->json(['status' => true,'Total_employees' => $total_employees,'Total_clients' => $total_clients, 'Total_projects' => $total_projects, 'payload' => $array]);
    }
    else{
      return response()->json(['status' => true, 'payload' => [], 'message' => 'No Data found']);
  }
  }

  public function add_leaves(Request $request)
  {
    $rules = [
      'employee_id' => 'required',
      'date' => 'required',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()){
      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    } else{
       
      foreach($request->employee_id as $val)
      {
        $leave = new \App\Leave;
        $leave->employee_id = $val;
        $leave->date = $request->date;
        $leave->save();
      }
      if ($leave->save()) {
        return response()->json(['status' => true, 'message' => 'Leave Added Successfully.', 'leave_id' => $leave->id, 'payload' => $leave]);
      } else {
        return response()->json(['status' => false, 'message' => 'Something went wrong.']);
      }
    }
  }


  public function edit_leave(Request $request)
  {
    $leave =  \App\Leave::find($request->id);
    $rules =[
      'employee_id' => 'required',
      'date' => 'required',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    } else {
      $leave->employee_id = $request->employee_id;
      $leave->date = $request->date;
      if ($leave->save()) {
        return response()->json(['status' => true, 'message' => 'Leave Updated Successfully.', 'holiday_id' => $leave->id, 'payload' => $leave]);
      } else {
        return response()->json(['status' => false, 'message' => 'Something went wrong.']);
      }
    }
  }


  public function get_leaves()
  {
    $get_leaves = \App\Leave::get();
    foreach($get_leaves as $data)
    {
       $employee = \App\User::where('role', 'employee')->where('id', $data->employee_id)->first();
       $data->employee_id =  $employee->first_name." ".$employee->last_name;
    }
    if ($get_leaves){
      return response()->json(['status' => true, 'payload' =>  $get_leaves]);
    } else {
      return response()->json(['status' => true, 'payload' => [], 'message' => 'No Data found']);
    }
  }



  public function delete_leaves(Request $request)
  {
    $del_leave =  \App\Leave::find($request->id);
    if (!is_null($del_leave)) :
      $del_leave->delete();
      return response()->json(['status' => true, 'message' => 'Leave Deleted Successfully.']);
    else :
      return response()->json(['status' => false, 'message' => 'Data Not Found.']);
    endif;
  }
  }



















