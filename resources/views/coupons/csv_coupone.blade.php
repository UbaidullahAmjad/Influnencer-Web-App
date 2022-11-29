@if(auth()->user()->user_type != 2)
@extends('layouts.simple.master')
@section('title', 'Validation Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Upload New CSV</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('coupon.index') }}">Coupones List</a></li>
<li class="breadcrumb-item active">Coupone CSV</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				
				<div class="card-body">
							
			@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
				<div class="card-body">
				    @php $me = "Below Coupons are not imported because their brands does not exists"; @endphp
				@if ($message = Session::get('error'))
                                            <div class="alert alert-danger">
                                                
                                                    @if(is_array($message) && count($message) > 0)
                                                        
                                                            <div class='row'>
                                                                {{ $me  }} <br><br>
                                                                @foreach($message as $m)
                                                                    <div class="col-md-2">
                                                                        {{ '['.$m. ']' }}
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            
                                                    
                                                    @else
                                                        {{ $message }}
                                                    @endif
                                               
                                            </div>
                                        @endif
					<form class="needs-validation" novalidate="" action="{{route('coupon_csv_upload')}}" method="post" enctype="multipart/form-data">
					@csrf	
					<div class="row">
							<div class="col-md-4 mb-3">
								<label for="validationCustom01">Coupones CSV</label>
								<input class="form-control" id="validationCustom01" name="csv" type="file" placeholder="Coupones Csv" required="">
								<div class="valid-feedback">Looks good!</div>
							</div>
							
						</div>
						<div class="mb-3">
							
						</div>
						<button class="btn btn-primary" type="submit">Submit form</button>
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