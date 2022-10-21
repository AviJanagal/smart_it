<div class="sidemenubar">
	<div class="toggle">
		<i class="fa fa-bars" aria-hidden="true"></i>
	</div>
	<div class="mainlogoimage"> <img src="{{asset('images/smartit.png')}}" style="width:183px" /> </div>
	<nav>
		<ul>
			<li>
				<a href="{{route('admin.home')}} " class="{{ Request::routeIs('admin.home') ? 'active' : '' }} "> <span class="icon "><i class="fa fa-home" aria-hidden="true"></i></span> <span class="title ">Dashboard</span> </a>
			</li>
			<li class="sidebar-dropdown active ">
				<a href="#" class="{{ Request::routeIs('admin.employee.index','admin.employee.create','admin.employee.edit','admin.employee.show','admin.show_department','admin.show_emp_leave','admin.edit_department') ? 'active' : '' }} "> <i class="fa fa-user home-custom " aria-hidden="true"></i><span>Employee</span> <i class="fa fa-angle-right right-custom" aria-hidden="true"></i> </a>
				<ul class="sidebar-submenu" style="display:none;">
					<li> <a href="{{route('admin.employee.index')}}">Add New Employee</a></li>
					<li> <a href="{{route('admin.employee.create')}}">Employee List</a> </li>
					<li> <a href="{{route('admin.show_department')}}">Department</a> </li>
					<li> <a href="{{route('admin.show_emp_leave')}}">Leaves</a> </li>
				</ul>
			</li>
			<li class="sidebar-dropdown  ">
				<a href="{{route('admin.client.index')}}" class="{{ Request::routeIs('admin.client.index','admin.client.edit') ? 'active' : '' }} "> <i class="fa fa-user home-custom " aria-hidden="true"></i><span>Client</span> </a>
			</li>
			<li class="sidebar-dropdown  ">
				<a href="{{route('admin.project.index')}}" class="{{ Request::routeIs('admin.project.index','admin.project.edit') ? 'active' : '' }} "> <i class="fa fa-diagram-project home-custom " aria-hidden="true"></i><span>Project</span> </a>
			</li>
			<li class="sidebar-dropdown  ">
				<a href="{{route('admin.get_project_assign')}}" class="{{ Request::routeIs('admin.get_project_assign') ? 'active' : '' }} "> <i class="fa fa-tasks home-custom " aria-hidden="true"></i><span>Project Assign</span> </a>
			</li>
		</ul>
	</nav>
</div>


