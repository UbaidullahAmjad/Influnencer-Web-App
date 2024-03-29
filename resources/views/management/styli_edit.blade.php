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
					 @if ($message = Session::get('success'))
                                 <div class="alert alert-success">
                                       <p>{{ $message }}</p>
                                 </div>
                              @endif
				
				<form id="upload_form" class="needs-validation" action="{{route('management.update',$management->id.'---'.$management->temp_id)}}" method="post" >
				@csrf
					@method('PUT')
						<div class="card-header">
										
									
						<div class="row">	
						@if ($errors->any())
                  @foreach ($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible p-2">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                     <strong>Error!</strong> {{$error}}.
                  </div>
                  @endforeach
                  @endif
								<div class="col-lg-4 mb-3">
									<p style="font-weight: bold;font-size: 15px;">Select Coupons</p>
										<!-- <div class="col-form-label">Select Coupons</div> -->
										<select class="js-example-placeholder-multiple col-sm-12" name="coupon" placeholder="Select Coupons">
											@foreach($Coupons as $Coupon)
											@if($management->coupon_id == $Coupon->id)
											<option value="{{ $Coupon->id}}" selected>{{ $Coupon->coupon_code}}</option>
											@else
											<option value="{{ $Coupon->id}}">{{ $Coupon->coupon_code}}</option>
											@endif
											@endforeach
										</select>
								</div>
									
								<div class="col-lg-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Select Brand</p>
										<select class="js-example-placeholder-multiple col-sm-12" name="brand">
										@foreach($brands as $brand)
											@if($management->brand_id == $brand->id)
												<option value="{{ $brand->id}}" selected>{{ $brand->company_name}}</option>
											@else
												<option value="{{ $brand->id}}">{{ $brand->company_name}}</option>
											@endif
												@endforeach
										</select>
								</div>
								<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Order date</p>
											    <div class="input-group mb-3">
												
                                                        
                                                       <input class="form-control" value="{{$management->order_date}}"  name="order_date" type="date">
                                                   </div>
                                                 </div>
                                
								<div class="col-md-4">
									<p style="font-weight: bold;font-size: 15px;">Customer Flag</p>
									<div class="input-group mb-3">
									
											
											<input class="form-control"  value="{{$management->customer_flag}}"  name="customer_flag" type="text"  >
									</div>
                                </div>
								<div class="col-md-4">
									<p style="font-weight: bold;font-size: 15px;">Payout Percentage</p>
									<div class="input-group mb-3">
									
									<div class="input-group-prepend">
												<span class="input-group-text">%</span>
										</div>
											<input class="form-control"  value="{{$management->payout_percentage}}"  name="payout_percentage" type="number" step="any" >
									</div>
                                </div>
								<div class="col-lg-4 mb-3">
									<p style="font-weight: bold;font-size: 15px;">Country</p>
										<!-- <div class="col-form-label">Select Coupons</div> -->
										<select class="js-example-placeholder-multiple col-sm-12" name="country" placeholder="Select Coupons">
											@foreach($countries as $country)
											@if($management->country == $country->iso3)
											<option value="{{ $country->iso3}}" selected>{{ $country->name}}</option>
											@else
											<option value="{{ $country->iso3}}">{{ $country->name}}</option>
											@endif
											@endforeach
										</select>
								</div>
								<div class="col-md-4">
									<p style="font-weight: bold;font-size: 15px;">Order Value (USD)</p>
									<div class="input-group mb-3">
									
									<div class="input-group-prepend">
												<span class="input-group-text">$</span>
										</div>
											<input class="form-control"  value="{{$management->order_usd}}"  name="order_value_usd" type="number"  step="any">
									</div>
                                </div>
								<div class="col-md-4">
									<p style="font-weight: bold;font-size: 15px;">Order Value (AED)</p>
									<div class="input-group mb-3">
									
									<div class="input-group-prepend">
												<span class="input-group-text">AED</span>
										</div>
											<input class="form-control"  value="{{$management->order_value_aed}}"  name="order_value_aed" type="number" step="any"  >
									</div>
                                </div>
								<div class="col-md-4">
									<p style="font-weight: bold;font-size: 15px;">Payout (AED)</p>
									<div class="input-group mb-3">
									
									<div class="input-group-prepend">
												<span class="input-group-text">AED</span>
										</div>
											<input class="form-control"  value="{{$management->payout_aed}}"  name="payout_aed" type="number" step="any"  >
									</div>
                                </div>
								<div class="col-md-4">
									<p style="font-weight: bold;font-size: 15px;">Payout (USD)</p>
									<div class="input-group mb-3">
									
									<div class="input-group-prepend">
												<span class="input-group-text">$</span>
										</div>
											<input class="form-control"  value="{{$management->payout_usd}}"  name="payout_usd" type="number" step="any"  >
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
@endsection

@section('script')

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
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
@endsection
@else
<script>
    window.location.href = "{{route('notfound')}}";
</script>
@endif