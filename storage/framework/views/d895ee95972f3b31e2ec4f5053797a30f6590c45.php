<?php if(auth()->user()->user_type != 2): ?>

<?php $__env->startSection('title', 'Apex Chart'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/daterange-picker.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/owlcarousel.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/rating.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Charts</li>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Fields -->
<!-- End Fields -->


<div class="container-fluid">
	<div class="row">
        
		<div class="col-sm-12 col-xl-12 box-col-12">
			<div class="card">
                
            <!-- <div class="card-header">
					<h5>Mixed Chart</h5>
				</div> -->

                <form class="needs-validation search_form"  novalidate="" action="<?php echo e(route('search_data')); ?>" method="post" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
						<div class="row">

                                                        
                                                            <?php if($message = Session::get('success')): ?>
                                            <div class="alert alert-success">
                                                <p><?php echo e($message); ?></p>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($message = Session::get('error')): ?>
                                            <div class="alert alert-danger">
                                                <p><?php echo e($message); ?></p>
                                            </div>
                                        <?php endif; ?>
									<div class="col-md-2 mb-2">
                                       <label for="validationCustom01">Select Brand</label>
										<!-- <div class="col-form-label">Select Brand</div> -->
                                        <?php if(auth()->user()->user_type != 2): ?>
										<select class="js-example-placeholder-multiple col-sm-12 form-control" id="brand_id" name="brand" data-href="<?php echo e(route('get_coupons')); ?>">
                                            <option value="">Select Brand</option>
                                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $br): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($brand) && $brand == $br->id): ?>
                                                <option value="<?php echo e($br->id); ?>" selected><?php echo e($br->company_name); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo e($br->id); ?>"><?php echo e($br->company_name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
										</select>
                                        <?php else: ?>
                                        <select class="js-example-placeholder-multiple col-sm-12 form-control" name="brand">
                                            <option value="">Select Brand</option>
                                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $br): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($brand) && $brand == $br->id): ?>
                                                <option value="<?php echo e($br->id); ?>" selected><?php echo e($br->company_name); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo e($br->id); ?>"><?php echo e($br->company_name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
										</select>
                                        <?php endif; ?>
										
									</div>
                                    <div class="col-md-2 mb-3">
                                                <label for="validationCustom01">Influencer Status</label>
                                                <!-- <div class="col-form-label">Select Coupons</div> -->
                                                <select class="js-example-placeholder-multiple col-sm-12 form-control" id="status" name="status" data-href="<?php echo e(route('get_influencers')); ?>">
                                                        <option value="-2">Select</option>
                                                        <option value="0" <?php echo e($status == 0 ? 'selected' : ''); ?>>Inactive</option>
                                                        <option value="1" <?php echo e($status == 1 ? 'selected' : ''); ?>>Active</option>

                                                    
                                                </select>
                                            </div>
                                    <?php if(auth()->user()->user_type != 2): ?>
                                    <div class="col-md-3 mb-2" id="influencer">
                                       <label for="validationCustom01">Select Influencer</label>
										<!-- <div class="col-form-label">Select Brand</div> -->
                                        
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="influencer" id="influencer_id">
                                        <option value="">Select Influencer</option>
                                        <?php $__currentLoopData = $influencers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $in): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($influencer) && $influencer == $in->id): ?>
											<option value="<?php echo e($in->id); ?>" selected><?php echo e($in->f_name); ?></option>
                                            <?php else: ?>
                                            <option value="<?php echo e($in->id); ?>"><?php echo e($in->f_name); ?></option>
                                            <?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
                                       
										
									</div>
                                    <?php else: ?>
                                        <input type="hidden" name="influencer" class="form-control" value="<?php echo e(auth()->user()->id); ?>" readonly>

                                        <?php endif; ?>
                                    <div class="col-md-2 mb-2">
                                       <label for="validationCustom01">Select Coupon</label>
										<!-- <div class="col-form-label">Select Brand</div> -->
                                        <?php if(auth()->user()->user_type != 2): ?>
										<select class="js-example-placeholder-multiple col-sm-12 form-control" id="coupon_id" name="coupon">
                                        <option value="">Select Coupon</option>
                                      
                                        <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cop->id); ?>"
												<?php echo e($cop->id == (isset($coupon) ? $coupon : 0) ? 'selected' : ''); ?>>
												<?php echo e($cop->coupon_code); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
                                        <?php else: ?>
                                        <select class="js-example-placeholder-multiple col-sm-12 form-control" name="coupon">
                                        <option value="">Select Coupon</option>
                                      
                                        <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cop->id); ?>"
												<?php echo e($cop->id == (isset($coupon) ? $coupon : 0) ? 'selected' : ''); ?>>
												<?php echo e($cop->coupon_code); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
                                        <?php endif; ?>
										
									</div>

                                    

                                    <!-- <div class="col-md-2 mb-2">
                                       <p style="font-weight: bold;font-size: 15px;">Date</p>
										<div class="col-form-label">Select Brand</div>
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="influencer">
                                        <option value="" disabled selected>Select Date</option>
											<option value=""></option>
											
										</select>
										
									</div> -->
								
                                    <div class="col-md-2 mb-2">
                                       <label for="validationCustom01"> Select Filter</label>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="filter">
										
                                            <option value="">Select Filter</option>
											<option value="revenue" <?php echo e((isset($filter) && $filter == "revenue") ? 'selected': ''); ?> >Revenue</option>
                                            <option value="sa" <?php echo e((isset($filter) && $filter == "sa") ? 'selected': ''); ?>>Sale Amount</option>
                                            <option value="order" <?php echo e((isset($filter) && $filter == "order") ? 'selected': ''); ?>>Orders</option>
										</select>
										
									</div>
                                    <?php if(count($currencies) > 0): ?>
                                    <div class="col-md-2 mb-2">
                                       <label for="validationCustom01">Select Currency</label>
										<!-- <div class="col-form-label">Select Brand</div> -->
                                        <?php if(auth()->user()->user_type != 2): ?>
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="currency">
                                            <option value="">Select Currency</option>
                                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($currency) && $currency == $curr->currency): ?>
                                                <option value="<?php echo e($curr->currency); ?>" selected><?php echo e($curr->currency); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo e($curr->currency); ?>"><?php echo e($curr->currency); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
										</select>
										<?php else: ?>
                                        <select class="js-example-placeholder-multiple col-sm-12 form-control" name="currency">
                                            <option value="">Select Currency</option>
                                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($currency) && $currency == $curr): ?>
                                                <option value="<?php echo e($curr); ?>" selected><?php echo e($curr); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo e($curr); ?>"><?php echo e($curr); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
										</select>
                                        <?php endif; ?>
									</div>
                                    <?php endif; ?>
                                       <!-- <div class="theme-form"> -->
                                            <div class="col-md-3 mb-3">
                                                    <label for="validationCustom01">From *</label>
                                                            <!-- <div class="col-form-label">Select Coupons</div> -->
                                                            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="from_month" required>
                                                            <option value="-1">Select Month</option>
                                                            <option value="1" <?php echo e($from_month == 1 ? 'selected' : ''); ?>>January</option>
                                                            <option value="2" <?php echo e($from_month == 2 ? 'selected' : ''); ?>>Februay</option>
                                                            <option value="3" <?php echo e($from_month == 3 ? 'selected' : ''); ?>>March</option>
                                                            <option value="4" <?php echo e($from_month == 4 ? 'selected' : ''); ?>>April</option>
                                                            <option value="5" <?php echo e($from_month == 5 ? 'selected' : ''); ?>>May</option>
                                                            <option value="6" <?php echo e($from_month == 6 ? 'selected' : ''); ?>>June</option>
                                                            <option value="7" <?php echo e($from_month == 7 ? 'selected' : ''); ?>>July</option>
                                                            <option value="8" <?php echo e($from_month == 8 ? 'selected' : ''); ?>>August</option>
                                                            <option value="9" <?php echo e($from_month == 9 ? 'selected' : ''); ?>>September</option>
                                                            <option value="10" <?php echo e($from_month == 10 ? 'selected' : ''); ?>>October</option>
                                                            <option value="11" <?php echo e($from_month == 11 ? 'selected' : ''); ?>>November</option>
                                                            <option value="12" <?php echo e($from_month == 12 ? 'selected' : ''); ?>>December</option>

                                                        
                                                            </select>
                                                
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                    <label for="validationCustom01">To *</label>
                                                            <!-- <div class="col-form-label">Select Coupons</div> -->
                                                            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="to_month" required>
                                                            <option value="-1">Select Month</option>
                                                            <option value="1" <?php echo e($to_month == 1 ? 'selected' : ''); ?>>January</option>
                                                            <option value="2" <?php echo e($to_month == 2 ? 'selected' : ''); ?>>Februay</option>
                                                            <option value="3" <?php echo e($to_month == 3 ? 'selected' : ''); ?>>March</option>
                                                            <option value="4" <?php echo e($to_month == 4 ? 'selected' : ''); ?>>April</option>
                                                            <option value="5" <?php echo e($to_month == 5 ? 'selected' : ''); ?>>May</option>
                                                            <option value="6" <?php echo e($to_month == 6 ? 'selected' : ''); ?>>June</option>
                                                            <option value="7" <?php echo e($to_month == 7 ? 'selected' : ''); ?>>July</option>
                                                            <option value="8" <?php echo e($to_month == 8 ? 'selected' : ''); ?>>August</option>
                                                            <option value="9" <?php echo e($to_month == 9 ? 'selected' : ''); ?>>September</option>
                                                            <option value="10" <?php echo e($to_month == 10 ? 'selected' : ''); ?>>October</option>
                                                            <option value="11" <?php echo e($to_month == 11 ? 'selected' : ''); ?>>November</option>
                                                            <option value="12" <?php echo e($to_month == 12 ? 'selected' : ''); ?>>December</option>

                                                        
                                                            </select>
                                                
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="validationCustom01">Year</label>
                                                <!-- <div class="col-form-label">Select Coupons</div> -->
                                                <select class="js-example-placeholder-multiple col-sm-12 form-control" name="year">
                                                        <option value="-2">Select Year</option>
                                                        <?php $__currentLoopData = range( $latest_year, $earliest_year ); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($i); ?>" <?php echo e($i == $year ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    
                                                </select>
                                            </div>
                                            
					                    <!-- </div> -->
							
						</div>
						<div class="mb-3">
							
						</div>
						<button class="btn btn-success" type="submit">Search</button>
					</form>


				<div class="card-body">
					<div id="mixedchart"></div>
				</div>

                
			</div>
		    </div>
		
	
		
		</div>
        <div class="col-sm-12 col-xl-12 box-col-12">
            <div class="row justify-content-center m-0">
                <div class="col-sm-3 px-1">
                    <div class="card data_show h-100">
                        <h5 class="text-center p-2">Total Revenues</h5>
                        <h5 class="text-center" style="font-size: 34px;"><?php echo e(round((float)$total_revenues,2)); ?></h5>
                    </div>
                </div>
                <div class="col-sm-3 px-1">
                    <div class="card data_show h-100">
                        <h5 class="text-center p-2">Total Sale Amount</h5>
                        <h5 class="text-center" style="font-size: 34px;"> <?php echo e(round((float)$total_sale_amount,2)); ?> </h5>
                    </div>
                </div>
                
                <div class="col-sm-3 px-1">
                    <div class="card data_show h-100">
                        <h5 class="text-center p-2">Total Orders</h5>
                        <h5 class="text-center" style="font-size: 34px;"><?php echo e((int)$total_orders); ?></h5>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="mt-5 card p-5">
            <div class="loader-box" id="my-loader">
                                    <div class="loader-2"></div>
                                </div>
            <div id="data-table" style="display:none;">
                <table class="display" id="basic-2" >
                         <thead>
                            <tr>
    
                            <th>#</th>
                            <th>Brand</th>
                            <th>Coupon</th>
                            <th>Revenue</th>
                            <th>Sale Amount</th>
                            <th>Orders</th>
                            <th>Date</th>
                               
                              
                            </tr>
                         </thead>
                         <tbody>
                         <?php ($i = 1); ?>
                         <?php if(count($araby) > 0): ?>
                         <?php $__currentLoopData = $araby; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php
                           $brand = app\Models\Brand::find($all_dat->brand_id);
                           $coupon = app\Models\Coupon::find($all_dat->coupon_id)
                         ?>
                         
                            <tr>
    
                            <th scope="row"><?php echo e($i++); ?></th>
                            
                                <td>
                                  <div class="some_text">
                                     <?php echo e(isset($brand) ? $brand->company_name : ''); ?>

                                  </div>
                               </td>
    
                               <td>
                                  <div class="some_text">
                                     <?php echo e(isset($coupon) ? $coupon->coupon_code : ''); ?>

                                  </div>
                               </td>
                               
                               <td>
                                  <div class="some_text">
                                     <?php echo e($all_dat->net_revenue); ?>

                                  </div>
                               </td>
                               <td><?php echo e($all_dat->net_sales_amount_usd); ?></td>
                               <td><?php echo e($all_dat->net_orders); ?></td>
                               <td><?php echo e($all_dat->date); ?></td>
                            </tr>
                
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(count($styli) > 0): ?>
                         <?php $__currentLoopData = $styli; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php
                           $brand = app\Models\Brand::find($all_dat->brand_id);
                           $coupon = app\Models\Coupon::find($all_dat->coupon_id)
                         ?>
                         
                            <tr>
    
                            <th scope="row"><?php echo e($i++); ?></th>
                            
                                <td>
                                  <div class="some_text">
                                     <?php echo e(isset($brand) ? $brand->company_name : ''); ?>

                                  </div>
                               </td>
    
                               <td>
                                  <div class="some_text">
                                     <?php echo e(isset($coupon) ? $coupon->coupon_code : ''); ?>

                                  </div>
                               </td>
                               
                               <td>
                                  <div class="some_text">
                                     <?php echo e($all_dat->payout_usd); ?>

                                  </div>
                               </td>
                               <td><?php echo e($all_dat->order_usd); ?></td>
                               <td>N/A</td>
                               <td><?php echo e($all_dat->order_date); ?></td>
                            </tr>
                
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(count($marketerHub) > 0): ?>
                         <?php $__currentLoopData = $marketerHub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php
                         $date = $all_dat->date;
                         if($date == 1)
                         {
                            $month = "January";
                         }
                         elseif($date == 2)
                         {
                            $month = "February";
                         }
                         elseif($date == 3)
                         {
                            $month = "March";
                         }
                         elseif($date == 4)
                         {
                            $month = "April";
                         }elseif($date == 5)
                         {
                            $month = "May";
                         }elseif($date == 6)
                         {
                            $month = "June";
                         }elseif($date == 7)
                         {
                            $month = "July";
                         }elseif($date == 8)
                         {
                            $month = "August";
                         }
                         elseif($date == 9)
                         {
                            $month = "September";
                         }elseif($date == 10)
                         {
                            $month = "October";
                         }elseif($date == 11)
                         {
                            $month = "November";
                         }elseif($date == 12)
                         {
                            $month = "December";
                         }
                           $brand = app\Models\Brand::find($all_dat->brand_id);
                           $coupon = app\Models\Coupon::find($all_dat->coupon_id)
                         ?>
                         
                            <tr>
    
                            <th scope="row"><?php echo e($i++); ?></th>
                            
                                <td>
                                  <div class="some_text">
                                     <?php echo e(isset($brand) ? $brand->company_name : ''); ?>

                                  </div>
                               </td>
    
                               <td>
                                  <div class="some_text">
                                     <?php echo e(isset($coupon) ? $coupon->coupon_code : ''); ?>

                                  </div>
                               </td>
                               
                               <td>
                                  <div class="some_text">
                                     <?php echo e($all_dat->revenue); ?>

                                  </div>
                               </td>
                               <td><?php echo e($all_dat->sales_amount_usd); ?></td>
                               <td><?php echo e($all_dat->orders); ?></td>
                               <td><?php echo e($month); ?></td>
                            </tr>
                
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(count($shosh) > 0): ?>
                         <?php $__currentLoopData = $shosh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php
                         $date = $all_dat->month;
                         if($date == 1)
                         {
                            $month = "January";
                         }
                         elseif($date == 2)
                         {
                            $month = "February";
                         }
                         elseif($date == 3)
                         {
                            $month = "March";
                         }
                         elseif($date == 4)
                         {
                            $month = "April";
                         }elseif($date == 5)
                         {
                            $month = "May";
                         }elseif($date == 6)
                         {
                            $month = "June";
                         }elseif($date == 7)
                         {
                            $month = "July";
                         }elseif($date == 8)
                         {
                            $month = "August";
                         }
                         elseif($date == 9)
                         {
                            $month = "September";
                         }elseif($date == 10)
                         {
                            $month = "October";
                         }elseif($date == 11)
                         {
                            $month = "November";
                         }elseif($date == 12)
                         {
                            $month = "December";
                         }
                           $brand = app\Models\Brand::find($all_dat->brand_id);
                           $coupon = app\Models\Coupon::find($all_dat->coupon_id)
                         ?>
                         
                            <tr>
    
                            <th scope="row"><?php echo e($i++); ?></th>
                            
                                <td>
                                  <div class="some_text">
                                     <?php echo e(isset($brand) ? $brand->company_name : ''); ?>

                                  </div>
                               </td>
    
                               <td>
                                  <div class="some_text">
                                     <?php echo e(isset($coupon) ? $coupon->coupon_code : ''); ?>

                                  </div>
                               </td>
                               
                               <td>
                                  <div class="some_text">
                                     <?php echo e($all_dat->revenue); ?>

                                  </div>
                               </td>
                               <td><?php echo e($all_dat->sale_amount); ?></td>
                               <td><?php echo e($all_dat->orders); ?></td>
                               <td><?php echo e($month); ?></td>
                            </tr>
                
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(count($ounass) > 0): ?>
                         <?php $__currentLoopData = $ounass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php
                         $date = $all_dat->month;
                         if($date == 1)
                         {
                            $month = "January";
                         }
                         elseif($date == 2)
                         {
                            $month = "February";
                         }
                         elseif($date == 3)
                         {
                            $month = "March";
                         }
                         elseif($date == 4)
                         {
                            $month = "April";
                         }elseif($date == 5)
                         {
                            $month = "May";
                         }elseif($date == 6)
                         {
                            $month = "June";
                         }elseif($date == 7)
                         {
                            $month = "July";
                         }elseif($date == 8)
                         {
                            $month = "August";
                         }
                         elseif($date == 9)
                         {
                            $month = "September";
                         }elseif($date == 10)
                         {
                            $month = "October";
                         }elseif($date == 11)
                         {
                            $month = "November";
                         }elseif($date == 12)
                         {
                            $month = "December";
                         }
                           $brand = app\Models\Brand::find($all_dat->brand_id);
                           $coupon = app\Models\Coupon::find($all_dat->coupon_id)
                         ?>
                         
                            <tr>
    
                            <th scope="row"><?php echo e($i++); ?></th>
                            
                                <td>
                                  <div class="some_text">
                                     <?php echo e(isset($brand) ? $brand->company_name : ''); ?>

                                  </div>
                               </td>
    
                               <td>
                                  <div class="some_text">
                                     <?php echo e(isset($coupon) ? $coupon->coupon_code : ''); ?>

                                  </div>
                               </td>
                               
                               <td>N/A</td>
                               <td><?php echo e($all_dat->sum_of_nmv); ?></td>
                               <td><?php echo e($all_dat->_004_orders); ?></td>
                               <td><?php echo e($month); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                           
                         </tbody>
            </table>
            </div>
        </div>
        
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/chart/apex-chart/apex-chart.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/chart/apex-chart/stock-prices.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/chart/apex-chart/chart-custom.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datepicker/daterange-picker/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datepicker/daterange-picker/daterangepicker.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datepicker/daterange-picker/daterange-picker.custom.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/rating/jquery.barrating.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/rating/rating-script.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/owlcarousel/owl.carousel.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/ecommerce.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/product-list-custom.js')); ?>"></script>
<script>
    window.onload = function(){
                setTimeout(function(){
                    $('#my-loader').hide();
                    $('#data-table').show();
                }, 3500);
                };
