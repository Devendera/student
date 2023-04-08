	<nav class="dashboard-menu">
		<ul>
			<li class="{{ Request::is('patient/dashboard') ? 'active' : '' }}">
				<a href="{{ url('/patient/dashboard') }}"><i class="fas fa-columns"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<!--<li>
				<a href="{{ url('/patient/dashboard') }}"><i class="fas fa-bookmark"></i>
					<span>Favourites</span>
				</a>
			</li>
			<li>
				<a href="{{ url('/patient/dashboard') }}"><i class="fas fa-users"></i>
					<span>Dependent</span>
				</a>
			</li>
			<li>
				<a href="{{ url('/patient/dashboard') }}"><i class="fas fa-comments"></i>
					<span>Message</span>
					<small class="unread-msg">23</small>
				</a>
			</li>-->
			<li class="{{ Request::is('patient/profile-setting') ? 'active' : '' }}">
				<a href="{{ url('/patient/profile-setting') }}"><i class="fas fa-user-cog"></i>
					<span>Profile Settings</span>
				</a>
			</li>
			<li class="{{ Request::is('patient/change-password') ? 'active' : '' }}">
				<a href="{{ url('/patient/change-password') }}"><i class="fas fa-lock"></i>
					<span>Change Password</span>
				</a>
			</li>
			<li>
				<a href="{{ url('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
					<span>Logout</span>
				</a>
			</li>
		</ul>
	</nav>