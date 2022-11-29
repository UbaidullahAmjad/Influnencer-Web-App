<?php if(auth()->user()->user_type != 2): ?>

<?php $__env->startSection('title', 'Validation Forms', 'Select2'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/select2.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Edit Coupon</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('coupon.index')); ?>">Coupons List</a></li>
<li class="breadcrumb-item active">Edit Coupone</li>
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
					<form id="coupon-form" class="needs-validation" novalidate="" action="<?php echo e(route('coupon.update',$Coupons->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
					<?php echo method_field('PUT'); ?>

                    <?php
                    $brands = App\Models\Brand::orderBy('id', 'DESC')->get();
                    ?>
						<div class="row">
                                   <div class="col-md-4 mb-4">
									   <p style="font-weight: bold;font-size: 15px;">Select Brand</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control " name="brand">
										<?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($brand->id); ?>"><?php echo e($brand->company_name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
										
									</div>
									<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Coupon Code</p>
										<input class="form-control" id="validationCustom01" value="<?php echo e($Coupons->coupon_code); ?>" name="coupon_code" type="text" placeholder="Coupones Code" required="">
										<div class="valid-feedback">Looks good!</div>
									</div>
							<!-- <div class="col-md-4 mb-3">
								<label for="validationCustom02">Currency</label>
								<input class="form-control" id="validationCustom02" value="<?php echo e($Coupons->currency); ?>"  name="currency" type="text" placeholder="Currency" required="">
								<div class="valid-feedback">Looks good!</div>
							</div> -->

                            
									<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Expiry Date</p>
										<!-- <div class="col-form-label">Expiry Date</div> -->
										<input class="form-control" id="date_picker" value="<?php echo e($Coupons->date); ?>" name="date" type="date" placeholder="Coupones Code" required="">
										<!-- <div class="valid-feedback">Looks good!</div> -->
									</div>
     
                                    <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Symbol</p>
										<!-- <div class="col-form-label">Symbol</div> -->
										<select class="js-example-placeholder-multiple col-sm-8 form-control" id="myDropdown" name="symbol">
                              <option value="" disabled selected>Select Symbol</option>
										<option value="$"<?php echo e($Coupons->symbol == '$' ? 'selected' : ''); ?>>$</option>
										<option value="%"<?php echo e($Coupons->symbol == '%' ? 'selected' : ''); ?>>%</option>
										
										</select>
										
                           </div>
                           
                           <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Amount</p>
										<!-- <div class="col-form-label">Amount</div> -->
                              <input class="form-control" id="amount" value="<?php echo e($Coupons->amount); ?>" name="amount" min="1" type="number" placeholder="Amount" required="">
										<!-- <div class="valid-feedback">Looks good!</div> -->
                              <p style="display:none;color:red" id="amount_message">Amount should be less/equal to 100</p>
									</div>

									<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Currency</p>
										<!-- <div class="col-form-label">Currency</div> -->
										<select class="js-example-placeholder-multiple col-sm-8 form-control" name="currency">
										<option value="AFN" <?php echo e($Coupons->currency == 'AFN' ? 'selected' : ''); ?>>AFN</option>
    <option value="ALL"<?php echo e($Coupons->currency == 'ALL' ? 'selected' : ''); ?>>ALL</option>
    <option value="DZD"<?php echo e($Coupons->currency == 'DZD' ? 'selected' : ''); ?>>DZD</option>
    <option value="AOA"<?php echo e($Coupons->currency == 'AOA' ? 'selected' : ''); ?>>AOA</option>
    <option value="ARS"<?php echo e($Coupons->currency == 'ARS' ? 'selected' : ''); ?>>ARS</option>
    <option value="AMD"<?php echo e($Coupons->currency == 'AMD' ? 'selected' : ''); ?>>AMD</option>
    <option value="AWG"<?php echo e($Coupons->currency == 'AWG' ? 'selected' : ''); ?>>AWG</option>
    <option value="AUD"<?php echo e($Coupons->currency == 'AUD' ? 'selected' : ''); ?>>AUD</option>
    <option value="AZN"<?php echo e($Coupons->currency == 'AZN' ? 'selected' : ''); ?>>AZN</option>
    <option value="BSD"<?php echo e($Coupons->currency == 'BSD' ? 'selected' : ''); ?>>BSD</option>
    <option value="BHD"<?php echo e($Coupons->currency == 'BHD' ? 'selected' : ''); ?>>BHD</option>
    <option value="BDT"<?php echo e($Coupons->currency == 'BDT' ? 'selected' : ''); ?>>BDT</option>
    <option value="BBD"<?php echo e($Coupons->currency == 'BBD' ? 'selected' : ''); ?>>BBD</option>
    <option value="BYR"<?php echo e($Coupons->currency == 'BYR' ? 'selected' : ''); ?>>BYR</option>
    <option value="BEF"<?php echo e($Coupons->currency == 'BEF' ? 'selected' : ''); ?>>BEF</option>
    <option value="BZD"<?php echo e($Coupons->currency == 'BZD' ? 'selected' : ''); ?>>BZD</option>
    <option value="BMD"<?php echo e($Coupons->currency == 'BMD' ? 'selected' : ''); ?>>BMD</option>
    <option value="BTN"<?php echo e($Coupons->currency == 'BTN' ? 'selected' : ''); ?>>BTN</option>
    <option value="BTC"<?php echo e($Coupons->currency == 'BTC' ? 'selected' : ''); ?>>BTC</option>
    <option value="BOB"<?php echo e($Coupons->currency == 'BOB' ? 'selected' : ''); ?>>BOB</option>
    <option value="BAM"<?php echo e($Coupons->currency == 'BAM' ? 'selected' : ''); ?>>BAM</option>
    <option value="BWP"<?php echo e($Coupons->currency == 'BWP' ? 'selected' : ''); ?>>BWP</option>
    <option value="BRL"<?php echo e($Coupons->currency == 'BRL' ? 'selected' : ''); ?>>BRL</option>
    <option value="GBP"<?php echo e($Coupons->currency == 'GBP' ? 'selected' : ''); ?>>GBP</option>
    <option value="BND"<?php echo e($Coupons->currency == 'BND' ? 'selected' : ''); ?>>BND</option>
    <option value="BGN"<?php echo e($Coupons->currency == 'BGN' ? 'selected' : ''); ?>>BGN</option>
    <option value="BIF"<?php echo e($Coupons->currency == 'BIF' ? 'selected' : ''); ?>>BIF</option>
    <option value="KHR"<?php echo e($Coupons->currency == 'KHR' ? 'selected' : ''); ?>>KHR</option>
    <option value="CAD"<?php echo e($Coupons->currency == 'CAD' ? 'selected' : ''); ?>>CAD</option>
    <option value="CVE"<?php echo e($Coupons->currency == 'CVE' ? 'selected' : ''); ?>>CVE</option>
    <option value="KYD"<?php echo e($Coupons->currency == 'KYD' ? 'selected' : ''); ?>>KYD</option>
    <option value="XAF"<?php echo e($Coupons->currency == 'XAF' ? 'selected' : ''); ?>>XAF</option>
    <option value="XAF"<?php echo e($Coupons->currency == 'XAF' ? 'selected' : ''); ?>>XAF</option>
    <option value="XPF"<?php echo e($Coupons->currency == 'XPF' ? 'selected' : ''); ?>>XPF</option>
    <option value="CLP"<?php echo e($Coupons->currency == 'CLP' ? 'selected' : ''); ?>>CLP</option>
    <option value="CNY"<?php echo e($Coupons->currency == 'CNY' ? 'selected' : ''); ?>>CNY</option>
    <option value="COP"<?php echo e($Coupons->currency == 'COP' ? 'selected' : ''); ?>>COP</option>
    <option value="KMF"<?php echo e($Coupons->currency == 'KMF' ? 'selected' : ''); ?>>KMF</option>
    <option value="CDF"<?php echo e($Coupons->currency == 'CDF' ? 'selected' : ''); ?>>CDF</option>
    <option value="CRC"<?php echo e($Coupons->currency == 'CRC' ? 'selected' : ''); ?>>CRC</option>
    <option value="HRK"<?php echo e($Coupons->currency == 'HRK' ? 'selected' : ''); ?>>HRK</option>
    <option value="CUC"<?php echo e($Coupons->currency == 'CUC' ? 'selected' : ''); ?>>CUC</option>
    <option value="CZK"<?php echo e($Coupons->currency == 'CZK' ? 'selected' : ''); ?>>CZK</option>
    <option value="DKK"<?php echo e($Coupons->currency == 'DKK' ? 'selected' : ''); ?>>DKK</option>
    <option value="DJF"<?php echo e($Coupons->currency == 'DJF' ? 'selected' : ''); ?>>DJF</option>
    <option value="DOP"<?php echo e($Coupons->currency == 'DOP' ? 'selected' : ''); ?>>DOP</option>
    <option value="XCD"<?php echo e($Coupons->currency == 'XCD' ? 'selected' : ''); ?>>XCD</option>
    <option value="EGP"<?php echo e($Coupons->currency == 'EGP' ? 'selected' : ''); ?>>EGP</option>
    <option value="ERN"<?php echo e($Coupons->currency == 'ERN' ? 'selected' : ''); ?>>ERN</option>
    <option value="EEK"<?php echo e($Coupons->currency == 'EEK' ? 'selected' : ''); ?>>EEK</option>
    <option value="ETB"<?php echo e($Coupons->currency == 'ETB' ? 'selected' : ''); ?>>ETB</option>
    <option value="EUR"<?php echo e($Coupons->currency == 'EUR' ? 'selected' : ''); ?>>EUR</option>
    <option value="FKP"<?php echo e($Coupons->currency == 'FKP' ? 'selected' : ''); ?>>FKP</option>
    <option value="FJD"<?php echo e($Coupons->currency == 'FJD' ? 'selected' : ''); ?>>FJD</option>
    <option value="GMD"<?php echo e($Coupons->currency == 'GMD' ? 'selected' : ''); ?>>GMD</option>
    <option value="GEL"<?php echo e($Coupons->currency == 'GEL' ? 'selected' : ''); ?>>GEL</option>
    <option value="DEM"<?php echo e($Coupons->currency == 'DEM' ? 'selected' : ''); ?>>DEM</option>
    <option value="GIP"<?php echo e($Coupons->currency == 'GIP' ? 'selected' : ''); ?>>GIP</option>
    <option value="GIP"<?php echo e($Coupons->currency == 'GIP' ? 'selected' : ''); ?>>GIP</option>
    <option value="GRD"<?php echo e($Coupons->currency == 'GRD' ? 'selected' : ''); ?>>GRD</option>
    <option value="GTQ"<?php echo e($Coupons->currency == 'GTQ' ? 'selected' : ''); ?>>GTQ</option>
    <option value="GNF"<?php echo e($Coupons->currency == 'GNF' ? 'selected' : ''); ?>>GNF</option>
    <option value="GYD"<?php echo e($Coupons->currency == 'GYD' ? 'selected' : ''); ?>>GYD</option>
    <option value="HTG"<?php echo e($Coupons->currency == 'HTG' ? 'selected' : ''); ?>>HTGe</option>
    <option value="HNL"<?php echo e($Coupons->currency == 'HNL' ? 'selected' : ''); ?>>HNL</option>
    <option value="HKD"<?php echo e($Coupons->currency == 'HKD' ? 'selected' : ''); ?>>HKD</option>
    <option value="HUF"<?php echo e($Coupons->currency == 'HUF' ? 'selected' : ''); ?>>HUF</option>
    <option value="ISK"<?php echo e($Coupons->currency == 'ISK' ? 'selected' : ''); ?>>ISK</option>
    <option value="INR"<?php echo e($Coupons->currency == 'INR' ? 'selected' : ''); ?>>INR</option>
    <option value="IDR"<?php echo e($Coupons->currency == 'IDR' ? 'selected' : ''); ?>>IDR</option>
    <option value="IRR"<?php echo e($Coupons->currency == 'IRR' ? 'selected' : ''); ?>>IRR</option>
    <option value="IQD"<?php echo e($Coupons->currency == 'IQD' ? 'selected' : ''); ?>>IQD</option>
    <option value="ILS"<?php echo e($Coupons->currency == 'ILS' ? 'selected' : ''); ?>>ILS</option>
    <option value="ITL"<?php echo e($Coupons->currency == 'ITL' ? 'selected' : ''); ?>>ITL</option>
    <option value="JMD"<?php echo e($Coupons->currency == 'JMD' ? 'selected' : ''); ?>>JMD</option>
    <option value="JPY"<?php echo e($Coupons->currency == 'JPY' ? 'selected' : ''); ?>>JPY</option>
    <option value="JOD"<?php echo e($Coupons->currency == 'JOD' ? 'selected' : ''); ?>>JOD</option>
    <option value="KZT"<?php echo e($Coupons->currency == 'KZT' ? 'selected' : ''); ?>>KZT</option>
    <option value="KES"<?php echo e($Coupons->currency == 'KES' ? 'selected' : ''); ?>>KES</option>
    <option value="KWD"<?php echo e($Coupons->currency == 'KWD' ? 'selected' : ''); ?>>KWD</option>
    <option value="KGS"<?php echo e($Coupons->currency == 'KGS' ? 'selected' : ''); ?>>KGS</option>
    <option value="LAK"<?php echo e($Coupons->currency == 'LAK' ? 'selected' : ''); ?>>LAK</option>
    <option value="LVL"<?php echo e($Coupons->currency == 'LVL' ? 'selected' : ''); ?>>LVL</option>
    <option value="LBP"<?php echo e($Coupons->currency == 'LBP' ? 'selected' : ''); ?>>LBP</option>
    <option value="LSL"<?php echo e($Coupons->currency == 'LSL' ? 'selected' : ''); ?>>LSL</option>
    <option value="LRD"<?php echo e($Coupons->currency == 'LRD' ? 'selected' : ''); ?>>LRD</option>
    <option value="LYD"<?php echo e($Coupons->currency == 'LYD' ? 'selected' : ''); ?>>LYD</option>
    <option value="LTL"<?php echo e($Coupons->currency == 'LTL' ? 'selected' : ''); ?>>LTL</option>
    <option value="MOP"<?php echo e($Coupons->currency == 'MOP' ? 'selected' : ''); ?>>MOP</option>
    <option value="MKD"<?php echo e($Coupons->currency == 'MKD' ? 'selected' : ''); ?>>MKD</option>
    <option value="MGA"<?php echo e($Coupons->currency == 'MGA' ? 'selected' : ''); ?>>MGA</option>
    <option value="MWK"<?php echo e($Coupons->currency == 'MWK' ? 'selected' : ''); ?>>MWK</option>
    <option value="MYR"<?php echo e($Coupons->currency == 'MYR' ? 'selected' : ''); ?>>MYR</option>
    <option value="MVR"<?php echo e($Coupons->currency == 'MVR' ? 'selected' : ''); ?>>MVR</option>
    <option value="MRO"<?php echo e($Coupons->currency == 'MRO' ? 'selected' : ''); ?>>MRO</option>
    <option value="MUR"<?php echo e($Coupons->currency == 'MUR' ? 'selected' : ''); ?>>MUR</option>
    <option value="MXN"<?php echo e($Coupons->currency == 'MXN' ? 'selected' : ''); ?>>MXN</option>
    <option value="MDL"<?php echo e($Coupons->currency == 'MDL' ? 'selected' : ''); ?>>MDL</option>
    <option value="MNT"<?php echo e($Coupons->currency == 'MNT' ? 'selected' : ''); ?>>MNT</option>
    <option value="MAD"<?php echo e($Coupons->currency == 'MAD' ? 'selected' : ''); ?>>MAD</option>
    <option value="MZM"<?php echo e($Coupons->currency == 'MZM' ? 'selected' : ''); ?>>MZM</option>
    <option value="MMK"<?php echo e($Coupons->currency == 'MMK' ? 'selected' : ''); ?>>MMK</option>
    <option value="NAD"<?php echo e($Coupons->currency == 'NAD' ? 'selected' : ''); ?>>NAD</option>
    <option value="NPR"<?php echo e($Coupons->currency == 'NPR' ? 'selected' : ''); ?>>NPR</option>
    <option value="ANG"<?php echo e($Coupons->currency == 'ANG' ? 'selected' : ''); ?>>ANG</option>
    <option value="TWD"<?php echo e($Coupons->currency == 'TWD' ? 'selected' : ''); ?>>TWD</option>
    <option value="NZD"<?php echo e($Coupons->currency == 'NZD' ? 'selected' : ''); ?>>NZD</option>
    <option value="NIO"<?php echo e($Coupons->currency == 'NIO' ? 'selected' : ''); ?>>NIO</option>
    <option value="NGN"<?php echo e($Coupons->currency == 'NGN' ? 'selected' : ''); ?>>NGN</option>
    <option value="KPW"<?php echo e($Coupons->currency == 'KPW' ? 'selected' : ''); ?>>KPW</option>
    <option value="NOK"<?php echo e($Coupons->currency == 'NOK' ? 'selected' : ''); ?>>NOK</option>
    <option value="OMR"<?php echo e($Coupons->currency == 'OMR' ? 'selected' : ''); ?>>OMR</option>
    <option value="PKR"<?php echo e($Coupons->currency == 'PKR' ? 'selected' : ''); ?>>PKR</option>
    <option value="PAB"<?php echo e($Coupons->currency == 'PAB' ? 'selected' : ''); ?>>PAB</option>
    <option value="PGK"<?php echo e($Coupons->currency == 'PGK' ? 'selected' : ''); ?>>PGK</option>
    <option value="PYG"<?php echo e($Coupons->currency == 'PYG' ? 'selected' : ''); ?>>PYG</option>
    <option value="PEN"<?php echo e($Coupons->currency == 'PEN' ? 'selected' : ''); ?>>PEN</option>
    <option value="PHP"<?php echo e($Coupons->currency == 'PHP' ? 'selected' : ''); ?>>PHP</option>
    <option value="PLN"<?php echo e($Coupons->currency == 'PLN' ? 'selected' : ''); ?>>PLN</option>
    <option value="QAR"<?php echo e($Coupons->currency == 'QAR' ? 'selected' : ''); ?>>QAR</option>
    <option value="RON"<?php echo e($Coupons->currency == 'RON' ? 'selected' : ''); ?>>RON</option>
    <option value="RUB"<?php echo e($Coupons->currency == 'RUB' ? 'selected' : ''); ?>>RUB</option>
    <option value="RWF"<?php echo e($Coupons->currency == 'RWF' ? 'selected' : ''); ?>>RWF</option>
    <option value="SVC"<?php echo e($Coupons->currency == 'SVC' ? 'selected' : ''); ?>>SVC</option>
    <option value="WST"<?php echo e($Coupons->currency == 'WST' ? 'selected' : ''); ?>>WST</option>
    <option value="SAR"<?php echo e($Coupons->currency == 'SAR' ? 'selected' : ''); ?>>SAR</option>
    <option value="RSD"<?php echo e($Coupons->currency == 'RSD' ? 'selected' : ''); ?>>RSD</option>
    <option value="SCR"<?php echo e($Coupons->currency == 'SCR' ? 'selected' : ''); ?>>SCR</option>
    <option value="SLL"<?php echo e($Coupons->currency == 'SLL' ? 'selected' : ''); ?>>SLL</option>
    <option value="SGD"<?php echo e($Coupons->currency == 'SGD' ? 'selected' : ''); ?>>SGD</option>
    <option value="SKK"<?php echo e($Coupons->currency == 'SKK' ? 'selected' : ''); ?>>SKK</option>
    <option value="SBD"<?php echo e($Coupons->currency == 'SBD' ? 'selected' : ''); ?>>SBD</option>
    <option value="SOS"<?php echo e($Coupons->currency == 'SOS' ? 'selected' : ''); ?>>SOS</option>
    <option value="ZAR"<?php echo e($Coupons->currency == 'ZAR' ? 'selected' : ''); ?>>ZAR</option>
    <option value="KRW"<?php echo e($Coupons->currency == 'KRW' ? 'selected' : ''); ?>>KRW</option>
    <option value="XDR"<?php echo e($Coupons->currency == 'XDR' ? 'selected' : ''); ?>>XDR</option>
    <option value="LKR"<?php echo e($Coupons->currency == 'LKR' ? 'selected' : ''); ?>>LKR</option>
    <option value="SHP"<?php echo e($Coupons->currency == 'SHP' ? 'selected' : ''); ?>>SHP</option>
    <option value="SDG"<?php echo e($Coupons->currency == 'SDG' ? 'selected' : ''); ?>>SDG</option>
    <option value="SRD"<?php echo e($Coupons->currency == 'SRD' ? 'selected' : ''); ?>>SRD</option>
    <option value="SZL"<?php echo e($Coupons->currency == 'SZL' ? 'selected' : ''); ?>>SZL</option>
    <option value="SEK"<?php echo e($Coupons->currency == 'SEK' ? 'selected' : ''); ?>>SEK</option>
    <option value="CHF"<?php echo e($Coupons->currency == 'CHF' ? 'selected' : ''); ?>>CHF</option>
    <option value="SYP"<?php echo e($Coupons->currency == 'SYP' ? 'selected' : ''); ?>>SYP</option>
    <option value="STD"<?php echo e($Coupons->currency == 'STD' ? 'selected' : ''); ?>>STD</option>
    <option value="TJS"<?php echo e($Coupons->currency == 'TJS' ? 'selected' : ''); ?>>TJS</option>
    <option value="TZS"<?php echo e($Coupons->currency == 'TZS' ? 'selected' : ''); ?>>TZS</option>
    <option value="THB"<?php echo e($Coupons->currency == 'THB' ? 'selected' : ''); ?>>THB</option>
    <option value="TOP"<?php echo e($Coupons->currency == 'TOP' ? 'selected' : ''); ?>>TOP</option>
    <option value="TTD"<?php echo e($Coupons->currency == 'TTD' ? 'selected' : ''); ?>>TTD</option>
    <option value="TND"<?php echo e($Coupons->currency == 'TND' ? 'selected' : ''); ?>>TND</option>
    <option value="TRY"<?php echo e($Coupons->currency == 'TRY' ? 'selected' : ''); ?>>TRY</option>
    <option value="TMT"<?php echo e($Coupons->currency == 'TMT' ? 'selected' : ''); ?>>TMT</option>
    <option value="UGX"<?php echo e($Coupons->currency == 'UGX' ? 'selected' : ''); ?>>UGX</option>
    <option value="UAH"<?php echo e($Coupons->currency == 'UAH' ? 'selected' : ''); ?>>UAH</option>
    <option value="AED"<?php echo e($Coupons->currency == 'AED' ? 'selected' : ''); ?>>AED</option>
    <option value="UYU"<?php echo e($Coupons->currency == 'UYU' ? 'selected' : ''); ?>>UYU</option>
    <option value="USD"<?php echo e($Coupons->currency == 'USD' ? 'selected' : ''); ?>>USD</option>
    <option value="UZS"<?php echo e($Coupons->currency == 'UZS' ? 'selected' : ''); ?>>UZS</option>
    <option value="VUV"<?php echo e($Coupons->currency == 'VUV' ? 'selected' : ''); ?>>VUV</option>
    <option value="VEF"<?php echo e($Coupons->currency == 'VEF' ? 'selected' : ''); ?>>VEF</option>
    <option value="VND"<?php echo e($Coupons->currency == 'VND' ? 'selected' : ''); ?>>VND</option>
    <option value="YER"<?php echo e($Coupons->currency == 'YER' ? 'selected' : ''); ?>>YER</option>
    <option value="ZMK"<?php echo e($Coupons->currency == 'ZMK' ? 'selected' : ''); ?>>ZMK</option>
										</select>
										<!-- <input class="form-control" id="validationCustom02"  name="currency" type="text" placeholder="Currency" required=""> -->
										<!-- <div class="valid-feedback">Looks good!</div> -->
									</div>
							
						</div>
						<div class="mb-3">
							
						</div>
						<button class="btn btn-success" id="submit-btn" type="button">Update</button>
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
   $('#submit-btn').click(async function(event) {
        Swal.fire({
        title: 'Are you sure to Update the coupon?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Update it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $("#coupon-form").submit();
        }
      })
});

</script>

<script src="<?php echo e(asset('assets/js/form-validation-custom.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
<script>
$("#amount").focusout(function(){
  var am = $(this).val();
  var e = document.getElementById("myDropdown");
   var strUser = e.value;
   console.log(am)
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
      console.log(val)
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
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\influencer_app\resources\views/coupons/edit.blade.php ENDPATH**/ ?>