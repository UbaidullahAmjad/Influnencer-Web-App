@if(auth()->user()->user_type != 2)
@extends('layouts.simple.master')
@section('title', 'Select2')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Upload</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{route('management.index')}}">Upload List</a></li>
<li class="breadcrumb-item active">Upload</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="select2-drpdwn">
		<div class="row">
			<!-- Default Textbox start-->
			<div class="col-md-12">
				<div class="card">
				<div class="container">
                     <div class="d-flex flex-row-reverse">
                           <a class="p-1" href="{{ route('management.index') }}" ><button class="btn btn-primary">Back</button></a>
                        
                           
                     </div>
				<form class="needs-validation" action="" method="post" >
				@csrf
					@method('PUT')
						<div class="card-header">
										
									
						<div class="row">	
						@if ($errors->any())
                  @foreach ($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible p-2">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Error!</strong> {{$error}}.
                  </div>
                  @endforeach
                  @endif
                  <?php
                  $brand = App\Models\Brand::find($data->brand_id);
                  $coupon = App\Models\Coupon::find($data->coupon_id);
                  ?>

                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Brand</p>
								<input class="form-control" id="validationCustom02" value="{{$brand->company_name}}"  name="company_name" type="text" placeholder="Company Name" readonly>
								<div class="valid-feedback">Looks good!</div>
							</div>

                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Coupon Code</p>
								<input class="form-control" id="validationCustom02" value="{{$coupon->coupon_code}}" name="company_name" type="text" placeholder="Company Name" readonly>
								<div class="valid-feedback">Looks good!</div>
							</div>    
								
								
								
								<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Revenue</p>
											    <div class="input-group mb-3">
												
                                                        <div class="input-group-prepend">
                                                             <span class="input-group-text">$</span>
                                                        </div>
                                                       <input class="form-control" value="{{$data->revenue}}" aria-label="Amount (to the nearest dollar)" name="revenue" type="number" placeholder="Revenue" readonly>
                                                   </div>
                                                 </div>

							

								<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Sale Amount</p>
											    <div class="input-group mb-3">
												
                                                        <div class="input-group-prepend">
                                                             <span class="input-group-text">$</span>
                                                        </div>
                                                       <input class="form-control"  value="{{$data->sale_ammount}}" aria-label="Amount (to the nearest dollar)" name="sale_ammount" type="number" placeholder="Sale Amount" readonly>
                                                   </div>
                                                 </div>

								

								<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Sale Amount USD</p>

											    <div class="input-group mb-3">
												
                                                        <div class="input-group-prepend">
                                                             <span class="input-group-text">$</span>
                                                        </div>
                                                       <input class="form-control" value="{{$data->sale_ammount_usd}}" aria-label="Amount (to the nearest dollar)" name="sale_ammount_usd" type="number" placeholder="Sale Amount USD" readonly>
                                                   </div>
											 </div>
										
											<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Commission Validation</p>

											    <div class="input-group mb-3">
												
                                                        <div class="input-group-prepend">
                                                             <span class="input-group-text">$</span>
                                                        </div>
                                                       <input class="form-control" value="{{$data->commission_validation}}" aria-label="Amount (to the nearest dollar)" name="commission_validation" type="number" placeholder="Commission Validation" readonly>
                                                   </div>
											 </div>

										
 
											<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Commission After Validation</p>

											    <div class="input-group mb-3">
												
                                                        <div class="input-group-prepend">
                                                             <span class="input-group-text">$</span>
                                                        </div>
                                                       <input class="form-control" value="{{$data->commission_after_validatione}}" aria-label="Amount (to the nearest dollar)" name="commission_after_validatione" type="number" placeholder="Commission After Validation" readonly>
                                                   </div>
											 </div>
									
										

											
							
                    	</div>
						
							</div>
						</div>
						</div> 
					
					</form>
</div>
				</div>
			</div>
			<!-- Default Textbox end-->
			<!-- Input Groups start-->
			
		
			<!-- Input Groups end-->
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
@endsection
@else
<script>
    window.location.href = "{{route('notfound')}}";
</script>
@endif