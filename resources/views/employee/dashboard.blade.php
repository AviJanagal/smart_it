
@include('employee.layouts.sidebar')
@include('employee.layouts.header')
	<main class="maintop">
    <div class="mainsectionbox">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mainheadingtop">
                                <h4>Hi <span>{{ ucfirst(trans(auth()->user()->first_name)) }}</span>,Welcome back</h4>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mainheadingbox">
                                <div class="iconimg">
                                    <img src="{{ asset('images/checkin.gif') }}" />
                                </div>
                                <div class="flowchart">
                                    <div id="cont" data-pct="00:00"></div>
                                </div>
                                <h6 class="btncheckincheckout"  onclick="logInTime()" id="checkIn" onMouseOver="this.style.cursor = 'pointer'">Check In</h6>
                            </div>
                           
                        </div>
                        <div class="col-md-3">
                            <div class="mainheadingbox">
                                <div class="iconimg">
                                    <img src="{{ asset('images/checkout.gif') }}" />
                                </div>
                                <div class="flowchart">
                                    <div id="cont" class="content" data-pct="00:00"></div>
                                </div>

                                <h6 class="btncheckincheckout" onclick="logOutTime()" onMouseOver="this.style.cursor = 'pointer'">Check Out</h6>
                            </div>
                           
                        </div>
                        
                        <div class="col-md-3">
                            <div class="mainheadingbox">
                                <div class="iconimgmy time">
                                    <img src="{{ asset('images/fulltime.gif') }}" />
                                </div>

                                <div class="flowchart">
                                    <div id="cont" class="total_hours" data-pct="Pending"></div>
                                </div>
                                <h6>Total time</h6>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mainheadingbox">
                                <div class="iconimg">
                                    <img class="holicon" src="{{ asset('images/holiday.gif') }}" />
                                </div>
                                <div class="flowchart">
                                    <h3>3</h3>
                                    <!-- <div id="coent" class="ceontent" data-pct="2"></div> -->
                                </div>

                                <h6>
                                    My Total leaves
                                </h6>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="Pendingbox">
                                <!-- <h3>Pending </h3> -->
                                <div class="textpending">
                                    <p>Today's Attendance</p>
                                </div>
                            </div>
                            <nav>
                                <div class="nav nav-tabs custom-maintab1" id="nav-tab" role="tablist">
                                    <!-- <a class="nav-item nav-link active show  custom-tab1  " id="nav-Artist-tab1" data-toggle="tab" href="#nav-Artist1" role="tab"
															aria-controls="nav-Artist1" aria-selected="true">Artist</a> -->
                                    <!-- <a class="nav-item nav-link   custom-tab1 " id="nav-Vendor1-tab" data-toggle="tab" href="#nav-Vendor1" role="tab"
															aria-controls="nav-Vendor1" aria-selected="false">Vendor</a>
														-->
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade active show" id="nav-Artist1" role="tabpanel" aria-labelledby="nav-Artist-tab1">
                                    <div class="pendingboxinner">
                                        <!-- php	 -->
                                        @php $my_attendance = \App\EmployeeAttendance::where('employee_id',Auth::id())->whereDate('created_at', \Carbon\Carbon::today())->get(); @endphp
                                        <!-- endphp -->
                                        @if(count($my_attendance) > 0)
                                        <div class="table-wrapper p-0">
                                            <table class="datatable table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Total Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($my_attendance as $attendance)
                                                    <tr>
                                                        <td>{{$attendance->id}}</td>
                                                        <td>{{($attendance->start_time !== null) ? \Carbon\Carbon::parse($attendance->start_time)->format('g:i A') : "Pending"}}</td>
                                                        <td>{{($attendance->end_time !== null) ? \Carbon\Carbon::parse($attendance->end_time)->format('g:i A') : "Pending"}}</td>

                                                        <?php
														// Converting time to hours/minutes/seconds..
														$startTime = strtotime($attendance->start_time); if(!is_null($attendance->end_time)){ $endTime = strtotime($attendance->end_time); $init = $endTime - $startTime; $hours = floor($init / 3600); $hour = (int) ($hours); $minutes = floor(($init
                                                        / 60) % 60); $minute = (int) ($minutes); } //End converting time to hours/minutes/seconds.. ?> @if(!is_null($attendance->end_time)) @if($hour !== 0 )
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
                                        <h6>Pending</h6>
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
                        <div class="col-md-4">
                            <div class="Pendingbox">
                                <!-- <h3>Pending </h3> -->
                                <div class="textpending">
                                    <p>Colleagues Working On Project</p>
                                </div>
                            </div>
                            <nav>
                                <div class="nav nav-tabs custom-maintab1" id="nav-tab" role="tablist">
                                    <!-- <a class="nav-item nav-link active show  custom-tab1  " id="nav-Artist-tab1" data-toggle="tab" href="#nav-Artist1" role="tab"
															aria-controls="nav-Artist1" aria-selected="true">Artist</a> -->
                                    <!-- <a class="nav-item nav-link   custom-tab1 " id="nav-Vendor1-tab" data-toggle="tab" href="#nav-Vendor1" role="tab"
															aria-controls="nav-Vendor1" aria-selected="false">Vendor</a>
														-->
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContents">
                                <div class="tab-pane fade active show" id="nav-Artist1" role="tabpanel" aria-labelledby="nav-Artist-tab1">
                                    <div class="pendingboxinner">
                                 
                                        @if(count($all_users) > 0)
                                        <div class="table-wrapper p-0">
                                            <table class="datatable table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Colleague Name</th>
                                                        <th>Project Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($all_users as $users)
                                                    <tr>
                                                        <td>{{$users->id}}</td>
                                                        <td>{{$users->first_name}}</td>
                                                        <td>{{(!empty($users->project_name)) ? $users->project_name : "Pending"}}</td>
                                                      
                                                       
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        @else
                                        <h6>Pending</h6>
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
                        <div class="col-md-4">
                            <div class="Pendingbox">
                                <!-- <h3>Pending </h3> -->
                                <div class="textpending">
                                    <p>Colleagues On Holidays</p>
                                </div>
                            </div>
                            <nav>
                                <div class="nav nav-tabs custom-maintab1" id="nav-tab" role="tablist">
                                    <!-- <a class="nav-item nav-link active show  custom-tab1  " id="nav-Artist-tab1" data-toggle="tab" href="#nav-Artist1" role="tab"
															aria-controls="nav-Artist1" aria-selected="true">Artist</a> -->
                                    <!-- <a class="nav-item nav-link   custom-tab1 " id="nav-Vendor1-tab" data-toggle="tab" href="#nav-Vendor1" role="tab"
															aria-controls="nav-Vendor1" aria-selected="false">Vendor</a>
														-->
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContents">
                                <div class="tab-pane fade active show" id="nav-Artist1" role="tabpanel" aria-labelledby="nav-Artist-tab1">
                                    <div class="pendingboxinner">
                                 
                                        @if(count($all_users) > 0)
                                        <div class="table-wrapper p-0">
                                            <table class="datatable table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Colleague Name</th>
                                                        <th>Project Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($all_users as $users)
                                                    <tr>
                                                        <td>{{$users->id}}</td>
                                                        <td>{{$users->first_name}}</td>
                                                        <td>{{(!empty($users->project_name)) ? $users->project_name : "Pending"}}</td>
                                                      
                                                       
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        @else
                                        <h6>Pending</h6>
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
        </div>
    </div>
</main>

		

@include('employee.layouts.footer')