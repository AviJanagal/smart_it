@include('layouts.header')
@include('layouts.sidebar')
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
                <form role="form" data-toggle="validator" action="{{route('add_employee') }}" method="post" enctype="multipart/form-data">
                @else
                <form role="form" data-toggle="validator" action="{{route('update_employee',$service_edit->id)}}" method="post" enctype="multipart/form-data">
                @endif
                @csrf
					<div class="row m-0">
                        
                        <div class="col-md-4">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> Name</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $service_edit->service_name : ''; ?>" type="text"  name="name" placeholder="Enter Employee Name" required  />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> Email</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $service_edit->service_name : ''; ?>" type="email"  name="email" placeholder="Enter Employee email" required  />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> Password</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $service_edit->service_name : ''; ?>" type="password"  name="password" placeholder="Enter Employee Password" required  />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> Designation</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror" value="<?php echo $type == 2 ? $service_edit->service_name : ''; ?>" type="text"  name="designation" placeholder="Enter Employee Name" required  />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group ">
                                <label for="usr" class="inputlabel">Image</label>
                                @if($type == 1)
                                <input type="file" class="form-control-file custom-control custom-inner" name="image">
                                @else
                                    @if(!is_null($service_edit->image))
                                    <img src="{{ asset($service_edit->image) }}" width="50" height="50">
                                    @endif
                                <input type="file" class="form-control-file custom-control custom-inner" name="image">
                                @endif
                            </div>
                        </div> -->
                        <!-- <div class="col-md-6">
                            <div class="form-group ">
                                <label for="status">Status</label>
                                <div class="form-check form-check-inline custom-button custom-buttonbox mystatusbtn ml-0">
                                    @if($type == 1)
                                    <input type="radio" name="a" value="active" id="rad1" checked>
                                    <label for="rad1">Active</label>
                                    @else
                                    <input id="rad1" type="radio" name="a" value="active" @if($service_edit->status == "active") checked @endif>
                                    <label for="rad1">Active</label>

                                    @endif
                                    @if($type == 1)
                                    <input id="rad2" type="radio" name="a" value="inactive">
                                    <label for="rad2">Inactive</label>
                                    @else
                                    <input id="rad2" type="radio" name="a" value="inactive"  @if($service_edit->status == "inactive") checked @endif>
                                    <label for="rad2">Inactive</label>

                                    @endif
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            @if($type == 1)
                                <button type="submit" class="btn btn-danger custom-innerbutton ">Save</button>
                            @else
                                <button type="submit" class="btn btn-danger custom-innerbutton">Update</button>
                            @endif     
                        </div>
                    </div>      
				</form>
			</div>
		</div>
    </div>
</main>
@include('layouts.footer')