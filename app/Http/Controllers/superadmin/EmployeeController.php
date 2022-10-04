<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Support\Facades\Auth;




class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        $type = 1;
        $get_department = \App\Department::get();
        return view('superadmin/employee/add_employee', compact('type','get_department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         
        $employee = \App\User::where('role', 'employee')->orderBy('id', 'desc')->get();
        $current_date = Carbon::now('Asia/Kolkata')->format('Y-m-d');
        foreach ($employee as $data) {

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

        return view('superadmin/employee/show_employee', compact('employee', 'current_date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'phone_number' => 'required|max:10|unique:users',
        ]);



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

            return redirect()->route('admin.employee.create')->with(['alert' => 'success', 'message' => 'Employee Added successfully!.']);
        } else {
            return redirect()->route('admin.employee.create')->with(['alert' => 'danger', 'message' => 'Something Went Wrong!.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $employee = \App\User::find($id);
        if ($employee->delete()) {
            return redirect()->route('admin.employee.create')->with(['alert' => 'success', 'message' => 'Employee Deleted Successfully!.']);
        } else {
            return redirect()->route('admin.employee.create')->with(['alert' => 'danger', 'message' => 'Employee has not been Deleted!.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $type = 2;
        $employee = \App\User::where('role', 'employee')->find($id);
        $get_department = \App\Department::get();
        return view('superadmin/employee/add_employee', compact('type', 'employee','get_department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone_number' => 'required|max:10',
        ]);
        $user = \App\User::where('role', 'employee')->find($id);
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
        $user->emp_account->ctc = $request->ctc;
        $user->emp_account->bank_name  = $request->bank_name;
        $user->emp_account->city = $request->city;
        $user->emp_account->branch_name = $request->branch_name;
        $user->emp_account->ifsc_code = $request->ifsc_code;
        $user->emp_account->account_number  = $request->account_number;
        $user->emp_account->save();
        if ($user->emp_info->save()) {

            return redirect()->route('admin.employee.create')->with(['alert' => 'success', 'message' => 'Employee Updated successfully!.']);
        } else {
            return redirect()->route('admin.employee.create')->with(['alert' => 'danger', 'message' => 'Something Went Wrong!.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //


    }

    public function view_employee($id)
    {
        //
        $employee = \App\User::where('role', 'employee')->find($id);
        $project_assign = \App\ProjectAssign::where('developer_id', $id)->get();

        foreach ($project_assign as $data) {

            $project = \App\Project::find($data->project_id);

            $data->project_name = $project->project_name;
        }

        if(!is_null($employee) && !is_null($employee->emp_info) ){
            $department = \App\Department::find($employee->emp_info->department);
            if(!is_null($department)){
                  $employee->emp_info->department = $department->name;
            }
        }





        // weekly_graph_code

          $week_days = \Carbon\CarbonPeriod::create(\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek());
          $emp_days = [];
        foreach($week_days as $days)
        {
             $emp_act_minutes = \App\DailyActivity::where('employee_id',$employee->id)->where('date',$days)->sum('time_in_minutes');
             $time_in_hours = floor($emp_act_minutes/60) ;   
              array_push($emp_days,[(string)$days->format('l'), $time_in_hours ,"#122f51"]);
                        
        }
        $title_discription = "Weekly Activity Chart";
        $title = "Days";


        return view('superadmin/employee/view_employee', compact('employee', 'project_assign','emp_days','title_discription','title'));
    }


    public function del_emp_assigned_project($id)
    {

        $project_assign = \App\ProjectAssign::find($id);
        if ($project_assign->delete()) {
            return redirect()->back()->with(['alert' => 'success', 'message' => 'Assigned project has been Deleted Successfully!.']);
        } else {
            return redirect()->back('admin.view_employee')->with(['alert' => 'danger', 'message' => 'Assigned project has not been Deleted!.']);
        }

    }

    public function employee_graph(Request $request,$id)
    {
        $employee = \App\User::where('role', 'employee')->find($id);
        if($request->graph_time == "monthly"){
        $monthly_data = \Carbon\CarbonPeriod::create(\Carbon\Carbon::now()->startOfMonth(), \Carbon\Carbon::now()->endOfMonth());
        $emp_days = [];

      foreach($monthly_data as $data)
      {
       
           $emp_act_minutes = \App\DailyActivity::where('employee_id',$employee->id)->whereDate('date',$data)->sum('time_in_minutes');
           $time_in_hours = floor($emp_act_minutes/60) ;   
            array_push($emp_days,[$data->format('Y/m/d'), $time_in_hours ,"#122f51"]);

      }

      $title_discription = "Monthly Attendance Chart";
      $title = "Months";

      
    }

    elseif($request->graph_time == "yearly"){

    }

    else{

        $week_days = \Carbon\CarbonPeriod::create(\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek());
        $emp_days = [];
      foreach($week_days as $days)
      {
       
           $emp_act_minutes = \App\DailyActivity::where('employee_id',$employee->id)->whereDate('date',$days)->sum('time_in_minutes');



           $time_in_hours = floor($emp_act_minutes/60) ;   
            array_push($emp_days,[(string)$days->format('l'), $time_in_hours ,"#122f51"]);
      }
      $title_discription = "Weekly Activity Chart";
      $title = "Days";

    }

      return view('superadmin/employee/view_employee', compact('employee','emp_days','title_discription','title'));


    }


    public function show_department()
    {
        $departments = \App\Department::orderBy('id','desc')->get();
        $type = 1;
        return view('Superadmin/employee/department',compact('departments','type'));

    }

    public function add_department(Request $request)
    {
      $department = new \App\Department;
      $department->name = $request->name;

        if ($department->save())
        {
            return redirect()->route('admin.show_department')->with(['alert' => 'success', 'message' => 'Department has been Added Successfully!.']);
        }
        else
        {
            return redirect()->route('admin.show_department')->with(['alert' => 'danger', 'message' => 'Department has not been Added!.']);
        }
    }

    public function edit_department($id)
    {
        $department =  \App\Department::find($id);
        $departments = \App\Department::orderBy('id','desc')->get();
        $type = 2;
        return view('Superadmin/employee/department',compact('department','departments','type'));
    }

    public function update_department(Request $request, $id)
    {
    
        $department =  \App\Department::find($id);
        $department->name = $request->name;

        if ($department->save())
        {
            return redirect()->route('admin.show_department')->with(['alert' => 'success', 'message' => 'Department has been Updated Successfully!.']);
        }
        else
        {
            return redirect()->route('admin.show_department')->with(['alert' => 'danger', 'message' => 'Department has not been Updated!.']);
        }

    }

    public function delete_department($id)
    {
       //

       $department = \App\Department::find($id);
       if($department->delete())
       {
            return redirect()->route('admin.show_department')->with(['alert' => 'success', 'message' => 'Department has been Deleted Successfully!.']);
       }
       else
       {
            return redirect()->route('admin.show_department')->with(['alert' => 'danger', 'message' => 'Department has not been Deleted!.']);
       }

    }



    public function show_emp_leave(Request $request)
    {

        $employee_leaves = \App\ApplyLeave::orderBy('start_date','asc')->get();
        foreach($employee_leaves as $item)
        {
            $item->employee = \App\User::where('role', 'employee')->where('id',$item->employee_id )->first();

        }

        if ($request->has('view_confirmed_leaves')) {
            $employee_leaves = \App\ApplyLeave::where('status','1')->orderBy('start_date','asc')->get();
            foreach($employee_leaves as $item)
            {
                $item->employee = \App\User::where('role', 'employee')->where('id',$item->employee_id )->first();
    
            }        }







        return view('Superadmin/employee/show_leave',compact('employee_leaves'));

    }


    public function view_emp_leave(Request $request)
    {

        $data = \App\ApplyLeave::where('employee_id',$request->id)->first();
        return response()->json($data, 200);


    }


    
    public function leave_approvel(Request $request)
    {
        $data = \App\ApplyLeave::where('employee_id',$request->employee_id)->first();
        $data->status = $request->id;
        $data->update();
        return response()->json($data, 200);
        
    }







}
