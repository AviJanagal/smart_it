<div class="sidemenubar">
		<div class="toggle">
			<i class="fa fa-bars" aria-hidden="true"></i>
		</div>
		<div class="mainlogoimage"> <img src="{{asset('images/smart_it.png')}}" /> </div>
		<nav>
			<ul >
				<li>
					<a href="{{route('employee.employee.index')}} " class="{{ (request()->is('employee.employee.index')) ? 'active' : '' }}"> <span class="icon "><i class="fa fa-server" aria-hidden="true"></i></span> <span class="title ">Dashboard</span> </a>
				</li>

				<li>
					<a href="{{route('employee.attendance_history')}} " class="{{ (request()->is('employee.attendance_history')) ? 'active' : '' }}"> <span class="icon "><i class="fa fa-server" aria-hidden="true"></i></span> <span class="title ">Attendance History</span> </a>
				</li>
				<li class="sidebar-dropdown active ">
					<a href="#"> <i class="fa fa-home home-custom " aria-hidden="true"></i><span>Daily Activity</span> <i class="fa fa-angle-right right-custom" aria-hidden="true"></i> </a>
					<ul class="sidebar-submenu" style="display:none;">
						<li> <a href="{{route('employee.daily_activity') }}">Add
                        
                      </a> </li>
						<li> <a href="{{route('employee.all_daily_activities') }}">My Activity</a> </li>
						
						
					</ul>
				</li>
				
			</ul>
		</nav>
	</div>