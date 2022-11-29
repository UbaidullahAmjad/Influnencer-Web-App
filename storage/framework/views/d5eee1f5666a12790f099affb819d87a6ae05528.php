<?php if(auth()->user()->user_type != 2): ?>

<?php $__env->startSection('title', 'Validation Forms', 'Select2'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/select2.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Add New Coupon</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('coupon.index')); ?>">Coupons List</a></li>
<li class="breadcrumb-item active">Add Coupon</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				
				<div class="card-body">
            <div class="container">
                     <div class="d-flex flex-row-reverse">
                           <a class="p-1" href="<?php echo e(route('coupon.index')); ?>" ><button class="btn btn-primary">Back</button></a>
                            
                     </div>
                  
                     <table class="display" id="basic-1">
                 
					<form class="needs-validation" novalidate="" action="<?php echo e(route('coupon.store')); ?>" method="post" enctype="multipart/form-data">
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
                              <p style="font-weight: bold;font-size: 15px;">Select Brand *</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="brand">
                                 <option value="" disabled selected>Select Brand</option>
										<?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->company_name); ?></option>  
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
										
									</div>
								
									<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Coupon Code *</p>
										<!-- <div class="col-form-label">Amount</div> -->
										<input class="form-control" id="validationCustom01" value="<?php echo e(old('coupon_code')); ?>" name="coupon_code" type="text" placeholder="Coupon Code">
										<!-- <div class="valid-feedback">Looks good!</div> -->
									</div>
                             
                           <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Expiry Date *</p>
										<!-- <div class="col-form-label">Expiry Date</div> -->
										<input class="form-control"  name="date" id="date_picker" type="date" placeholder="dd/mm/yyyy">
										<!-- <div class="valid-feedback">Looks good!</div> -->
									</div>
                               

									<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Symbol *</p>
										<!-- <div class="col-form-label">Symbol</div> -->
										<select class="js-example-placeholder-multiple col-sm-8 form-control" id="myDropdown" name="symbol">
                              <option value="" disabled selected>Select Symbol</option>
										<option value="$" <?php echo e(old('symbol') == "$" ? 'selected' : ''); ?>>$</option>
										<option value="%" <?php echo e(old('symbol') == "%" ? 'selected' : ''); ?>>%</option>
										
										</select>
										
                           </div>
                           
                           <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Amount *</p>
										<!-- <div class="col-form-label">Amount</div> -->
                              <input class="form-control" id="amount" value="<?php echo e(old('amount')); ?>" name="amount" min="1" type="number" placeholder="Amount">
										<!-- <div class="valid-feedback">Looks good!</div> -->
                              <p style="display:none;color:red" id="amount_message">Amount should be less/equal to 100</p>
									</div>

									
									<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Currency *</p>
										<!-- <div class="col-form-label">Currency</div> -->
										<select class="js-example-placeholder-multiple col-sm-8 form-control" name="currency">
                              <option value="" disabled selected>Select Currency</option>
    <option value="AFN">AFN</option>
    <option value="ALL">ALL</option>
    <option value="DZD">DZD</option>
    <option value="AOA">AOA</option>
    <option value="ARS">ARS </option>
    <option value="AMD">AMD </option>
    <option value="AWG">AWG </option>
    <option value="AUD">AUD </option>
    <option value="AZN">AZN </option>
    <option value="BSD">BSD </option>
    <option value="BHD">BHD </option>
    <option value="BDT">BDT </option>
    <option value="BBD">BBD </option>
    <option value="BYR">BYR </option>
    <option value="BEF">BEF </option>
    <option value="BZD">BZD </option>
    <option value="BMD">BMD </option>
    <option value="BTN">BTN </option>
    <option value="BTC">BTC</option>
    <option value="BOB">BOB </option>
    <option value="BAM">BAM  </option>
    <option value="BWP">BWP </option>
    <option value="BRL">BRL </option>
    <option value="GBP">GBP </option>
    <option value="BND">BND</option>
    <option value="BGN">BGN </option>
    <option value="BIF">BIF </option>
    <option value="KHR">KHR </option>
    <option value="CAD">CAD </option>
    <option value="CVE">CVE </option>
    <option value="KYD">KYD  </option>
    <option value="XOF">XOF</option>
    <option value="XAF">XAF</option>
    <option value="XPF">XPF</option>
    <option value="CLP">CLP</option>
    <option value="CNY">CNY</option>
    <option value="COP">COP</option>
    <option value="KMF">KMF</option>
    <option value="CDF">CDF </option>
    <option value="CRC">CRC</option>
    <option value="HRK">HRK</option>
    <option value="CUC">CUC</option>
    <option value="CZK">CZK</option>
    <option value="DKK">DKK</option>
    <option value="DJF">DJF</option>
    <option value="DOP">DOP</option>
    <option value="XCD">XCD</option>
    <option value="EGP">EGP</option>
    <option value="ERN">ERN</option>
    <option value="EEK">EEK</option>
    <option value="ETB">ETB</option>
    <option value="EUR">Euro</option>
    <option value="FKP">FKP</option>
    <option value="FJD">FJD</option>
    <option value="GMD">GMD</option>
    <option value="GEL">GEL</option>
    <option value="DEM">DEM</option>
    <option value="GHS">GHS</option>
    <option value="GIP">GIP</option>
    <option value="GRD">GRD</option>
    <option value="GTQ">GTQ</option>
    <option value="GNF">GNF</option>
    <option value="GYD">GYD</option>
    <option value="HTG">HTG</option>
    <option value="HNL">HNL</option>
    <option value="HKD">HKD</option>
    <option value="HUF">HUF</option>
    <option value="ISK">ISK</option>
    <option value="INR">INR</option>
    <option value="IDR">IDR</option>
    <option value="IRR">IRR</option>
    <option value="IQD">IQD</option>
    <option value="ILS">ILS</option>
    <option value="ITL">ITL</option>
    <option value="JMD">JMD</option>
    <option value="JPY">JPY</option>
    <option value="JOD">JOD</option>
    <option value="KZT">KZT</option>
    <option value="KES">KES</option>
    <option value="KWD">KWD</option>
    <option value="KGS">KGS</option>
    <option value="LAK">LAK</option>
    <option value="LVL">LVL</option>
    <option value="LBP">LBP</option>
    <option value="LSL">LSL</option>
    <option value="LRD">LRD</option>
    <option value="LYD">LYD</option>
    <option value="LTL">LTL</option>
    <option value="MOP">MOP</option>
    <option value="MKD">MKD</option>
    <option value="MGA">MGA</option>
    <option value="MWK">MWK</option>
    <option value="MYR">MYR</option>
    <option value="MVR">MVR</option>
    <option value="MRO">MRO</option>
    <option value="MUR">MUR</option>
    <option value="MXN">MXN</option>
    <option value="MDL">MDL</option>
    <option value="MNT">MNT</option>
    <option value="MAD">MAD</option>
    <option value="MZM">MZM</option>
    <option value="MMK">MMK</option>
    <option value="NAD">NAD</option>
    <option value="NPR">NPR</option>
    <option value="ANG">ANG</option>
    <option value="TWD">TWD</option>
    <option value="NZD">NZD</option>
    <option value="NIO">NIO</option>
    <option value="NGN">NGN</option>
    <option value="KPW">KPW</option>
    <option value="NOK">NOK</option>
    <option value="OMR">OMR</option>
    <option value="PKR">PKR</option>
    <option value="PAB">PAB</option>
    <option value="PGK">PGK</option>
    <option value="PYG">PYG</option>
    <option value="PEN">PEN</option>
    <option value="PHP">PHP</option>
    <option value="PLN">PLN</option>
    <option value="QAR">QAR</option>
    <option value="RON">RON</option>
    <option value="RUB">RUB</option>
    <option value="RWF">RWF</option>
    <option value="SVC">SVC</option>
    <option value="WST">WST</option>
    <option value="SAR">SAR</option>
    <option value="RSD">RSD</option>
    <option value="SCR">SCR</option>
    <option value="SLL">SLL</option>
    <option value="SGD">SGD</option>
    <option value="SKK">SKK</option>
    <option value="SBD">SBD</option>
    <option value="SOS">SOS</option>
    <option value="ZAR">ZAR</option>
    <option value="KRW">KRW</option>
    <option value="XDR">XDR</option>
    <option value="LKR">LKR</option>
    <option value="SHP">SHP</option>
    <option value="SDG">SDG</option>
    <option value="SRD">SRD</option>
    <option value="SZL">SZL</option>
    <option value="SEK">SEK</option>
    <option value="CHF">CHF</option>
    <option value="SYP">SYP</option>
    <option value="STD">STD</option>
    <option value="TJS">TJS</option>
    <option value="TZS">TZS</option>
    <option value="THB">THB</option>
    <option value="TOP">TOP</option>
    <option value="TTD">TTD</option>
    <option value="TND">TND</option>
    <option value="TRY">TRY</option>
    <option value="TMT">TMT</option>
    <option value="UGX">UGX</option>
    <option value="UAH">UAH</option>
    <option value="AED">AED</option>
    <option value="UYU">UYU</option>
    <option value="USD">USD</option>
    <option value="UZS">UZS</option>
    <option value="VUV">VUV</option>
    <option value="VEF">VEF</option>
    <option value="VND">VND</option>
    <option value="YER">YER</option>
    <option value="ZMK">ZMK</option>
										</select>
										<!-- <input class="form-control" id="validationCustom02"  name="currency" type="text" placeholder="Currency" required=""> -->
										<!-- <div class="valid-feedback">Looks good!</div> -->
									</div>
							
						</div>
						<div class="mb-3">
							
						</div>
						<button class="btn btn-success" id="submit-btn" type="submit">Submit</button>
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

$("#amount").focusout(function(){
  var am = $(this).val();
  var e = document.getElementById("myDropdown");
   var strUser = e.value;
   if(strUser == "%" && am > 100){
      document.getElementById("amount_message").style.display = "block";
      document.getElementById("submit-btn").disabled = true;
   }else if(strUser == "$" || am <= 100){
      document.getElementById("amount_message").style.display = "none";
      document.getElementById("submit-btn").disabled = false;
   }
});
  $('#myDropdown').on('change',function(){
      var val = this.value;
      var e = document.getElementById("amount");
      var strUser = e.value;
      if(val == "%" && strUser && strUser > 100){
         document.getElementById("amount_message").style.display = "block";
         document.getElementById("submit-btn").disabled = true;
      }else if(val == "$" || (strUser && strUser <= 100)){
         document.getElementById("amount_message").style.display = "none";
         document.getElementById("submit-btn").disabled = false;
      }
  })
</script>
<script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#date_picker').attr('min',today);
    </script>
<?php $__env->stopSection(); ?>
<?php else: ?>
<script>
    window.location.href = "<?php echo e(route('notfound')); ?>";
</script>
<?php endif; ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\influencer_app\resources\views/coupons/create.blade.php ENDPATH**/ ?>