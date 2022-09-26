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
            @include('sweet::alert')
           
        </div>
    <div class="bank-innersection">
        <div class="table-title-add">
            <div class="row">
                <div class="col-sm-12">
                    <h2 style="text-align:center;">Current Month Attendance </h2>
                </div>
            </div>
        </div>
    </div>
        <div class="customtableinnerbox">
        <div class="main-container-inner">
        @if(count($all_daily_activities) > 0)
                <div class="table-wrapper p-0">
                    <table class=" datatable table table-bordered table-striped table-hover " id="myTable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Project Name</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Total Time</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_daily_activities as $daily_activities)
                    <tr>
                        <td>{{$daily_activities->id}}</td>
                        <td>{{$daily_activities->date}}</td>
                        @if($daily_activities->project_id == 1)
                        <td>Cut2You</td>
                        @elseif($daily_activities->project_id == 2)
                        <td>Heal It</td>
                        @elseif($daily_activities->project_id == 3)
                        <td>Maid Me</td>
                        @else
                        <td>Orchard Theives</td>
                        @endif
                        <td>{{($daily_activities->start_time !== null) ? \Carbon\Carbon::parse($daily_activities->start_time)->format('g:i A') : "Pending"}}</td>
                        <td>{{($daily_activities->end_time !== null) ? \Carbon\Carbon::parse($daily_activities->end_time)->format('g:i A') : "Pending"}}</td>

                        <?php
                            // Converting time to hours/minutes/seconds..
                            $startTime = strtotime($daily_activities->start_time);
                            if(!is_null($daily_activities->end_time)){
                                $endTime = strtotime($daily_activities->end_time);
                                $init = $endTime - $startTime;
                                
                                $hours = floor($init / 3600);
                                $hour = (int) ($hours);
                                $minutes = floor(($init / 60) % 60);
                                $minute = (int) ($minutes);
                            }
                            //End converting time to hours/minutes/seconds..
                        ?>
                       
                        @if(!is_null($daily_activities->end_time))
                            @if($hour !== 0 )
                                <td>{{$hour}} hour {{$minute}} min</td>
                            @else
                                <td>{{$minute}} min </td>
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