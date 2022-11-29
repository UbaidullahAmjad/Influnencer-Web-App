@if(auth()->user()->user_type != 2)
@extends('layouts.simple.master')
@section('title', 'Product list')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/rating.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Gallery list</h3>
@endsection

@section('breadcrumb-items')

<li class="breadcrumb-item active">Multiple Images</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
     
      <div class="col-sm-12">
         <div class="card">
            <div class="card-body">
               <div class="row csv-button-row">
                  <div class="col-lg-12">
                  <div class="row">
                  <div class="col-sm-12">
                     <div class="">
                        
                        <div class="card-body">
                           <form class="needs-validation" action="{{route('back.item.images.multiple')}}" method="post" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
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
                                 <div class="col-md-4 mb-3">
                                    <label for="validationCustom01">Gallery Images</label>
                                    <input class="form-control" name="images[]" type="file" placeholder="Images" accept="image/*" required="" multiple>
                                 </div>
                                 <div class="col-md-2 mb-3" style="margin-top: 29px;">
                                    <button class="btn btn-primary" type="submit">Upload</button>
                                 </div>
                                 
                              </div>
                              <div class="mb-3">
                                 
                              </div>
                              
                           </form>
                        </div>
                     </div>
                     
                  </div>
	</div>
                  </div>
                  
                  
               </div>
            

            
            
               <div class="table-responsive product-table">
               @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                  
               </div>
                <div class="container">
                    <div class="row">
                        @foreach($images as $image)
                                <div class="col-md-3 mb-2 mt-2">
                                    <div class="row">
                                    <div class="image-box" style="position:relative;">
                                        <img src="{{ isset($image->image) ? (file_exists(public_path('/assets/images/gallery_images/'. $image->image)) ? asset('/assets/images/gallery_images/' . $image->image) : asset('images/brand/thumbnail.png')) : asset('images/brand/thumbnail.png')}}" alt="" height="200" width="200">

                                        
                                        <a href="{{ route('remove.image',$image->id) }}"><i class="fa fa-trash" style="position:absolute;margin-left: -24px;margin-top:11px"></i></a>
                                    </div>
                                    </div>
                                    <div class="row">
                                       <p class="text-center">{{ $image->image }}</p>
                                    </div>
                                    
                                    
                                    <br>
                                </div>
                                
                        @endforeach
                  </div>
                  {{ $images->links() }}
                </div>
               
            </div>
         </div>
      </div>
      <!-- Individual column searching (text inputs) Ends-->
   </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/rating/jquery.barrating.js')}}"></script>
<script src="{{asset('assets/js/rating/rating-script.js')}}"></script>
<script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
<script src="{{asset('assets/js/ecommerce.js')}}"></script>
<script src="{{asset('assets/js/product-list-custom.js')}}"></script>
<script>
    setTimeout(function() {
    $('.alert-success').fadeOut('fast');
}, 3000);
</script>
<script>
    setTimeout(function() {
    $('.alert-danger').fadeOut('fast');
}, 3000);
</script>
@endsection
@else
<script>
    window.location.href = "{{route('notfound')}}";
   
</script>
@endif