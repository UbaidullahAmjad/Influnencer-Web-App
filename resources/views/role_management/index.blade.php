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
<h3>Role list</h3>
@endsection

@section('breadcrumb-items')

<li class="breadcrumb-item active">Role list</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
     
      <div class="col-sm-12">
         <div class="card">
            <div class="card-body">
                <div class="container">
               
                     <div class="d-flex flex-row-reverse mb-3">
                         <!-- <a class="p-1" href="{{ route('csv_brands') }}" ><button class="btn btn-primary">CSV</button></a> -->
                           <!-- <a class="p-1" href="{{ route('brand.export') }}" ><button class="btn btn-warning">Export</button></a> -->
                           <a class="p-1"   href="{{ route('brands.create') }}" ><button class="btn btn-success">Add</button></a>
                     </div>
                
            
                     <div class="table-responsive product-table">
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
                  <table class="display" id="basic-1">
                     <thead>
                        <tr>
                        <th>#</th>
                           <th>Name</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                    
                     @foreach ($roles as $key => $role) 
                     
                        <tr>
                        <th scope="row"></th>
                        <td>{{ ++$i }}</td>
                        <td>{{ $role->name }}</td>
                           <td>
                           <div class="row">
                          
                                 <div class="col-md-2">
                           <form method="POST" action="">
                                 @csrf
                                 @method('delete')
                              <button class="btn btn-danger btn-xs" type="submit" data-original-title="btn btn-danger btn-xs" title=""><i class="fa fa-trash"></i></button>
                              </form>
                              </div>
                             
                             
                                 <div class="col-md-2">
                             <a href=""> <button class="btn btn-success btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title=""><i class="fa fa-edit"></i></button></a>
                             </div>
                           
                              </div>
                           </td>
                        </tr>
                        @endforeach
            
        
                       
                     </tbody>
                  </table>
                  {!! $roles->render() !!}
               </div>
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
@endsection