</script>
<?php if(empty($filter)): ?>

<script>
var cont = "<?php echo e(count($all_data)); ?>";
var d_cont = "<?php echo e(count($dates)); ?>";

var options7 = {
    chart: {
        height: 350,
       
        type: 'line',
        stacked: false,
        toolbar:{
          show: false
        }
    },
    stroke: {
        // width: [0, 2, 5],
        curve: 'smooth'
    },
    plotOptions: {
        bar: {
            columnWidth: '50%'
        }
    },
    series: [{
        name: 'Revenue',
        type: 'area',
        data: [<?php $d_count = count($dates); 
        if(count($araby) > 0) 
        {
            $ar = 0;
            foreach ($araby as $data) {
                        if($d_count > 0 ){
                            if($data->net_revenue){
                                echo $data->net_revenue.",";
                            }
                            
                        }
                         $d_count--;
                     }
        }
        $d_count = count($dates);
        if(count($styli) > 0) 
        {
            foreach ($styli as $data) {
                        if($d_count > 0 && !empty($data->payout_usd)){
                            echo $data->payout_usd.",";
                        }
                         $d_count--;
                     }
        }
        $d_count = count($dates);
        if(count($marketerHub) > 0) 
        {
            foreach ($marketerHub as $data) {
                        if($d_count > 0 && !empty($data->revenue)){
                            echo $data->revenue.",";
                        }
                         $d_count--;
                     }
        }
        $d_count = count($dates);
        if(count($shosh) > 0) 
        {
            foreach ($shosh as $data) {
                        if($d_count > 0 && !empty($data->revenue)){
                            echo $data->revenue.",";
                        }
                         $d_count--;
                     }
        }
        //             elseif(count($ounass) > 0) 
        // {
        //     foreach ($ounass as $data) {
        //                 if($d_count > 0){
        //                     echo $data->revenue.",";
        //                 }
        //                  $d_count--;
        //              }
        //             }
                     ?>]
    }, {
        name: 'Sale Amount',
        type: 'area',
        data: [<?php $d_count = count($dates);  
        if(count($araby) > 0) 
        {
            foreach ($araby as $data) {
                        if($d_count > 0 && !empty($data->net_sales_amount_usd)){
                            echo $data->net_sales_amount_usd.",";
                        }
                         $d_count--;
                     }
                    }
        $d_count = count($dates);
        if(count($styli) > 0) 
        {
            foreach ($styli as $data) {
                        if($d_count > 0 && !empty($data->order_usd)){
                            echo $data->order_usd.",";
                        }
                         $d_count--;
                     }
                    }
        $d_count = count($dates);
        if(count($marketerHub) > 0) 
        {
            foreach ($marketerHub as $data) {
                        if($d_count > 0 && !empty($data->sales_amount_usd)){
                            echo $data->sales_amount_usd.",";
                        }
                         $d_count--;
                     }
                    }
        $d_count = count($dates);
        if(count($shosh) > 0) 
        {
            foreach ($shosh as $data) {
                        if($d_count > 0 && !empty($data->sale_amount)){
                            echo $data->sale_amount.",";
                        }
                         $d_count--;
                     }
                    }
        $d_count = count($dates);
        if(count($ounass) > 0) 
        {
            foreach ($ounass as $data) {
                        if($d_count > 0 && !empty($data->sum_of_nmv)){
                            echo (float)$data->sum_of_nmv.",";
                        }
                         $d_count--;
                     }
                    }
        ?>]
    }, 
     {
        name: 'Orders',
        type: 'area',
        data: [<?php $d_count = count($dates);
        if(count($araby) > 0) 
        {
            foreach ($araby as $data) {
                        if($d_count > 0 && !empty($data->net_orders)){
                            echo $data->net_orders.",";
                        }
                         $d_count--;
                     }
                    }
        $d_count = count($dates);
        if(count($marketerHub) > 0) 
        {
            foreach ($marketerHub as $data) {
                        if($d_count > 0 && !empty($data->orders)){
                            echo $data->orders.",";
                        }
                         $d_count--;
                     }
                    }
        $d_count = count($dates);
        if(count($shosh) > 0) 
        {
            foreach ($shosh as $data) {
                        if($d_count > 0 && !empty($data->orders)){
                            echo $data->orders.",";
                        }
                         $d_count--;
                     }
                    }
        $d_count = count($dates);
        if(count($ounass) > 0) 
        {
            foreach ($ounass as $data) {
                        if($d_count > 0 && !empty($data->_004_orders)){
                            echo (float)$data->_004_orders.",";
                        }
                         $d_count--;
                     }
                    }
        ?>]
    }],
    fill: {
        opacity: [0.85,0.25,1],
        gradient: {
            inverseColors: false,
            shade: 'light',
            type: "vertical",
            opacityFrom: 0.85,
            opacityTo: 0.55,
            // stops: [0, 100, 100, 100]
        }
    },
    labels: 
        [<?php
            if (count($dates) > 0) {
                $kkk=0;
                foreach ($dates as $date) {
                    if ($kkk != (count($dates) -1)) {
                        echo "'".$date . "',";
                    } else {
                        echo "'".$date."'";
                    }
                    $kkk++;
                }
            }
            ?>],
    markers: {
        size: 0
    },
    xaxis: {
        type:'date'
    },
    yaxis: {
        min: 0,
        max: <?php echo e(round((float)$max)); ?>

    },
    tooltip: {
        shared: true,
        intersect: false,
        y: {
            formatter: function (y) {
                if(typeof y !== "undefined") {
                    return  y.toFixed(0) + " views";
                }
                return y;

            }
        }
    },
    legend: {
        labels: {
            useSeriesColors: true
        },
    },
    colors:[CubaAdminConfig.secondary , '#51bb25' , CubaAdminConfig.primary ]
}
    var chart7 = new ApexCharts(
    document.querySelector("#mixedchart"),
    options7
);

