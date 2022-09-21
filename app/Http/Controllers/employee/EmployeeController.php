<?php

namespace App\Http\Controllers\employee;
use App\Http\Controllers\Controller;
use Auth;
use DateTime;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function log_in_time()
    {
        $is_valid = \App\EmployeeAttendance::where('employee_id',Auth::id())->where('date',(new DateTime)->format('Y-m-d'))->where('end_time',null)->first();
        if(!$is_valid){
            // $check = \App\EmployeeAttendance::where('date',(new DateTime)->format('Y-m-d'))
            $employee = new \App\EmployeeAttendance;
            $employee->employee_id = Auth::id();
            $employee->start_time = (new DateTime)->format('H:i:s');
            $employee->date = (new DateTime)->format('Y-m-d');
            if($employee->save()){               
                return response()->json(['status' => true,'message' => \Carbon\Carbon::parse($employee->start_time)->format('g:i A')]);
            }
            else{
                return response()->json(['status' => false,'message' => ' Something went wrong']);

            }
        }

    }

    public function default_log_in_time(){
        $default_time = \App\EmployeeAttendance::where('employee_id',Auth::id())->where('date',(new DateTime)->format('Y-m-d'))->latest()->first();
        if(isset($default_time) && !is_null($default_time) && !empty($default_time)){
            if(!is_null($default_time->start_time)){
                $log_in_time = \Carbon\Carbon::parse($default_time->start_time)->format('g:i A');
            }
            else{
                $log_in_time = null;
            }
            if(!is_null($default_time->end_time)){
                $log_out_time = \Carbon\Carbon::parse($default_time->end_time)->format('g:i A');
            }
            else{
                $log_out_time = null;
            }
            if(!is_null($default_time->start_time) && !is_null($default_time->end_time)){
                $endTime = strtotime($default_time->end_time);
                $startTime = strtotime($default_time->start_time);
                
                $init = $endTime - $startTime;
                $hours = floor($init / 3600);
                $hour = (int) ($hours);
                $minutes = floor(($init / 60) % 60);
                $minute = (int) ($minutes);
                if($hour !== 0 ){
                    $total = $hours."hrs".$minute."min";
                }else{
                    $total = $minute." min";
                }
            }
            else {
                $total = "Pending";
            }
            return response()->json(['status' => true,'logIn' => $log_in_time,'logOut' => $log_out_time,'total' => $total]);
        }
        else{
            return response()->json(['status' => false,'message' => 'Something went wrong']);

        }
    }

    public function log_out_time(){
        $can_logout = \App\DailyActivity::where('employee_id',Auth::id())->whereDate('created_at', \Carbon\Carbon::today())->whereNotNull('start_time')->latest()->first();
        if($can_logout && !is_null($can_logout->end_time)){
            $logout = \App\EmployeeAttendance::where('employee_id',Auth::id())->where('date',(new DateTime)->format('Y-m-d'))->whereNotNull('start_time')->whereNull('end_time')->latest()->first();
            if($logout){
                $logout->end_time = (new DateTime)->format('H:i:s');
                if($logout->save()){
                    // Converting time to hours/minutes/seconds..
                    $endTime = strtotime($logout->end_time);
                    $startTime = strtotime($logout->start_time);
                    
                    $init = $endTime - $startTime;
                    $hours = floor($init / 3600);
                    $hour = (int) ($hours);
                    $minutes = floor(($init / 60) % 60);
                    $minute = (int) ($minutes);
                    if($hour !== 0 ){
                        $total = $hours." hrs".$minutes." min";
                    }else{
                        $total = $minutes." min";
                    }
                    
                    return response()->json(['status' => true,'message' => \Carbon\Carbon::parse($logout->end_time)->format('g:i A'), 'total' => $total]);
                }
                else{
                    return response()->json(['status' => false,'message' => ' Something went wrong']);

                }
            }
        }else {
            return response()->json(['status' => false,'message' => false]);
        }
    }

    public function attendance_history(){
        $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereMonth('created_at', \Carbon\Carbon::now()->month)->get();
        return view('employee.attendance_history',compact('my_attendance'));
    }

    public function daily_activity(){
        $is_valid = \App\DailyActivity::where('employee_id',Auth::id())->whereDate('created_at', \Carbon\Carbon::today())->latest()->first();
        if($is_valid){
            if(is_null($is_valid->end_time)){
                $type = 1;
            }
            elseif(!is_null($is_valid->end_time)){
                $type = 2;
            }
            else{

            }
        }
        else{
            $type = 2;
        }
        $total_daily_activity = \App\DailyActivity::where('employee_id',Auth::id())->whereDate('created_at', \Carbon\Carbon::today())->get();
        return view('employee.daily_activity',compact('type','total_daily_activity'));
    }

    public function add_daily_activity(Request $request){
        $daily_activity = new \App\DailyActivity;
        $daily_activity->project_id = $request->project_id;
        $daily_activity->start_time = (new DateTime)->format('H:i:s');
        $daily_activity->employee_id = Auth::id();
        $daily_activity->date = (new DateTime)->format('Y-m-d');
        $daily_activity->description = $request->description;
        if($daily_activity->save()){
            alert()->message('Daily Activity Added Successfully!','Success');
            return redirect()->route('employee.daily_activity');
        }
        else{
            alert()->error('Something Went Wrong');
            return redirect()->route('employee.daily_activity');
        }
    }

    public function finish_daily_activity(){
        $finish_activity = \App\DailyActivity::where('employee_id',Auth::id())->whereDate('created_at', \Carbon\Carbon::today())->latest()->first();
        $finish_activity->end_time = (new DateTime)->format('H:i:s');
        if($finish_activity->save()){
            alert()->success('Daily Activity Finished Successfully!','Success');
            return redirect()->route('employee.daily_activity');
        }
        else{
            alert()->error('Something Went Wrong');
            return redirect()->route('employee.daily_activity');
        }
    }

    public function all_daily_activities(){
        $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereMonth('created_at', \Carbon\Carbon::now()->month)->get();
        return view('employee.all_daily_activities',compact('all_daily_activities'));
    }

    public function attendance_filter(Request $request){
        $year = $request->year;
        if(!empty($request->month)){
            $umonth = $request->month;
            $month = date("m", strtotime($umonth));
        }
        if(!empty($request->date)){
            $date = date("Y-m-d", strtotime($request->date));
        }
     
        if(!empty($year) && !empty($month) && !empty($date)){
             $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereYear('created_at',$year)->whereMonth('created_at', $month)->whereDate('created_at',$date)->get();
        }
        elseif(!empty($year) && !empty($month) && empty($date)){
             $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereYear('created_at',$year)->whereMonth('created_at', $month)->get();
        }
        elseif(!empty($year) && empty($month) && empty($date)){
             $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereYear('created_at',$year)->get();
        }
        elseif(!empty($year) && empty($month) && !empty($date)){
             $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereYear('created_at',$year)->whereDate('created_at',$date)->get();
        }
        elseif(empty($year) && !empty($month) && !empty($date)){
             $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereMonth('created_at', $month)->whereDate('created_at',$date)->get();
        }
        elseif(empty($year) && !empty($month) && empty($date)){
            $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereMonth('created_at', $month)->get();
        }
        elseif(empty($year) && empty($month) && !empty($date)){
             $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereDate('created_at',$date)->get();
        }
        else{
            $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereMonth('created_at', \Carbon\Carbon::now()->month)->get();
        }

        return view('employee.attendance_history',compact('my_attendance'));
    }


    public function activity_filter(Request $request){
        $year = $request->year;
        if(!empty($request->month)){
            $umonth = $request->month;
            $month = date("m", strtotime($umonth));
        }
        if(!empty($request->date)){
            $date = date("Y-m-d", strtotime($request->date));
        }
     
        if(!empty($year) && !empty($month) && !empty($date)){
             $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereYear('created_at',$year)->whereMonth('created_at', $month)->whereDate('created_at',$date)->get();
        }
        elseif(!empty($year) && !empty($month) && empty($date)){
             $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereYear('created_at',$year)->whereMonth('created_at', $month)->get();
        }
        elseif(!empty($year) && empty($month) && empty($date)){
             $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereYear('created_at',$year)->get();
        }
        elseif(!empty($year) && empty($month) && !empty($date)){
             $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereYear('created_at',$year)->whereDate('created_at',$date)->get();
        }
        elseif(empty($year) && !empty($month) && !empty($date)){
             $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereMonth('created_at', $month)->whereDate('created_at',$date)->get();
        }
        elseif(empty($year) && !empty($month) && empty($date)){
            $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereMonth('created_at', $month)->get();
        }
        elseif(empty($year) && empty($month) && !empty($date)){
             $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereDate('created_at',$date)->get();
        }
        else{
            $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereMonth('created_at', \Carbon\Carbon::now()->month)->get();
        }

        return view('employee.all_daily_activities',compact('all_daily_activities'));
    }

}

