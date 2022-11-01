<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

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
        // $profile = \App\User::where('id',3)->first();
        // return $pdf = PDF::loadView('Superadmin.pdf.employee_register_pdf', compact('profile'));
        // Mail::to('harjeetsmartitventures@gmail.com')->send(new \App\Mail\EmployeeregisterMail($pdf));
        $get_department = \App\Department::get();
        return view('superadmin/employee/add_employee', compact('type', 'get_department'));
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
            } else {
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
        $employee_account->ctc = $request->ctc;
        $employee_account->bank_name  = $request->bank_name;
        $employee_account->city = $request->city;
        $employee_account->branch_name = $request->branch_name;
        $employee_account->ifsc_code = $request->ifsc_code;
        $employee_account->account_number  = $request->account_number;
        $employee_account->save();
        if ($employee_account->save()) {
            // $data["email"] = $request->email;
            // $data["title"] = "From ItSolutionStuff.com";
            // $data["body"] = "This is Demo";
            // $profile = \App\User::where('id',$user->id)->first();
            // $pdf = PDF::loadView('Superadmin.pdf.employee_register_pdf', compact('profile'));
            // Mail::send('Superadmin.emails.employee_mail', $data, function($message)use($data, $pdf) {
            //     $message->to($data["email"], $data["email"])
            //             ->subject($data["title"])
            //             ->attachData($pdf->output(), "text.pdf");
            // });
            $profile = \App\User::where('id', $user->id)->first();
            $pdf = PDF::loadView('Superadmin.pdf.employee_register_pdf', compact('profile'));
            Mail::to($user->email)->send(new \App\Mail\EmployeeregisterMail($pdf));
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
        return view('superadmin/employee/add_employee', compact('type', 'employee', 'get_department'));
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
        if ($user->password == $request->password) {
            $user->password = $request->password;
        } else {
            $user->password = \Hash::make($request->password);
        }
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

    public function view_employee(Request $request, $id)
    {
        $employee = \App\User::where('role', 'employee')->find($id);
        $project_assign = \App\ProjectAssign::where('developer_id', $id)->get();
        foreach ($project_assign as $data) {
            $project = \App\Project::find($data->project_id);
            $data->project_name = $project->project_name;
        }
        if (!is_null($employee) && !is_null($employee->emp_info)) {
            $department = \App\Department::find($employee->emp_info->department);
            if (!is_null($department)) {
                $employee->emp_info->department = $department->name;
            }
        }

    // weekly_graph_code
        $week_days = \Carbon\CarbonPeriod::create(\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek());
        $emp_days = [];
        foreach ($week_days as $days) {
            $emp_act_minutes = \App\DailyActivity::where('employee_id', $employee->id)->where('date', $days)->sum('time_in_minutes');
            $time_in_hours = floor($emp_act_minutes / 60);
            $time_in_minutes =   $emp_act_minutes - ($time_in_hours * 60);
            $time_val = $time_in_hours . "." . $time_in_minutes;
            array_push($emp_days, [(string)$days->format('D'), $time_val, "#122f51"]);
        }
        $title_description = "Weekly Employee Activity Graph";
        $title = "Days";
        $key = "weekly";

    // Attendence History
        $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->get();
        $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->sum('time_in_minutes');
        $hours = floor($total_mins / 60);
        $minute = $total_mins % 60;
        if ($hours == 0) {
            $total_time =  $minute . " min";
        } else {
            $total_time = $hours . " hrs " . $minute . " min";
        }

    // Attendence Filter
        $attendence_year = $request->attendence_year;
        if (!empty($request->attendence_month)) {
            $c_month = date_parse($request->attendence_month);
            $month = $c_month['month'];
        }
        if (!empty($request->attendence_date)) {
            $attendence_date = date("Y-m-d", strtotime($request->attendence_date));
        }
        if (!empty($attendence_year) && !empty($attendence_month) && !empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereMonth('created_at', $attendence_month)->whereDate('created_at', $attendence_date)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereMonth('created_at', $attendence_month)->whereDate('created_at', $attendence_date)->sum('time_in_minutes');
        } elseif (!empty($attendence_year) && !empty($attendence_month) && empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereMonth('created_at', $attendence_month)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereMonth('created_at', $attendence_month)->sum('time_in_minutes');
        } elseif (!empty($attendence_year) && empty($attendence_month) && empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->sum('time_in_minutes');
        } elseif (!empty($attendence_year) && empty($attendence_month) && !empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereDate('created_at', $attendence_date)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereDate('created_at', $attendence_date)->sum('time_in_minutes');
        } elseif (empty($attendence_year) && !empty($attendence_month) && !empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', $attendence_month)->whereDate('created_at', $attendence_date)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', $attendence_month)->whereDate('created_at', $attendence_date)->sum('time_in_minutes');
        } elseif (empty($attendence_year) && !empty($attendence_month) && empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', $attendence_month)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', $attendence_month)->sum('time_in_minutes');
        } elseif (empty($attendence_year) && empty($attendence_month) && !empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereDate('created_at', $attendence_date)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereDate('created_at', $attendence_date)->sum('time_in_minutes');
        } else {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', \Carbon\Carbon::now()->month)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', \Carbon\Carbon::now()->month)->sum('time_in_minutes');
        }
        $year_status_attendence = $request->attendence_year;
        $month_status_attendence = $request->attendence_month;
        $date_status_attendence = $request->attendence_date;
        $hours = floor($total_mins / 60);
        $minute = $total_mins % 60;
        if ($hours == 0) {
            $total_time =  $minute . " min";
        } else {
            $total_time = $hours . " hrs " . $minute . " min";
        }

    //Daily Activity
        $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->get();
        $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->where('project_id', '!=', 0)->sum('time_in_minutes');
        // $month_status = date('F');
        $hours = floor($total_mins / 60);
        $minute = $total_mins % 60;

        if ($hours == 0) {
            $total_time =  $minute . " min";
        } else {
            $total_time = $hours . " hrs " . $minute . " min";
        }

    // Daily Activity filter
        $year = $request->year;
        if (!empty($request->month)) {
            $c_month = date_parse($request->month);
            $month = $c_month['month'];
        }
        (!empty($request->date)) ? $date = date("Y-m-d", strtotime($request->date)) : $date = "";
        if (!empty($year) && !empty($month) && !empty($date)) {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->whereDate('created_at', $date)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->whereDate('created_at', $date)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (!empty($year) && !empty($month) && empty($date)) {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (!empty($year) && empty($month) && empty($date)) {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (!empty($year) && empty($month) && !empty($date)) {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereDate('created_at', $date)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereDate('created_at', $date)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (empty($year) && !empty($month) && !empty($date)) {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', $month)->whereDate('created_at', $date)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', $month)->whereDate('created_at', $date)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (empty($year) && !empty($month) && empty($date)) {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', $month)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', $month)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (empty($year) && empty($month) && !empty($date)) {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereDate('created_at', $date)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereDate('created_at', $date)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } else {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->where('project_id', '!=', 0)->sum('time_in_minutes');
        }
        $year_status = $request->year;
        if (!isset($request->month)) {
            $month_status = date('F');
        } else {
            $month_status = $request->month;
        }
        $date_status = $request->date;
        $hours = floor($total_mins / 60);
        $minute = $total_mins % 60;

        if ($hours == 0) {
            $total_time =  $minute . " min";
        } else {
            $total_time = $hours . " hrs " . $minute . " min";
        }
        return view('superadmin/employee/view_employee', compact('employee', 'project_assign', 'emp_days', 'title_description', 'title', 'key', 'all_daily_activities', 'total_mins', 'hours', 'minute', 'month_status', 'date_status', 'year_status', 'total_time', 'my_attendance', 'year_status_attendence', 'month_status_attendence', 'date_status_attendence'));
    }


    public function attendance_filter(Request $request, $id)
    {
        $employee = \App\User::where('role', 'employee')->find($id);
        $project_assign = \App\ProjectAssign::where('developer_id', $id)->get();
        foreach ($project_assign as $data) {
            $project = \App\Project::find($data->project_id);
            $data->project_name = $project->project_name;
        }
        if (!is_null($employee) && !is_null($employee->emp_info)) {
            $department = \App\Department::find($employee->emp_info->department);
            if (!is_null($department)) {
                $employee->emp_info->department = $department->name;
            }
        }

    // weekly_graph_code
        $week_days = \Carbon\CarbonPeriod::create(\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek());
        $emp_days = [];
        foreach ($week_days as $days) {
            $emp_act_minutes = \App\DailyActivity::where('employee_id', $employee->id)->where('date', $days)->sum('time_in_minutes');
            $time_in_hours = floor($emp_act_minutes / 60);
            $time_in_minutes =   $emp_act_minutes - ($time_in_hours * 60);
            $time_val = $time_in_hours . "." . $time_in_minutes;
            array_push($emp_days, [(string)$days->format('D'), $time_val, "#122f51"]);
        }
        $title_description = "Weekly Employee Activity Graph";
        $title = "Days";
        $key = "weekly";

    //Daily Activity
        $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->get();
        $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->where('project_id', '!=', 0)->sum('time_in_minutes');
        if (!isset($request->month)) {
            $month_status = date('F');
        } else {
            $month_status = $request->month;
        }
        $hours = floor($total_mins / 60);
        $minute = $total_mins % 60;

        if ($hours == 0) {
            $total_time =  $minute . " min";
        } else {
            $total_time = $hours . " hrs " . $minute . " min";
        }

    // Daily Activity filter
        $year = $request->year;
        if (!empty($request->month)) {
            $c_month = date_parse($request->month);
            $month = $c_month['month'];
        }
        (!empty($request->date)) ? $date = date("Y-m-d", strtotime($request->date)) : $date = "";
        if (!empty($year) && !empty($month) && !empty($date)) {
            $all_daily_activities = \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->whereDate('created_at', $date)->get();
            $total_mins = \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->whereDate('created_at', $date)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (!empty($year) && !empty($month) && empty($date)) {
            $all_daily_activities = \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
            $total_mins = \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (!empty($year) && empty($month) && empty($date)) {
            $all_daily_activities = \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->get();
            $total_mins = \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (!empty($year) && empty($month) && !empty($date)) {
            $all_daily_activities = \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereDate('created_at', $date)->get();
            $total_mins = \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereDate('created_at', $date)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (empty($year) && !empty($month) && !empty($date)) {
            $all_daily_activities = \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', $month)->whereDate('created_at', $date)->get();
            $total_mins = \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', $month)->whereDate('created_at', $date)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (empty($year) && !empty($month) && empty($date)) {
            $all_daily_activities = \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', $month)->get();
            $total_mins = \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', $month)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (empty($year) && empty($month) && !empty($date)) {
            $all_daily_activities = \App\DailyActivity::where('employee_id', $employee->id)->whereDate('created_at', $date)->get();
            $total_mins = \App\DailyActivity::where('employee_id', $employee->id)->whereDate('created_at', $date)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } else {
            $all_daily_activities = \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->get();
            $total_mins = \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->where('project_id', '!=', 0)->sum('time_in_minutes');
        }
        $year_status = $request->year;
        $month_status = $request->month;
        $date_status = $request->date;
        $hours = floor($total_mins / 60);
        $minute = $total_mins % 60;
        if ($hours == 0) {
            $total_time =  $minute . " min";
        } else {
            $total_time = $hours . " hrs " . $minute . " min";
        }

    // Attendence History
        $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->get();
        $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->sum('time_in_minutes');
        $hours = floor($total_mins / 60);
        $minute = $total_mins % 60;
        if ($hours == 0) {
            $total_time =  $minute . " min";
        } else {
            $total_time = $hours . " hrs " . $minute . " min";
        }
        $month_status = date('F');

    // Attendence Filter
        $attendence_year = $request->attendence_year;
        if (!empty($request->month)) {
            $c_month = date_parse($request->month);
            $month = $c_month['month'];
        }
        if (!empty($request->attendence_month)) {
            $umonth = $request->attendence_month;
            $attendence_month = date("m", strtotime($umonth));
        }
        if (!empty($request->attendence_date)) {
            $attendence_date = date("Y-m-d", strtotime($request->attendence_date));
        }
        if (!empty($attendence_year) && !empty($attendence_month) && !empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereMonth('created_at', $attendence_month)->whereDate('created_at', $attendence_date)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereMonth('created_at', $attendence_month)->whereDate('created_at', $attendence_date)->sum('time_in_minutes');
        } elseif (!empty($attendence_year) && !empty($attendence_month) && empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereMonth('created_at', $attendence_month)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereMonth('created_at', $attendence_month)->sum('time_in_minutes');
        } elseif (!empty($attendence_year) && empty($attendence_month) && empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->sum('time_in_minutes');
        } elseif (!empty($attendence_year) && empty($attendence_month) && !empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereDate('created_at', $attendence_date)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereDate('created_at', $attendence_date)->sum('time_in_minutes');
        } elseif (empty($attendence_year) && !empty($attendence_month) && !empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', $attendence_month)->whereDate('created_at', $attendence_date)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', $attendence_month)->whereDate('created_at', $attendence_date)->sum('time_in_minutes');
        } elseif (empty($attendence_year) && !empty($attendence_month) && empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', $attendence_month)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', $attendence_month)->sum('time_in_minutes');
        } elseif (empty($attendence_year) && empty($attendence_month) && !empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereDate('created_at', $attendence_date)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereDate('created_at', $attendence_date)->sum('time_in_minutes');
        } else {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', \Carbon\Carbon::now()->month)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', \Carbon\Carbon::now()->month)->sum('time_in_minutes');
        }
        $year_status_attendence = $request->attendence_year;
        $month_status_attendence = $request->attendence_month;
        $date_status_attendence = $request->attendence_date;
        $hours = floor($total_mins / 60);
        $minute = $total_mins % 60;
        if ($hours == 0) {
            $total_time =  $minute . " min";
        } else {
            $total_time = $hours . " hrs " . $minute . " min";
        }
        return view('superadmin/employee/view_employee', compact('my_attendance', 'month_status', 'date_status', 'year_status', 'total_time', 'employee', 'project_assign', 'emp_days', 'title_description', 'title', 'key', 'all_daily_activities', 'total_mins', 'hours', 'minute', 'total_time', 'year_status_attendence', 'month_status_attendence', 'date_status_attendence'));
    }


    public function activity_filter(Request $request, $id)
    {

        $employee = \App\User::where('role', 'employee')->find($id);
        $project_assign = \App\ProjectAssign::where('developer_id', $id)->get();
        foreach ($project_assign as $data) {
            $project = \App\Project::find($data->project_id);
            $data->project_name = $project->project_name;
        }
        if (!is_null($employee) && !is_null($employee->emp_info)) {
            $department = \App\Department::find($employee->emp_info->department);
            if (!is_null($department)) {
                $employee->emp_info->department = $department->name;
            }
        }

    // weekly_graph_code
        $week_days = \Carbon\CarbonPeriod::create(\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek());
        $emp_days = [];
        foreach ($week_days as $days) {
            $emp_act_minutes = \App\DailyActivity::where('employee_id', $employee->id)->where('date', $days)->sum('time_in_minutes');
            $time_in_hours = floor($emp_act_minutes / 60);
            $time_in_minutes =   $emp_act_minutes - ($time_in_hours * 60);
            $time_val = $time_in_hours . "." . $time_in_minutes;
            array_push($emp_days, [(string)$days->format('D'), $time_val, "#122f51"]);
        }
        $title_description = "Weekly Employee Activity Graph";
        $title = "Days";
        $key = "weekly";

    //Daily Activity
        $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->get();
        $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->where('project_id', '!=', 0)->sum('time_in_minutes');
        // $month_status = date('F');
        $hours = floor($total_mins / 60);
        $minute = $total_mins % 60;
        if ($hours == 0) {
            $total_time =  $minute . " min";
        } else {
            $total_time = $hours . " hrs " . $minute . " min";
        }

    //Activity Filter
        $year = $request->year;
        if (!empty($request->month)) {
            $c_month = date_parse($request->month);
            $month = $c_month['month'];
        }
        (!empty($request->date)) ? $date = date("Y-m-d", strtotime($request->date)) : $date = "";

        if (!empty($year) && !empty($month) && !empty($date)) {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->whereDate('created_at', $date)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->whereDate('created_at', $date)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (!empty($year) && !empty($month) && empty($date)) {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (!empty($year) && empty($month) && empty($date)) {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (!empty($year) && empty($month) && !empty($date)) {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereDate('created_at', $date)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereYear('created_at', $year)->whereDate('created_at', $date)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (empty($year) && !empty($month) && !empty($date)) {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', $month)->whereDate('created_at', $date)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', $month)->whereDate('created_at', $date)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (empty($year) && !empty($month) && empty($date)) {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', $month)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', $month)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } elseif (empty($year) && empty($month) && !empty($date)) {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereDate('created_at', $date)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereDate('created_at', $date)->where('project_id', '!=', 0)->sum('time_in_minutes');
        } else {
            $all_daily_activities =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->get();
            $total_mins =  \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->where('project_id', '!=', 0)->sum('time_in_minutes');
        }
        $year_status = $request->year;
        // if(!isset($requst->month)){
        //     $month_status = date('F');
        // }
        // else{
        $month_status = $request->month;
        // }
        $date_status = $request->date;
        $hours = floor($total_mins / 60);
        $minute = $total_mins % 60;
        if ($hours == 0) {
            $total_time =  $minute . " min";
        } else {
            $total_time = $hours . " hrs " . $minute . " min";
        }

    // Attendence History
        $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->get();
        $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->sum('time_in_minutes');
        $hours = floor($total_mins / 60);
        $minute = $total_mins % 60;

        if ($hours == 0) {
            $total_time =  $minute . " min";
        } else {
            $total_time = $hours . " hrs " . $minute . " min";
        }
        // $month_status = date('F');

    // Attendence Filter
        $attendence_year = $request->attendence_year;
        if (!empty($request->attendence_month)) {
            $c_month = date_parse($request->attendence_month);
            $month = $c_month['month'];
        }
        if (!empty($request->attendence_date)) {
            $attendence_date = date("Y-m-d", strtotime($request->attendence_date));
        }
        if (!empty($attendence_year) && !empty($attendence_month) && !empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereMonth('created_at', $attendence_month)->whereDate('created_at', $attendence_date)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereMonth('created_at', $attendence_month)->whereDate('created_at', $attendence_date)->sum('time_in_minutes');
        } elseif (!empty($attendence_year) && !empty($attendence_month) && empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereMonth('created_at', $attendence_month)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereMonth('created_at', $attendence_month)->sum('time_in_minutes');
        } elseif (!empty($attendence_year) && empty($attendence_month) && empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->sum('time_in_minutes');
        } elseif (!empty($attendence_year) && empty($attendence_month) && !empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereDate('created_at', $attendence_date)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereYear('created_at', $attendence_year)->whereDate('created_at', $attendence_date)->sum('time_in_minutes');
        } elseif (empty($attendence_year) && !empty($attendence_month) && !empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', $attendence_month)->whereDate('created_at', $attendence_date)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', $attendence_month)->whereDate('created_at', $attendence_date)->sum('time_in_minutes');
        } elseif (empty($attendence_year) && !empty($attendence_month) && empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', $attendence_month)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', $attendence_month)->sum('time_in_minutes');
        } elseif (empty($attendence_year) && empty($attendence_month) && !empty($attendence_date)) {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereDate('created_at', $attendence_date)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereDate('created_at', $attendence_date)->sum('time_in_minutes');
        } else {
            $my_attendance = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', \Carbon\Carbon::now()->month)->get();
            $total_mins = \App\EmployeeAttendance::where('employee_id', $employee->id)->whereMonth('created_at', \Carbon\Carbon::now()->month)->sum('time_in_minutes');
        }
        $year_status_attendence = $request->attendence_year;
        $month_status_attendence = $request->attendence_month;
        $date_status_attendence = $request->attendence_date;
        $hours = floor($total_mins / 60);
        $minute = $total_mins % 60;
        if ($hours == 0) {
            $total_time =  $minute . " min";
        } else {
            $total_time = $hours . " hrs " . $minute . " min";
        }
        return view('superadmin/employee/view_employee', compact('employee', 'project_assign', 'emp_days', 'title_description', 'title', 'key', 'all_daily_activities', 'total_mins', 'month_status', 'hours', 'minute', 'date_status', 'year_status', 'total_time', 'my_attendance', 'year_status_attendence', 'month_status_attendence', 'date_status_attendence'));
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

    public function employee_graph(Request $request, $id)
    {
        $employee = \App\User::where('role', 'employee')->find($id);
        if ($request->graph_time == "weekly") {
            $week_days = \Carbon\CarbonPeriod::create(\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek());
            $emp_days = [];
            foreach ($week_days as $days) {

                $emp_act_minutes = \App\DailyActivity::where('employee_id', $employee->id)->where('date', $days)->sum('time_in_minutes');
                $time_in_hours = floor($emp_act_minutes / 60);
                $time_in_minutes =   $emp_act_minutes - ($time_in_hours * 60);
                $time_val = $time_in_hours . "." . $time_in_minutes;
                array_push($emp_days, [(string)$days->format('D'), $time_val, "#122f51"]);
            }
            $title_description = "Weekly Employee Activity Graph";
            $title = "Days";
            $key = "weekly";
        } elseif ($request->graph_time == "yearly") {
            $months = [];
            for ($m = 1; $m <= 12; $m++) {
                $months[] = date('M', mktime(0, 0, 0, $m, 1, date('Y')));
            }
            // return $months;
            $emp_days = [];
            foreach ($months as $data) {
                $c_month = date_parse($data);
                $emp_act_minutes = \App\DailyActivity::where('employee_id', $employee->id)->whereMonth('date', $c_month['month'])->sum('time_in_minutes');
                $time_in_hours = floor($emp_act_minutes / 60);
                $time_in_minutes =   $emp_act_minutes - ($time_in_hours * 60);
                $time_val = $time_in_hours . "." . $time_in_minutes;
                array_push($emp_days, [date('M', mktime(0, 0, 0, $c_month['month'], 1)), $time_val, "#122f51"]);
            }
            // return $emp_days;
            $title_description = "Yearly Attendance Chart";
            $title = "Months";
            $key = "yearly";
        } else {
            $monthly_data = \Carbon\CarbonPeriod::create(\Carbon\Carbon::now()->startOfMonth(), \Carbon\Carbon::now()->endOfMonth());
            $emp_days = [];
            foreach ($monthly_data as $data) {
                $emp_act_minutes = \App\DailyActivity::where('employee_id', $employee->id)->where('date', $data)->sum('time_in_minutes');
                $time_in_hours = floor($emp_act_minutes / 60);
                $time_in_minutes =   $emp_act_minutes - ($time_in_hours * 60);
                $time_val = $time_in_hours . "." . $time_in_minutes;
                array_push($emp_days, [$data->format('d/M/y'), $time_val, "#122f51"]);
            }
            $title_description = "Monthly Attendance Chart";
            $title = "Dates";
            $key = "monthly";
        }
        return view('superadmin/employee/view_employee', compact('employee', 'emp_days', 'title_description', 'title', 'key'));
    }

    public function show_department()
    {
        $departments = \App\Department::orderBy('id', 'desc')->get();
        $type = 1;
        return view('Superadmin/employee/department', compact('departments', 'type'));
    }

    public function add_department(Request $request)
    {
        $department = new \App\Department;
        $department->name = $request->name;
        if ($department->save()) {
            return redirect()->route('admin.show_department')->with(['alert' => 'success', 'message' => 'Department has been Added Successfully!.']);
        } else {
            return redirect()->route('admin.show_department')->with(['alert' => 'danger', 'message' => 'Department has not been Added!.']);
        }
    }

    public function edit_department($id)
    {
        $department =  \App\Department::find($id);
        $departments = \App\Department::orderBy('id', 'desc')->get();
        $type = 2;
        return view('Superadmin/employee/department', compact('department', 'departments', 'type'));
    }

    public function update_department(Request $request, $id)
    {

        $department =  \App\Department::find($id);
        $department->name = $request->name;
        if ($department->save()) {
            return redirect()->route('admin.show_department')->with(['alert' => 'success', 'message' => 'Department has been Updated Successfully!.']);
        } else {
            return redirect()->route('admin.show_department')->with(['alert' => 'danger', 'message' => 'Department has not been Updated!.']);
        }
    }

    public function delete_department($id)
    {
        //
        $department = \App\Department::find($id);
        if ($department->delete()) {
            return redirect()->route('admin.show_department')->with(['alert' => 'success', 'message' => 'Department has been Deleted Successfully!.']);
        } else {
            return redirect()->route('admin.show_department')->with(['alert' => 'danger', 'message' => 'Department has not been Deleted!.']);
        }
    }


    public function show_emp_leave(Request $request)
    {

        $employee_leaves = \App\ApplyLeave::orderBy('start_date', 'asc')->get();
        foreach ($employee_leaves as $item) {
            $item->employee = \App\User::where('role', 'employee')->where('id', $item->employee_id)->first();
        }
        if ($request->has('view_confirmed_leaves')) {
            $employee_leaves = \App\ApplyLeave::where('status', '1')->orderBy('start_date', 'asc')->get();
            foreach ($employee_leaves as $item) {
                $item->employee = \App\User::where('role', 'employee')->where('id', $item->employee_id)->first();
            }
        }
        return view('Superadmin/employee/show_leave', compact('employee_leaves'));
    }


    public function view_emp_leave(Request $request)
    {
        $data = \App\ApplyLeave::where('employee_id', $request->id)->first();
        return response()->json($data, 200);
    }


    public function leave_approvel(Request $request)
    {
        $data = \App\ApplyLeave::where('employee_id', $request->employee_id)->first();
        $data->status = $request->id;
        $data->update();
        return response()->json($data, 200);
    }
}
