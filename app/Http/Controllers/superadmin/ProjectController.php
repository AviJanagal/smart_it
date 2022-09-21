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

        
        foreach($projects as $data)
        {
            $clients = \App\Client::find($data->client);
            $data->client =  $clients->name;

        }
        
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
      $project = new \App\Project;
      $project->project_name = $request->project_name;
      $project->client = $request->client;

        if ($project->save())
        {
            return redirect()->route('admin.project.index')->with(['alert' => 'success', 'message' => 'Project has been Added Successfully!.']);
        }
        else
        {
            return redirect()->route('admin.project.index')->with(['alert' => 'danger', 'message' => 'Project has not been Added!.']);
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

       $project = \App\Project::find($id);
       if($project->delete())
       {
            return redirect()->route('admin.project.index')->with(['alert' => 'success', 'message' => 'Project has been Deleted Successfully!.']);
       }
       else
       {
            return redirect()->route('admin.project.index')->with(['alert' => 'danger', 'message' => 'Project has not been Deleted!.']);
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
        $project =  \App\Project::find($id);

        $projects = \App\Project::orderBy('id','desc')->get();
        $get_clients = \App\Client::orderBy('id','desc')->get();

        foreach($projects as $data)
        {
            $clients = \App\Client::find($data->client);
            $data->client =  $clients->name;

        }



        $type = 2;
        return view('Superadmin/project/project',compact('project','projects','type','get_clients'));
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
    
        $project =  \App\Project::find($id);
        $project->project_name = $request->project_name;
        $project->client = $request->client;
        if ($project->save())
        {
            return redirect()->route('admin.project.index')->with(['alert' => 'success', 'message' => 'Project has been Updated Successfully!.']);
        }
        else
        {
            return redirect()->route('admin.project.index')->with(['alert' => 'danger', 'message' => 'Project has not been Updated!.']);
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


    public function get_project_assign()
    {

        $type = 1;
        $employee = \App\User::where('role','employee')->orderBy('id','desc')->get();
        $projects = \App\ProjectAssign::orderBy('id','desc')->get();
        $get_projects = \App\Project::orderBy('id','desc')->get();
        foreach($projects as $data)
        {
            $project = \App\Project ::find($data->project_id);
            $data->project_name = $project->project_name;

            $developer = \App\User::where('role','employee')->find($data->developer_id);
            $data->first_name = $developer->first_name.' '.$developer->last_name;

        }

        return view('Superadmin/project/project_assign',compact('type','get_projects','projects','employee'));

        
    }

    public function store_assigned_projects(Request $request)
    {



        foreach ($request->select_employee as  $val) {
            $assign_project = new \App\ProjectAssign;
            $assign_project->developer_id = $val;
            $assign_project->project_id = $request->select_project;
            $assign_project->save();
        }


        if ($assign_project->save())
        {
            return redirect()->route('admin.get_project_assign')->with(['alert' => 'success', 'message' => 'Project has been Assigned Successfully!.']);
        }
        else
        {
            return redirect()->route('admin.get_project_assign')->with(['alert' => 'danger', 'message' => 'Project has not been Assigned!.']);
        }
        
    }


    public function edit_assigned_projects($id)
    {
        $assign_project =  \App\ProjectAssign::find($id);
        $employee = \App\User::where('role','employee')->orderBy('id','desc')->get();
        $projects = \App\ProjectAssign::orderBy('id','desc')->get();
        $get_projects = \App\Project::orderBy('id','desc')->get();
        foreach($projects as $data)
        {
            $project = \App\Project ::find($data->project_id);
            $data->project_name = $project->project_name;

            $developer = \App\User::where('role','employee')->find($data->developer_id);
            $data->first_name = $developer->first_name.' '.$developer->last_name;

        }

        $type = 2;
        return view('Superadmin/project/project_assign',compact('assign_project','projects','type','employee','get_projects'));
    }



    public function delete_assigned_project($id)
    {
        $assign_project =  \App\ProjectAssign::find($id);
        
        if($assign_project->delete())
        {
             return redirect()->route('admin.get_project_assign')->with(['alert' => 'success', 'message' => 'Developer has been Deleted Successfully!.']);
        }
        else
        {
             return redirect()->route('admin.get_project_assign')->with(['alert' => 'danger', 'message' => 'Developer has not been Deleted!.']);
        }
 


    }












}
