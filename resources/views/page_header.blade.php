@if(Auth::check())

	<div class="top-menu">
		<div class="row">
			<div class="col-8 ">
				<div class="table-div">
					<div>
						<div class="toggle-menu-cont">
							<a class="toggle-menu" href="javascript:;">
								<i></i>
								<i></i>
								<i></i>
						    </a>
						</div>
					</div>
					<div>
						<div class="switch-tab">
				            <a href="javascript:;" class="main-link">
				            	{{ ucwords($menu) }} <i class="icons icon-arrow-down"></i>
				            </a>
				        </div>
		        	</div>

				</div>
			</div>
			<div class="col-4 text-right">
				<div class="welcome-nav">
					<span class="name">
						{{ Auth::user()->name }}
					</span>
					<div class="menu">
						<ul>
							<li>
								<a href="{{url('/update-password')}}"><i class="icons icon-lock-open"></i> <span>Change Password</span></a>
							</li>

							<li>
								<a href="{{url('/logout')}}"><i class="icons icon-logout"></i> <span>Logout</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
@endif