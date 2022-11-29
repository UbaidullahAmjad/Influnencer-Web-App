@extends('layouts.simple.master')
@section('title', 'Select2')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Payment Detail</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{auth()->user()->user_type != 2 ? route('payment_detail') : route('get_influencer_payments')}}">Payment Detail List</a></li>
<li class="breadcrumb-item active">Payment Detail</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="select2-drpdwn">
		<div class="row">
			<!-- Default Textbox start-->
			<div class="col-md-12">
				<div class="card">
				<div class="container">
			
                     <div class="d-flex flex-row-reverse">
                           <a class="p-1" href="{{ auth()->user()->user_type != 2 ? route('payment_detail') : route('get_influencer_payments') }}" ><button class="btn btn-primary">Back</button></a>
                        
                           
                     </div>
					 @if ($message = Session::get('success'))
                                 <div class="alert alert-success">
                                       <p>{{ $message }}</p>
                                 </div>
                              @endif
				
				<form id="upload_form" class="needs-validation" action="" method="post" >
				@csrf
					@method('PUT')
						<div class="card-header">
										
									
						<div class="row">	
						@if ($errors->any())
                  @foreach ($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible p-2">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                     <strong>Error!</strong> {{$error}}.
                  </div>
                  @endforeach
                  @endif
								
								
								<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Publisher</p>
											    <div class="input-group mb-3">
                                                       <input class="form-control" value="{{$payments->publisher}}"  name="publisher" type="text" readonly >
                                                   </div>
                                                 </div>
											
								<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Link</p>
											    <div class="input-group mb-3">
                                                       <input class="form-control"  value="{{$payments->link}}"  name="link" type="text" readonly>
                                                   </div>
                                                 </div>
                                
								<div class="col-md-4">
											 <p style="font-weight: bold;font-size: 15px;">Direct WhatsApp</p>

											    <div class="input-group mb-3">
                                                       <input class="form-control" value="{{$payments->direct_whatsapp}}" name="direct_whatsapp" type="text" readonly>
                                                   </div>
											 </div>
											
											 <div class="col-md-4">
													<p style="font-weight: bold;font-size: 15px;">WhatsApp Group</p>

													<div class="input-group mb-3">
														<input class="form-control" value="{{$payments->group_whatsapp}}" name="group_whatsapp" type="text"
														readonly	>
													</div>
                                              </div>
											 <div class="col-md-4">
													<p style="font-weight: bold;font-size: 15px;">Country</p>
													<div class="input-group mb-3">
														<input class="form-control" value="{{$payments->country}}" name="country" type="text"
                                                        readonly>
													</div>
                                              </div>
									<div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Bank Name</p>
										<input  value="{{$payments->bank_name}}" class="form-control" id="validationCustom01" name="bank_city" type="text" readonly>
									</div>
                                    <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Bank City</p>
										<input class="form-control" value="{{$payments->bank_city}}" id="validationCustom01" name="bank_city" type="text" readonly >
									</div>
                                    <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Beneficiary</p>
										<input class="form-control" value="{{$payments->beneficiary}}" id="validationCustom01" name="beneficiary" type="text" readonly>
									</div>
                                   <div class="col-md-4 mb-3">
										<p style="font-weight: bold;font-size: 15px;">Account Number</p>
										<input class="form-control" value="{{$payments->account_number}}" id="validationCustom01" name="account_number" type="text" readonly>
									</div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">IBAN Number</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="{{$payments->iban_number}}" name="iban_number" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Notes</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="{{$payments->notes}}" name="notes" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Account</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="{{$payments->amount}}" name="notes" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Pending Account</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="{{$payments->pending_amount}}" name="pending_amount" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Quality</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="{{$payments->quality}}" name="quality" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Payment Currency</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="{{$payments->payment_currency}}" name="payment_currency" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Transfer</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="{{ $payments->transfer == 0 ? 'Inactive' : 'Active'}}" name="transfer" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">POP Invoice</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="{{$payments->pop_invoice}}" name="pop_invoice" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">MM</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="{{$payments->mm}}" name="mm" type="text" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="font-weight: bold;font-size: 15px;">Total</p>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="{{$payments->total}}" name="total" type="text" readonly >
                                        </div>
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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $('#update').click(async function(event) {
        Swal.fire({
        title: 'Are you sure to Update the Data?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Update it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $("#upload_form").submit();
        }
      })
});

</script>

<script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#date_picker').attr('min',today);
    </script>
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
@endsection
