<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>

	<!-- Bootstrap -->
	<link rel="icon" href="{{ asset('images/smart_it.png') }}" type="image/png" sizes="16x16">
	<!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet" />
	<link href="{{ asset('css/employee/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/employee/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/employee/responsive.css') }}" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">


    <!-- <style>
        #loader {
            border: 12px solid #f3f3f3;
            border-radius: 50%;
            border-top: 12px solid #444444;
            width: 70px;
            height: 70px;
            animation: spin 1s linear infinite;
        }
          
        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
          
        .center {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }
    </style> -->
</head>

<body>
     <!-- <div id="loader" class="center"></div> -->
     
	<header class="headertop">
    <div class="container-fluid">
        <div class="row custom-row">
            <div class="col-md-6">
                <div class="headingbox">
                    <h6>   
                        @php 
                            if(Route::is('employee.attendance_history'))
                            {
                                $name = "Attendance History";
                            }
                            elseif(Route::is('employee.employee.index'))
                            {
                                $name = "Dashboard";
                            }
                            elseif(Route::is('employee.daily_activity'))
                            {
                                $name = "Daily Activity";
                            }
                            elseif(Route::is('employee.all_daily_activities'))
                            {
                                $name = "All Time Activity";
                            }
                            elseif(Route::is('employee.apply_leave'))
                            {
                                $name = "Apply Leave";
                            }
                            elseif(Route::is('employee.graphs') || Route::is('employee.graph_time'))
                            {
                                $name = "Graphs";
                            }
                            elseif(Route::is('employee.my_profile'))
                            {
                                $name = "My profile";
                            }
                            else{
                                $name = " ";
                            }
                        @endphp
                        <a href="#"> <span class="app">Application </span></a><span class="ïcon"><i class="fa fa-arrow-right" aria-hidden="true"></i></span><span class="dash">{{$name}}</span>
                    </h6>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profilebox">
                    <div class="dropdown-custom2">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <a href="#"> <img src="{{asset('images/dummy.jpg')}}" /></a>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('employee.my_profile') }}">Profile</a>
                            <!-- <a class="dropdown-item" href="#">Calender</a> -->
                            <!-- <a class="dropdown-item" href="#">Setting</a> -->
                            <a class="{{ (request()->is('logout')) ? 'active' : '' }} dropdown-item custom-dropdown" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <span class="menuname">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                    Log out
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

	

	

    



     