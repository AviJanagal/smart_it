<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $total_employees = \App\User::where('role', 'employee')->count();
        $total_clients = \App\Client::count();
        $total_projects = \App\Project::count();

        $employee = \App\User::where('role', 'employee')->orderBy('id', 'desc')->paginate(6);
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


        $projects = \App\ProjectAssign::whereNull('deadline')->orderBy('id','desc')->paginate(6);
        $get_projects = \App\Project::orderBy('id','desc')->get();
        foreach($projects as $data)
        {
            $project = \App\Project ::find($data->project_id);
            $data->project_name = $project->project_name;

            $developer = \App\User::where('role','employee')->find($data->developer_id);
            $data->first_name = $developer->first_name.' '.$developer->last_name;
            $data->email = $developer->email;
        }


        


       //return  $current_date;
        $employee_leaves = \App\ApplyLeave::where('start_date', '<=', $current_date)->where('end_date', '>=', $current_date)->where('status','1')->orderBy('start_date','asc')->paginate(6);
        foreach($employee_leaves as $item)
        {
            $item->employee = \App\User::where('role', 'employee')->where('id',$item->employee_id )->first();

        }

          $employee_present = \App\User::where('role', 'employee')->orderBy('id', 'desc')->pluck('id')->toArray();
          $absent_employees = \App\EmployeeAttendance::where('date',$current_date)->whereNotNull('start_time')->orderBy('id','desc')->pluck('employee_id')->toArray();
        
           $array_diff= array_diff($employee_present, $absent_employees);
            $item = array_values($array_diff);

           $employee_absent = \App\User::where('role', 'employee')->whereIn('id',$item)->get();


        return view('superadmin/dashboard',compact('total_employees','total_clients','total_projects','employee','current_date','projects','get_projects','employee_leaves','employee_absent','array_diff','item'));


    }
}
