<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $leaves = \App\Leave::orderBy('id','desc')->get();
        $employee = \App\User::where('role','employee')->orderBy('id','desc')->get();
        $type = 1;
        foreach($leaves as $data)
        {
            $developer = \App\User::where('role','employee')->find($data->employee_name);
            if(!is_null($developer))
            {
                $data->first_name = $developer->first_name.' '.$developer->last_name;
            }
        }
        return view('Superadmin/leaves/leaves',compact('leaves','type','employee'));
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

      foreach ($request->employee_name as  $val) {
        $leave = new \App\Leave;
        $leave->employee_name = $val;
        $leave->save();
    }
        if ($leave->save())
        {
            return redirect()->route('admin.leave.index')->with(['alert' => 'success', 'message' => 'Leave has been Added Successfully!.']);
        }
        else
        {
            return redirect()->route('admin.leave.index')->with(['alert' => 'danger', 'message' => 'Leave has not been Added!.']);
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
        $leave = \App\Leave::find($id);
       if($leave->delete())
       {
            return redirect()->route('admin.leave.index')->with(['alert' => 'success', 'message' => 'Leave has been Deleted Successfully!.']);
       }
       else
       {
            return redirect()->route('admin.leave.index')->with(['alert' => 'danger', 'message' => 'Leave has not been Deleted!.']);
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
        $leave =  \App\Leave::find($id);
        $leaves = \App\Leave::orderBy('id','desc')->get();
        $employee = \App\User::where('role','employee')->orderBy('id','desc')->get();
        $type = 2;

        foreach($leaves as $data)
        {
        
            $developer = \App\User::where('role','employee')->find($data->employee_name);
            if(!is_null($developer))
            {
                $data->first_name = $developer->first_name.' '.$developer->last_name;

            }

        }
        return view('Superadmin/leaves/leaves',compact('leave','type','leaves','employee'));
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

        foreach ($request->employee_name as  $val) {
            $leave =  \App\Leave::find($id);
            $leave->employee_name = $val;
            $leave->save();
        }
        if ($leave->save())
        {
            return redirect()->route('admin.leave.index')->with(['alert' => 'success', 'message' => 'Leave has been Updated Successfully!.']);
        }
        else
        {
            return redirect()->route('admin.leave.index')->with(['alert' => 'danger', 'message' => 'Leave has not been Updated!.']);
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
}
