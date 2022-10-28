@include('employee.layouts.sidebar')
@include('employee.layouts.header')

<main class="maintop">
  <div class="mainsectionbox">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12">
          @if (Session::get('alert'))
          <div class="alert alert-{{ Session::get('alert') }} alert-dismissible" role="alert">
            <p>{{ Session::get('message') }} </p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          @endif
          @include('sweet::alert')
        </div>
        <div class="col-md-12">
          <div class="tattotsylehed">
            <label class="sl">Select Project</label>
          </div>
        </div>

        <div class="row mb-4">
           <div class="col-md-8">
            <form data-toggle="validator">
              @csrf         
              <?php
                $projects_ids = \App\ProjectAssign::where('developer_id',auth()->user()->id)->pluck('project_id');
                if($projects_ids){
                  $projects = \App\Project::whereIn('id', $projects_ids)->get();
                }
              ?>
            <select class="form-select col-md-4"  name="project_id" id="myProject" {{($type == "1") ? "disabled" : " "}} required>
                <option selected value="" disabled>Select </option>
               @if($projects_ids){
                @foreach ($projects as $project)
									<option value="{{$project->id}}">{{$project->project_name}}</option>
								@endforeach
									<option value="0">Other</option>
              @endif
               
            </select>
          </div>
              <div class="col-md-4">
                @if($type == 1)
                <a href="{{ route('employee.finish_daily_activity')}}" class="btn btn-success" >Finish</a>
                @else
                <button type="submit" class="btn btn-danger custom-innerbutton btn-stylessav d-none" id="#sub">Submit</button>
                @endif
              </div>           
            </form>
       </div>

  
      <div class="bank-innersection mb-3">
        <div class="table-title-add">
            <div class="row">
              <div class="col-sm-12">
                <h2 class="mb-0" style="text-align:center;">Today's Activity List</h2>
              </div>
              @if(count($total_daily_activity)){
               <div class="col-sm-2 mt-2 ml-4">
                   <h6>  <span class="totleorotime">Total  Time :</span> {{$total_time}}</h6>
                </div>
              @endif
            </div>
        </div>
      </div>

      <div class="customtableinnerbox">

      <div class="main-container-inner">
       
       @if(count($total_daily_activity) > 0)
        <div class="table-wrapper p-0">
          <table class=" datatable table table-bordered table-striped table-hover " id="user_data_table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Project Name</th>
                <th>Description</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Total Time</th>
              </tr>
            </thead>
            <tbody>
             @foreach($total_daily_activity as $daily_activity)
              <tr>
                <td>{{$daily_activity->id}}</td>
                <!-- here 0 project_id is for other tasks -->
                @if($daily_activity->project_id !== 0)
                  @php
                      $project = \App\Project::where('id', $daily_activity->project_id)->value('project_name');
                  @endphp
                  <td>{{$project}}</td>
                @else
                    <td>Other</td>
                @endif
                <td>{{$daily_activity->description}}</td>
                <td>{{($daily_activity->start_time !== null) ? \Carbon\Carbon::parse($daily_activity->start_time)->format('g:i A') : "Pending"}}</td>
                <td>{{($daily_activity->end_time !== null) ? \Carbon\Carbon::parse($daily_activity->end_time)->format('g:i A') : "Pending"}}</td>
                <?php
                  // Converting time to hours/minutes/seconds..
                  $startTime = strtotime($daily_activity->start_time);
                  if(!is_null($daily_activity->end_time)){
                    $endTime = strtotime($daily_activity->end_time);
                    $init = $endTime - $startTime;
                    $hours = floor($init / 3600);
                    $hour = (int) ($hours);
                    $minutes = floor(($init / 60) % 60);
                    $minute = (int) ($minutes);
                  }
                  //End converting time to hours/minutes/seconds..
                ?>
                @if(!is_null($daily_activity->end_time))
                  @if($hour !== 0 )
                    <td>{{$hour}} hour {{$minute}} min</td>
                  @else
                    <td>{{$minute}} min</td>
                  @endif
                @else
                  <td>Pending</td>
                @endif
               
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      @else
        <h6 class="nodatafoundheading" >No data found</h6>
      @endif 
      </div>
      </div>
    </div>
</main>






@include('employee.layouts.footer')