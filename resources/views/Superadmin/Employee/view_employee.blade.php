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
                                <a class="nav-item nav-link custom-tab " id="nav-Reviews-tab" data-toggle="tab" href="#nav-Reviews" role="tab" aria-controls="nav-Reviews" aria-selected="false">Graph</a>
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
                                        <p>{{ucfirst($employee->first_name)}}&nbsp;{{ucfirst($employee->last_name)}}</p>
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
                                        <h5>{{ucfirst($employee->emp_info->designation)}}</h5>
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
                                        <h5>{{ucfirst($employee->emp_info->department)}}</h5>
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
                                        <h5>{{ucfirst($employee->emp_info->employee_type)}}</h5>
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




        <div class="gallery-section">
                <div class="container-fluid">
                <div class="row">


                <div class="row">
                    <div class="col-md-2 mt-4">
                   

                        <form id="graph_form_status" data-toggle="validator" action="" method="post">
                            @csrf
                            <div class="col-md-12">

                                <select class="form-control form-cantrol-custom status_search mt-1" name="graph_form_key" id="graph_form_key">
                                    <option value="all" >All</option>
                                    <option value="weekly" >Weekly</option>
                                    <option value="monthly" >Monthly</option>
                                    <option value="select_date" >Select Date</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-10">
                        <form method="post" action="" id="graph_date" class="mb-3 w-100 ml-3 d-none">
                            @csrf
                            <div class="row">
                                <input type="hidden" value="" name="key" />
                                <!-- <input type = "hidden" value = "null" name = "status" id="status"/> -->
                                <div class="col-lg-4 col-xl-4 col-md-4">
                                    <label for="send_message">Start Date:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control graph_start_date_picker" name="start_date" placeholder="MM/DD/YY" value="" id="start_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-4 col-md-4">
                                    <label for="send_message">End Date:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control graph_end_date_picker" name="end_date" placeholder="MM/DD/YY" value="" id="end_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-4 col-md-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info mtcustom-4">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="row">
                    <div id="dual_x_div" style="width: 100%; "></div>
                </div>
                
                <div class="row d-none " id="graph_result_show">
                    <div class="col-md-12">
                        <h3 class="w-100 text-center b-block">No Data</h3>
                    </div>
                </div>

                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {



            var my_array = <?php echo json_encode($my_array) ?>;

            if (my_array == "") {

                $("#graph_result_show").removeClass("d-none");

            } else {

                var title = [
                    ['Complaint_id', 'Resolved Time', 'Exceed Time', {
                        role: 'annotation'
                    }]
                ];

                var complaints = jQuery.merge(title, my_array);

                var data = google.visualization.arrayToDataTable(complaints);

                var options = {
                    title: "No. of Resolved Complaints",
                    width: "100%",
                    height: 600,
                    colors: ['#0F8B8D', '#ce0808'],
                    bar: {
                        groupWidth: '75%'
                    },
                    hAxis: {
                        title: 'Resolve Time ( in Hrs )',
                    },
                    legend: {
                        position: 'top',
                        maxLines: 3
                    },
                    vAxis: {
                        title: 'Complaint Numbers'
                    },
                    isStacked: true
                };

                var chart = new google.visualization.BarChart(document.getElementById('dual_x_div'));
                chart.draw(data, options);
            }


        };
    </script>












                    
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