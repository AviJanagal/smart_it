@include('Superadmin.layouts.header')
@include('Superadmin.layouts.sidebar')
<main class="maintop">
    <div class="mainsectionbox">
        <div class="container-fluid">
            @if(Session::get('alert'))
            <div class="alert alert-{{Session::get('alert')}} alert-dismissible" role="alert">
                <p>{{Session::get('message')}} </p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="mainheadinglink">
                        <ul>
                            <li><a href="{{route('admin.home')}}">Home /</a></li>
                            <li><a href="#" class="custom-color active">Employee Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mainprofilesection">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="maintoplinkbutton">
                        <nav>
                            <div class="nav nav-tabs " id="nav-tab" role="tablist">
                                <a class="nav-item nav-link custom-tab active " id="nav-Profile-tab" data-toggle="tab" href="#nav-Profile" role="tab" aria-controls="nav-Profile" aria-selected="true">Profile</a> 
                                <!-- <a class="nav-item nav-link custom-tab " id="nav-Gallery-tab" data-toggle="tab" href="#nav-Gallery" role="tab" aria-controls="nav-Gallery" aria-selected="false">Gallery</a> -->
                                <a class="nav-item nav-link custom-tab " id="nav-Services-tab" data-toggle="tab" href="#nav-Services" role="tab" aria-controls="nav-Services" aria-selected="false">Projects</a>
                                <a class="nav-item nav-link custom-tab " id="nav-Reviews-tab" data-toggle="tab" href="#nav-Reviews" role="tab" aria-controls="nav-Reviews" aria-selected="false">Reviews</a>
                                <!-- <a class="nav-item nav-link custom-tab " id="nav-Bank-information-tab" data-toggle="tab" href="#nav-Bank-information" role="tab" aria-controls="nav-Bank-information" aria-selected="false">Information</a>                             -->
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content " id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-Profile" role="tabpanel" aria-labelledby="nav-Profile-tab">
            <div class="profile">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12 custom-col">
                                    <div class="leftbox">
                                        <div class="custom-imagebox">
                                        <img src="{{asset('images/profile-image.jpg')}}">
                                        </div>
                                        <h3></h3>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="personal-info">
                                        <h4>Personal Information</h4>
                                    </div>
                                    <div class="mail-box">
                                        <div class="iocn-box">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </div>
                                        <p>{{$employee->first_name}}&nbsp;{{$employee->last_name}}</p>
                                    </div>

                                    <div class="mail-box">
                                        <div class="iocn-box">
                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        </div>
                                        <p>{{$employee->email}}</p>
                                    </div>
                                    <div class="mail-box">
                                        <div class="iocn-box">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </div>
                                        <p>{!! date('d M, Y', strtotime($employee->emp_info->dob)) !!}</p>
                                    </div>
                                    <div class="mail-box">
                                        <div class="iocn-box">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </div>
                                        <p>{{$employee->phone_number}}</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="personal-info">
                                        <!-- <h4>Address</h4> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="rightbox">
                                        <h2>Basic Information</h2>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contactinfoleft">
                                        <h5>Employee Id:</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contactinforight">

                                    @if(!is_null($employee->emp_info) && !is_null($employee->emp_info->employee_id))
                                        <h5>{{$employee->emp_info->employee_id}}</h5>
                                    @else
                                        <h5>-</h5>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contactinfoleft">
                                        <h5>Designation:</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contactinforight">

                                    @if(!is_null($employee->emp_info) && !is_null($employee->emp_info->designation))
                                        <h5>{{$employee->emp_info->designation}}</h5>
                                    @else
                                        <h5>-</h5>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contactinfoleft">
                                        <h5>Department:</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contactinforight">
                                    @if(!is_null($employee->emp_info) && !is_null($employee->emp_info->department))
                                        <h5>{{$employee->emp_info->department}}</h5>
                                    @else
                                        <h5>-</h5>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="rightbox">
                                        <h2>Employee Type</h2>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="custom-buttoninner">
                                    <span class="custom-pending">
                                    @if(!is_null($employee->emp_info) && !is_null($employee->emp_info->employee_type))
                                        <h5>{{$employee->emp_info->employee_type}}</h5>
                                    @else
                                        <h5>-</h5>
                                    @endif
                                    </span> 
                                        
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="tab-pane fade " id="nav-Gallery" role="tabpanel" aria-labelledby="nav-Gallery-tab">
            <div class="gallery-section">
                <div class="container-fluid">
                <div class="row">
                    
                    </div>
                </div>
            </div>
        </div> -->
        <div class="tab-pane fade " id="nav-Services" role="tabpanel" aria-labelledby="nav-Services-tab">
        <div class="main-table">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-innerdata">
                            <table class="table table-striped table-bordered datatable" id="user_data_table" style="width:100%">
                                <thead class="inner-tablecolor">
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Projects Assign</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($project_assign) && count($project_assign) > 0 )
                                @foreach($project_assign as $item)
                                    <tr>
                                        <td>
                                          {{$item->id}}
                                        </td>
                                        <td>
                                          {{$item->project_name}}
                                        </td>
                                        <td></td>
                                    </tr> 
                                @endforeach
                                @else
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-Reviews" role="tabpanel" aria-labelledby="nav-Reviews-tab">
            <div class="main-table">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-innerdata">
                            <table class="table table-striped table-bordered datatable" id="user_data_table_1" style="width:100%">
                                <thead class="inner-tablecolor">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Comment</th>
                                        <th scope="col">Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                               
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade " id="nav-Bank-information" role="tabpanel" aria-labelledby="nav-Bank-information-tab">
            <div class="bank-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bank-innersection">
                                <h3>No record found.</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('Superadmin.layouts.footer')