@if(auth()->user()->user_type != 2)
@extends('layouts.simple.master')
@section('title', 'Select2')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>association</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{route('management.index')}}">association List</a></li>
<li class="breadcrumb-item active">Association</li>
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
                           <a class="p-1" href="{{ route('assciate.index') }}" ><button class="btn btn-primary">Back</button></a>
                        
                           
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
                  $brand = App\Models\Brand::find($associations->brand_id);
                  $coupon = App\Models\Coupon::find($associations->coupon_id);
				  $association = App\Models\Influencer::find($associations->influencer_id);
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
								
							<div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Influencer</p>
								<input class="form-control" id="validationCustom02" value="{{$association->f_name}}" name="company_name" type="text" placeholder="Company Name" readonly>
								<div class="valid-feedback">Looks good!</div>
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