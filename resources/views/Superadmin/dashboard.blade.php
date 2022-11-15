@include('Superadmin.layouts.header')
@include('Superadmin.layouts.sidebar')
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
								<h6>Total Employees</h6>
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
								<h6>Total Clients</h6>
							</div>
                        </div>
                        <div class="col-md-4">
							<div class="mainheadingbox">
								<div class="iconimg">
									<img class="holicon" src="{{ asset('images/total_projects.gif') }}"/>
								</div>
								<div class="flowchart">
									<h3>{{$total_projects}}</h3>
									<!-- <div id="coent" class="ceontent" data-pct="2"></div> -->
								</div>
								<h6>Total Projects</h6>
							</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="Pendingbox">
							    <h3>Available Employees</h3>
                            </div>
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
											@if(!is_null($item) && !is_null($item->emp_info) && !is_null($item->emp_info->image))
											<a href=""><img src="{{asset($item->emp_info->image)}}" /></a>
											@else
											<img src="{{asset('images/profile-image.jpg')}}" />

											@endif
											<div class="textbox2">
												<h6>{{ucfirst($item->first_name)}}&nbsp;{{ucfirst($item->last_name)}}</h6>
												<p>{{$item->email}}</p>
											</div>
											<div class="buttonbox2"> <a href="{{route('admin.view_employee',$item->id)}}">{{$item->emp_status}}</a></div>
										</div>
										@endforeach
										<div class="viewbuttonbox"> <a href="{{route('admin.employee.create')}}">View More</a></div>
										@else
										<h4>No data found</h4>
										@endif
							        </div>
                                </div>
                            </div>
                        </div>
						<div class="col-md-3">
                            <div class="Pendingbox">
							    <h3>Employees Working On Projects</h3>
                            </div>
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
													@if(!is_null($data->image))
													    <a href=""><img src="{{asset($data->image)}}" /> </a>
													@else
													    <a href=""><img src="{{asset('images/profile-image.jpg')}}" /> </a>
													@endif
													<div class="textbox2">
													    @if(!is_null($data))
														    <h6>{{ucfirst($data->first_name)}}</h6>
														@endif
														<p>{{$data->email}}</p>
													</div>
													<div class="buttonbox2"> <a style="color:white;">{{$data->project_name}}</a></div>
												</div>
											@endforeach
											<div class="viewbuttonbox"> <a href="{{route('admin.get_project_assign')}}">View More</a></div>
										@else
										    <h4>No data found</h4>
										@endif
							        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
						    <div class="Pendingbox">
						        <h3>Employees On Leave</h3>
                            </div>
                            <div class="tab-content" id="nav-tabContents">
                                <div class="tab-pane fade active show" id="nav-Artist1" role="tabpanel" aria-labelledby="nav-Artist-tab1">
									<div class="pendingboxinner">
									    @if(count($employee_leaves) > 0)
								            @foreach( $employee_leaves as $data)
												<div class="imgbox2">
													@if(!is_null($data->employee) && !is_null($data->employee->emp_info->image))
														<a href=""> <img src="{{asset($data->employee->emp_info->image)}}" /> </a>
													@else
														<a href=""> <img src="{{asset('images/profile-image.jpg')}}" /> </a>
													@endif
													<div class="textbox2">
														@if(!is_null($data))
															<h6>{{ucfirst($data->employee->first_name)}} &nbsp;{{$data->employee->last_name}}</h6>
														@endif
														<p>{{$data->employee->email}}</p>
													</div>
													<div class="buttonbox2"> <a href="{{route('admin.view_employee',$data->id)}}">{!! date('d M Y', strtotime($data->date)) !!}</a> </div>
												</div>
								            @endforeach
								            <div class="viewbuttonbox"> <a href="{{route('admin.show_emp_leave',['view_confirmed_leaves'])}}">View More</a></div>
								        @else
								            <h4>No data found</h4>
								        @endif
							        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
						    <div class="Pendingbox">
						        <h3>Absent Employees</h3>
                            </div>
                            <div class="tab-content" id="nav-tabContents">
                                <div class="tab-pane fade active show" id="nav-Artist1" role="tabpanel" aria-labelledby="nav-Artist-tab1">
									<div class="pendingboxinner">
									    @if(count($employee_absent) > 0)
								            @foreach( $employee_absent as $data)
												<div class="imgbox2">
													@if(!is_null($data->emp_info) && !is_null($data->emp_info->image))
														<a href=""> <img src="{{asset($data->emp_info->image)}}"/> </a>
													@else
														<img src="{{asset('images/profile-image.jpg')}}">
													@endif
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('Superadmin.layouts.footer')