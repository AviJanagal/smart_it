@include('Superadmin.layouts.header')
@include('Superadmin.layouts.sidebar')
<!-- <main class="maintop">
	<div class="mainsectionbox">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-7">
					<div class="row ">
						<div class="col-md-12">
							<div class="mainheadingtop">
								<h4>Hi <span>Admin</span>,Welcome back</h4>
							</div>
						</div>	
						<div class="col-md-4">
							<div class="mainheadingbox">
								<h6>Total Employees</h6>
							</div>
							<div class="flowchart">
								<div id="cont" data-pct="{{$total_employees}}">
									<svg id="svg" width="200" height="200" viewPort="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
										<circle r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
										<circle id="bar" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
									</svg>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="mainheadingbox">
								<h6>Total Clients</h6>
							</div>
							<div class="flowchart">
								<div id="cont" data-pct="{{$total_clients}}">
									<svg id="svg" width="200" height="200" viewPort="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
										<circle r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
										<circle id="bar" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
									</svg>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="mainheadingbox">
								<h6>Total Projects</h6>
							</div>
							<div class="flowchart">
								<div id="cont" data-pct="{{$total_projects}}">
									<svg id="svg" width="200" height="200" viewPort="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
										<circle r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
										<circle id="bar" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
									</svg>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="pendingboxinner">
								<div class="Pendingbox customerheadingbox">
									<h3>Available Employees</h3>
								</div>
								@if(count($employee) > 0)
								@foreach($employee as $item)
								<div class="imgbox2">
									<div class="textbox2">
										<h6>{{ucfirst($item->first_name)}}&nbsp;{{ucfirst($item->last_name)}}</h6>
										<p>{{$item->email}}</p>
									</div>
									<div class="buttonbox2"> <a href="">{{$item->emp_status}}</a></div>

								</div>
								@endforeach
								<div class="viewbuttonbox"> <a href="{{route('admin.employee.create')}}">View More</a> </div>
								@else
								<h4>No data found</h4>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="row">
						<div class="col-md-12">
							<div class="pendingboxinner">
								<div class="Pendingbox customerheadingbox">
									<h3>Employees Working On Projects</h3>
								</div>
								@if(count($projects) > 0)
								@foreach( $projects as $data)
								<div class="imgbox2">
									
									<div class="textbox2">
									@if(!is_null($data))
										<h6>{{ucfirst($data->first_name)}}</h6>
										@endif
										<p>{{$data->email}}</p>
									</div>
									<div class="buttonbox2"> <a href="">{{$data->project_name}}</a></div>
								</div>
								@endforeach
								<div class="viewbuttonbox"> <a href="{{route('admin.get_project_assign')}}">View More</a></div>
								@else
								<h4>No data found</h4>
								@endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="pendingboxinner">
								<div class="Pendingbox customerheadingbox">
									<h3>Employees On Leave</h3>
								</div>
								@if(count($employee_leaves) > 0)
								@foreach( $employee_leaves as $data)
								<div class="imgbox2">
									<div class="textbox2">
									@if(!is_null($data))
										<h6>{{ucfirst($data->employee->first_name)}} &nbsp;{{$data->employee->last_name}}</h6>
										@endif
										<p>{{$data->employee->email}}</p>
									</div>
									<div class="buttonbox2"> <a href="">{!! date('d M Y', strtotime($data->start_date)) !!}</a> </div>
								</div>
								@endforeach
								<div class="viewbuttonbox"> <a href="{{route('admin.show_emp_leave',['view_confirmed_leaves'])}}">View More</a></div>
								@else
								<h4>No data found</h4>
								@endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="pendingboxinner">
								<div class="Pendingbox customerheadingbox">
									<h3>Absent Employees</h3>
								</div>
								@if(count($employee_absent) > 0)
								@foreach( $employee_absent as $data)
								<div class="imgbox2">
									
									<div class="textbox2">
									@if(!is_null($data))
										<h6>{{ucfirst($data->first_name)}} &nbsp;{{$data->last_name}}</h6>
										@endif
										<p>{{$data->email}}</p>
									</div>
									<div class="buttonbox2"> <a href="{{route('admin.view_employee',$data->id)}}">View</a> </div>
								</div>
								@endforeach
								<div class="viewbuttonbox"> <a href=""> </a></div>
								@else
								<h4>No data found</h4>
								@endif
							</div>
						</div>
					</div>
		        </div>
		    </div>
		</div>
	</div>
</main> -->


