@include('Superadmin.layouts.header')
@include('Superadmin.layouts.sidebar')
@include('Superadmin.employee.view_leave')
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
                        <h2 style="text-align:center;">Employee Leaves</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="card toptrashbutton">
            <div class="card-header ">
                <div class="row">
                    <div class="col col-md-12 text-right">
                        @if(request()->has('view_confirmed_leaves'))
                        <a href="{{route('admin.show_emp_leave')}}" class="btn btn-primary reqleave">View Requested Leaves</a>
                        @else
                        <a href="{{route('admin.show_emp_leave',['view_confirmed_leaves'])}}" class="btn btn-danger confleave">View Confirmed leaves</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="customtableinnerbox">
            <div class="main-container-inner">
                @if(count($employee_leaves) > 0)
                <div class="table-wrapper p-0">
                    <table class=" datatable table table-bordered table-striped table-hover " id="user_data_table">
                        <thead>
                            <tr>
                                <th>Emp_id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee_leaves as $item)
                            <tr>
                                <td>{{$item->employee->id}}</td>
                                <td>{{$item->employee->first_name}}&nbsp;{{$item->employee->last_name}}</td>
                                <td>{{$item->employee->email}}</td>
                                <td>{{$item->employee->phone_number}}</td>
                                <td>
                                    <a data-id="{{$item->employee->id}}" class="edit btn-edit-plan"><i class="fa fa-eye"></i></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <h1 class="nodatafoundheading">No data found</h1>
                @endif
            </div>
        </div>
    </div>
</main>
@include('Superadmin.layouts.footer')