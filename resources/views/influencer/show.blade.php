@if(auth()->user()->user_type != 2)
@extends('layouts.simple.master')
@section('title', 'Validation Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Influencer</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{route('influencer.index') }}">Influencer List</a></li>
<li class="breadcrumb-item active">Influencer</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				
				<div class="card-body">
                <div class="container">
                     <div class="d-flex flex-row-reverse">
                           <a class="p-1" href="{{ route('influencer.index') }}" ><button class="btn btn-primary">Back</button></a>
                            
                     </div>
					<form class="needs-validation" novalidate="" action="{{route('influencer.update',$Influencer->id) }}" method="post" enctype="multipart/form-data" >
					@csrf
					@method('PUT')
						<div class="row">
						@if ($errors->any())
                  @foreach ($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible p-2">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Error!</strong> {{$error}}.
                  </div>
                  @endforeach
                  @endif
							<div class="col-md-12 mb-3">
							<p class="text-center"><label for="validationCustom01">Image</label></p>
							<p class="text-center"><img src="{{ asset('images/influencer/'.$Influencer->image)}}" id="img" class="mb-2" height="200" width="200"></p>

								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">First Name</p>
								<input class="form-control" id="validationCustom02" value="{{$Influencer->f_name}}" name="f_name" type="text" placeholder="First Name" readonly>
								<div class="valid-feedback">Looks good!</div>
							</div>
                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Last Name</p>
								<input class="form-control" id="validationCustom02" value="{{$Influencer->l_name}}" name="l_name" type="text" placeholder="Last Name" readonly>
								<div class="valid-feedback">Looks good!</div>
							</div>
                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Phone</p>
								<input class="form-control phone" id="validationCustom02" value="{{$Influencer->phone}}"  name="phone" type="number" placeholder="Phone" readonly>
								<div class="valid-feedback">Looks good!</div>
							</div>
                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Email*</p>
								<input class="form-control" id="validationCustom02" value="{{$Influencer->email}}"  name="email" type="emai" placeholder="Email" readonly>
								<div class="valid-feedback">Looks good!</div>
							</div>
                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Login ID</p>
								<input class="form-control" id="validationCustom02" value="{{$Influencer->login_id}}"  name="login_id" type="text" placeholder="Login ID" readonly>
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