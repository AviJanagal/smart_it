<div class="sidemenubarwrapper ">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <nav class="navbar navbar-expand-lg navbar-light navbarcustome">
          <a class="navbar-brand" href="#">
            <img class="navlogo" src="{{asset('images/smart_it.png')}}" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav customnavbarsettings">
              <li class="nav-item">
                <a class="nav-link  {{ Request::routeIs('admin.home') ? 'active' : '' }}" href="{{route('admin.home')}} ">Dashboard </a>
              </li>
              <li class="nav-item dropdown owndropdown">
                <a class="nav-link dropdown-toggle {{in_array(Route::currentRouteName(),['admin.employee.index','admin.employee.create','admin.employee.edit','admin.employee.show','admin.show_department','admin.show_emp_leave','admin.edit_department','admin.view_employee']) ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Employee</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item {{(Route::is('admin.employee.index'))?'active' : ''}}" href="{{route('admin.employee.index')}}">Add New Employee</a>
                  <a class="dropdown-item {{(Route::is('admin.employee.create'))?'active' : ''}}" href="{{route('admin.employee.create')}}">Employee List</a>
                  <a class="dropdown-item {{(Route::is('admin.show_department'))?'active' : ''}}" href="{{route('admin.show_department')}}">Department </a>
                  <a class="dropdown-item {{(Route::is('admin.show_emp_leave'))?'active' : ''}}" href="{{route('admin.show_emp_leave')}}">Leave Requests</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.client.index','admin.client.edit') ? 'active' : '' }}" href="{{route('admin.client.index')}} ">Client</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.project.index','admin.project.edit') ? 'active' : '' }}" href="{{route('admin.project.index')}}"> Project</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.get_project_assign') ? 'active' : '' }}" href="{{route('admin.get_project_assign')}}"> Project Assign </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.holidays.index') ? 'active' : '' }} " href="{{route('admin.holidays.index')}}"> Holidays </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.leave.index') ? 'active' : '' }} " href="{{route('admin.leave.index')}}">Leaves</a>
              </li>
            </ul>
          </div>
          <div class="profilebox">
            <div class="dropdown-custom2">
              <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> -->
              <a class="{{ (request()->is('logout')) ? 'active' : '' }} dropdown-item custom-dropdown logouthovercss" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <span class="menuname">
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form> <i class="fa fa-sign-out" aria-hidden="true"></i>

                </span>
              </a>
              <!-- <a href="#">
              <img src="{{asset('images/dummy.jpg')}}" />
            </a> -->
              <!-- </button> -->
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <!-- <a class="dropdown-item" href="{{ route('employee.my_profile') }}">Profile</a> -->
                <!-- <a class="dropdown-item" href="#">Calender</a> -->
                <!-- <a class="dropdown-item" href="#">Setting</a> -->
                <!-- <a class="{{ (request()->is('logout')) ? 'active' : '' }} dropdown-item custom-dropdown" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <span class="menuname">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form> Log out
              </span>
            </a> -->
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>