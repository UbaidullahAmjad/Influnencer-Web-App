@if(auth()->user()->user_type != 2)
@extends('layouts.simple.master')
@section('title', 'Validation Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Add New Influencer</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{route('influencer.index') }}">Influencer List</a></li>
<li class="breadcrumb-item active">Add Influencer</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				
				

				<div class="col-sm-12">
         <div class="card">
            <div class="card-body">
            <div class="container">
                     <div class="d-flex flex-row-reverse">
                           <a class="p-1" href="{{ route('influencer.index') }}" ><button class="btn btn-primary">Back</button></a>
                           
                     </div>
                 
					<form class="needs-validation" novalidate="" action="{{route('influencer.store')}}" method="post" enctype="multipart/form-data">
					@csrf
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
							<div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Image</p>
								<input class="form-control" id="validationCustom01" name="image" type="file" placeholder="Image" accept="image/*">
								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">First Name *</p>
								<input class="form-control" id="validationCustom02" value="{{old('f_name')}}" name="f_name" type="text" placeholder="First Name" required="">
								<div class="valid-feedback">Looks good!</div>
							</div>
                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Last Name</p>
								<input class="form-control" id="validationCustom02" value="{{old('l_name')}}" name="l_name" type="text" placeholder="Last Name">
								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Influencer Handle Name *</p>
								<input class="form-control" id="validationCustom02" value="{{old('inf_handle_name')}}" name="inf_handle_name" type="text" placeholder="Influencer Handle Name" required>
								<div class="valid-feedback">Looks good!</div>
							</div>
                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Phone</p>
								<input class="form-control phone" id="validationCustom02" value="{{old('phone')}}" name="phone" type="number" placeholder="Phone">
								<div class="valid-feedback">Looks good!</div>
							</div>
                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Email*</p>
								<input class="form-control" id="validationCustom02" value="{{old('email')}}"  name="email" type="emai" placeholder="Email" required="">
								<div class="valid-feedback">Looks good!</div>
							</div>
							
                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Login ID</p>
								<input class="form-control" id="validationCustom02" value="{{old('login_id')}}"  name="login_id" type="text" placeholder="Login ID">
								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Publisher ID</p>
								<input class="form-control" id="validationCustom02" value="{{old('pub_id')}}" name="pub_id" type="number" placeholder="Publisher ID">
								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Location*</p>
								<input class="form-control" id="validationCustom02" value="{{old('location')}}" name="location" type="text" placeholder="Location">
								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="col-md-4 mb-4">
                              <p style="font-weight: bold;font-size: 15px;">New/Old User</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="inf_type" required="">
											<option value="1" {{ old('inf_type') == 1 ? 'selected' : '' }}>New User</option>
											<option value="2" {{ old('inf_type') == 2 ? 'selected' : '' }}>Old User</option>
											
										</select>
										
							</div>
							<div class="col-md-4 mb-4">
                                       <p style="font-weight: bold;font-size: 15px;">Status</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control" id="status" name="status" require="">
										    <option value="">Select Status</option>
											<option value="1"{{ old('status') == 1 ? 'selected' : '' }}>Active</option>
											<option value="0"{{ old('status') == 0 ? 'selected' : '' }}>In Active</option>
											
										</select>
										
									</div>
                            <div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">Password *</p>
								<input class="form-control" id="validationCustom02" name="password" type="password" placeholder="Password" required="">
								<div class="valid-feedback">Looks good!</div>
							</div>
<!-- @if($influencer_id = Session::get('influencer'))
							<div class="col-md-4 mb-3">
								<p style="font-weight: bold;font-size: 15px;">User Id</p>
								<input class="form-control" id="validationCustom02" value="{{ $influencer_id }}" type="text" readonly>
								<div class="valid-feedback">Looks good!</div>
							</div>
@endif -->
						</div>
						
						<div class="mb-3">	
						</div>
						<button class="btn btn-success" type="submit">Submit</button>
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
@endsection
@else
<script>
    window.location.href = "{{route('notfound')}}";
</script>
@endif