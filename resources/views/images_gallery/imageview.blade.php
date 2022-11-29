@if(auth()->user()->user_type != 2)
@extends('layouts.simple.master')
@section('title', 'Validation Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Upload New Images</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Gallery Images</li>
<li class="breadcrumb-item active">Upload Images</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				
				<div class="card-body">
					<form class="needs-validation" action="{{route('back.item.images.multiple')}}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-4 mb-3">
								<label for="validationCustom01">Gallery Images</label>
								<input class="form-control" name="images[]" type="file" placeholder="Images" accept="image/*" required="" multiple>
							</div>
							
						</div>
						<div class="mb-3">
							
						</div>
						<button class="btn btn-primary" type="submit">Upload</button>
					</form>
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