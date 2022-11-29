<?php if(auth()->user()->user_type != 2): ?>

<?php $__env->startSection('title', 'Validation Forms'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/select2.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Upload New CSV</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('management.index')); ?>">Upload List</a></li>
<li class="breadcrumb-item active">Upload CSV</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				
				<div class="card-body">
					
				<?php if($message = Session::get('error')): ?>
        <div class="alert alert-danger">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
	<?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
	<div class="row">
		<!-- <div class="col-md-4 offset-8 mb-3">
                    <input class="form-check-input" name="" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
						Check to Upload the Validation Template:
                    </label>
                </div>
		</div> -->
					<form class="needs-validation" novalidate="" action="<?php echo e(route('management_csv_upload')); ?>" method="post" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="row">
							<div class="col-md-4 mb-3">
								<label for="validationCustom01">Influencers CSV</label>
								<input class="form-control" id="validationCustom01" name="csv" type="file" placeholder="Influencer Csv" required="">
								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="col-lg-4 mb-3" id="template">
                                        <!-- <p style="font-weight: bold;font-size: 15px;">Select Template</p> -->
                                        <label for="validationCustom01">Select Template</label>
                                        <!-- <div class="col-form-label">Select Coupons</div> -->
                                        <select class="js-example-placeholder-multiple col-sm-12" name="template" id="select_month_date" required="">

                                                <option selected disabled>Select Template</option>
                                                <option value="1">Araby Ads</option>
												<option value="2">Ounass</option>
												<option value="3">Styli</option>
												<option value="4">Marketeer Hub</option>
												<option value="5">Shosh</option>
												<option value="6">Araby Ads Validations</option>
												<option value="7">Ounass Validations</option>
												<option value="8">Styli Validations</option>
												<option value="9">Marketeer Hub Validations</option>
												<option value="10">Shosh Validations</option>
												<option value="11">Noon EG</option>
                                            
                                        </select>
                                    </div>
									
									<div class="col-lg-4 mb-3" id="month_date">
                                        <!-- <p style="font-weight: bold;font-size: 15px;">Select Template</p> -->
                                        <label for="validationCustom01">Select Month</label>
                                        <!-- <div class="col-form-label">Select Coupons</div> -->
                                        <select class="js-example-placeholder-multiple col-sm-12" name="month_date" required="">
                                            
                                                <option value="1">January</option>
												<option value="2">Februay</option>
												<option value="3">March</option>
												<option value="4">April</option>
												<option value="5">May</option>
												<option value="6">June</option>
												<option value="7">July</option>
												<option value="8">August</option>
												<option value="9">September</option>
												<option value="10">October</option>
												<option value="11">November</option>
												<option value="12">December</option>

                                            
                                        </select>
                                    </div>
							
						</div>
						<div class="mb-3">
							
						</div>
						<button class="btn btn-primary" type="submit">Submit form</button>
					</form>

					
				</div>
			</div>
			
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/form-validation-custom.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
	<script>
    setTimeout(function() {
    $('.alert-success').fadeOut('fast');
}, 3000);
</script>
<script>
    setTimeout(function() {
    $('.alert-danger').fadeOut('fast');
}, 3000);
</script>
	<!-- <script>
		// $('#select_month_date').on('change', function() {
		// 	var val = this.value;
		// 	if (val == 4 || val == 5 || val == 2)
		// 	{
		// 		$('#month_date').show();
		// 	}
		// 	else
		// 	{
		// 		$('#month_date').hide();

			}
		});
		// $('.form-check-input').click(function(){
        //     if($(this).prop("checked") == true)
		// 	{
		// 		$('#validation_template').show();
		// 		$('#month_date').show();
		// 		$('#template').hide();
        //     }
		// 	else
		// 	{
		// 		$('#validation_template').hide();
		// 		$('#month_date').hide();
		// 		$('#template').show();
		// 	}
        // });
	</script> -->
<?php $__env->stopSection(); ?>
<?php else: ?>
<script>
    window.location.href = "<?php echo e(route('notfound')); ?>";
</script>
<?php endif; ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\influencer_app\resources\views/management/csv_management.blade.php ENDPATH**/ ?>