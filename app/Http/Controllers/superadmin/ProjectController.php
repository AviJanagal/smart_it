<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = \App\Project::orderBy('id','desc')->get();
        $get_clients = \App\Client::orderBy('id','desc')->get();
        $type = 1;
        return view('Superadmin/project/project',compact('projects','type','get_clients'));

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
      $Project = new \App\Project;
      $Project->name = $request->name;
      $Project->email = $request->email;

        if ($Project->save())
        {
            return redirect()->route('admin.Project.index')->with(['alert' => 'success', 'message' => 'Project has been Added Successfully!.']);
        }
        else
        {
            return redirect()->route('admin.Project.index')->with(['alert' => 'danger', 'message' => 'Project has not been Added!.']);
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

       $Project = \App\Project::find($id);
       if($Project->delete())
       {
            return redirect()->route('admin.Project.index')->with(['alert' => 'success', 'message' => 'Project has been Deleted Successfully!.']);
       }
       else
       {
            return redirect()->route('admin.Project.index')->with(['alert' => 'danger', 'message' => 'Project has not been Deleted!.']);
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
        $Project =  \App\Project::find($id);
        $Projects = \App\Project::orderBy('id','desc')->get();
        $type = 2;
        return view('Superadmin/Project/add_Project',compact('Project','Projects','type'));
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
    
        $Project =  \App\Project::find($id);
        $Project->name = $request->name;
        $Project->email = $request->email;
        if ($Project->save())
        {
            return redirect()->route('admin.Project.index')->with(['alert' => 'success', 'message' => 'Project has been Updated Successfully!.']);
        }
        else
        {
            return redirect()->route('admin.Project.index')->with(['alert' => 'danger', 'message' => 'Project has not been Updated!.']);
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
        

    }


}
