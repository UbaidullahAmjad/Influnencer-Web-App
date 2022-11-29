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
				
				<form id="upload_form" class="needs-validation" action="{{route('management.update',$managements->id.'---'.$managements->temp_id)}}" method="post" >
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
											@if($managements->coupon_id == $Coupon->id)
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
											@if($managements->brand_id == $brand->id)
												<option value="{{ $brand->id}}" selected>{{ $brand->company_name}}</option>
											@else
												<option value="{{ $brand->id}}">{{ $brand->company_name}}</option>
											@endif
												@endforeach
										</select>
								</div>
								@if(isset($managements->revenue))
								<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Revenue</p>
											    <div class="input-group mb-3">
												
                                                        <div class="input-group-prepend">
                                                             <span class="input-group-text">$</span>
                                                        </div>
                                                       <input class="form-control" value="{{$managements->revenue}}" aria-label="Amount (to the nearest dollar)" name="revenue" type="number" placeholder="Revenue"  step="any">
                                                   </div>
                                                 </div>
												 @endif
                                @if(isset($managements->sale_amount))
								<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Sale Amount</p>
											    <div class="input-group mb-3">
												
                                                        <div class="input-group-prepend">
                                                             <span class="input-group-text">$</span>
                                                        </div>
                                                       <input class="form-control"  value="{{$managements->sale_amount}}" aria-label="Amount (to the nearest dollar)" name="sale_amount" type="number" placeholder="Sale Amount"  step="any">
                                                   </div>
                                                 </div>
                                  @endif
                                  @if(isset($managements->sale_amount_usd))
								<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Sale Amount USD</p>

											    <div class="input-group mb-3">
												
                                                        <div class="input-group-prepend">
                                                             <span class="input-group-text">$</span>
                                                        </div>
                                                       <input class="form-control" value="{{$managements->sale_amount_usd}}" aria-label="Amount (to the nearest dollar)" name="sale_amount_usd" type="number" placeholder="Sale Amount USD"  step="any">
                                                   </div>
											 </div>
											 @endif
											 @if(isset($managements->date))
											 <div class="col-md-4">
													<p style="font-weight: bold;font-size: 15px;">Date</p>

													<div class="input-group mb-3">

														
														<input class="form-control"  aria-label="Amount (to the nearest dollar)"
														value="{{$managements->date}}" name="date" type="date"
															placeholder="" required="">
													</div>
                                              </div>
											  @endif

											  @if(isset($managements->last_update))
											 <div class="col-md-4">
													<p style="font-weight: bold;font-size: 15px;">Time</p>

													<div class="input-group mb-3">

														
														<input class="form-control"  aria-label="Amount (to the nearest dollar)"
														value="{{$managements->last_update}}" name="time" type="time"
															placeholder="" required="">
													</div>
                                              </div>
											  @endif
											  
											  @if(isset($managements->automation))  
									<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Automation</p>
										<input  value="{{$managements->automation}}" class="form-control" id="validationCustom01" name="automation" type="text" placeholder="Automation" >
									</div>
									@endif
									@if(isset($managements->customer_type))
                                    <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Customer Type</p>
										<input class="form-control" value="{{$managements->customer_type}}" id="validationCustom01" name="customer_type" type="text" placeholder="Customer Type" >
									</div>
									@endif
									@if(isset($managements->ad_set))
                                    <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Ad_set</p>
										<input class="form-control" value="{{$managements->ad_set}}" id="validationCustom01" name="ad_set" type="text" placeholder="Ad_set">
									</div>
									@endif
									@if(isset($managements->aov))
                                    <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">AOV</p>
										<input class="form-control" value="{{$managements->aov}}" id="validationCustom01" name="aov" type="text" placeholder="Ad_set">
									</div>
									@endif
									@if(isset($managements->orders))
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Orders</p>
                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input class="form-control" value="{{$managements->orders}}" aria-label="Amount (to the nearest dollar)"
                                                name="orders" type="number" placeholder="Orders" >
                                        </div>
                                    </div>
									@endif
									@if(isset($managements->aov_usd))
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">AOV USD</p>
                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input class="form-control" value="{{$managements->aov_usd}}" aria-label="Amount (to the nearest dollar)"
                                                name="aov_usd" type="number" placeholder="AOV USD" step="any" >
                                        </div>
                                    </div>
									@endif
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