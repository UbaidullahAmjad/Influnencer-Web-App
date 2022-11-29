
<?php $__env->startSection('title', 'Select2'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/select2.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Payment Detail</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(auth()->user()->user_type != 2 ? route('payment_detail') : route('get_influencer_payments')); ?>">Payment Detail List</a></li>
<li class="breadcrumb-item active">Payment Detail</li>
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
                           <a class="p-1" href="<?php echo e(auth()->user()->user_type != 2 ? route('payment_detail') : route('get_influencer_payments')); ?>" ><button class="btn btn-primary">Back</button></a>
                        
                           
                     </div>
					 <?php if($message = Session::get('success')): ?>
                                 <div class="alert alert-success">
                                       <p><?php echo e($message); ?></p>
                                 </div>
                              <?php endif; ?>
				
				<form id="upload_form" class="needs-validation" action="" method="post" >
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
								
								
								<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Publisher</p>
											    <div class="input-group mb-3">
                                                       <input class="form-control" value="<?php echo e($payments->publisher); ?>"  name="publisher" type="text" readonly >
                                                   </div>
                                                 </div>
											
								<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Link</p>
											    <div class="input-group mb-3">
                                                       <input class="form-control"  value="<?php echo e($payments->link); ?>"  name="link" type="text" readonly>
                                                   </div>
                                                 </div>
                                
								<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Direct WhatsApp</p>

											    <div class="input-group mb-3">
                                                       <input class="form-control" value="<?php echo e($payments->direct_whatsapp); ?>" name="direct_whatsapp" type="text" readonly>
                                                   </div>
											 </div>
											
											 <div class="col-md-4">
													<p style="font-weight: bold;font-size: 15px;">WhatsApp Group</p>

													<div class="input-group mb-3">
														<input class="form-control" value="<?php echo e($payments->group_whatsapp); ?>" name="group_whatsapp" type="text"
														readonly	>
													</div>
                                              </div>
											 <div class="col-md-4">
													<p style="font-weight: bold;font-size: 15px;">Country</p>
													<div class="input-group mb-3">
														<input class="form-control" value="<?php echo e($payments->country); ?>" name="country" type="text"
                                                        readonly>
													</div>
                                              </div>
									<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Bank Name</p>
										<input  value="<?php echo e($payments->bank_name); ?>" class="form-control" id="validationCustom01" name="bank_city" type="text" readonly>
									</div>
                                    <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Bank City</p>
										<input class="form-control" value="<?php echo e($payments->bank_city); ?>" id="validationCustom01" name="bank_city" type="text" readonly >
									</div>
                                    <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Beneficiary</p>
										<input class="form-control" value="<?php echo e($payments->beneficiary); ?>" id="validationCustom01" name="beneficiary" type="text" readonly>
									</div>
                                   <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Account Number</p>
										<input class="form-control" value="<?php echo e($payments->account_number); ?>" id="validationCustom01" name="account_number" type="text" readonly>
									</div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">IBAN Number</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="<?php echo e($payments->iban_number); ?>" name="iban_number" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Notes</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="<?php echo e($payments->notes); ?>" name="notes" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Account</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="<?php echo e($payments->amount); ?>" name="notes" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Pending Account</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="<?php echo e($payments->pending_amount); ?>" name="pending_amount" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Quality</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="<?php echo e($payments->quality); ?>" name="quality" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Payment Currency</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="<?php echo e($payments->payment_currency); ?>" name="payment_currency" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Transfer</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="<?php echo e($payments->transfer == 0 ? 'Inactive' : 'Active'); ?>" name="transfer" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">POP Invoice</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="<?php echo e($payments->pop_invoice); ?>" name="pop_invoice" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">MM</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="<?php echo e($payments->mm); ?>" name="mm" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Total</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="<?php echo e($payments->total); ?>" name="total" type="text" readonly >
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

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\influencer_app\resources\views/payment/view_payment_details.blade.php ENDPATH**/ ?>