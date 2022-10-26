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
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link  {{(Route::is('employee.employee.index'))?'active' : ''}}" href="{{route('employee.employee.index')}} ">Dashboard </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{in_array(Route::currentRouteName(),['employee.attendance_filter','employee.attendance_history']) ? 'active' : '' }}" href="{{route('employee.attendance_history')}} ">Attendance History</a>
        </li>
        <li class="nav-item dropdown owndropdown">
          <a class="nav-link dropdown-toggle {{in_array(Route::currentRouteName(),['employee.daily_activity','employee.all_daily_activities']) ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Daily Activity </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item {{(Route::is('employee.daily_activity'))?'active' : ''}}" href="{{route('employee.daily_activity') }}">Add</a>
            <a class="dropdown-item {{(Route::is('employee.all_daily_activities'))?'active' : ''}}" href="{{route('employee.all_daily_activities') }}">All Time Activity</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link {{in_array(Route::currentRouteName(),['employee.graph_time','employee.graphs']) ? 'active' : '' }}" href="{{route('employee.graphs')}} ">Productivity Graph</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{(Route::is('employee.calender'))?'active' : ''}}" href="{{ route('employee.calender') }}"> Calender</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{(Route::is('employee.apply_leave'))?'active' : ''}}" href="{{ route('employee.apply_leave') }}"> Apply Leave</a>
        </li>
      </ul>
    </div>
	<div class="profilebox">
        <div class="dropdown-custom2">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <a href="#">
              <img src="{{asset('images/dummy.jpg')}}" />
            </a>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('employee.my_profile') }}">Profile</a>
            <!-- <a class="dropdown-item" href="#">Calender</a> -->
            <!-- <a class="dropdown-item" href="#">Setting</a> -->
            <a class="{{ (request()->is('logout')) ? 'active' : '' }} dropdown-item custom-dropdown" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <span class="menuname">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form> Log out
              </span>
            </a>
          </div>
        </div>
      </div>
  </nav>
  </div>
  </div>
  </div>

  