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


        return view('superadmin/dashboard',compact('total_employees','total_clients','total_projects','employee','current_date'));





    }
}