chart7.render();
</script>
<?php elseif(isset($filter) && !empty($filter)): ?>

<script>
var filter = "";
var d_cont = "<?php echo e(count($dates)); ?>";
<?php if ($filter == "revenue") {?>
            filter = 'Revenue';
            <?php } elseif ($filter == "sa") {?>
                filter = 'Sale Amount';
            
            <?php } elseif ($filter == "order") {?>
                filter = 'Orders';
            <?php } ?>;

var options7 = {
    chart: {
        height: 350,
        
        type: 'area',
        stacked: false,
        toolbar:{
          show: false
        }
    },
    stroke: {
        // width: [0, 2, 5],
        curve: 'smooth'
    },
    plotOptions: {
        bar: {
            columnWidth: '50%'
        }
    },
    series: [{
        name: filter,
        type: 'area',
        data: [<?php $d_count = count($dates);

        if ($filter == "revenue") {
                        if(count($araby) > 0) 
        {
            foreach ($araby as $data) {
                        if($d_count > 0 && !empty($data->net_revenue)){
                            echo $data->net_revenue.",";
                        }
                         $d_count--;
                     }
                    }
                    $d_count = count($dates);
        if(count($styli) > 0) 
        {
            foreach ($styli as $data) {
                        if($d_count > 0 && !empty($data->payout_usd)){
                            echo $data->payout_usd.",";
                        }
                         $d_count--;
                     }
                    }
                    $d_count = count($dates);
        if(count($marketerHub) > 0) 
        {
            foreach ($marketerHub as $data) {
                        if($d_count > 0 && !empty($data->revenue)){
                            echo $data->revenue.",";
                        }
                         $d_count--;
                     }
                    }
                    $d_count = count($dates);
        if(count($shosh) > 0) 
        {
            foreach ($shosh as $data) {
                        if($d_count > 0 && !empty($data->revenue)){
                            echo $data->revenue.",";
                        }
                         $d_count--;
                     }
                    }
        }
        elseif ($filter == "sa") {
            $d_count = count($dates);
                        if(count($araby) > 0) 
        {
            foreach ($araby as $data) {
                        if($d_count > 0 && !empty($data->net_sales_amount_usd)){
                            echo $data->net_sales_amount_usd.",";
                        }
                         $d_count--;
                     }
                    }
                    $d_count = count($dates);
        if(count($styli) > 0) 
        {
            foreach ($styli as $data) {
                        if($d_count > 0 && !empty($data->order_usd)){
                            echo $data->order_usd.",";
                        }
                         $d_count--;
                     }
                    }
                    $d_count = count($dates);
        if(count($marketerHub) > 0) 
        {
            foreach ($marketerHub as $data) {
                        if($d_count > 0 && !empty($data->sales_amount_usd)){
                            echo $data->sales_amount_usd.",";
                        }
                         $d_count--;
                     }
                    }
        $d_count = count($dates);
        if(count($shosh) > 0) 
        {
            foreach ($shosh as $data) {
                        if($d_count > 0 && !empty($data->sale_amount)){
                            echo $data->sale_amount.",";
                        }
                         $d_count--;
                     }
                    }
                    $d_count = count($dates);
        if(count($ounass) > 0) 
        {
            foreach ($ounass as $data) {
                        if($d_count > 0 && !empty($data->sum_of_nmv)){
                            echo (float)$data->sum_of_nmv.",";
                        }
                         $d_count--;
                     }
                    }

                    } 
        elseif ($filter == "order") {
            $d_count = count($dates);
                        if(count($araby) > 0) 
        {
            foreach ($araby as $data) {
                        if($d_count > 0 && !empty($data->net_orders)){
                            echo $data->net_orders.",";
                        }
                         $d_count--;
                     }
                    }
        $d_count = count($dates);
        if(count($marketerHub) > 0) 
        {
            foreach ($marketerHub as $data) {
                        if($d_count > 0 && !empty($data->orders)){
                            echo $data->orders.",";
                        }
                         $d_count--;
                     }
                    }
                    $d_count = count($dates);
        if(count($shosh) > 0) 
        {
            foreach ($shosh as $data) {
                        if($d_count > 0 && !empty($data->orders)){
                            echo $data->orders.",";
                        }
                         $d_count--;
                     }
                    }
            $d_count = count($dates);
        if(count($ounass) > 0) 
        {
            foreach ($ounass as $data) {
                        if($d_count > 0 && !empty($data->_004_orders)){
                            echo $data->_004_orders.",";
                        }
                         $d_count--;
                     }
                    }

                    }
                     ?>]
    }],
    fill: {
        opacity: [0.85,0.25,1],
        gradient: {
            inverseColors: false,
            shade: 'light',
            type: "vertical",
            opacityFrom: 0.85,
            opacityTo: 0.55,
            stops: [0, 100, 100, 100]
        }
    },
    labels: [<?php
            if (count($dates) > 0) {
                $kkk=0;
                foreach ($dates as $date) {
                    if ($kkk != (count($dates) -1)) {
                        echo "'".$date . "',";
                    } else {
                        echo "'".$date."'";
                    }
                    $kkk++;
                }
            }
            ?>],//['01/01/2003', '02/01/2003','03/01/2003','04/01/2003','05/01/2003','06/01/2003','07/01/2003','08/01/2003','09/01/2003','10/01/2003','11/01/2003'],
    markers: {
        size: 0
    },
    xaxis: {
        type:'date'
    },
    yaxis: {
        min: 0,
        //  max: <?php echo e(round((float)$max)); ?>

    },
    tooltip: {
        shared: true,
        intersect: false,
        y: {
            formatter: function (y) {
                if(typeof y !== "undefined") {
                    return  y.toFixed(0) + " views";
                }
                return y;

            }
        }
    },
    legend: {
        labels: {
            useSeriesColors: true
        },
    },
    colors:[CubaAdminConfig.secondary , '#51bb25' , CubaAdminConfig.primary ]
}
    var chart7 = new ApexCharts(
    document.querySelector("#mixedchart"),
    options7
);

