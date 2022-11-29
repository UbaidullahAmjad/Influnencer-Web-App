<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<h4>Coupon App </h4>
			<!-- <a href="<?php echo e(route('/')); ?>"><img class="img-fluid for-light" src="<?php echo e(asset('assets/images/logo/logo.png')); ?>" alt=""><img class="img-fluid for-dark" src="<?php echo e(asset('assets/images/logo/logo_dark.png')); ?>" alt=""></a> -->
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper"><a href="<?php echo e(route('/')); ?>"><img class="img-fluid" src="<?php echo e(asset('assets/images/logo/logo-icon.png')); ?>" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					
					<li class="sidebar-main-title">
						<div>
							<h6 class="lan-1"><?php echo e(trans('lang.General')); ?> </h6>
                     		<p class="lan-2"><?php echo e(trans('lang.Dashboards,widgets & layout.')); ?></p>
						</div>
					</li>
					<?php if(auth()->user()->user_type != 2): ?>
					<li class="sidebar">
						<!-- <a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == '/dashboard' ? 'active' : ''); ?>" href="<?php echo e(route('index')); ?>"><i data-feather="home"></i><span class="lan-3"><?php echo e(trans('lang.Dashboard')); ?></span> -->
							<!-- <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == '/dashboard' ? 'down' : 'right'); ?>"></i></div> -->
						</a>
						<!-- <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/dashboard' ? 'block;' : 'none;'); ?>">
							<li><a class="lan-4 <?php echo e(Route::currentRouteName()=='index' ? 'active' : ''); ?>" href="<?php echo e(route('index')); ?>"><?php echo e(trans('lang.Default')); ?></a></li>
						</ul> -->
					</li>
					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title <?php echo e(Request::is('graph*') ? 'active' : ''); ?>" href="<?php echo e(route('graph')); ?>">
							<i data-feather="trending-up"></i><span><?php echo e(trans('lang.Stats')); ?> </span>
						</a>
						
					</li>
					<li class="sidebar-list">
							<a class="sidebar-link sidebar-title <?php echo e(Request::is('brands*') ? 'active' : ''); ?>" href="<?php echo e(route('brands.index')); ?>"><i data-feather="archive"></i><span class=""><?php echo e(trans('lang.Brands')); ?></span>
								<!-- <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == '/brands' ? 'down' : 'right'); ?>"></i></div> -->
							</a>
							<!-- <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/widgets' ? 'block;' : 'none;'); ?>">
		                  	</ul> -->
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title <?php echo e(Request::is('influencer*') ? 'active' : ''); ?>" href="<?php echo e(route('influencer.index')); ?>"><i data-feather="users"></i>
							<span class="lan-7"><?php echo e(trans('lang.Influencers')); ?></span>
							<!-- <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == '/page-layouts' ? 'down' : 'right'); ?>"></i></div> -->
						</a>
	                    <!-- <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/page-layouts' ? 'block;' : 'none;'); ?>">
                          <li><a href=" class="">Boxed</a></li>
                          <li><a href="<?php echo e(route('layout-rtl')); ?>" class="<?php echo e(Route::currentRouteName() == 'layout-rtl' ? 'active' : ''); ?>">RTL</a></li>
                          <li><a href="" class="">Dark Layout</a></li>
                          <li><a href="" class="">Hide Nav Scroll</a></li>
                          <li><a href="" class="">Footer Light</a></li>
                          <li><a href="" class="">Footer Dark</a></li>
                          <li><a href="" class="">Footer Fixed</a></li>
                      </ul> -->
                  	</li>

					  <li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title <?php echo e(Request::is('coupon*') ? 'active' : ''); ?>" href="<?php echo e(route('coupon.index')); ?>">
							<i data-feather="archive"></i><span><?php echo e(trans('lang.Coupons')); ?> </span>
							<!-- <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == '/project' ? 'down' : 'right'); ?>"></i></div> -->
						</a>
						<!-- <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/Coupones' ? 'block;' : 'none;'); ?>">
		                    <li><a href="" class=""><?php echo e(trans('lang.Project List')); ?></a></li>
		                    <li><a href="" class=""><?php echo e(trans('lang.Create new')); ?></a></li>
		                </ul> -->
						</li>

					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title <?php echo e(Request::is('management*') ? 'active' : ''); ?>" href="<?php echo e(route('management.index')); ?>">
							<i data-feather="upload"></i><span><?php echo e(trans('lang.Upload Data')); ?> </span>
							<!-- <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == '/project' ? 'down' : 'right'); ?>"></i></div> -->
						</a>
						<!-- <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/Coupones' ? 'block;' : 'none;'); ?>">
		                    <li><a href="" class=""><?php echo e(trans('lang.Project List')); ?></a></li>
		                    <li><a href="" class=""><?php echo e(trans('lang.Create new')); ?></a></li>
		                </ul> -->
					</li>
                      
					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title <?php echo e(Request::is('assciate*') ? 'active' : ''); ?>" href="<?php echo e(route('assciate.index')); ?>">
							<i data-feather="refresh-cw"></i><span><?php echo e(trans('lang.Associate')); ?> </span>
							<!-- <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == '/project' ? 'down' : 'right'); ?>"></i></div> -->
						</a>
						<!-- <ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/Coupones' ? 'block;' : 'none;'); ?>">
		                    <li><a href="" class=""><?php echo e(trans('lang.Project List')); ?></a></li>
		                    <li><a href="" class=""><?php echo e(trans('lang.Create new')); ?></a></li>
		                </ul> -->
					</li>

					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title <?php echo e(Request::is('galleryimages*') ? 'active' : ''); ?>" href="<?php echo e(route('galleryimages.index')); ?>">
							<i data-feather="image"></i><span><?php echo e(trans('lang.Galley Images')); ?> </span>
						</a>
						
					</li>
					
					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title" href="#">
							<i data-feather="trending-up"></i><span>Influencer Payments </span>
						<div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == '/project' ? 'down' : 'right'); ?>"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/Coupones' ? 'block;' : 'none;'); ?>">
		                    <li><a href="<?php echo e(route('influencer_payment_detail')); ?>" class="">Influencers Account</a></li>
		                    <li><a href="<?php echo e(route('upload_payments')); ?>" class="">Upload Payments</a></li>
		                    <li><a href="<?php echo e(route('payment_detail')); ?>" class="">Payment Details</a></li>

		                </ul>
						
					</li>

					<!-- <li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title <?php echo e(Request::is('graph*') ? 'active' : ''); ?>" href="<?php echo e(route('line_graph')); ?>">
							<i data-feather="trending-up"></i><span><?php echo e(trans('lang.Graph')); ?> </span>
						</a>
						
					</li> -->

					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title" href="<?php echo e(route('backupmanager')); ?>">
							<i data-feather="download"></i><span><?php echo e(trans('lang.BackUp')); ?> </span>
						</a>
						
					</li>
					
					<?php elseif(auth()->user()->user_type == 2): ?>
					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title" href="<?php echo e(route('influencer.graph')); ?>">
							<i data-feather="trending-up"></i><span><?php echo e(trans('lang.Stats')); ?> </span>
						</a>
						
					</li>
					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title" href="<?php echo e(route('commissionCal')); ?>">
						<i data-feather="dollar-sign"></i><span>My Commissions</span>
						</a>
						
					</li>
					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title" href="<?php echo e(route('payment')); ?>">
							<i data-feather="credit-card"></i><span>Account Details</span>
						</a>
						
					</li>
					<li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title" href="<?php echo e(route('get_influencer_payments')); ?>">
						<i data-feather="dollar-sign"></i><span>Payment Details</span>
						</a>
						
					</li>
					<?php endif; ?>

					

					<!-- <li class="sidebar-list">
						
						<a class="sidebar-link sidebar-title <?php echo e(Request::is('roles*') ? 'active' : ''); ?>" href="<?php echo e(route('roles.index')); ?>">
							<i data-feather="user-check"></i><span><?php echo e(trans('lang.Role Management')); ?> </span>
						</a>
						
					</li> -->
				</ul>
			</div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div><?php /**PATH C:\xampp\htdocs\influencer_app\resources\views/layouts/simple/sidebar.blade.php ENDPATH**/ ?>