<?php

namespace App\Http\Controllers\employee;
use App\Http\Controllers\Controller;
use App\Mail\ApplyLeaveMail;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use PDF,DB,DateTime,DateInterval,DatePeriod,Mail,Auth;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
   
    public function index()
    {
        return view('employee.dashboard');

    }

    public function log_in_time()
    {
        $is_valid = \App\EmployeeAttendance::where('employee_id',Auth::id())->where('date',(new DateTime)->format('Y-m-d'))->where('end_time',null)->first();
        if(!$is_valid){
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
                        $total = $hours."hrs".$minutes."min";
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
        $month_status = date('F');
        return view('employee.attendance_history',compact('my_attendance','month_status'));
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
        $startTime = strtotime($finish_activity->start_time);
        $endTime = strtotime($finish_activity->end_time);
        $finish_activity->time_in_minutes = floor(round(abs($endTime - $startTime) / 60,2));
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
        $total_mins = \App\DailyActivity::where('employee_id',Auth::id())->whereMonth('created_at', \Carbon\Carbon::now()->month)->where('project_id','!=',0)->sum('time_in_minutes');
        $month_status = date('F');
        $hours = floor($total_mins/60) ;
        $minute = $total_mins%60 ;

        if($hours == 0){
            $total_time =  $minute." min";
        }
        else{
            $total_time = $hours." hour". $minute." min";
        }
        return view('employee.all_daily_activities',compact('all_daily_activities','total_time','month_status'));
    }

    public function attendance_filter(Request $request){
        $year = $request->year;
        (!empty($request->month))?  $month = date("m", strtotime($request->month)):  $month = "" ;
        (!empty($request->date))? $date = date("Y-m-d", strtotime($request->date)) : $date = "" ;
       
        $my_attendance = \App\EmployeeAttendance::select("*")
            ->when(!empty($year), function ($query) use ($year) {
                $query->where('employee_id',Auth::id())->whereYear('created_at',$year)->get();
            })
            ->when(!empty($month), function ($query) use ($month) {
                $query->where('employee_id',Auth::id())->whereMonth('created_at', $month)->get();
            })
            ->when(!empty($date), function ($query) use ($date) {
                $query->where('employee_id',Auth::id())->whereDate('created_at',$date)->get();
            })
            ->get();
     
        // if(!empty($year) && !empty($month) && !empty($date)){
        //      $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereYear('created_at',$year)->whereMonth('created_at', $month)->whereDate('created_at',$date)->get();
        // }
        // elseif(!empty($year) && !empty($month) && empty($date)){
        //      $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereYear('created_at',$year)->whereMonth('created_at', $month)->get();
        // }
        // elseif(!empty($year) && empty($month) && empty($date)){
        //      $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereYear('created_at',$year)->get();
        // }
        // elseif(!empty($year) && empty($month) && !empty($date)){
        //      $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereYear('created_at',$year)->whereDate('created_at',$date)->get();
        // }
        // elseif(empty($year) && !empty($month) && !empty($date)){
        //      $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereMonth('created_at', $month)->whereDate('created_at',$date)->get();
        // }
        // elseif(empty($year) && !empty($month) && empty($date)){
        //     $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereMonth('created_at', $month)->get();
        // }
        // elseif(empty($year) && empty($month) && !empty($date)){
        //      $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereDate('created_at',$date)->get();
        // }
        // else{
        //     $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereMonth('created_at', \Carbon\Carbon::now()->month)->get();
        // }
        $year_status = $request->year;
        $month_status = $request->month;
        $date_status = $request->date;

        return view('employee.attendance_history',compact('my_attendance','month_status','date_status','year_status'));
    }


    public function activity_filter(Request $request){
        $year = $request->year;
        (!empty($request->month))?  $month = date("m", strtotime($request->month)):  $month = "" ;
        (!empty($request->date))? $date = date("Y-m-d", strtotime($request->date)) : $date = "" ;

        // return $all_daily_activities = \App\DailyActivity::select(DB::raw("daily_activities.* "))
        //     ->when(!empty($year), function ($query) use ($year) {
        //         $query->where('employee_id',Auth::id())->whereYear('created_at',$year)->get();
        //     })
        //     ->when(!empty($month), function ($query) use ($month) {
        //         $query->where('employee_id',Auth::id())->whereMonth('created_at', $month)->get();
        //     })
        //     ->when(!empty($date), function ($query) use ($date) {
        //         $query->where('employee_id',Auth::id())->whereDate('created_at',$date)->get();
        //     })
        //     ->sum('time_in_minutes');

        //     $total_mins = \App\DailyActivity::select("*")
        //     ->when(!empty($year), function ($query) use ($year) {
        //         $query->where('employee_id',Auth::id())->whereYear('created_at',$year)->where('project_id','!=',0)->sum('time_in_minutes');
        //     })
        //     ->when(!empty($month), function ($query) use ($month) {
        //         $query->where('employee_id',Auth::id())->whereMonth('created_at', $month)->where('project_id','!=',0)->sum('time_in_minutes');
        //     })
        //     ->when(!empty($date), function ($query) use ($date) {
        //         $query->where('employee_id',Auth::id())->whereDate('created_at',$date)->where('project_id','!=',0)->sum('time_in_minutes');
        //     })
        //     ->where('project_id','!=',0)->sum('time_in_minutes');

     
     
        if(!empty($year) && !empty($month) && !empty($date)){
             $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereYear('created_at',$year)->whereMonth('created_at', $month)->whereDate('created_at',$date)->get();
             $total_mins = \App\DailyActivity::where('employee_id',Auth::id())->whereYear('created_at',$year)->whereMonth('created_at', $month)->whereDate('created_at',$date)->where('project_id','!=',0)->sum('time_in_minutes');
        }
        elseif(!empty($year) && !empty($month) && empty($date)){
             $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereYear('created_at',$year)->whereMonth('created_at', $month)->get();
             $total_mins = \App\DailyActivity::where('employee_id',Auth::id())->whereYear('created_at',$year)->whereMonth('created_at', $month)->where('project_id','!=',0)->sum('time_in_minutes');
        }
        elseif(!empty($year) && empty($month) && empty($date)){
             $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereYear('created_at',$year)->get();
             $total_mins = \App\DailyActivity::where('employee_id',Auth::id())->whereYear('created_at',$year)->where('project_id','!=',0)->sum('time_in_minutes');
        }
        elseif(!empty($year) && empty($month) && !empty($date)){
             $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereYear('created_at',$year)->whereDate('created_at',$date)->get();
             $total_mins = \App\DailyActivity::where('employee_id',Auth::id())->whereYear('created_at',$year)->whereDate('created_at',$date)->where('project_id','!=',0)->sum('time_in_minutes');
        }
        elseif(empty($year) && !empty($month) && !empty($date)){
             $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereMonth('created_at', $month)->whereDate('created_at',$date)->get();
             $total_mins = \App\DailyActivity::where('employee_id',Auth::id())->whereMonth('created_at', $month)->whereDate('created_at',$date)->where('project_id','!=',0)->sum('time_in_minutes');
        }
        elseif(empty($year) && !empty($month) && empty($date)){
            $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereMonth('created_at', $month)->get();
            $total_mins = \App\DailyActivity::where('employee_id',Auth::id())->whereMonth('created_at', $month)->where('project_id','!=',0)->sum('time_in_minutes');
        }
        elseif(empty($year) && empty($month) && !empty($date)){
             $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereDate('created_at',$date)->get();
             $total_mins = \App\DailyActivity::where('employee_id',Auth::id())->whereDate('created_at',$date)->where('project_id','!=',0)->sum('time_in_minutes');
        }
        else{
            $all_daily_activities = \App\DailyActivity::where('employee_id',Auth::id())->whereMonth('created_at', \Carbon\Carbon::now()->month)->get();
            $total_mins = \App\DailyActivity::where('employee_id',Auth::id())->whereMonth('created_at', \Carbon\Carbon::now()->month)->where('project_id','!=',0)->sum('time_in_minutes');
        }
        $year_status = $request->year;
        $month_status = $request->month;
        $date_status = $request->date;
        $hours = floor($total_mins/60) ;
        $minute = $total_mins%60 ;

        if($hours == 0 ){
            $total_time =  $minute." min";
        }
        else{
            $total_time = $hours." hour". $minute." min";
        }

        return view('employee.all_daily_activities',compact('all_daily_activities','month_status','date_status','year_status','total_time'));
    }

    public function graphs(){
        $week_dates = \Carbon\CarbonPeriod::create(\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek());
        $result = [];
        foreach($week_dates as $date){
          $minutes = \App\DailyActivity::where('employee_id',Auth::id())->whereDate('created_at',$date)->where('project_id','!=',0)->sum('time_in_minutes');
          $hours = floor($minutes/60) ;
          $minutes = $minutes%60 ;
          array_push($result,[(string)$date->format('l'), $hours.".".$minutes ,"#122f51"]);
        }
        $title_discription = "My Weekly Productivity";
        $title = "Days";
        $type = "weekly";

        return view('employee.graphs',compact('result','title_discription','title','type'));
    }

    public function graph_time(Request $request){
        if($request->graph_time == "monthly"){
            $month_dates = \Carbon\CarbonPeriod::create(\Carbon\Carbon::now()->startOfMonth(), \Carbon\Carbon::now()->endOfMonth());
            $result = [];
            foreach($month_dates as $date){
                $minutes = \App\DailyActivity::where('employee_id',Auth::id())->whereDate('created_at',$date)->where('project_id','!=',0)->sum('time_in_minutes');
                $hours = floor($minutes/60) ;
                $minutes = $minutes%60 ;
                array_push($result,[$date->format('Y/m/d'), $hours.".".$minutes ,"#122f51"]);
            }
            $title_discription = "My Monthly Productivity";
            $title = "Dates";
            $type = $request->graph_time;
        }
        elseif($request->graph_time == "yearly"){
            $result = [];
            $month = [];
            for ($m=1; $m<=12; $m++) {
                $month[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
            }
            foreach($month as $month){
                $minutes = \App\DailyActivity::where('employee_id',Auth::id())->whereMonth('created_at',date('m',strtotime($month)))->whereYear('created_at', date('Y'))->where('project_id','!=',0)->sum('time_in_minutes');
                $hours = floor($minutes/60) ;
                $minutes = $minutes%60 ;
                array_push($result,[date('F',strtotime($month)), $hours.".".$minutes ,"#122f51"]);
            }
           
            $title_discription = "My Yearly Productivity";
            $title = "Months";
            $type = $request->graph_time;
        }
        else{
            $week_dates = \Carbon\CarbonPeriod::create(\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek());
            $result = [];
            foreach($week_dates as $date){
                $minutes = \App\DailyActivity::where('employee_id',Auth::id())->whereDate('created_at',$date)->where('project_id','!=',0)->sum('time_in_minutes');
                $hours = floor($minutes/60) ;
                $minutes = $minutes%60 ;
                array_push($result,[(string)$date->format('l'), $hours.".".$minutes ,"#122f51"]);
            }
            $title_discription = "My Weekly Productivity";
            $title = "Days";
            $type = $request->graph_time;
        }
        if($request->ajax()){
                return response()->json(['result'=>$result,'title_discription'=>$title_discription,'title'=>$title,'type'=>$type]);
            }
        else{

            return view('employee.graphs',compact('result','title_discription','title','type'));  
        }
    }


    public function Chartjs(){
        $holidays = \App\Calender::get()->toArray();
        $holidays_list = \App\Calender::get();
        return view('employee.fullcalendar',['holidays' => $holidays,'holidays_list' => $holidays_list]);
    }
    
    public function apply_leave(){
        $leaves = \App\ApplyLeave::where('employee_id',Auth::id())->whereDate('start_date', '>=', \Carbon\Carbon::now())->get();
        return view('employee.apply_leave',compact('leaves'));
    }

    public function send_leave(Request $request){
        if(empty($request->discription) or is_null($request->discription)) {
            alert()->message('Please fill Your Mail Description!','Error');
            return back();
        }
        else{
            $leave = new \App\ApplyLeave;
            $leave->employee_id = Auth::id();
            $leave->start_date = $request->start_date;
            $leave->end_date = $request->end_date;
            $leave->discription = $request->discription;
            if($leave->save())
                Mail::to('avinash@smartitventures.com')->send(new ApplyLeaveMail($leave));
                alert()->message('Leave applied Successfully!','Success');
            return redirect()->route('employee.apply_leave');
        }
    }


    
    public function my_profile(){
        $profile = \App\EmployeeInformation::where('employee_id',Auth::id())->first();
        return view('employee.my_profile',compact('profile'));
    }

    public function download_icard()
    {
        $imagePath = public_path("images/profile_img222.jpg");
        $image = "data:image/png;base64,".base64_encode(file_get_contents($imagePath));
        $profile = \App\EmployeeInformation::where('employee_id',Auth::id())->first();
        $profile->image = $image;
        
        $pdf = PDF::loadView('employee.icard', compact('profile'))->setOptions(['defaultFont' => 'Roboto']);
        //  return view('employee.icard',compact('pdf','profile'));
    
        return $pdf->download('SmartIt I-Card.pdf');
    }























    // function getMondays()
    // {
    //     $begin = new DateTime('first day of january');
    //     $end = new DateTime('last day of december');
    //     $end = $end->modify('+1 day');
    //     $interval = new DateInterval('P1D');
    //     $daterange = new DatePeriod($begin, $interval, $end);

    //     // getting all sunday dates
    //     foreach ($daterange as $date) {
    //         $sunday = date('w', strtotime($date->format("Y-m-d")));
    //         if ($sunday == 0) {
    //             $sundays[] = $date->format("Y-m-d");
    //         } else {
    //             echo'';
    //         }
    //     }
        
    //     // getting all saturday dates
    //     foreach ($daterange as $date) {
    //         $saturday = date('w', strtotime($date->format("Y-m-d")));
    //         if ($saturday == 6) {
    //             $saturdays[] = $date->format("Y-m-d");
    //         } else {
    //             echo'';
    //         }
    //     }
       
    //     //  merge saturdays and sundays
    //     $all_sat_sun =  array_merge($saturdays, $sundays);

    //     // getting holidays from admin
    //     $custom_holidays = \App\Calender::whereYear('date', \Carbon\Carbon::now())->pluck('date')->toArray();
    //     $all_holidays =array_unique(array_merge($all_sat_sun, $custom_holidays));


    //     // getting all dates in a year
    //     $dateRange = CarbonPeriod::create(\Carbon\Carbon::now()->startOfYear(),\Carbon\Carbon::now()->endOfYear());
    //     $all_dates_in_year = array_map(fn ($date) => $date->format('Y-m-d'), iterator_to_array($dateRange));


    //     // total holidays to employee
    //     $working_days_count = count(array_unique(array_diff($all_dates_in_year,$all_holidays)));
    //     $working_days = array_values(array_unique(array_diff($all_dates_in_year,$all_holidays)));
       
       

    //     // employee total attendance  .
    //     $employee_total_attendance = \App\EmployeeAttendance::distinct()->where('employee_id',Auth::id())->whereNotNull('end_time')->pluck('date');
    //     $employee_total_attendance_count = $employee_total_attendance->count();

    //     // holidays that employee ne lyeaa
    //      $employee_holidays = $working_days_count-$employee_total_attendance_count;

    //     // employee holiday dates
    //    return $employee_holiday_dates = count(array_values(array_unique(array_diff($working_days,$employee_total_attendance->toArray()))));
    // } 
    
}

 





















































        // $dates = [
        //         (string)new \Carbon\Carbon('first Sunday  of '.date("F").''.date("Y").''),
        //         (string)new \Carbon\Carbon('second Sunday  of '.date("F").''.date("Y").''),
        //         (string)new \Carbon\Carbon('third Sunday  of '.date("F").''.date("Y").''),
        //         (string)new \Carbon\Carbon('fourth Sunday  of '.date("F").''.date("Y").''),
        //     ];
        
        // $holidays = \App\Calender::whereMonth('date', \Carbon\Carbon::now())->pluck('date')->toArray();
        // $data =  array_merge($dates, $holidays);
        // print_r($data) ;
        // echo "</br>";

        //  $attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereNotIn('date',$data)->whereNotNull('end_time')->get();
        
        // $dates = 
        // return $present = $dates->count();