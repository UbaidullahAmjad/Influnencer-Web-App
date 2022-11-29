@if(auth()->user()->user_type == 2)
@extends('layouts.simple.master')
@section('title', 'Checkbox & Radio')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Account Details</h3>
@endsection

@section('breadcrumb-items')

@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				
				<div class="card-body">
					<div class="row">
						
						
							<h5>Select Payment Method</h5>
						
						
							<!-- <div class="mb-3 m-t-15 custom-radio-ml"> -->
                                <div class="col-lg-2" >
                                    <div class="form-check radio radio-primary">
                                        <input class="form-check-input" id="radio11" type="radio" name="radio1" value="option1" />
                                        <label class="form-check-label" for="radio11">Paypal<span class="digits"> </span></label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-check radio radio-warning">
                                        <input class="form-check-input" id="radio22" type="radio" name="radio1" value="option1" />
                                        <label class="form-check-label" for="radio22">Wallet<span class="digits"> </span></label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-check radio radio-success">
                                        <input class="form-check-input" id="radio55" type="radio" name="radio1" value="option1" />
                                        <label class="form-check-label" for="radio55">Bank<span class="digits"></span></label>
                                    </div>
                                </div>
						    <!-- </div> -->	
					</div>
				</div>
			</div>
            <div class="card" id="card" style="display:none">
                <div class="card-body">

                <div class="col-12 mb-5" >
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
                        <div class="col-lg-6" id="paypal_col">
                            <div id="paypal" style="display:none">
                                
                                <form class="needs-validation"action="{{route('payment_store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                    
                                    <input type="hidden" value="paypal" name="paypal">
                                            <div class="mb-3">
                                                <p style="font-weight: bold;font-size: 15px;">Paypal Email*</p>
                                                <input class="form-control" id="validationCustom02"  name="email" value="{{ isset($data) ? $data->paypal_email : '' }}" type="email" placeholder="Paypal Email" >
                                                <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    
                                    <div class="mb-3">	
                                    </div>
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6" id="wallet_col">
                            <div id="wallet"  style="display:none">
                                <form class="needs-validation" action="{{route('payment_store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                               
                                    
                                    <input type="hidden" value="wallet" name="wallet">
                                            <div class="mb-3">
                                                <p style="font-weight: bold;font-size: 15px;">Wallet ID*</p>
                                                <input class="form-control" id="validationCustom02" value="{{ isset($data) ? $data->wallet_id : '' }}" name="wallet" type="text" placeholder="Wallet ID" >
                                                <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    
                                    <div class="mb-3">	
                                    </div>
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>                
				</div>
                <div class="col-12" id="bank_col">
                    <div id="bank" style="display:none">
                        <form class="needs-validation" action="{{route('payment_store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                       
                            <input type="hidden" value="bank" name="bank">
                                    <div class="col-md-4 mb-3">
                                        <p style="font-weight: bold;font-size: 15px;">Bank Name</p>
                                        <input class="form-control" id="validationCustom02" value="{{ isset($data) ? $data->bank_name : '' }}" name="bank_name" type="text" placeholder="Bank Name" >
                                        <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="col-md-4 mb-3">
                                        <p style="font-weight: bold;font-size: 15px;">Account Holder Name</p>
                                        <input class="form-control" id="validationCustom02" value="{{ isset($data) ? $data->account_holder : '' }}"  name="account_holder_name" type="text" placeholder="Account Holder Name" >
                                        <div class="valid-feedback">Looks good!</div>
                                </div>


                                <div class="col-md-4 mb-3">
                                        <p style="font-weight: bold;font-size: 15px;">Account No</p>
                                        <input class="form-control" id="validationCustom02" value="{{ isset($data) ? $data->bank_account_no : '' }}" name="account_no" type="text" placeholder="Account No" >
                                        <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="col-md-4 mb-3">
                                        <p style="font-weight: bold;font-size: 15px;">IBAN</p>
                                        <input class="form-control" id="validationCustom02" value="{{ isset($data) ? $data->iban : '' }}"  name="iban" type="text" placeholder="IBAN" >
                                        <div class="valid-feedback">Looks good!</div>
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
<script>
    // alert(radio11);
    
    // $('#wallet').hide();
    // $('#paypal').hide(); 

    $(document).ready(function() {    
        var data = "{{ isset($data) ? $data : '' }}";
        if(data){
            $('#paypal').css('display','block');
            $('#card').css('display','block');
            $('#wallet').css('display','block');
            $('#bank').css('display','block');
        }
   $('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'radio11') {
            $('#paypal').css('display','block');
            $('#card').css('display','block');
            $('#wallet').hide();
            $('#bank').hide();
            $('#bank_col').hide(); 
            $('#wallet_col').hide();   
            $('#paypal_col').show();         
       }

       else {
            $('#paypal').hide();   
       }
       if($(this).attr('id') == 'radio22') {
            $('#paypal').hide();
            $('#bank').hide(); 
            $('#bank_col').hide(); 
            $('#paypal_col').hide(); 
            $('#wallet_col').show(); 
            $('#wallet').css('display','block');
            $('#card').css('display','block'); 
                      
       }

       else {
            $('#wallet').hide();   
       }

       if($(this).attr('id') == 'radio55') {
            $('#paypal').hide();
            $('#wallet').hide(); 
            $('#wallet_col').hide(); 
            $('#paypal_col').hide();
            $('#bank_col').show(); 
            $('#bank').css('display','block');
            $('#card').css('display','block');           
       }

       else {
            $('#bank').hide();   
       }
   });
});
</script>
@endsection
@else
    <script>
        window.location.href = "{{ route('notfound') }}";
    </script>
@endif