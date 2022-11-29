@if(auth()->user()->user_type != 2)
@extends('layouts.simple.master')
@section('title', 'Validation Forms', 'Select2')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Update Association</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('assciate.index') }}">Assosiation List</a></li>
<li class="breadcrumb-item active">Update Assosiation</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				
				<div class="card-body">

				<div class="container">
                     <div class="d-flex flex-row-reverse">
                         <a class="p-1" href="{{ route('assciate.index') }}" ><button class="btn btn-primary">Back</button></a>
                          
                     </div>
					<form id="association_form" class="needs-validation" novalidate="" action="{{ route('assciate.update',$associations->id) }}" method="post">
					@csrf
                    @method('PUT')
						<div class="row">

                     
						@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

	@if ($message = Session::get('error'))
        <div class="alert alert-danger">
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
									
									<div class="col-md-4 mb-4">
                                       <p style="font-weight: bold;font-size: 15px;">Select Brand</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control" id="brand_id" name="brand" data-href="{{ route('get_coupons') }}">
										@foreach($brands as $brand)
											@if($associations->brand_id == $brand->id)
											<option value="{{$brand->id}}" selected>{{$brand->company_name}}</option>
											@else
											<option value="{{$brand->id}}">{{$brand->company_name}}</option>
											@endif
										@endforeach
										</select>
										
									</div>

                                    <div class="col-md-4 mb-4">
                                       <p style="font-weight: bold;font-size: 15px;">Select Coupon</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control" id="coupon_id" name="coupon">
										<option value="">{{ __('Select one') }}</option>
										@php $couponss = App\Models\Coupon::where('brand_id',$associations->brand_id)->get(); @endphp
										@foreach ($couponss as $cop)
											<option value="{{ $cop->id }}"
												{{ $cop->id == $associations->coupon_id ? 'selected' : '' }}>
												{{ $cop->coupon_code }}</option>
                                    	@endforeach
										
										</select>
										
									</div>

                                    <div class="col-md-4 mb-4">
                                       <p style="font-weight: bold;font-size: 15px;">Select Influencer</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="influencer">
										@foreach($influencers as $influencer)
										@if($associations->influencer_id == $influencer->pub_id)
											<option value="{{$influencer->pub_id}}" selected>{{$influencer->f_name}}</option>
											@else
											<option value="{{$influencer->pub_id}}">{{$influencer->f_name}}</option>
											@endif
											@endforeach
										</select>
										
									</div>
								
								
							
						</div>
						<div class="mb-3">
							
						</div>
						<button class="btn btn-success" id="update" type="button">Update</button>
					</form>
                  </div>
               <!-- <div class="mb-3">
							
                     </div>
                   <a  href="{{route('coupon.index')}}">  <button class="btn btn-primary" type="button">Back</button></a> -->
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection

@section('script')

<script src="{{asset('assets/js/form-validation-custom.js')}}"></script>
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $('#update').click(async function(event) {
        Swal.fire({
        title: 'Are you sure to Update the Association?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Update it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $("#association_form").submit();
        }
      })
});

</script>

<script>
	$(document).on('change','#brand_id',function(){
            let brand_id = $(this).val();
            let url = $(this).attr('data-href');
            getCategory(url,brand_id);
        });

		function getCategory(url,brand_id){
            $.get(url+'?brand_id='+brand_id,function(data){
                let response = data.data;
                let view_html = ``;
                $.each(response , function(key, value) {
                    view_html += `<option value="${value.id}">${value.coupon_code}</option>`;
                  });
                  console.log(view_html)
                  let start = `<option value="">Select One</option>`;
                $('#coupon_id').html(start+view_html);
            })
        }
</script>
@endsection
@else
<script>
    window.location.href = "{{route('notfound')}}";
</script>
@endif