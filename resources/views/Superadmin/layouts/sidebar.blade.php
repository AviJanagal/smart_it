<div class="sidemenubar">
		<div class="toggle">
			<i class="fa fa-bars" aria-hidden="true"></i>
		</div>
		<div class="mainlogoimage"> <img src="{{asset('images/mainlogo3.png')}}" /> </div>
		<nav>
			<ul >
				<li>
					<a href="{{route('admin.home')}} " class="{{ (request()->is('admin.home')) ? 'active' : '' }}"> <span class="icon "><i class="fa fa-server" aria-hidden="true"></i></span> <span class="title ">Dashboard</span> </a>
				</li>
				<li class="sidebar-dropdown active ">
					<a href="#"> <i class="fa fa-home home-custom " aria-hidden="true"></i><span>Employee</span> <i class="fa fa-angle-right right-custom" aria-hidden="true"></i> </a>
					<ul class="sidebar-submenu" style="display:none;">
						<li> <a href="{{route('admin.employee.index')}}">Add New Employee
                        
                      </a> </li>
						<li> <a href="{{route('admin.employee.create')}}">Employees List</a> </li>
						
					</ul>
				</li>
				<li class="sidebar-dropdown  ">
					<a href="{{route('admin.client.index')}}"> <i class="fa fa-home home-custom " aria-hidden="true"></i><span>Client</span> </a>
				</li>
				<li class="sidebar-dropdown  ">
					<a href="{{route('admin.project.index')}}"> <i class="fa fa-home home-custom " aria-hidden="true"></i><span>Project</span> </a>
				</li>
			</ul>
		</nav>
	</div>