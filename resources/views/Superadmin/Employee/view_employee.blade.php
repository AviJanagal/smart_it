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
                                <a class="nav-item nav-link custom-tab " id="nav-Reviews-tab" data-toggle="tab" href="#nav-Reviews" role="tab" aria-controls="nav-Reviews" aria-selected="false">Graphs</a>
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
                                            @if(!is_null($employee) && !is_null($employee->emp_info) && !is_null($employee->emp_info->image) )
                                            <img src="{{asset($employee->emp_info->image)}}" /> 
                                            @else
                                            <img src="{{asset('images/profile-image.jpg')}}">
                                            @endif
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

                                        @if(!is_null($employee) && !is_null($employee->first_name) && !is_null($employee->last_name) )
                                        <p>{{ucfirst($employee->first_name)}}&nbsp;{{ucfirst($employee->last_name)}}</p>
                                        @else
                                        <p>No Data</p>
                                        @endif
                                    </div>
                                    <div class="mail-box">
                                        <div class="iocn-box">
                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        </div>
                                        @if(!is_null($employee) && !is_null($employee->email))
                                        <p>{{$employee->email}}</p>
                                        @else
                                        <p>No Data</p>
                                        @endif
                                    </div>
                                    <div class="mail-box">
                                        <div class="iocn-box">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </div>
                                        @if(!is_null($employee) && !is_null($employee->emp_info) && !is_null($employee->emp_info->dob) )
                                        <p>{!! date('d M, Y', strtotime($employee->emp_info->dob)) !!}</p>
                                        @else
                                        <p>No Data</p>
                                        @endif
                                    </div>
                                    <div class="mail-box">
                                        <div class="iocn-box">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </div>
                                        @if(!is_null($employee) && !is_null($employee->phone_number))
                                        <p>{{$employee->phone_number}}</p>
                                        @else
                                        <p>No Data</p>
                                        @endif
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

                                        @if(!is_null($employee) && !is_null($employee->emp_info) && !is_null($employee->emp_info->employee_id))
                                        <h5>{{$employee->emp_info->employee_id}}</h5>
                                        @else
                                        <h5>No Data</h5>
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

                                        @if(!is_null($employee) && !is_null($employee->emp_info) && !is_null($employee->emp_info->designation))
                                        <h5>{{ucfirst($employee->emp_info->designation)}}</h5>
                                        @else
                                        <h5>No Data</h5>
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
                                        @if(!is_null($employee) && !is_null($employee->emp_info) && !is_null($employee->emp_info->department))
                                        <h5>{{ucfirst($employee->emp_info->department)}}</h5>
                                        @else
                                        <h5>No Data</h5>
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
                                            @if(!is_null($employee) && !is_null($employee->emp_info) && !is_null($employee->emp_info->employee_type))
                                            <h5>{{ucfirst($employee->emp_info->employee_type)}}</h5>
                                            @else
                                            <h5>No Data</h5>
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
                                        <td class="btn-td">
                                            <a class="delete" onclick="deletedata('{{route('admin.del_emp_assigned_project',$item->id)}}');"><i class="fa fa-trash"></i></a>
                                        </td>
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
                        <form method="post" action="{{route('admin.employee_graph',$employee->id)}}" id="emp_graph" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-2">
                                    <select class="form-select graphselect" aria-label="Default select example" name="graph_time" id="graph_time" required>
                                        <option selected disabled value="">Select Time Period</option>
                                        <option value="weekly" <?php if ($key == "weekly") echo 'selected'; ?>>Weekly</option>
                                        <option value="monthly" <?php if ($key == "monthly") echo 'selected'; ?>>Monthly</option>
                                        <option value="yearly" <?php if ($key == "yearly") echo 'selected'; ?>>Yearly</option>
                                    </select>

                                </div>
                            </div>
                        </form>
                        <div id="myChart"></div>
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var my_array = <?php echo json_encode($emp_days, JSON_NUMERIC_CHECK); ?>;
        // console.log(my_array);
        var title = [
            ['Days', 'Hours', {
                role: 'style'
            }]
        ];
        var activities = jQuery.merge(title, my_array);
        var data = google.visualization.arrayToDataTable(activities);
        var view = new google.visualization.DataView(data);
        var options = {
            title: "<?php echo $title_description; ?>",
            width: 1300,
            height: 500,
            bar: {
                groupWidth: "95%"
            },
            vAxes: {
                // Adds titles to each axis.
                0: {
                    title: 'Time(In Hours)',
                    format: '0.00',
                    titleFontSize: 20
                },
            },
            hAxes: {
                // Adds titles to each axis.
                0: {
                    title: "<?php echo $title; ?>",
                    titleFontSize: 20
                },
            },
            legend: {
                position: "none"
            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("myChart"));
        chart.draw(view, options);
    }
</script>