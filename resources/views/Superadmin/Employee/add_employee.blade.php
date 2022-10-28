<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>

	<link rel="icon" href="{{ asset('images/smartit.png') }}" type="image/png" sizes="16x16">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('multistepform/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('multistepform/fonts/material-icon/css/material-design-iconic-font.min.css') }}"> 

</head>

<body>

<header class="headertop">
    <div class="container-fluid">
        <div class="row custom-row">
            <!-- <div class="col-md-6">
                <div class="headingbox">
                    <h6>
                        <a href="#"> <span class="app">Application </span></a><span class="ïcon"><i class="fa fa-arrow-right" aria-hidden="true"></i></span><span class="dash">Dashboard</span>
                    </h6>
                </div>
            </div> -->
            <!-- <div class="col-md-6">
                <div class="profilebox">
                    <div class="dropdown-custom2">
                        <button class="dropdown-toggle dropdown-custom" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <a href="#"> <img src="{{asset('images/userimage2.png')}}" /></a>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item " href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Setting</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <span class="">Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
					</div>
				</div>
            </div> -->
        </div>
    </div>
</header>

@include('Superadmin.layouts.sidebar')
    <div class="main">
        <div class="container">
            <div class="container-fluid">
                @if($type == 1)
                <h2 style=" margin-bottom:20px; color:#f05a22;">Add Employee </h2>
                @else
                <h2 style=" margin-bottom:20px; color:#f05a22;">Update Employee </h2>
                @endif
                @if($type == 1)
                    <form role="form" class="signup-form" id="signup-form" autocomplete="off" data-toggle="validator" action="{{route('admin.employee.store')}}" method="post" enctype="multipart/form-data">
                @else
                    <form role="form" id="signup-form" class="signup-form"  data-toggle="validator" action="{{route('admin.employee.update',$employee->id)}}" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                @endif
                @csrf
                <h3><span class="title_text"> Login Information</span></h3>
                <fieldset>
                    <div class="col-md-12">
                        <div class="form-group custom-from">
                            <label for="first_name" class="inputlabel multiformlabel">First Name</label>
                            <input class="form-control @error('first_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->first_name : ''; ?>" type="text"  id="first_name" name="first_name" placeholder="First Name" required  />
                            @error('first_name')
                            <span class="invalid-feedback errorcorrectmessage" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group custom-from">
                            <label for="last_name" class="inputlabel multiformlabel">Last Name</label>
                            <input class="form-control  @error('last_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->last_name : ''; ?>" type="text" id="last_name" name="last_name" placeholder="Last Name" required  />
                            @error('last_name')
                            <span class="invalid-feedback errorcorrectmessage" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group custom-from">
                            <label for="email" class="form-label">Email</label>
                            <input autocomplete="false" class="form-control @error('email') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->email : ''; ?>" type="email" id="email"  name="email" placeholder="Email"/>
                            @error('email')
                            <span class="invalid-feedback errorcorrectmessage" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group custom-from">
                            <label for="password" class="inputlabel multiformlabel"> Password</label>
                            <input autocomplete="false" class="form-control  @error('password') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->password : ''; ?>" type="password" id="password"  name="password" placeholder=" Password" required/>
                            @error('password')
                            <span class="invalid-feedback errorcorrectmessage" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group custom-from">
                            <label for="phone_number" class="inputlabel multiformlabel"> Phone Number</label>
                            <input class="form-control  @error('phone_number') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->phone_number : ''; ?>" type="number" id="phone_number" name="phone_number" placeholder=" Mobile Number" required/>
                            @error('phone_number')
                            <span class="invalid-feedback errorcorrectmessage" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="fieldset-footer">
                        <span>Step 1 of 3</span>
                    </div>
                </fieldset>
                <h3><span class="title_text"> Basic Information</span></h3>
                <fieldset>
                    <div class="col-md-10">
                        <div class="form-group custom-from">
                            <label for="dob" class="inputlabel multiformlabel" class="form-label multiformlabel "> Date of Birth</label>
                            <input class="form-control  @error('dob') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_info->dob : ''; ?>" type="date" id="dob" name="dob" placeholder="D-O-B" required/>
                            @error('dob')
                            <span class="invalid-feedback errorcorrectmessage" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group custom-from">
                            <label for="gender" class="inputlabel multiformlabel" class="form-label multiformlabel">Gender</label>
                            <div class="form-check form-check-inline custom-button custom-buttonbox mystatusbtn ml-0 multiformradio">
                                @if($type == 1)
                                    <input class="form-control" type="radio" name="gender" value="male" id="rad1" checked>
                                    <label class="radiomultiformtext" for="rad1">Male</label>
                                @else
                                    <input class="form-control" id="rad1" type="radio" name="gender" value="male" @if($employee->emp_info->gender == "male") checked @endif>
                                    <label class="radiomultiformtext" for="rad1">Male</label>
                                @endif

                                @if($type == 1)
                                    <input class="form-control" id="rad2" type="radio" name="gender" value="female">
                                    <label class="radiomultiformtext" for="rad2">Female</label>
                                @else
                                    <input class="form-control" id="rad2" type="radio" name="gender" value="female"  @if($employee->emp_info->gender == "female") checked @endif>
                                    <label class="radiomultiformtext" for="rad2">Female</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group custom-from">
                            <label for="Name" class="inputlabel multiformlabel"> Employee Id</label>
                            <input class="form-control  @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_info->employee_id : ''; ?>" type="text" id="employee_id" name="employee_id" placeholder="Employee Id" required  />
                            @error('email')
                            <span class="invalid-feedback errorcorrectmessage" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group custom-from">
                            <label for="Name" class="inputlabel multiformlabel"> Department</label>
                            <select id="department" class="form-select departmentclasssetting" name="department">
                            <option value="" disabled selected hidden>Select Department</option>
                                @if($type == 1)
                                @foreach($get_department as $list)
                                <option value="{{$list->id}}">{{$list->name}}</option>
                                @endforeach
                                @else
                                    @foreach($get_department as $list)
                                        @if($list->id == $employee->emp_info->department )
                                        <option value="{{$list->id}}" selected>{{$list->name}}</option>
                                        @else
                                        <option value="{{$list->id}}">{{$list->name}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group custom-from">
                            <label for="Name" class="inputlabel multiformlabel"> Designation</label>
                            <input class="form-control  @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_info->designation : ''; ?>" type="text" id="designation"  name="designation" placeholder="Designation" required  />
                            @error('email')
                            <span class="invalid-feedback errorcorrectmessage" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>



                    <!-- <div class="col-md-10">
                        <div class="form-group custom-from">
                            <label for="Name" class="inputlabel multiformlabel"> Job Title</label>
                            <input class="form-control  @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_info->job_title : ''; ?>" type="text" id="job_title" name="job_title" placeholder="Job Title " required  />
                            @error('name')
                            <span class="invalid-feedback errorcorrectmessage" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div> -->


                    <div class="col-md-10">
                    <div class="form-group custom-from">
                    <label for="Name" class="inputlabel multiformlabel">Image</label>
                                @if($type == 1)
                                <input type="file" class="form-control imageinputcss" name="image" id="image"  placeholder="image" required >
                                @else
                                    <!-- @if(!is_null($employee->emp_info->image))
                                    <img src="{{ asset($employee->emp_info->image) }}" width="50" height="50">
                                    @endif -->
                                <input type="file" class="form-control imageinputcss" name="image">
                                @endif
                            </div>
                        </div>




                    <div class="col-md-10">
                        <div class="form-group custom-from">
                            <label for="Name" class="inputlabel multiformlabel"> Employee Type</label>
                            <select id="employee_type" class="form-select departmentclasssetting" name="employee_type">
                            <option value="" disabled selected hidden>Select Employee Type</option>
                                @if($type == 1)
                                <option value="Full-Time">Full-Time</option>
                                <option value="Part-Time">Part-Time</option>
                                <option value="temporary ">Temporary</option>
                                <option value="Trainee">Trainee</option>
                                @else     
                                <option value="Full-Time" @if($employee->emp_info->employee_type == "Full-Time") selected @endif>Full-Time Employee</option>
                                <option value="Part-Time" @if($employee->emp_info->employee_type == "Part-Time") selected @endif>Part-Time Employee</option>
                                <option value="temporary" @if($employee->emp_info->employee_type == "temporary") selected @endif>temporary Employee</option>
                                <option value="Trainee" @if($employee->emp_info->employee_type == "Trainee") selected @endif>Trainee</option>  
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group custom-from">
                            <label for="Name" class="inputlabel multiformlabel"> Date of Joining</label>
                            <input class="form-control  @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_info->date_of_joining : ''; ?>" type="date" id="date_of_joining" name="date_of_joining" placeholder="Date Of Joining" required  />
                            @error('name')
                            <span class="invalid-feedback errorcorrectmessage" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="fieldset-footer">
                        <span>Step 2 of 3</span>
                    </div>
                </fieldset>
                <h3><span class="title_text"> Account Information</span></h3>
                <fieldset>
                    <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel multiformlabel"> CTC</label>
                                <input class="form-control  @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_account->ctc : ''; ?>" type="text" id="ctc" name="ctc" placeholder="CTC" required  />
                                @error('email')
                                <span class="invalid-feedback errorcorrectmessage" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel multiformlabel"> Bank Name</label>
                                <input class="form-control  @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_account->bank_name : ''; ?>" type="text" id="bank_name" name="bank_name" placeholder="Bank Name" required  />
                                @error('email')
                                <span class="invalid-feedback errorcorrectmessage" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel multiformlabel"> City</label>
                                <input class="form-control  @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_account->city : ''; ?>" type="text" id="city" name="city" placeholder="City" required  />
                                @error('name')
                                <span class="invalid-feedback errorcorrectmessage" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel multiformlabel"> Branch Name</label>
                                <input class="form-control  @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_account->branch_name : ''; ?>" type="text" id="branch_name" name="branch_name" placeholder="Branch Name" required  />
                                @error('name')
                                <span class="invalid-feedback errorcorrectmessage" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel multiformlabel"> IFSC Code</label>
                                <input class="form-control  @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_account->ifsc_code : ''; ?>" type="text" id="ifsc_code" name="ifsc_code" placeholder="IFSC Code" required  />
                                @error('name')
                                <span class="invalid-feedback errorcorrectmessage" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel multiformlabel"> Account Number </label>
                                <input class="form-control  @error('account_number') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_account->account_number : ''; ?>" type="text" id="account_number" name="account_number" placeholder="Account Number" required  />
                                @error('account_number')
                                <span class="invalid-feedback errorcorrectmessage" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    <div class="fieldset-footer">
                        <span>Step 3 of 3</span>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>


<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://kit.fontawesome.com/9681e38096.js" crossorigin="anonymous"></script>
<!-- <script src="{{ asset('multistepform/vendor/jquery/jquery.min.js') }}"></script>  -->
 <script src="{{ asset('multistepform/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('multistepform/vendor/jquery-steps/jquery.steps.min.js') }}"></script>
<script src="{{ asset('multistepform/js/main.js') }}"></script>


<script>


$("#select_employee").select2({
    placeholder: "Select Developer",
    allowClear: true
});


    $( document ).ready(function() {
        $('#user_data_table').DataTable({order:[[0,"desc"]]});
    });

   
    // $( document ).ready(function() {
    //     $('#user_data_table_1').DataTable({order:[[1,"desc"]]});
    // });


    function deletedata(url){

    $('#delete_modal').modal('show');
    $("#delete_user").attr('href', url);
    
    }


    
    jQuery(function ($)
    {
    $(".sidebar-dropdown > a").click(function()
    {
    $(".sidebar-submenu").slideUp(200);
    if($(this).parent().hasClass("active"))
    {
        $(".sidebar-dropdown").removeClass("active");
        $(this).parent().removeClass("active");
    }
    else
    {
        $(".sidebar-dropdown").removeClass("active");
        $(this).next(".sidebar-submenu").slideDown(200);
        $(this).parent().addClass("active");
    }
    });
    });



	$('#percent').on('change', function() {
		var val = parseInt($(this).val());
		var $circle = $('#svg #bar');
		if(isNaN(val)) {
			val = 100;
		} else {
			var r = $circle.attr('r');
			var c = Math.PI * (r * 2);
			if(val < 0) {
				val = 0;
			}
			if(val > 100) {
				val = 100;
			}
			var pct = ((100 - val) / 100) * c;
			$circle.css({
				strokeDashoffset: pct
			});
			$('#cont').attr('data-pct', val);
		}
	});


    let toggle = document.querySelector('.toggle');
    let sidemenubar = document.querySelector('.sidemenubar');
    let maintop = document.querySelector('.maintop');
    let headertop = document.querySelector('.headertop');

    toggle.onclick = function(){
        sidemenubar.classList.toggle('active');
        maintop.classList.toggle('active');
        headertop.classList.toggle('active');
    }



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


    $(document).ready(function(){
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});



$('#nav-tab a:first').tab('show');
//for bootstrap 3 use 'shown.bs.tab' instead of 'shown' in the next line
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
//save the latest tab; use cookies if you like 'em better:
localStorage.setItem('selectedTab', $(e.target).attr('id'));
});

//go to the latest tab, if it exists:
var selectedTab = localStorage.getItem('selectedTab');
if (selectedTab) {
  $('#'+selectedTab).tab('show');
}



   $("#clientform").validate({
    submitHandler: function(form) {  
      form.submit(); 
      },
    rules: {
        name: 'required',
          email: {
            required: true,
            email: true,//add an email rule that will ensure the value entered is valid email id.
            maxlength: 255,
         },

    }  
    });
    
</script>
</body>
</html>

