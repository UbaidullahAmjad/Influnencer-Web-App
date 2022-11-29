@if(auth()->user()->user_type != 2)
@extends('layouts.simple.master')
@section('title', 'Select2')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Upload</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('management.index') }}">Upload List</a></li>
    <li class="breadcrumb-item active">Upload</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="select2-drpdwn">
            <div class="row">
                <!-- Default Textbox start-->
                <div class="col-md-12">
                    <div class="card">
                        

                            <div class="card-body">
                            <div class="container">
                     <div class="d-flex flex-row-reverse">
                           <a class="p-1" href="{{ route('management.index') }}" ><button class="btn btn-primary">Back</button></a>
                        
                           
                     </div>
                                <form class="needs-validation" action="{{ route('management.store') }}" method="post">
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
                                                <a href="#" class="close" data-dismiss="alert"
                                                    aria-label="close"></a>
                                                <strong>Error!</strong> {{ $error }}.
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="col-lg-4 mb-3">
                                        <p style="font-weight: bold;font-size: 15px;">Select Brand</p>
                                        <!-- <label for="validationCustom01">Select Brand</label> -->
                                        <!-- <div class="col-form-label">Select Coupons</div> -->
                                        <select class="js-example-placeholder-multiple col-sm-12" name="brand" required="">
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <p style="font-weight: bold;font-size: 15px;">Select Coupon</p>
                                        <!-- <div class="col-form-label">Select Influencers</div> -->
                                        <select class="js-example-placeholder-multiple col-sm-12" name="coupon" required="">
                                            @foreach ($Coupons as $Coupon)
                                                <option value="{{ $Coupon->id }}">{{ $Coupon->coupon_code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- <div class="col-md-4 mb-3">
               <label for="validationCustom02">Revenue</label>
               <input class="form-control" id="validationCustom02"  name="revenue" type="number" placeholder="Revenue" required="">
               <div class="valid-feedback">Looks good!</div>
           </div> -->

                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Revenue</p>
                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input class="form-control" aria-label="Amount (to the nearest dollar)"
                                                name="revenue" type="number" placeholder="Revenue" required="" step="any" >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Sale Amount</p>
                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input class="form-control" aria-label="Amount (to the nearest dollar)"
                                                name="sale_ammount" type="number" placeholder="Sale Amount" required="" step="any">
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-4 mb-3">
               <label for="validationCustom02">Sale Amount</label>
               
               <input class="form-control" aria-label="Amount (to the nearest dollar)" id="validationCustom02"  name="sale_ammount" type="number" placeholder="Sale Amount" required="">
               <div class="valid-feedback">Looks good!</div>
              </div> -->


                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Sale Amount USD</p>

                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input class="form-control" aria-label="Amount (to the nearest dollar)"
                                                name="sale_ammount_usd" type="number" placeholder="Sale Amount USD"
                                                required="" step="any">
                                        </div>
                                    </div>


                                    <!-- <div class="col-md-4 mb-3">
                <label for="validationCustom02">Sale Amount USD</label>
                <input class="form-control" id="validationCustom02"  name="sale_ammount_usd" type="number" placeholder="Sale Amount USD" required="">
                <div class="valid-feedback">Looks good!</div>
               </div> -->


                                    <!-- <div class="col-md-4 mb-3">
                <label for="validationCustom02">Commission Validation</label>
                <input class="form-control" id="validationCustom02"  name="commission_validation" type="number" placeholder="Commission Validation" required="">
                <div class="valid-feedback">Looks good!</div>
               </div> -->

                                    <!-- <div class="col-md-4 mb-3">
                <label for="validationCustom02">Commission After Validation</label>
                <input class="form-control" id="validationCustom02"  name="commission_after_validatione" type="number" placeholder="Commission After Validation" required="">
                <div class="valid-feedback">Looks good!</div>
               </div> -->


                                  
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Date</p>

                                        <div class="input-group mb-3">

                                            
                                            <input class="form-control" id="date_picker" aria-label="Amount (to the nearest dollar)"
                                                name="date" type="date"
                                                placeholder="" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Automation</p>
										<!-- <div class="col-form-label">Amount</div> -->
										<input class="form-control" id="validationCustom01" name="automation" type="text" placeholder="Automation" required="">
										<!-- <div class="valid-feedback">Looks good!</div> -->
									</div>

                                    <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Customer Type</p>
										<!-- <div class="col-form-label">Amount</div> -->
										<input class="form-control" id="validationCustom01" name="customer_type" type="text" placeholder="Customer Type" required="">
										<!-- <div class="valid-feedback">Looks good!</div> -->
									</div>

                                    <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Ad_set</p>
										<!-- <div class="col-form-label">Amount</div> -->
										<input class="form-control" id="validationCustom01" name="ad_set" type="text" placeholder="Ad_set" required="">
										<!-- <div class="valid-feedback">Looks good!</div> -->
									</div>

                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">AOV</p>
                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input class="form-control" aria-label="Amount (to the nearest dollar)"
                                                name="aov" type="number" placeholder="AOV" required="" step="any" >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Orders</p>
                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input class="form-control" aria-label="Amount (to the nearest dollar)"
                                                name="order" type="number" placeholder="Orders" required="" >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">AOV USD</p>
                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input class="form-control" aria-label="Amount (to the nearest dollar)"
                                                name="aov_usd" type="number" placeholder="AOV USD" required="" step="any" >
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Last Updated At</p>

                                        <div class="input-group mb-3">

                                            
                                            <input class="form-control"  aria-label="Amount (to the nearest dollar)"
                                                name="last_updated_at" type="time"
                                                placeholder="" required="">
                                        </div>
                                    </div> -->

                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <button class="btn btn-success" type="submit">Submit</button>
                                    </div>
                                </div>
                        </form>
</div>
                               
                            </div>
                                    </div>
                                </div>
                            </div>
                        <div class="mb-3">
                        </div>
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
<script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#date_picker').attr('min',today);
    </script>
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
@endsection
@else
<script>
    window.location.href = "{{route('notfound')}}";
</script>
@endif