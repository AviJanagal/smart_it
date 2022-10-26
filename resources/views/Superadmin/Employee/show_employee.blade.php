@include('Superadmin.layouts.header')
@include('Superadmin.layouts.sidebar')
<main class="maintop">
    <div class="mainsectionbox">
        <div class="container-fluid">
            @if(Session::get('alert'))
            <div class="alert alert-{{Session::get('alert')}} alert-dismissible" role="alert">
                <p>{{Session::get('message')}} </p>
                <button type="button" class="close alertclosecss" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            @endif
        </div>
        <div class="bank-innersection">
        <div class="table-title-add">
            <div class="row">
            <div class="col-sm-12">
            <h2 style="text-align:center;">Employee Details</h2>
            </div>
            </div>
        </div>
        </div>
        <div class="customtableinnerbox">
        <div class="main-container-inner">
            @if(count($employee) > 0)
                <div class="table-wrapper p-0">
                    <table class=" datatable table table-bordered table-striped table-hover " id="user_data_table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->first_name}}&nbsp;{{$item->last_name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->phone_number}}</td>
                                <td>{{$item->emp_status}}</td>
                                <td style="width: 102px;">
                                    <a href="{{route('admin.employee.edit',$item->id)}}" class="edit"><i class="fa fa-pencil"></i></a>
                                    <a  class="delete"  onclick="deletedata('{{route('admin.employee.show',$item->id)}}');"><i class="fa fa-trash" aria-hidden="true"data-toggle="tooltip" title="Delete"></i></a>
                                    <a href="{{route('admin.view_employee',$item->id)}}" class="edit"><i class="fa fa-eye"></i></a>

                                </td>
                            </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
            <h1 class="nodatafoundheading" >No data found</h1>
            @endif
        </div>
        </div>
    </div> 
</main>
@include('Superadmin.layouts.footer')