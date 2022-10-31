@include('employee.layouts.sidebar')
@include('employee.layouts.header')

<main class="maintop">
    <div class="mainsectionbox">
        <div class="container-fluid">
            @if(Session::get('alert'))
            <div class="alert alert-{{Session::get('alert')}} alert-dismissible" role="alert">
                <p>{{Session::get('message')}} </p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            @endif
            @include('sweet::alert')
        </div>
        <div class="bank-innersection">
            <div class="table-title-add">
                <div class="row">
                <div class="col-sm-12">
                    <h2 style="text-align:center;">My Attendance </h2>
                </div>
           {{-- @if(count($my_attendance)) --}}
            <form  method="post" action="{{ route('employee.attendance_filter')}}" id="filterForm" enctype="multipart/form-data">
                <div class="row">
                @csrf
                <div class="col-sm-2">
                    <input type="text" id="yearPicker" name="year" placeholder="Select Year" value="{{(!empty($year_status))? $year_status:''}}"autocomplete="off">
                </div>
                <div class="col-sm-2"> 
                    <input type="text" id="monthPicker" name="month"  placeholder="Select Month" value="{{(!empty($month_status))? $month_status:''}}"autocomplete="off">
                </div>
                <div class="col-sm-2">
                    <input type="text" id="datePicker"  name="date"  placeholder="Select Date" value="{{(!empty($date_status))? $date_status:''}}"autocomplete="off">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
               
                <div class="col-sm-2 mt-2 ml-4">
                   <h6>  <span class="totleorotime">Total  Time :</span> {{ $total_time}}</h6>
                </div>
             {{-- @endif --}}  
                </div>
            </form>
            </div>
        </div>
        </div>
        <div class="customtableinnerbox" id="myFilterForm">
            <div class="main-container-inner">
                @if(count($my_attendance) > 0)
                <div class="table-wrapper p-0">
                    <table class="datatable table table-bordered table-striped table-hover" id="myDtTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Total Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($my_attendance as $attendance)
                            <tr>
                                <td>{{$attendance->id}}</td>
                                <td>{{$attendance->date}}</td>
                                <td>{{($attendance->start_time !== null) ? \Carbon\Carbon::parse($attendance->start_time)->format('g:i A') : "Pending"}}</td>
                                <td>{{($attendance->end_time !== null) ? \Carbon\Carbon::parse($attendance->end_time)->format('g:i A') : "Pending"}}</td>

                                <?php
                                    // Converting time to hours/minutes/seconds..
                                    $startTime = strtotime($attendance->start_time);
                                    if (!is_null($attendance->end_time)) {
                                        $endTime = strtotime($attendance->end_time);
                                        $init = $endTime - $startTime;
                                        $hours = floor($init / 3600);
                                        $hour = (int) $hours;
                                        $minutes = floor(($init / 60) % 60);
                                        $minute = (int) $minutes;
                                    }

                                    //End converting time to hours/minutes/seconds..
                                    ?>
                                @if(!is_null($attendance->end_time)) @if($hour !== 0 )
                                <td>{{$hour}} hour {{$minute}} min</td>
                                @else
                                <td>{{$minute}} min</td>
                                @endif @else
                                <td>Pending</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <h1 class="nodatafoundheading">No data found</h1>
                @endif
            </div>
        </div>

    </div> 
</main>

@include('employee.layouts.footer')