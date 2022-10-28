@include('employee.layouts.sidebar') 
@include('employee.layouts.header')

<main class="maintop">
	<div class="mainsectionbox mainsectionbox-cus">
		<div class="container-fluid">
			<div class="row">
                <div class="col-md-12">
                    <div class="bank-innersection">
                    <div class="faqheading table-title-add">
                     @include('sweet::alert')
                    <!-- <h4 class="">Apply Leave</h4> -->
                  <h2 class="" style="text-align:center;">Apply Leave </h2>
                    </div>
                </div>
               </div>
                <form role="form" data-toggle="validator" id="ck" action="{{route('employee.send_leave')}}" method="post" enctype="multipart/form-data">
             
                @csrf
					<div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel">Leave From</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror"  type="date" id="service_name" name="start_date" placeholder=" Date From" required  />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group custom-from">
                                <label for="Name" class="inputlabel"> Leave To</label>
                                <input class="form-control custom-control @error('service_name') is-invalid @enderror"  type="date" id="service_name" name="end_date" placeholder=" Date To"   />
                                @error('service_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group custom-from">
                                <label for="description" class="inputlabel">Description</label>
                                <textarea name="discription" class="form-control custom-control-lg custom-text ckeditor " rows="5" cols="50" placeholder="Description" required></textarea>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-12">
                                <button type="submit" class="btn btn-danger custom-apply ">Apply</button>
                        </div>
                    </div>      
				</form>
                 <div class="customtableinnerbox mt-4">
                    <div class="main-container-inner mt-4">
                        <div class="row">
                        <div class="col-md-12">
                            <div class="bank-innersection">
                    <div class="faqheading table-title-add">
                    <h2 class="" style="text-align:center;">Leave Status</h2>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                <div class="table-wrapper p-0">
                @if(count($leaves) > 0)
                    <table class=" datatable table table-bordered table-striped table-hover " >
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Leave</th>
                        <th>view</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($leaves as $leave)
                  <tr>
                    <td>{{$leave->id}}</td>
                    @if((!is_null($leave->start_date) and !is_null($leave->end_date)))
                        @if( ($leave->end_date != $leave->start_date))
                            <td>{{$leave->start_date}} <h6>to</h6> {{$leave->start_date}}</td>
                        @else
                        <td>{{$leave->start_date}}</td>
                        @endif
                    @else
                        <td>{{$leave->start_date}}</td>
                    @endif  
                    <td class="limitedtxt"> {!! Illuminate\Support\Str::limit($leave->discription, 50)  !!}</td>
                    <input type="hidden" id="desc_{{$leave->id}}" value="{!!$leave->discription!!}">
                    <td> <a href="#" onclick="showMailModel('{{$leave->id}}')" ><i class="fa fa-envelope-o iconenvlop" aria-hidden="true"></i></a></td>    
                    @if($leave->status == 1)
                    <td> <a href="#" class="btn btn-success">Approved</a></td>    
                    @elseif($leave->status == 2)
                    <td> <a href="#" class="btn btn-danger">Declined</a></td>    
                    @else
                    <td> <a href="#" class="btn btn-primary">Pending</a></td>    
                    @endif
                  </tr>

                  @endforeach
                </tbody>
                    </table>
                @else
                <h5 class="d-flex justify-content-center">No leave. You are on Fire😎</h5>
                @endif
                </div>
            </div>
            </div>
        </div>
        </div>
			</div>
		</div>
    </div>
</main>

@include('employee.layouts.footer') 
 <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace("discription");
    $("form").submit(function (e) {
        var messageLength = CKEDITOR.instances["discription"].getData().replace(/<[^>]*>/gi, "").length;
        if (!messageLength) {
            $("#ckModel").modal("show");
            e.preventDefault();
        }
    });

</script>
