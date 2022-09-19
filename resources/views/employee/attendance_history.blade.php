@include('employee.layouts.header')
@include('employee.layouts.sidebar')

<main class="maintop">
    <div class="mainsectionbox">
        <div class="container-fluid">
            @if(Session::get('alert'))
            <div class="alert alert-{{Session::get('alert')}} alert-dismissible" role="alert">
                <p>{{Session::get('message')}} </p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            @endif
        </div>
    <div class="bank-innersection">
        <div class="table-title-add">
            <div class="row">
            <div class="col-sm-12">
            <h2 style="text-align:center;">My Attendance </h2>
            </div>
            </div>
        </div>
        </div>
        <div class="customtableinnerbox">
        <div class="main-container-inner">
        @if(count($my_attendance) > 0)
                <div class="table-wrapper p-0">
                    <table class=" datatable table table-bordered table-striped table-hover " id="myTable">
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
                            if(!is_null($attendance->end_time)){
                                $endTime = strtotime($attendance->end_time);
                                $init = $endTime - $startTime;
                                $hours = floor($init / 3600);
                                $hour = (int) ($hours);
                                $minutes = floor(($init / 60) % 60);
                                $minute = (int) ($minutes);
                            }
                            //End converting time to hours/minutes/seconds..
                        ?>
                        @if(!is_null($attendance->end_time))
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
            <h1 class="nodatafoundheading" >No data found</h1>
            @endif
        </div>
        </div>

    </div> 
</main>

@include('employee.layouts.footer')