<?php if(auth()->user()->user_type != 2): ?>

<?php $__env->startSection('title', 'Validation Forms', 'Select2'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/select2.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Add New Assosiation</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('assciate.index')); ?>">Assosiation List</a></li>
<li class="breadcrumb-item active">Add Assosiation</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				
				<div class="card-body">

				<div class="container">
                     <div class="d-flex flex-row-reverse">
                         <a class="p-1" href="<?php echo e(route('assciate.index')); ?>" ><button class="btn btn-primary">Back</button></a>
                          
                     </div>
					<form class="needs-validation" novalidate="" action="<?php echo e(route('assciate.store')); ?>" method="post">
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

						<?php if($errors->any()): ?>
                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="alert alert-danger alert-dismissible p-2">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                     <strong>Error!</strong> <?php echo e($error); ?>.
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
						
									<div class="col-md-4 mb-4">
                                       <p style="font-weight: bold;font-size: 15px;">Select Brand</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control" id="brand_id" name="brand"  data-href="<?php echo e(route('get_coupons')); ?>">
											<option value="" disabled selected>-- Select Brand --</option>
										<?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($brand->id); ?>"><?php echo e($brand->company_name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
										
									</div>

                                    <div class="col-md-4 mb-4">
                                       <p style="font-weight: bold;font-size: 15px;">Select Coupon</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="coupon" id="coupon_id">
										
										</select>
										
									</div>

                                    <div class="col-md-4 mb-4">
                                       <p style="font-weight: bold;font-size: 15px;">Select Influencer</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="influencer">
										<?php $__currentLoopData = $influencers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $influencer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($influencer->pub_id); ?>"><?php echo e($influencer->f_name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
	
									</div>
								
								
							
						</div>
						<div class="mb-3">
							
						</div>
						<button class="btn btn-success" type="submit">Submit</button>
					</form>
                  </div>
               <!-- <div class="mb-3">
							
                     </div>
                   <a  href="<?php echo e(route('coupon.index')); ?>">  <button class="btn btn-primary" type="button">Back</button></a> -->
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
</script>
<?php $__env->stopSection(); ?>

<?php else: ?>
<script>
    window.location.href = "<?php echo e(route('notfound')); ?>";
</script>
<?php endif; ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\influencer_app\resources\views/association/create.blade.php ENDPATH**/ ?>