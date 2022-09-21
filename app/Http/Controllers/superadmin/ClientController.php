<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = \App\Client::orderBy('id','desc')->get();
        $type = 1;
        return view('Superadmin/client/add_client',compact('clients','type'));

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
      $client = new \App\Client;
      $client->name = $request->name;
      $client->email = $request->email;

        if ($client->save())
        {
            return redirect()->route('admin.client.index')->with(['alert' => 'success', 'message' => 'Client has been Added Successfully!.']);
        }
        else
        {
            return redirect()->route('admin.client.index')->with(['alert' => 'danger', 'message' => 'Client has not been Added!.']);
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

       $client = \App\Client::find($id);
       if($client->delete())
       {
            return redirect()->route('admin.client.index')->with(['alert' => 'success', 'message' => 'Client has been Deleted Successfully!.']);
       }
       else
       {
            return redirect()->route('admin.client.index')->with(['alert' => 'danger', 'message' => 'Client has not been Deleted!.']);
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
        $client =  \App\Client::find($id);
        $clients = \App\Client::orderBy('id','desc')->get();
        $type = 2;
        return view('Superadmin/client/add_client',compact('client','clients','type'));
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
    
        $client =  \App\Client::find($id);
        $client->name = $request->name;
        $client->email = $request->email;

        if ($client->save())
        {
            return redirect()->route('admin.client.index')->with(['alert' => 'success', 'message' => 'Client has been Updated Successfully!.']);
        }
        else
        {
            return redirect()->route('admin.client.index')->with(['alert' => 'danger', 'message' => 'Client has not been Updated!.']);
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
