@include('Superadmin.layouts.header')
@include('Superadmin.layouts.sidebar')
<main class="maintop">
	<div class="mainsectionbox mainsectionbox-cus">
		<div class="container-fluid">
			<div class="row">
                <div class="col-md-12">
                    <div class="faqheading">
                    @if($type == 1)
                    <h4 class="">Add Employee</h4>
                    @else
                    <h4 class="">Update Employee</h4>
                    @endif
                    </div>
                </div>

                @if($type == 1)
                <form role="form" class="jqueryvalidationerror" id="myForm" autocomplete="off" data-toggle="validator" action="{{route('admin.employee.store')}}" method="post" enctype="multipart/form-data">
                @else
                <form role="form" id="myForm" data-toggle="validator" action="{{route('admin.employee.update',$employee->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}

                @endif
                @csrf
					<div class="row m-0">


                    <div class="tab">
                    <h1 Style="text-align:center;">Employee Login Information</h1> 

                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="first_name" class="inputlabel">First Name</label>
                                <input class="form-control custom-control @error('first_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->first_name : ''; ?>" type="text"  name="first_name" placeholder="First Name" required  />
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="last_name" class="inputlabel">Last Name</label>
                                <input class="form-control custom-control @error('last_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->last_name : ''; ?>" type="text"  name="last_name" placeholder="Last Name" required  />
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="email" class="inputlabel"> Email</label>
                                <input autocomplete="false" class="form-control custom-control @error('email') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->email : ''; ?>" type="email"  name="email" placeholder="Email" required  />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="password" class="inputlabel"> Password</label>
                                <input autocomplete="false" class="form-control custom-control @error('password') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->password : ''; ?>" type="password"  name="password" placeholder=" Password" required  />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="phone_number" class="inputlabel"> Phone Number</label>
                                <input class="form-control custom-control @error('phone_number') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->phone_number : ''; ?>" type="number"  name="phone_number" placeholder=" Mobile Number" required  />
                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        </div>


                        <div class="tab">
                        <h1 Style="text-align:center;">Employee Basic Information</h1> 

                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="dob" class="inputlabel"> Date of Birth</label>
                                <input class="form-control custom-control @error('dob') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_info->dob : ''; ?>" type="date"  name="dob" placeholder="D-O-B" required  />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="gender">Gender</label>
                                <div class="form-check form-check-inline custom-button custom-buttonbox mystatusbtn ml-0">
                                    @if($type == 1)
                                    <input type="radio" name="a" value="male" id="rad1" checked>
                                    <label for="rad1">Male</label>
                                    @else
                                    <input id="rad1" type="radio" name="a" value="male" @if($employee->emp_info->gender == "male") checked @endif>
                                    <label for="rad1">Male</label>
                                    @endif

                                    @if($type == 1)
                                    <input id="rad2" type="radio" name="a" value="female">
                                    <label for="rad2">Female</label>
                                    @else
                                    <input id="rad2" type="radio" name="a" value="female"  @if($employee->emp_info->gender == "female") checked @endif>
                                    <label for="rad2">Female</label>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> Employee Id</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_info->employee_id : ''; ?>" type="text"  name="employee_id" placeholder="Employee Id" required  />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> Department</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_info->department : ''; ?>" type="text"  name="department" placeholder="Department" required  />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> Designation</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_info->designation : ''; ?>" type="text"  name="designation" placeholder="Designation" required  />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> Job Title</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_info->job_title : ''; ?>" type="text"  name="job_title" placeholder="Job Title " required  />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> Employee Type</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_info->employee_type : ''; ?>" type="text"  name="employee_type" placeholder="Employee Type" required  />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> Date of Joining</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_info->date_of_joining : ''; ?>" type="date"  name="date_of_joining" placeholder="Date Of Joining" required  />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        </div>

                        <div class="tab">
                            <h1 Style="text-align:center;">Employee Account Information</h1> 

                        

                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> CTC</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_account->ctc : ''; ?>" type="text"  name="ctc" placeholder="CTC" required  />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> Bank Name</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_account->bank_name : ''; ?>" type="text"  name="bank_name" placeholder="Bank Name" required  />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> City</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_account->city : ''; ?>" type="text"  name="city" placeholder="City" required  />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> Branch Name</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_account->branch_name : ''; ?>" type="text"  name="branch_name" placeholder="Branch Name" required  />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> IFSC Code</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_account->ifsc_code : ''; ?>" type="text"  name="ifsc_code" placeholder="IFSC Code" required  />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> Account Number </label>
                                <input class="form-control custom-control @error('account_number') is-invalid @enderror" value="<?php echo $type == 2 ? $employee->emp_account->account_number : ''; ?>" type="text"  name="account_number" placeholder="Account Number" required  />
                                @error('account_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        </div>

                        <div style="overflow:auto;">
                        <div style="float:right;">

                        <button type="button" class="previous btn btn-danger custom-innerbutton">Previous</button>
                        <button type="button" class="next btn btn-danger custom-innerbutton">Next</button>
                        <button type="button" class="submit btn btn-danger custom-innerbutton">Submit</button>
                     <!-- <button type="button" class="btn btn-danger custom-innerbutton "  id="prevBtn" onclick="nextPrev(-1) ">Previous</button>
                     <button type="button"  class="btn btn-danger custom-innerbutton " id="nextBtn" onclick="nextPrev(1)">Next</button> -->

                     </div>
                     </div> 

                     <div style="text-align:center;margin-top:40px;">
                     <span class="step"></span>
                     <span class="step"></span>
                     <span class="step"></span>
                  </div> 


                        <!-- <div class="col-md-6">
                            @if($type == 1)
                                <button type="submit" class="btn btn-danger custom-innerbutton ">Save</button>
                            @else
                                <button type="submit" class="btn btn-danger custom-innerbutton">Update</button>
                            @endif     
                        </div> -->
                    </div>      
				</form>
			</div>
		</div>
    </div>
</main>
@include('Superadmin.layouts.footer')