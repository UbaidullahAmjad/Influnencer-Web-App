@if(auth()->user()->user_type != 2)
@extends('layouts.simple.master')
@section('title', 'Validation Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Edit Influencer</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{route('influencer.index') }}">Influencer List</a></li>
<li class="breadcrumb-item active">Edit Influencer</li>
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
					<form id="influencer_form" class="needs-validation" novalidate="" action="{{route('influencer.update',$influencer->id) }}" method="post" enctype="multipart/form-data" >
					@csrf
					@method('PUT')
						<div class="row">
						@if ($message = Session::get('success'))
        <div class="alert alert-success">
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
				  @if ($message = Session::get('error'))
                                            <div class="alert alert-danger">
                                                <p>{{ $message }}</p>
                                            </div>
                                        @endif
							<div class="col-md-12 mb-3">
							<p class="text-center"><label for="validationCustom01">Image</label></p>
							
							<p class="text-center"><img src="{{ file_exists(public_path('images/influencer/'.$influencer->image)) && !empty($influencer->image) ? asset('images/influencer/'.$influencer->image) : asset('images/influencer/thumbnail.png')   }}" id="img" class="mb-2" height="200" width="200"></p>

								<input class="form-control" id="validationCustom01" onchange="readURL(this)" value="{{$influencer ->image}}" name="image" type="file" placeholder="Image" accept="image/*">
								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">First Name *</p>
								<input class="form-control" id="validationCustom02" value="{{$influencer->f_name}}" name="f_name" type="text" placeholder="First Name" required="">
								<div class="valid-feedback">Looks good!</div>
							</div>
                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Last Name</p>
								<input class="form-control" id="validationCustom02" value="{{$influencer->l_name}}" name="l_name" type="text" placeholder="Last Name">
								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Influencer Handle Name *</p>
								<input class="form-control" id="validationCustom02" value="{{$influencer->inf_handle_name}}" name="inf_handle_name" type="text" placeholder="Influencer Handle Name">
								<div class="valid-feedback">Looks good!</div>
							</div>
                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Phone</p>
								<input class="form-control phone" id="validationCustom02" value="{{$influencer->phone}}"  name="phone" type="number" placeholder="Phone">
								<div class="valid-feedback">Looks good!</div>
							</div>
                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Email*</p>
								<input class="form-control" id="validationCustom02" value="{{$influencer->email}}"  name="email" type="email" placeholder="Email" required="">
								<div class="valid-feedback">Looks good!</div>
							</div>
                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Login ID</p>
								<input class="form-control" id="validationCustom02" value="{{$influencer->login_id}}"  name="login_id" type="text" placeholder="Login ID" required="">
								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Publisher ID</p>
								<input class="form-control" id="validationCustom02" value="{{$influencer->pub_id}}" name="pub_id" type="number" placeholder="Publisher ID" {{ !empty($influencer->pub_id) ? 'readonly' : '' }}>
								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Location</p>
								<input class="form-control" id="validationCustom02" value="{{$influencer->location}}" name="location" type="text" placeholder="Location">
								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="col-md-4 mb-4">
                              <p style="font-weight: bold;font-size: 15px;">New/Old User</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="inf_type" required="">
											<option value="1" {{ $influencer->inf_type == 1 ? 'selected' : '' }}>New User</option>
											<option value="2" {{ $influencer->inf_type == 2 ? 'selected' : '' }}>Old User</option>
										</select>
										
							</div>
							<div class="col-md-4 mb-4">
                                       <p style="font-weight: bold;font-size: 15px;">Status</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control"  id="status" name="status" require="">
										  
											<option value="1" {{$influencer->status == 1 ? 'selected' : ''}}>Active</option>
											<option value="0" {{$influencer->status == 0 ? 'selected' : ''}}>In Active</option>
											
										</select>
										
									</div>
                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Password</p>
								<input class="form-control" id="validationCustom02"  name="password" type="password" placeholder="Password" >
								<div class="valid-feedback">Looks good!</div>
							</div>
						</div>
						<!-- @if(isset($influencer) && $influencer->id != null)
							<div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">User Id</p>
								<input class="form-control" id="validationCustom02" value="{{$influencer->id}}" type="text" readonly>
								<div class="valid-feedback">Looks good!</div>
							</div>
@endif
						 -->
						<div class="mb-3">	
						</div>
						<button class="btn btn-success" id="update" type="button">Update</button>
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
        title: 'Are you sure to Update the Influencer?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Update it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $("#influencer_form").submit();
        }
      })
});

</script>
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