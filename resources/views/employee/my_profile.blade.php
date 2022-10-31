@include('employee.layouts.sidebar')
@include('employee.layouts.header')
<main class="maintop">
    <div class="headermaintopbarcustom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 custompadding">
            <div class="mainheadingtopbarcustom"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="maincustomsetting">
      <div class="mainsection">
        <div class="container">
          <div class="row">
             @include('sweet::alert')
            <div class="col-md-4">
              <div class="profilesectionleftcustomsetting">
               
                <div class="profileimgboxcustomsetting">
                  <a href="#"><i class="fa fa-camera" aria-hidden="true"  onclick="UploadProfileImg()"></i></a>
                  <img src="{{(!is_null($profile->image))? $profile->image : asset('images/profile-image.jpg')}}">
                </div>
                <div class="customphoneboxsetting">
                  <a href="#">
                    <i class="fa fa-phone" aria-hidden="true"></i>{{auth()->user()->phone_number }} </a>
                </div>
                <div class="mailboxcustomsetting">
                  <a href="#" class="custommail">
                    <i class="fa fa-envelope" aria-hidden="true"></i>{{auth()->user()->email }}  </a>
                </div>
                <button type="button" class="custtombuttonsettingdownload"><a href="{{route('employee.download_icard')}}">Download Id Card</a></button>
              </div>
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-12">
                  <div class="headingmaincustomsetting">
                    <h1>{{ucfirst(auth()->user()->first_name )}} {{auth()->user()->last_name }} </h1>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="personalinfoboxcustomsetting">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="haedingbottomborder">
                          <div class="headingpersonalinfocustomsetting">
                            <h3>PERSONAL INFO</h3>
                          </div>
                         
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="innerboxinfocustomsetting">
                          <h6>Name</h6>
                          <p>
                            <span>{{ucfirst(auth()->user()->first_name )}} {{auth()->user()->last_name }} </span>
                          </p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="innerboxinfocustomsetting">
                          <h6>Date of Birth </h6>
                          <p>
                            <span>{{$profile->dob}}</span>
                          </p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="innerboxinfocustomsetting">
                          <h6>Gender</h6>
                          <p>
                            <span>{{$profile->gender}}</span>
                          </p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="innerboxinfocustomsetting">
                          <h6>Employee Id</h6>
                          <p>
                            <span># {{$profile->employee_id}} </span>
                          </p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="innerboxinfocustomsetting">
                          <h6>Date of Joining </h6>
                          <p>
                            <span>{{$profile->date_of_joining}}</span>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="personalinfoboxcustomsetting">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="haedingbottomborder">
                          <div class="headingpersonalinfocustomsetting">
                            <h3>Department Info</h3>
                          </div>
                         
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="innerboxinfocustomsetting">
                          <h6>Department</h6>
                        
                          <p>
                            <span>{{$profile->department_name}}</span>
                          </p>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="innerboxinfocustomsetting">
                          <h6>Designation</h6>
                          <p>
                            <span>{{$profile->designation}}</span>
                          </p>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="innerboxinfocustomsetting">
                          <h6>Employee Type</h6>
                          <p>
                            <span>{{$profile->employee_type}}</span>
                          </p>
                        </div>
                      </div>
                      <!-- <div class="col-md-6">
                        <div class="innerboxinfocustomsetting">
                          <h6>Alternate Phone Number</h6>
                          <p>
                            <span>-</span>
                          </p>
                        </div>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     
    <!-- main-wrapper end -->
    <!-- footer start-->
    <!-- footer end -->
    </main>
   @include('employee.layouts.footer')
   <!-- get project description model -->
<div class="modal fade " id="ProfilePicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content customchanges">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Profile Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <form action="{{ route('employee.upload_profile_pic')}}" method="post" id="myformVal" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Upload Image:</label>
            <input type="file" name="profile_pic" id="imgInp" required>
            <img src="{{(!is_null($profile->image))? $profile->image : asset('images/profile-image.jpg')}}" height="50" width="50" id="blah" class="mt-4">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="hideModel()">Update</button>
      </div>
	    </form>
    </div>
  </div>
</div>
	<!-- End project description model -->

<script>
  function UploadProfileImg(){
    $('#ProfilePicModal').modal('show');
  }
  
  imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}

function hideModel() {
  $('#ProfilePicModal').modal('hide')
}
</script>

