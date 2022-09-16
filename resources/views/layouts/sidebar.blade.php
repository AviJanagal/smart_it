<div class="sidemenubar">
		<div class="toggle">
			<i class="fa fa-bars" aria-hidden="true"></i>
		</div>
		<div class="mainlogoimage"> <img src="{{asset('images/mainlogo3.png')}}" /> </div>
		<nav>
			<ul >
				<li>
					<a href="{{route('home')}} " class="{{ (request()->is('home')) ? 'active' : '' }}"> <span class="icon "><i class="fa fa-server" aria-hidden="true"></i></span> <span class="title ">Dashboard</span> </a>
				</li>
				<li class="sidebar-dropdown active ">
					<a href="#"> <i class="fa fa-home home-custom " aria-hidden="true"></i><span>Employee</span> <i class="fa fa-angle-right right-custom" aria-hidden="true"></i> </a>
					<ul class="sidebar-submenu" style="display:none;">
						<li> <a href="{{route('add') }}">Add
                        
                      </a> </li>
						<li> <a href="#">View</a> </li>
						
					</ul>
				</li>
				<li class="sidebar-dropdown  ">
					<a href=""> <i class="fa fa-home home-custom " aria-hidden="true"></i><span>Employee </span> </a>
				</li>
				<li class="sidebar-dropdown  ">
					<a href=""> <i class="fa fa-home home-custom " aria-hidden="true"></i><span>Service Providers</span> </a>
				</li>
				<li class="sidebar-dropdown  ">
					<a href="#"> <i class="fa fa-home home-custom " aria-hidden="true"></i><span>Earnings</span> </a>
				</li>
				<li class="sidebar-dropdown ">
					<a href="#"> <i class="fa fa-home home-custom " aria-hidden="true"></i><span>FAQ's</span> </a>
				</li>
				<li class="sidebar-dropdown ">
					<a href="#"> <i class="fa fa-home home-custom " aria-hidden="true"></i><span>Customers</span> </a>
				</li>
				<li class="sidebar-dropdown ">
					<a href="#"> <i class="fa fa-home home-custom " aria-hidden="true"></i><span>Earnings</span> </a>
				</li>
				<li class="sidebar-dropdown  ">
					<a href="#"> <i class="fa fa-home home-custom " aria-hidden="true"></i><span>FAQ's</span> </a>
				</li>
			</ul>
		</nav>
	</div>