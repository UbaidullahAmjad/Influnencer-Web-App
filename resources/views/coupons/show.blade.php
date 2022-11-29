@if(auth()->user()->user_type != 2)
@extends('layouts.simple.master')
@section('title', 'Validation Forms', 'Select2')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">

@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Edit Coupone</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('coupon.index') }}">Coupones List</a></li>
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
					<form class="needs-validation" novalidate="" action="" method="post">
                    @csrf
					@method('PUT')

                    <?php
                    $brands = App\Models\Brand::orderBy('id', 'DESC')->get();
                    ?>
                  
						<div class="row">
                        <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Brand</p>
										<input class="form-control" id="validationCustom01" value="{{ $brands[0]->company_name}}" name="code" type="text" placeholder="Coupones Code" readonly>
										<div class="valid-feedback">Looks good!</div>
									</div>
									<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Coupones Code</p>
										<input class="form-control" id="validationCustom01" value="{{ $Coupon->coupon_code }}" name="code" type="text" placeholder="Coupones Code" readonly>
										<div class="valid-feedback">Looks good!</div>
									</div>
							
     
							<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Ammount</p>
										<!-- <div class="col-form-label">Amount</div> -->
										<input class="form-control" id="validationCustom01" value="{{ $Coupon->amount }}" name="amount" type="number" placeholder="Amount" readonly>
										<!-- <div class="valid-feedback">Looks good!</div> -->
									</div>

									<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Symbol</p>
										<!-- <div class="col-form-label">Amount</div> -->
										<input class="form-control" id="validationCustom01" value="{{ $Coupon->symbol }}" name="amount" type="text" placeholder="Amount" readonly>
										<!-- <div class="valid-feedback">Looks good!</div> -->
									</div>


									<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Expiry Date</p>
										<!-- <div class="col-form-label">Expiry Date</div> -->
										<input class="form-control" id="validationCustom01" value="{{ $Coupon->date }}" name="date" type="date" placeholder="Coupones Code" readonly>
										<!-- <div class="valid-feedback">Looks good!</div> -->
									</div>
                                     
                                    <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Currency</p>
										<!-- <div class="col-form-label">Expiry Date</div> -->
										<input class="form-control" id="validationCustom01" value="{{ $Coupon->currency }}" name="date" type="text" placeholder="Coupones Code" readonly>
										<!-- <div class="valid-feedback">Looks good!</div> -->
									</div>

									
									
							
						</div>
					
					</form>
</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/form-validation-custom.js')}}"></script>
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
@endsection
@else
<script>
    window.location.href = "{{route('notfound')}}";
</script>
@endif