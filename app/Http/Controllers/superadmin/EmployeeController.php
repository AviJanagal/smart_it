<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


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
        return view('superadmin/employee/add_employee', compact('type'));
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

            $employee_status = \App\DailyActivity::where('employee_id', $data->id)->where('date', $current_date)->whereNotNull('end_time')->orderBy('id', 'desc')->first();

            if (!is_null($employee_status)) {
                $data->emp_status = "Available";
            } else {
                $data->emp_status = "Not Available";
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
        return view('superadmin/employee/add_employee', compact('type', 'employee'));
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
        $user->emp_info->gender = $request->a;
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
        return view('superadmin/employee/view_employee', compact('employee', 'project_assign'));
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



    public function emp_graph($id)
    {
        
           $graph_id = \App\User::find($id);
           $complaint_ids = \App\AssignTo::where('user_id', $id)->pluck('complaint_id');
           $complaints = \App\Complaint::whereIn('id', $complaint_ids)->where('status','2')->get();


        $my_array = [];

        foreach($complaints as $data){

            $current_time = Carbon::now('Asia/Kolkata')->toDateTimeString();
            $complaint_assign = \App\AssignTo::where('complaint_id', $data->id)->first();    
    
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $complaint_assign->assign_time);
            $deadline = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $complaint_assign->deadline);


            $diff_in_hours = $to->diffInHours($deadline);

    
            $complete_time = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $data->complete_date);
    
            if( $data->complete_date > $complaint_assign->deadline ){
                $exceed_hours = $complete_time->diffInHours($deadline);
            }else{
                $exceed_hours = 0;
            }            
    
            $data->current_time = $current_time;									
    
            array_push($my_array,[strval($data->id), $diff_in_hours, $exceed_hours ,'']);
                  
        }

        $key = "all";
        $start_week = "";
        $end_week = "";
        return view("departmentGraph", compact('key','my_array','start_week', 'end_week', 'graph_id'));
    }



















}
