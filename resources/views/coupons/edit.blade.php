@if(auth()->user()->user_type != 2)
@extends('layouts.simple.master')
@section('title', 'Validation Forms', 'Select2')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">

@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Edit Coupon</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('coupon.index') }}">Coupons List</a></li>
<li class="breadcrumb-item active">Edit Coupone</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				
				<div class="card-body">
                <div class="container">
                     <div class="d-flex flex-row-reverse">
                         <a class="p-1" href="{{ route('coupon.index') }}" ><button class="btn btn-primary">Back</button></a>
                     </div>
                           
						@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

						@if ($errors->any())
                  @foreach ($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible p-2">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                     <strong>Error!</strong> {{$error}}.
                  </div>
                  @endforeach
                  @endif
					<form id="coupon-form" class="needs-validation" novalidate="" action="{{ route('coupon.update',$Coupons->id) }}" method="post">
                    @csrf
					@method('PUT')

                    <?php
                    $brands = App\Models\Brand::orderBy('id', 'DESC')->get();
                    ?>
						<div class="row">
                                   <div class="col-md-4 mb-4">
									   <p style="font-weight: bold;font-size: 15px;">Select Brand</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control " name="brand">
										@foreach($brands as $brand)
											<option value="{{$brand->id}}">{{$brand->company_name}}</option>
											@endforeach
										</select>
										
									</div>
									<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Coupon Code</p>
										<input class="form-control" id="validationCustom01" value="{{ $Coupons->coupon_code }}" name="coupon_code" type="text" placeholder="Coupones Code" required="">
										<div class="valid-feedback">Looks good!</div>
									</div>
							<!-- <div class="col-md-4 mb-3">
								<label for="validationCustom02">Currency</label>
								<input class="form-control" id="validationCustom02" value="{{ $Coupons->currency }}"  name="currency" type="text" placeholder="Currency" required="">
								<div class="valid-feedback">Looks good!</div>
							</div> -->

                            
									<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Expiry Date</p>
										<!-- <div class="col-form-label">Expiry Date</div> -->
										<input class="form-control" id="date_picker" value="{{ $Coupons->date }}" name="date" type="date" placeholder="Coupones Code" required="">
										<!-- <div class="valid-feedback">Looks good!</div> -->
									</div>
     
                                    <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Symbol</p>
										<!-- <div class="col-form-label">Symbol</div> -->
										<select class="js-example-placeholder-multiple col-sm-8 form-control" id="myDropdown" name="symbol">
                              <option value="" disabled selected>Select Symbol</option>
										<option value="$"{{$Coupons->symbol == '$' ? 'selected' : ''}}>$</option>
										<option value="%"{{$Coupons->symbol == '%' ? 'selected' : ''}}>%</option>
										
										</select>
										
                           </div>
                           
                           <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Amount</p>
										<!-- <div class="col-form-label">Amount</div> -->
                              <input class="form-control" id="amount" value="{{ $Coupons->amount }}" name="amount" min="1" type="number" placeholder="Amount" required="">
										<!-- <div class="valid-feedback">Looks good!</div> -->
                              <p style="display:none;color:red" id="amount_message">Amount should be less/equal to 100</p>
									</div>

									<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Currency</p>
										<!-- <div class="col-form-label">Currency</div> -->
										<select class="js-example-placeholder-multiple col-sm-8 form-control" name="currency">
										<option value="AFN" {{$Coupons->currency == 'AFN' ? 'selected' : ''}}>AFN</option>
    <option value="ALL"{{$Coupons->currency == 'ALL' ? 'selected' : ''}}>ALL</option>
    <option value="DZD"{{$Coupons->currency == 'DZD' ? 'selected' : ''}}>DZD</option>
    <option value="AOA"{{$Coupons->currency == 'AOA' ? 'selected' : ''}}>AOA</option>
    <option value="ARS"{{$Coupons->currency == 'ARS' ? 'selected' : ''}}>ARS</option>
    <option value="AMD"{{$Coupons->currency == 'AMD' ? 'selected' : ''}}>AMD</option>
    <option value="AWG"{{$Coupons->currency == 'AWG' ? 'selected' : ''}}>AWG</option>
    <option value="AUD"{{$Coupons->currency == 'AUD' ? 'selected' : ''}}>AUD</option>
    <option value="AZN"{{$Coupons->currency == 'AZN' ? 'selected' : ''}}>AZN</option>
    <option value="BSD"{{$Coupons->currency == 'BSD' ? 'selected' : ''}}>BSD</option>
    <option value="BHD"{{$Coupons->currency == 'BHD' ? 'selected' : ''}}>BHD</option>
    <option value="BDT"{{$Coupons->currency == 'BDT' ? 'selected' : ''}}>BDT</option>
    <option value="BBD"{{$Coupons->currency == 'BBD' ? 'selected' : ''}}>BBD</option>
    <option value="BYR"{{$Coupons->currency == 'BYR' ? 'selected' : ''}}>BYR</option>
    <option value="BEF"{{$Coupons->currency == 'BEF' ? 'selected' : ''}}>BEF</option>
    <option value="BZD"{{$Coupons->currency == 'BZD' ? 'selected' : ''}}>BZD</option>
    <option value="BMD"{{$Coupons->currency == 'BMD' ? 'selected' : ''}}>BMD</option>
    <option value="BTN"{{$Coupons->currency == 'BTN' ? 'selected' : ''}}>BTN</option>
    <option value="BTC"{{$Coupons->currency == 'BTC' ? 'selected' : ''}}>BTC</option>
    <option value="BOB"{{$Coupons->currency == 'BOB' ? 'selected' : ''}}>BOB</option>
    <option value="BAM"{{$Coupons->currency == 'BAM' ? 'selected' : ''}}>BAM</option>
    <option value="BWP"{{$Coupons->currency == 'BWP' ? 'selected' : ''}}>BWP</option>
    <option value="BRL"{{$Coupons->currency == 'BRL' ? 'selected' : ''}}>BRL</option>
    <option value="GBP"{{$Coupons->currency == 'GBP' ? 'selected' : ''}}>GBP</option>
    <option value="BND"{{$Coupons->currency == 'BND' ? 'selected' : ''}}>BND</option>
    <option value="BGN"{{$Coupons->currency == 'BGN' ? 'selected' : ''}}>BGN</option>
    <option value="BIF"{{$Coupons->currency == 'BIF' ? 'selected' : ''}}>BIF</option>
    <option value="KHR"{{$Coupons->currency == 'KHR' ? 'selected' : ''}}>KHR</option>
    <option value="CAD"{{$Coupons->currency == 'CAD' ? 'selected' : ''}}>CAD</option>
    <option value="CVE"{{$Coupons->currency == 'CVE' ? 'selected' : ''}}>CVE</option>
    <option value="KYD"{{$Coupons->currency == 'KYD' ? 'selected' : ''}}>KYD</option>
    <option value="XAF"{{$Coupons->currency == 'XAF' ? 'selected' : ''}}>XAF</option>
    <option value="XAF"{{$Coupons->currency == 'XAF' ? 'selected' : ''}}>XAF</option>
    <option value="XPF"{{$Coupons->currency == 'XPF' ? 'selected' : ''}}>XPF</option>
    <option value="CLP"{{$Coupons->currency == 'CLP' ? 'selected' : ''}}>CLP</option>
    <option value="CNY"{{$Coupons->currency == 'CNY' ? 'selected' : ''}}>CNY</option>
    <option value="COP"{{$Coupons->currency == 'COP' ? 'selected' : ''}}>COP</option>
    <option value="KMF"{{$Coupons->currency == 'KMF' ? 'selected' : ''}}>KMF</option>
    <option value="CDF"{{$Coupons->currency == 'CDF' ? 'selected' : ''}}>CDF</option>
    <option value="CRC"{{$Coupons->currency == 'CRC' ? 'selected' : ''}}>CRC</option>
    <option value="HRK"{{$Coupons->currency == 'HRK' ? 'selected' : ''}}>HRK</option>
    <option value="CUC"{{$Coupons->currency == 'CUC' ? 'selected' : ''}}>CUC</option>
    <option value="CZK"{{$Coupons->currency == 'CZK' ? 'selected' : ''}}>CZK</option>
    <option value="DKK"{{$Coupons->currency == 'DKK' ? 'selected' : ''}}>DKK</option>
    <option value="DJF"{{$Coupons->currency == 'DJF' ? 'selected' : ''}}>DJF</option>
    <option value="DOP"{{$Coupons->currency == 'DOP' ? 'selected' : ''}}>DOP</option>
    <option value="XCD"{{$Coupons->currency == 'XCD' ? 'selected' : ''}}>XCD</option>
    <option value="EGP"{{$Coupons->currency == 'EGP' ? 'selected' : ''}}>EGP</option>
    <option value="ERN"{{$Coupons->currency == 'ERN' ? 'selected' : ''}}>ERN</option>
    <option value="EEK"{{$Coupons->currency == 'EEK' ? 'selected' : ''}}>EEK</option>
    <option value="ETB"{{$Coupons->currency == 'ETB' ? 'selected' : ''}}>ETB</option>
    <option value="EUR"{{$Coupons->currency == 'EUR' ? 'selected' : ''}}>EUR</option>
    <option value="FKP"{{$Coupons->currency == 'FKP' ? 'selected' : ''}}>FKP</option>
    <option value="FJD"{{$Coupons->currency == 'FJD' ? 'selected' : ''}}>FJD</option>
    <option value="GMD"{{$Coupons->currency == 'GMD' ? 'selected' : ''}}>GMD</option>
    <option value="GEL"{{$Coupons->currency == 'GEL' ? 'selected' : ''}}>GEL</option>
    <option value="DEM"{{$Coupons->currency == 'DEM' ? 'selected' : ''}}>DEM</option>
    <option value="GIP"{{$Coupons->currency == 'GIP' ? 'selected' : ''}}>GIP</option>
    <option value="GIP"{{$Coupons->currency == 'GIP' ? 'selected' : ''}}>GIP</option>
    <option value="GRD"{{$Coupons->currency == 'GRD' ? 'selected' : ''}}>GRD</option>
    <option value="GTQ"{{$Coupons->currency == 'GTQ' ? 'selected' : ''}}>GTQ</option>
    <option value="GNF"{{$Coupons->currency == 'GNF' ? 'selected' : ''}}>GNF</option>
    <option value="GYD"{{$Coupons->currency == 'GYD' ? 'selected' : ''}}>GYD</option>
    <option value="HTG"{{$Coupons->currency == 'HTG' ? 'selected' : ''}}>HTGe</option>
    <option value="HNL"{{$Coupons->currency == 'HNL' ? 'selected' : ''}}>HNL</option>
    <option value="HKD"{{$Coupons->currency == 'HKD' ? 'selected' : ''}}>HKD</option>
    <option value="HUF"{{$Coupons->currency == 'HUF' ? 'selected' : ''}}>HUF</option>
    <option value="ISK"{{$Coupons->currency == 'ISK' ? 'selected' : ''}}>ISK</option>
    <option value="INR"{{$Coupons->currency == 'INR' ? 'selected' : ''}}>INR</option>
    <option value="IDR"{{$Coupons->currency == 'IDR' ? 'selected' : ''}}>IDR</option>
    <option value="IRR"{{$Coupons->currency == 'IRR' ? 'selected' : ''}}>IRR</option>
    <option value="IQD"{{$Coupons->currency == 'IQD' ? 'selected' : ''}}>IQD</option>
    <option value="ILS"{{$Coupons->currency == 'ILS' ? 'selected' : ''}}>ILS</option>
    <option value="ITL"{{$Coupons->currency == 'ITL' ? 'selected' : ''}}>ITL</option>
    <option value="JMD"{{$Coupons->currency == 'JMD' ? 'selected' : ''}}>JMD</option>
    <option value="JPY"{{$Coupons->currency == 'JPY' ? 'selected' : ''}}>JPY</option>
    <option value="JOD"{{$Coupons->currency == 'JOD' ? 'selected' : ''}}>JOD</option>
    <option value="KZT"{{$Coupons->currency == 'KZT' ? 'selected' : ''}}>KZT</option>
    <option value="KES"{{$Coupons->currency == 'KES' ? 'selected' : ''}}>KES</option>
    <option value="KWD"{{$Coupons->currency == 'KWD' ? 'selected' : ''}}>KWD</option>
    <option value="KGS"{{$Coupons->currency == 'KGS' ? 'selected' : ''}}>KGS</option>
    <option value="LAK"{{$Coupons->currency == 'LAK' ? 'selected' : ''}}>LAK</option>
    <option value="LVL"{{$Coupons->currency == 'LVL' ? 'selected' : ''}}>LVL</option>
    <option value="LBP"{{$Coupons->currency == 'LBP' ? 'selected' : ''}}>LBP</option>
    <option value="LSL"{{$Coupons->currency == 'LSL' ? 'selected' : ''}}>LSL</option>
    <option value="LRD"{{$Coupons->currency == 'LRD' ? 'selected' : ''}}>LRD</option>
    <option value="LYD"{{$Coupons->currency == 'LYD' ? 'selected' : ''}}>LYD</option>
    <option value="LTL"{{$Coupons->currency == 'LTL' ? 'selected' : ''}}>LTL</option>
    <option value="MOP"{{$Coupons->currency == 'MOP' ? 'selected' : ''}}>MOP</option>
    <option value="MKD"{{$Coupons->currency == 'MKD' ? 'selected' : ''}}>MKD</option>
    <option value="MGA"{{$Coupons->currency == 'MGA' ? 'selected' : ''}}>MGA</option>
    <option value="MWK"{{$Coupons->currency == 'MWK' ? 'selected' : ''}}>MWK</option>
    <option value="MYR"{{$Coupons->currency == 'MYR' ? 'selected' : ''}}>MYR</option>
    <option value="MVR"{{$Coupons->currency == 'MVR' ? 'selected' : ''}}>MVR</option>
    <option value="MRO"{{$Coupons->currency == 'MRO' ? 'selected' : ''}}>MRO</option>
    <option value="MUR"{{$Coupons->currency == 'MUR' ? 'selected' : ''}}>MUR</option>
    <option value="MXN"{{$Coupons->currency == 'MXN' ? 'selected' : ''}}>MXN</option>
    <option value="MDL"{{$Coupons->currency == 'MDL' ? 'selected' : ''}}>MDL</option>
    <option value="MNT"{{$Coupons->currency == 'MNT' ? 'selected' : ''}}>MNT</option>
    <option value="MAD"{{$Coupons->currency == 'MAD' ? 'selected' : ''}}>MAD</option>
    <option value="MZM"{{$Coupons->currency == 'MZM' ? 'selected' : ''}}>MZM</option>
    <option value="MMK"{{$Coupons->currency == 'MMK' ? 'selected' : ''}}>MMK</option>
    <option value="NAD"{{$Coupons->currency == 'NAD' ? 'selected' : ''}}>NAD</option>
    <option value="NPR"{{$Coupons->currency == 'NPR' ? 'selected' : ''}}>NPR</option>
    <option value="ANG"{{$Coupons->currency == 'ANG' ? 'selected' : ''}}>ANG</option>
    <option value="TWD"{{$Coupons->currency == 'TWD' ? 'selected' : ''}}>TWD</option>
    <option value="NZD"{{$Coupons->currency == 'NZD' ? 'selected' : ''}}>NZD</option>
    <option value="NIO"{{$Coupons->currency == 'NIO' ? 'selected' : ''}}>NIO</option>
    <option value="NGN"{{$Coupons->currency == 'NGN' ? 'selected' : ''}}>NGN</option>
    <option value="KPW"{{$Coupons->currency == 'KPW' ? 'selected' : ''}}>KPW</option>
    <option value="NOK"{{$Coupons->currency == 'NOK' ? 'selected' : ''}}>NOK</option>
    <option value="OMR"{{$Coupons->currency == 'OMR' ? 'selected' : ''}}>OMR</option>
    <option value="PKR"{{$Coupons->currency == 'PKR' ? 'selected' : ''}}>PKR</option>
    <option value="PAB"{{$Coupons->currency == 'PAB' ? 'selected' : ''}}>PAB</option>
    <option value="PGK"{{$Coupons->currency == 'PGK' ? 'selected' : ''}}>PGK</option>
    <option value="PYG"{{$Coupons->currency == 'PYG' ? 'selected' : ''}}>PYG</option>
    <option value="PEN"{{$Coupons->currency == 'PEN' ? 'selected' : ''}}>PEN</option>
    <option value="PHP"{{$Coupons->currency == 'PHP' ? 'selected' : ''}}>PHP</option>
    <option value="PLN"{{$Coupons->currency == 'PLN' ? 'selected' : ''}}>PLN</option>
    <option value="QAR"{{$Coupons->currency == 'QAR' ? 'selected' : ''}}>QAR</option>
    <option value="RON"{{$Coupons->currency == 'RON' ? 'selected' : ''}}>RON</option>
    <option value="RUB"{{$Coupons->currency == 'RUB' ? 'selected' : ''}}>RUB</option>
    <option value="RWF"{{$Coupons->currency == 'RWF' ? 'selected' : ''}}>RWF</option>
    <option value="SVC"{{$Coupons->currency == 'SVC' ? 'selected' : ''}}>SVC</option>
    <option value="WST"{{$Coupons->currency == 'WST' ? 'selected' : ''}}>WST</option>
    <option value="SAR"{{$Coupons->currency == 'SAR' ? 'selected' : ''}}>SAR</option>
    <option value="RSD"{{$Coupons->currency == 'RSD' ? 'selected' : ''}}>RSD</option>
    <option value="SCR"{{$Coupons->currency == 'SCR' ? 'selected' : ''}}>SCR</option>
    <option value="SLL"{{$Coupons->currency == 'SLL' ? 'selected' : ''}}>SLL</option>
    <option value="SGD"{{$Coupons->currency == 'SGD' ? 'selected' : ''}}>SGD</option>
    <option value="SKK"{{$Coupons->currency == 'SKK' ? 'selected' : ''}}>SKK</option>
    <option value="SBD"{{$Coupons->currency == 'SBD' ? 'selected' : ''}}>SBD</option>
    <option value="SOS"{{$Coupons->currency == 'SOS' ? 'selected' : ''}}>SOS</option>
    <option value="ZAR"{{$Coupons->currency == 'ZAR' ? 'selected' : ''}}>ZAR</option>
    <option value="KRW"{{$Coupons->currency == 'KRW' ? 'selected' : ''}}>KRW</option>
    <option value="XDR"{{$Coupons->currency == 'XDR' ? 'selected' : ''}}>XDR</option>
    <option value="LKR"{{$Coupons->currency == 'LKR' ? 'selected' : ''}}>LKR</option>
    <option value="SHP"{{$Coupons->currency == 'SHP' ? 'selected' : ''}}>SHP</option>
    <option value="SDG"{{$Coupons->currency == 'SDG' ? 'selected' : ''}}>SDG</option>
    <option value="SRD"{{$Coupons->currency == 'SRD' ? 'selected' : ''}}>SRD</option>
    <option value="SZL"{{$Coupons->currency == 'SZL' ? 'selected' : ''}}>SZL</option>
    <option value="SEK"{{$Coupons->currency == 'SEK' ? 'selected' : ''}}>SEK</option>
    <option value="CHF"{{$Coupons->currency == 'CHF' ? 'selected' : ''}}>CHF</option>
    <option value="SYP"{{$Coupons->currency == 'SYP' ? 'selected' : ''}}>SYP</option>
    <option value="STD"{{$Coupons->currency == 'STD' ? 'selected' : ''}}>STD</option>
    <option value="TJS"{{$Coupons->currency == 'TJS' ? 'selected' : ''}}>TJS</option>
    <option value="TZS"{{$Coupons->currency == 'TZS' ? 'selected' : ''}}>TZS</option>
    <option value="THB"{{$Coupons->currency == 'THB' ? 'selected' : ''}}>THB</option>
    <option value="TOP"{{$Coupons->currency == 'TOP' ? 'selected' : ''}}>TOP</option>
    <option value="TTD"{{$Coupons->currency == 'TTD' ? 'selected' : ''}}>TTD</option>
    <option value="TND"{{$Coupons->currency == 'TND' ? 'selected' : ''}}>TND</option>
    <option value="TRY"{{$Coupons->currency == 'TRY' ? 'selected' : ''}}>TRY</option>
    <option value="TMT"{{$Coupons->currency == 'TMT' ? 'selected' : ''}}>TMT</option>
    <option value="UGX"{{$Coupons->currency == 'UGX' ? 'selected' : ''}}>UGX</option>
    <option value="UAH"{{$Coupons->currency == 'UAH' ? 'selected' : ''}}>UAH</option>
    <option value="AED"{{$Coupons->currency == 'AED' ? 'selected' : ''}}>AED</option>
    <option value="UYU"{{$Coupons->currency == 'UYU' ? 'selected' : ''}}>UYU</option>
    <option value="USD"{{$Coupons->currency == 'USD' ? 'selected' : ''}}>USD</option>
    <option value="UZS"{{$Coupons->currency == 'UZS' ? 'selected' : ''}}>UZS</option>
    <option value="VUV"{{$Coupons->currency == 'VUV' ? 'selected' : ''}}>VUV</option>
    <option value="VEF"{{$Coupons->currency == 'VEF' ? 'selected' : ''}}>VEF</option>
    <option value="VND"{{$Coupons->currency == 'VND' ? 'selected' : ''}}>VND</option>
    <option value="YER"{{$Coupons->currency == 'YER' ? 'selected' : ''}}>YER</option>
    <option value="ZMK"{{$Coupons->currency == 'ZMK' ? 'selected' : ''}}>ZMK</option>
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
@endsection

@section('script')

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

<script src="{{asset('assets/js/form-validation-custom.js')}}"></script>
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
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
@endsection
@else
<script>
    window.location.href = "{{route('notfound')}}";
</script>
@endif