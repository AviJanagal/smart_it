<?php

namespace App\Http\Controllers\superadmin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HolidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $holidays = \App\Calender::orderBy('id','desc')->get();
        $type = 1;
        return view('Superadmin/holidays/holiday',compact('holidays','type'));

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

      $holiday = new \App\Calender;
      $holiday->title = $request->title;
      $holiday->date = $request->date;

        if ($holiday->save())
        {
            return redirect()->route('admin.holidays.index')->with(['alert' => 'success', 'message' => 'Holidays has been Added Successfully!.']);
        }
        else
        {
            return redirect()->route('admin.holidays.index')->with(['alert' => 'danger', 'message' => 'Holidays has not been Added!.']);
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

        
       $holiday = \App\Calender::find($id);
       if($holiday->delete())
       {
            return redirect()->route('admin.holidays.index')->with(['alert' => 'success', 'message' => 'Holidays has been Deleted Successfully!.']);
       }
       else
       {
            return redirect()->route('admin.holidays.index')->with(['alert' => 'danger', 'message' => 'Holidays has not been Deleted!.']);
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

        $holiday =  \App\Calender::find($id);
        $holidays = \App\Calender::orderBy('id','desc')->get();
        $type = 2;
        return view('Superadmin/holidays/holiday',compact('holiday','holidays','type'));

        
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
        $holiday =  \App\Calender::find($id);
        $holiday->title = $request->title;
        $holiday->date = $request->date;

        if ($holiday->save())
        {
            return redirect()->route('admin.holidays.index')->with(['alert' => 'success', 'message' => 'Holiday has been Updated Successfully!.']);
        }
        else
        {
            return redirect()->route('admin.holidays.index')->with(['alert' => 'danger', 'message' => 'Holiday has not been Updated!.']);
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
