<?php if(auth()->user()->user_type != 2): ?>

<?php $__env->startSection('title', 'Validation Forms'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Upload New CSV</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('brands.index')); ?>">Brand List</a></li>
<li class="breadcrumb-item active">Brand CSV</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				
			<?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
				<div class="card-body">
				<?php if($message = Session::get('error')): ?>
        <div class="alert alert-danger">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
					<form class="needs-validation" action="<?php echo e(route('brand_csv')); ?>" method="post" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>
						<div class="row">
							<div class="col-md-4 mb-3">
								<label for="validationCustom01">Brands CSV</label>
								<input class="form-control" id="validationCustom01" name="csv" type="file" placeholder="Brand Csv" required="">
								<div class="valid-feedback">Looks good!</div>
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
<?php $__env->stopSection(); ?>
<?php else: ?>
<script>
    window.location.href = "<?php echo e(route('notfound')); ?>";
</script>
<?php endif; ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\influencer_app\resources\views/brands/csv_brands.blade.php ENDPATH**/ ?>