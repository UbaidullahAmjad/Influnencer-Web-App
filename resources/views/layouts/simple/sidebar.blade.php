<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<h4>Coupon App </h4>
			<!-- <a href="{{route('/')}}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt=""></a> -->
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper"><a href="{{route('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					
					<li class="sidebar-main-title">
						<div>
							<h6 class="lan-1">{{ trans('lang.General') }} </h6>
                     		<p class="lan-2">{{ trans('lang.Dashboards,widgets & layout.') }}</p>
						</div>
					</li>
					@if(auth()->user()->user_type != 2)
					<li class="sidebar">
						<!-- <a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/dashboard' ? 'active' : '' }}" href="{{route('index')}}"><i data-feather="home"></i><span class="lan-3">{{ trans('lang.Dashboard') }}</span> -->
							<!-- <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/dashboard' ? 'down' : 'right' }}"></i></div> -->
						</a>
						<!-- <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;' }}">
							<li><a class="lan-4 {{ Route::currentRouteName()=='index' ? 'active' : '' }}" href="{{route('index')}}">{{ trans('lang.Default') }}</a></li>
						</ul> -->
					</li>
					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title {{Request::is('graph*') ? 'active' : '' }}" href="{{route('graph')}}">
							<i data-feather="trending-up"></i><span>{{ trans('lang.Stats') }} </span>
						</a>
						
					</li>
					<li class="sidebar-list">
							<a class="sidebar-link sidebar-title {{Request::is('brands*') ? 'active' : '' }}" href="{{route('brands.index')}}"><i data-feather="archive"></i><span class="">{{ trans('lang.Brands') }}</span>
								<!-- <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/brands' ? 'down' : 'right' }}"></i></div> -->
							</a>
							<!-- <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/widgets' ? 'block;' : 'none;' }}">
		                  	</ul> -->
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{ Request::is('influencer*') ? 'active' : '' }}" href="{{route('influencer.index')}}"><i data-feather="users"></i>
							<span class="lan-7">{{ trans('lang.Influencers') }}</span>
							<!-- <div class="according-menu"><i class="fa fa-angle-{{ request()->route()->getPrefix() == '/page-layouts' ? 'down' : 'right' }}"></i></div> -->
						</a>
	                    <!-- <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/page-layouts' ? 'block;' : 'none;' }}">
                          <li><a href=" class="">Boxed</a></li>
                          <li><a href="{{ route('layout-rtl') }}" class="{{ Route::currentRouteName() == 'layout-rtl' ? 'active' : '' }}">RTL</a></li>
                          <li><a href="" class="">Dark Layout</a></li>
                          <li><a href="" class="">Hide Nav Scroll</a></li>
                          <li><a href="" class="">Footer Light</a></li>
                          <li><a href="" class="">Footer Dark</a></li>
                          <li><a href="" class="">Footer Fixed</a></li>
                      </ul> -->
                  	</li>

					  <li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title {{Request::is('coupon*') ? 'active' : '' }}" href="{{route('coupon.index')}}">
							<i data-feather="archive"></i><span>{{ trans('lang.Coupons') }} </span>
							<!-- <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/project' ? 'down' : 'right' }}"></i></div> -->
						</a>
						<!-- <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/Coupones' ? 'block;' : 'none;' }}">
		                    <li><a href="" class="">{{ trans('lang.Project List') }}</a></li>
		                    <li><a href="" class="">{{ trans('lang.Create new') }}</a></li>
		                </ul> -->
						</li>

					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title {{Request::is('management*') ? 'active' : '' }}" href="{{route('management.index')}}">
							<i data-feather="upload"></i><span>{{ trans('lang.Upload Data') }} </span>
							<!-- <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/project' ? 'down' : 'right' }}"></i></div> -->
						</a>
						<!-- <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/Coupones' ? 'block;' : 'none;' }}">
		                    <li><a href="" class="">{{ trans('lang.Project List') }}</a></li>
		                    <li><a href="" class="">{{ trans('lang.Create new') }}</a></li>
		                </ul> -->
					</li>
                      
					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title {{Request::is('assciate*') ? 'active' : '' }}" href="{{route('assciate.index')}}">
							<i data-feather="refresh-cw"></i><span>{{ trans('lang.Associate') }} </span>
							<!-- <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/project' ? 'down' : 'right' }}"></i></div> -->
						</a>
						<!-- <ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/Coupones' ? 'block;' : 'none;' }}">
		                    <li><a href="" class="">{{ trans('lang.Project List') }}</a></li>
		                    <li><a href="" class="">{{ trans('lang.Create new') }}</a></li>
		                </ul> -->
					</li>

					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title {{Request::is('galleryimages*') ? 'active' : '' }}" href="{{route('galleryimages.index')}}">
							<i data-feather="image"></i><span>{{ trans('lang.Galley Images') }} </span>
						</a>
						
					</li>
					
					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title" href="#">
							<i data-feather="trending-up"></i><span>Influencer Payments </span>
						<div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/project' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{ request()->route()->getPrefix() == '/Coupones' ? 'block;' : 'none;' }}">
		                    <li><a href="{{route('influencer_payment_detail')}}" class="">Influencers Account</a></li>
		                    <li><a href="{{ route('upload_payments') }}" class="">Upload Payments</a></li>
		                    <li><a href="{{ route('payment_detail') }}" class="">Payment Details</a></li>

		                </ul>
						
					</li>

					<!-- <li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title {{Request::is('graph*') ? 'active' : '' }}" href="{{route('line_graph')}}">
							<i data-feather="trending-up"></i><span>{{ trans('lang.Graph') }} </span>
						</a>
						
					</li> -->

					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title" href="{{route('backupmanager')}}">
							<i data-feather="download"></i><span>{{ trans('lang.BackUp') }} </span>
						</a>
						
					</li>
					
					@elseif(auth()->user()->user_type == 2)
					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title" href="{{route('influencer.graph')}}">
							<i data-feather="trending-up"></i><span>{{ trans('lang.Stats') }} </span>
						</a>
						
					</li>
					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title" href="{{route('commissionCal')}}">
						<i data-feather="dollar-sign"></i><span>My Commissions</span>
						</a>
						
					</li>
					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title" href="{{route('payment')}}">
							<i data-feather="credit-card"></i><span>Account Details</span>
						</a>
						
					</li>
					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title" href="{{route('get_influencer_payments')}}">
						<i data-feather="dollar-sign"></i><span>Payment Details</span>
						</a>
						
					</li>
					@endif

					

					<!-- <li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title {{Request::is('roles*') ? 'active' : '' }}" href="{{route('roles.index')}}">
							<i data-feather="user-check"></i><span>{{ trans('lang.Role Management') }} </span>
						</a>
						
					</li> -->
				</ul>
			</div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>