chart7.render();
</script>

<?php endif; ?>
<script>
    var status = "<?php echo e($status); ?>";
    if(status == 1 || status == 0){
        $('#influencer').css('display','block');
    }else{
        $('#influencer').css('display','none');
    }
     
	$(document).on('change','#brand_id',function(){
            let brand_id = $(this).val();
            let url = $(this).attr('data-href');
            getCategory(url,brand_id);
        });

		function getCategory(url,brand_id){
            $.get(url+'?brand_id='+brand_id,function(data){
                let response = data.data;
                let view_html = ``;
                $.each(response , function(key, value) {
                    view_html += `<option value="${value.id}">${value.coupon_code}</option>`;
                  });
                  console.log(view_html)
                  let start = `<option value="">Select One</option>`;
                $('#coupon_id').html(start+view_html);
            })
        }

        $(document).on('change','#status',function(){
            let status = $(this).val();
            if(status != -2){
                let url = $(this).attr('data-href');
                getInfluencers(url,status);
            }else if(status == -2){
                $('#influencer').css('display','none');
            }
        });

		function getInfluencers(url,status){
            $.get(url+'?status='+status,function(data){
                $('#influencer').css('display','block');
                let response = data.data;
                let view_html = ``;
                $.each(response , function(key, value) {
                    view_html += `<option value="${value.id}">${value.f_name}</option>`;
                  });
                  console.log(view_html)
                  let start = `<option value="">Select One</option>`;
                $('#influencer_id').html(start+view_html);
            })
        }
</script>
<?php $__env->stopSection(); ?>

<?php else: ?>
<script>
    window.location.href = "<?php echo e(route('notfound')); ?>";
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
</script>
<?php endif; ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\influencer_app\resources\views/graph/search.blade.php ENDPATH**/ ?>