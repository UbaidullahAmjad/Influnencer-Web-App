@if(auth()->user()->user_type != 2)
@extends('layouts.simple.master')
@section('title', 'Validation Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Brand</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{route('brands.index')}}">Brand List</a></li>
<li class="breadcrumb-item active"> Brand</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				
				<div class="card-body">
                <div class="container">
                     <div class="d-flex flex-row-reverse">
                         <a class="p-1" href="{{ route('brands.index') }}" ><button class="btn btn-primary">Back</button></a>
                     </div>

					<form class="needs-validation" action="" method="post" enctype="multipart/form-data">
					@csrf
					@method('PUT')
						<div class="row">
					
							<div class="col-md-12 mb-3">
							 <!--  -->
							 @if ($errors->any())
                  @foreach ($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible p-2">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Error!</strong> {{$error}}.
                  </div>
                  @endforeach
                  @endif
							 <!--  -->
							<p class="text-center" p style="font-weight: bold;font-size: 15px;"><label class="text-center" for="validationCustom01">Brand Logo</label></p>
								<p class="text-center"><img src="{{ asset('images/brand/'.$brand->image)}}" id="img" class="mb-2" height="200" width="200"></p>
								
								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="col-md-6 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Comapany Name*</p>
								<input class="form-control" id="validationCustom02" value="{{$brand->company_name}}" name="company_name" type="text" placeholder="Company Name" readonly>
								<div class="valid-feedback">Looks good!</div>
							</div>
							
							<div class="col-md-6 mb-3">
								<p style="font-weight: bold;font-size: 15px;">country</p>
								<input class="form-control" id="validationCustom02" value="{{$brand->country}}" name="company_name" type="text" placeholder="Company Name" readonly>
								<div class="valid-feedback">Looks good!</div>
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
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
    
      var reader = new FileReader();
      reader.onload = function (e) { 
        document.querySelector("#img").setAttribute("src",e.target.result);
      };

      reader.readAsDataURL(input.files[0]); 
    }
  }
  </script>
@endsection
@else
<script>
    window.location.href = "{{route('notfound')}}";
</script>
@endif