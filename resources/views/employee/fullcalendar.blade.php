<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>

	<!-- Bootstrap -->
	<link rel="icon" href="{{ asset('images/smart_it.png') }}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet" />
	<!-- <link href="{{ asset('css/employee/bootstrap.min.css') }}" rel="stylesheet"> -->
	<link href="{{ asset('css/employee/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/employee/responsive.css') }}" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.css' rel='stylesheet' />
    <link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/moment.min.js'></script>
    <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/jquery.min.js'></script>
    <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.js'></script>
<script>
  $(document).ready(function() {
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: <?php echo json_encode($holidays); ?>

    });
  });
</script>
</head>
<body>
	<header class="headertop">
    <div class="container-fluid">
        <div class="row custom-row">
            <div class="col-md-6">
                <div class="headingbox">
                    <h6>   
                        <a href="#"> <span class="app">Application </span></a><span class="ïcon"><i class="fa fa-arrow-right" aria-hidden="true"></i></span><span class="dash">Calender</span>
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
                            <!-- <a class="dropdown-item" href="#">Profile</a> -->
                            <!-- <a class="dropdown-item" href="{{ route('employee.calender') }}">Calender</a> -->
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
@include('employee.layouts.sidebar')
<body>
    <main class="maintop">
        <div class="mainsectionbox">
            <!-- <div class="container-fluid"> -->
                <div class="bank-innersection">
            <div class="table-title-add">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 style="text-align:center;">Calender </h2>
                    </div>
                </div>
            </div>
        </div>
 <div class="row">
    <div class="col-sm-7">
        <div id='calendar' class="cal-custom"></div>
    </div>
   	
					<div class="col-md-5">
						<div class="row">
							<div class="col-md-12">
								<div class="Pendingbox calender">
									<!-- <h3>Pending </h3> -->
									<div class="textpending">
										<p>Current Month Holidays</p>
									</div>
								</div>
								<nav>
									<div class="nav nav-tabs custom-maintab1" id="nav-tab" role="tablist">
									</div>
								</nav>
								<div class="tab-content" id="nav-tabContent">
									<div class="tab-pane fade active show" id="nav-Artist1" role="tabpanel" aria-labelledby="nav-Artist-tab1">
										<div class="pendingboxinner">
											@if(count($holidays_list) > 0)
											<div class="table-wrapper p-0">
												<table class=" datatable table table-bordered table-striped table-hover " >
												<thead>
												<tr>
                                                
													<th>Date</th>
													<th>Title</th>
													
												</tr>
											</thead>
											<tbody>
											@foreach($holidays_list as $holiday)
												<tr>
													<td>{{date('d F Y', strtotime($holiday->date))}}</td>
													<td>{{$holiday->title}}</td>
												</tr>  
											@endforeach
											 </tbody>
											</table>
										</div>
                                        @else
                                        <h5 class="d-flex justify-content-center">No extra holidays. Enjoy weekends 😊</h5>
										@endif

										
											</div>
										</div>

									<div class="tab-pane fade" id="nav-Vendor1" role="tabpanel" aria-labelledby="nav-Vendor1-tab">
										<div class="flowchart">
											<div id="cont" data-pct="5000">
												<svg id="svg" width="200" height="200" viewPort="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
													<circle r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
													<circle id="bar" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
												</svg>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

</div>
  <!-- </div> -->
  </div>
  </main>
  
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

<script>
    
		   $(window).scroll(function () {
			 if ($(window).scrollTop() >= 300) {
			   $('nav').addClass('fixed-header');
			   $('nav div').addClass('visible-title');
			 }
			 else {
			   $('nav').removeClass('fixed-header');
			   $('nav div').removeClass('visible-title');
			 }
		   });

		    jQuery(function ($) {
                $(".sidebar-dropdown > a").click(function () {
                    $(".sidebar-submenu").slideDown(200);
                    if ($(this).parent().hasClass("active")) {
                        $(".sidebar-dropdown").removeClass("active");
                        $(this).parent().removeClass("active");
                    } else {
                        $(".sidebar-dropdown").removeClass("active");
                        $(this).next(".sidebar-submenu").slideUp(200);
                        $(this).parent().addClass("active");
                    }
                });
            });
	   
		 </script>
         <script>
			let toggle = document.querySelector('.toggle');
			let sidemenubar = document.querySelector('.sidemenubar');
			let maintop = document.querySelector('.maintop');
			let headertop = document.querySelector('.headertop');
	 
			toggle.onclick = function(){
				sidemenubar.classList.toggle('active');
				maintop.classList.toggle('active');
				headertop.classList.toggle('active');
			}
		  </script>
		
		 <script>
		   //Get the button
		   var mybutton = document.getElementById("myBtn");
	   
		   // When the user scrolls down 20px from the top of the document, show the button
		   window.onscroll = function () { scrollFunction() };
	   
		   function scrollFunction() {
			 if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			   mybutton.style.display = "block";
			 } else {
			   mybutton.style.display = "none";
			 }
		   }
	   
		   // When the user clicks on the button, scroll to the top of the document
		   function topFunction() {
			 document.body.scrollTop = 0;
			 document.documentElement.scrollTop = 0;
		   }
	   
		 </script>
		 
</html>