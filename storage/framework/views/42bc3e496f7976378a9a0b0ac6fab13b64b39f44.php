<?php if(auth()->user()->user_type != 2): ?>

<?php $__env->startSection('title', 'Select2'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/select2.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Upload</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('management.index')); ?>">Upload List</a></li>
<li class="breadcrumb-item active">Upload</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="select2-drpdwn">
		<div class="row">
			<!-- Default Textbox start-->
			<div class="col-md-12">
				<div class="card">
				<div class="container">
			
                     <div class="d-flex flex-row-reverse">
                           <a class="p-1" href="<?php echo e(route('management.index')); ?>" ><button class="btn btn-primary">Back</button></a>
                        
                           
                     </div>
					 <?php if($message = Session::get('success')): ?>
                                 <div class="alert alert-success">
                                       <p><?php echo e($message); ?></p>
                                 </div>
                              <?php endif; ?>
				
				<form id="upload_form" class="needs-validation" action="<?php echo e(route('management.update',$management->id.'---'.$management->temp_id)); ?>" method="post" >
				<?php echo csrf_field(); ?>
					<?php echo method_field('PUT'); ?>
						<div class="card-header">
										
									
						<div class="row">	
						<?php if($errors->any()): ?>
                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="alert alert-danger alert-dismissible p-2">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                     <strong>Error!</strong> <?php echo e($error); ?>.
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
								<div class="col-lg-4 mb-3">
									<p style="font-weight: bold;font-size: 15px;">Select Coupons</p>
										<!-- <div class="col-form-label">Select Coupons</div> -->
										<select class="js-example-placeholder-multiple col-sm-12" name="coupon" placeholder="Select Coupons">
											<?php $__currentLoopData = $Coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($management->coupon_id == $Coupon->id): ?>
											<option value="<?php echo e($Coupon->id); ?>" selected><?php echo e($Coupon->coupon_code); ?></option>
											<?php else: ?>
											<option value="<?php echo e($Coupon->id); ?>"><?php echo e($Coupon->coupon_code); ?></option>
											<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
								</div>
									
								<div class="col-lg-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Select Brand</p>
										<select class="js-example-placeholder-multiple col-sm-12" name="brand">
										<?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($management->brand_id == $brand->id): ?>
												<option value="<?php echo e($brand->id); ?>" selected><?php echo e($brand->company_name); ?></option>
											<?php else: ?>
												<option value="<?php echo e($brand->id); ?>"><?php echo e($brand->company_name); ?></option>
											<?php endif; ?>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
								</div>
								<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Revenue</p>
											    <div class="input-group mb-3">
												
                                                        <div class="input-group-prepend">
                                                             <span class="input-group-text">$</span>
                                                        </div>
                                                       <input class="form-control" value="<?php echo e($management->revenue); ?>" aria-label="Amount (to the nearest dollar)" name="revenue" type="number" placeholder="Revenue"  step="any">
                                                   </div>
                                                 </div>
								<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Sale Amount</p>
											    <div class="input-group mb-3">
												
                                                        <div class="input-group-prepend">
                                                             <span class="input-group-text">$</span>
                                                        </div>
                                                       <input class="form-control"  value="<?php echo e($management->sale_amount); ?>" aria-label="Amount (to the nearest dollar)" name="sale_amount" type="number" placeholder="Sale Amount"  step="any">
                                                   </div>
                                                 </div>
                                  
												 <div class="col-md-4">
									<p style="font-weight: bold;font-size: 15px;">Month</p>
									<select name="month" id="" class="form-control">
										<?php for($i=1;$i<=12;$i++): ?>
											<?php if($i == 1): ?>
												<option value="<?php echo e($i); ?>" <?php echo e($management->month == $i ? 'selected' : ''); ?> >January</option>
											<?php elseif($i == 2): ?>
												<option value="<?php echo e($i); ?>" <?php echo e($management->month == $i ? 'selected' : ''); ?> >February</option>
											<?php elseif($i == 3): ?>
												<option value="<?php echo e($i); ?>" <?php echo e($management->month == $i ? 'selected' : ''); ?> >March</option>
											<?php elseif($i == 4): ?>
												<option value="<?php echo e($i); ?>" <?php echo e($management->month == $i ? 'selected' : ''); ?> >April</option>
											<?php elseif($i == 5): ?>
												<option value="<?php echo e($i); ?>" <?php echo e($management->month == $i ? 'selected' : ''); ?> >May</option>
											<?php elseif($i == 6): ?>
												<option value="<?php echo e($i); ?>" <?php echo e($management->month == $i ? 'selected' : ''); ?> >June</option>
											<?php elseif($i == 7): ?>
												<option value="<?php echo e($i); ?>" <?php echo e($management->month == $i ? 'selected' : ''); ?> >July</option>
											<?php elseif($i == 8): ?>
												<option value="<?php echo e($i); ?>" <?php echo e($management->month == $i ? 'selected' : ''); ?> >August</option>
											<?php elseif($i == 9): ?>
												<option value="<?php echo e($i); ?>" <?php echo e($management->month == $i ? 'selected' : ''); ?> >September</option>
											<?php elseif($i == 10): ?>
												<option value="<?php echo e($i); ?>" <?php echo e($management->month == $i ? 'selected' : ''); ?> >October</option>
											<?php elseif($i == 11): ?>
												<option value="<?php echo e($i); ?>" <?php echo e($management->month == $i ? 'selected' : ''); ?> >November</option>
											<?php else: ?>
												<option value="<?php echo e($i); ?>" <?php echo e($management->month == $i ? 'selected' : ''); ?> >December</option>
											<?php endif; ?>
										<?php endfor; ?>
									</select>
										
										
                                </div>

											 
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Orders</p>
                                        <div class="input-group mb-3">

                                            
                                            <input class="form-control" value="<?php echo e($management->orders); ?>" aria-label="Amount (to the nearest dollar)"
                                                name="orders" type="number" placeholder="Orders" >
                                        </div>
                                    </div>
									
                    	</div>
						<div class="row">
							<div class="col-lg-2">
								<button class="btn btn-success" id="update" type="button">Update</button>
							</div>
						</div>
						</div> 
					
					</form>
</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $('#update').click(async function(event) {
        Swal.fire({
        title: 'Are you sure to Update the Data?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Update it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $("#upload_form").submit();
        }
      })
});

</script>

<script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#date_picker').attr('min',today);
    </script>
<script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php else: ?>
<script>
    window.location.href = "<?php echo e(route('notfound')); ?>";
</script>
<?php endif; ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\influencer_app\resources\views/management/shosh_edit.blade.php ENDPATH**/ ?>