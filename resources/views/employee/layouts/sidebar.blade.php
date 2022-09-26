<div class="sidemenubar">
	<div class="toggle">
		<i class="fa fa-bars" aria-hidden="true"></i>
	</div>
	<div class="mainlogoimage"> <img src="{{asset('images/smartit.png')}}" /> </div>
	<nav>
		<ul >
			<li>
				<a href="{{route('employee.employee.index')}} " class="{{(Route::is('employee.employee.index'))?'active' : ''}}"> <span class="icon "><i class="fa fa-server" aria-hidden="true"></i></span> <span class="title ">Dashboard</span> </a>
			</li>                                                     

			<li>                                                         
				<a href="{{route('employee.attendance_history')}} " class="{{(Route::is('employee.attendance_history'))?'active' : ''}}"> <span class="icon "><i class="fa fa-check" aria-hidden="true"></i></span> <span class="title ">Attendance History</span> </a>
			</li>
			<li class="sidebar-dropdown active ">
				<a href="#" class="{{in_array(Route::currentRouteName(),['employee.daily_activity','employee.all_daily_activities']) ? 'active' : '' }}"> <i class="fa fa-home home-custom " aria-hidden="true"></i><span>Daily Activity</span> <i class="fa fa-angle-right right-custom" aria-hidden="true"></i> </a>
				<ul class="sidebar-submenu" style="display:none;">
					<li> <a href="{{route('employee.daily_activity') }}">Add
					
					</a> </li>
					<li> <a href="{{route('employee.all_daily_activities') }}">All Time Activity</a> </li>
					
					
				</ul>
			</li>
			<li>                                          
				<a href="{{route('employee.graphs')}} " class="{{in_array(Route::currentRouteName(),['employee.graph_time','employee.graphs']) ? 'active' : '' }}"> <span class="icon "><i class="fa fa-bar-chart" aria-hidden="true"></i></span> <span class="title ">Productivity Graph</span> </a>
			</li>			
			<li>
				<a href="{{ route('employee.calender') }}" class="{{(Route::is('employee.calender'))?'active' : ''}}"> <span class="icon "><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span> <span class="title ">Calender</span> </a>
			</li>			
		</ul>
	</nav>
</div>