<main class="maintop">
    <div class="mainsectionbox">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mainheadingtop">
								<h4>Hi <span>{{ucfirst(Auth::user()->first_name)}}&nbsp;{{ucfirst(Auth::user()->last_name)}}</span>,Welcome back</h4>

                            </div>
                        </div>
                        <div class="col-md-4">
						<div class="mainheadingbox">
                                <div class="iconimg">
                                    <img class="holicon" src="{{ asset('images/total_employees.gif') }}" />
                                </div>
                                <div class="flowchart">
                                    <h3>{{$total_employees}}</h3>
                                    <!-- <div id="coent" class="ceontent" data-pct="2"></div> -->
                                </div>

                                <h6>
                                 Total Employees
                                </h6>
                            </div>
                           
                        </div>
                        <div class="col-md-4">
						<div class="mainheadingbox">
                                <div class="iconimg">
                                    <img class="holicon" src="{{ asset('images/total_clients.gif') }}" />
                                </div>
                                <div class="flowchart">
                                    <h3>{{$total_clients}}</h3>
                                    <!-- <div id="coent" class="ceontent" data-pct="2"></div> -->
                                </div>

                                <h6>
                                     Total Clients
                                </h6>
                            </div>
                           
                        </div>
                        
                        <div class="col-md-4">
						<div class="mainheadingbox">
                                <div class="iconimg">
                                    <img class="holicon" src="{{ asset('images/holiday.gif') }}" />
                                </div>
                                <div class="flowchart">
                                    <h3>{{$total_projects}}</h3>
                                    <!-- <div id="coent" class="ceontent" data-pct="2"></div> -->
                                </div>

                                <h6>
                                     Total Projects
                                </h6>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <div class="row">
					
                        <div class="col-md-6">
                            <div class="Pendingbox">
							<h3>Available Employees</h3>
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
                                    <!-- <div class="pendingboxinner">
                                        <div class="table-wrapper p-0">
                                            
                                        </div>
                                    </div> -->

									<div class="pendingboxinner">
								
								@if(count($employee) > 0)
								@foreach($employee as $item)
								<div class="imgbox2">
									<div class="textbox2">
										<h6>{{ucfirst($item->first_name)}}&nbsp;{{ucfirst($item->last_name)}}</h6>
										<p>{{$item->email}}</p>
									</div>
									<div class="buttonbox2"> <a href="">{{$item->emp_status}}</a></div>

								</div>
								@endforeach
								<div class="viewbuttonbox"> <a href="{{route('admin.employee.create')}}">View More</a> </div>
								@else
								<h4>No data found</h4>
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
						
						 <div class="col-md-6">
                            <div class="Pendingbox">
							<h3>Employees Working On Projects</h3>

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
                                    <!-- <div class="pendingboxinner">
                                        <div class="table-wrapper p-0">
                                            
                                        </div>
                                    </div> -->

									<div class="pendingboxinner">
								
									@if(count($projects) > 0)
								@foreach( $projects as $data)
								<div class="imgbox2">
									
									<div class="textbox2">
									@if(!is_null($data))
										<h6>{{ucfirst($data->first_name)}}</h6>
										@endif
										<p>{{$data->email}}</p>
									</div>
									<div class="buttonbox2"> <a href="">{{$data->project_name}}</a></div>
								</div>
								@endforeach
								<div class="viewbuttonbox"> <a href="{{route('admin.get_project_assign')}}">View More</a></div>
								@else
								<h4>No data found</h4>
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
                        <div class="col-md-6">
						<div class="Pendingbox">
						<h3>Employees On Leave</h3>
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
								
									@if(count($employee_leaves) > 0)
								@foreach( $employee_leaves as $data)
								<div class="imgbox2">
									<div class="textbox2">
									@if(!is_null($data))
										<h6>{{ucfirst($data->employee->first_name)}} &nbsp;{{$data->employee->last_name}}</h6>
										@endif
										<p>{{$data->employee->email}}</p>
									</div>
									<div class="buttonbox2"> <a href="">{!! date('d M Y', strtotime($data->start_date)) !!}</a> </div>
								</div>
								@endforeach
								<div class="viewbuttonbox"> <a href="{{route('admin.show_emp_leave',['view_confirmed_leaves'])}}">View More</a></div>
								@else
								<h4>No data found</h4>
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
                        <div class="col-md-6">
						<div class="Pendingbox">
						<h3>Absent Employees</h3>
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
								
									@if(count($employee_absent) > 0)
								@foreach( $employee_absent as $data)
								<div class="imgbox2">
									
									<div class="textbox2">
									@if(!is_null($data))
										<h6>{{ucfirst($data->first_name)}} &nbsp;{{$data->last_name}}</h6>
										@endif
										<p>{{$data->email}}</p>
									</div>
									<div class="buttonbox2"> <a href="{{route('admin.view_employee',$data->id)}}">View</a> </div>
								</div>
								@endforeach
								<!-- <div class="viewbuttonbox"> <a href="{{route('admin.view_employee',$data->id)}}">View </a></div> -->
								@else
								<h4>No data found</h4>
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









@include('Superadmin.layouts.footer')