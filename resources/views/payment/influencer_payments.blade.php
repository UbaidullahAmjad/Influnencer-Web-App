
@if(auth()->user()->user_type == 2)
    @extends('layouts.simple.master')
    @section('title', 'Product list')

    @section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/owlcarousel.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/rating.css') }}">

    @endsection
    @section('style')
    @endsection

    @section('breadcrumb-title')
        <h3>Payment Details</h3>
    @endsection

    @section('breadcrumb-items')

        <li class="breadcrumb-item active">Payment Details</li>
    @endsection
	
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <!-- Individual column searching (text inputs) Starts-->

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">

                                    @if ($message = Session::get('error'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ $message }}
                                                
                                                </div>
                                                @endif

                                        <div class="row">
                                            <div class="col-lg-4 mb-3 mt-2">
                                        
                                            </div>
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-6">
                                                <div class="d-flex flex-row-reverse mb-3">
                                                
                                                    
                                                </div>
                                            </div>

                                        </div>
                                
                                    <div class="loader-box" id="my-loader">
                                        <div class="loader-2"></div>
                                    </div>
                                    <div class="table-responsive product-table" id="data-table" style="display:none;">
                                        <table class="display" id="basic-2">
                                                                @if ($message = Session::get('success'))
                                                                    <div class="alert alert-success">
                                                                        <p>{{ $message }}</p>
                                                                    </div>
                                                                @endif

                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Publisher</th>
                                                                        <th>Country</th>
                                                                        <th>Bank Name</th>
                                                                        <th>Bank City</th>
                                                                        <th>Account No</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                            
                                                                <tbody>
                                                                    @php $loop_var = 1; @endphp
                                                                    @foreach($payments as $payment)
                                                                            <tr>
                                                                                <th scope="row">{{ $loop_var++ }}</th>
                                                                                <td>
                                                                                    <div class="some_text">
                                                                                        {{$payment->publisher}}
                                                                                    </div>
                                                                                </td>
                                                                                
                                                                                <td>
                                                                                    <div class="some_text">
                                                                                    {{$payment->country}}
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="some_text">
                                                                                    {{$payment->bank_name}}
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="some_text">
                                                                                    {{$payment->bank_city}}
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="some_text">
                                                                                    {{$payment->account_number}}
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                <div class="row">
                                                                                <div class="col-md-1">
                                                                                            <a href="{{ route('payment_view', $payment->id) }}">
                                                                                            
                                                                                           
                                                                                            <i class="fa fa-eye"></i></a>
                                                                                </div>
                                                                                
                                                                                
                                                            </td>
                                                            
                                                                            </tr>
                                                                            @endforeach
                                                                </tbody>
                                        </table>
                                        
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
        <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/rating/jquery.barrating.js') }}"></script>
        <script src="{{ asset('assets/js/rating/rating-script.js') }}"></script>
        <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
        <script src="{{ asset('assets/js/ecommerce.js') }}"></script>
        <script src="{{ asset('assets/js/product-list-custom.js') }}"></script>
        
        <script>
            
           
            window.onload = function(){
                setTimeout(function(){
                    $('#my-loader').hide();
                    $('#data-table').show();
                }, 500);

                setTimeout(function(){
                    $(".alert").alert('close');
                }, 100);
                };
            $(document).ready(function() {


                $('#master').on('click', function(e) {
                    if ($(this).is(':checked', true)) {
                        $(".sub_chk").prop('checked', true);
                    } else {
                        $(".sub_chk").prop('checked', false);
                    }
                });


                $('.delete_all').on('click', async function(e) {


                    var allVals = [];
                    $(".sub_chk:checked").each(function() {
                        allVals.push($(this).attr('data-id'));
                    });


                    if (allVals.length <= 0) {
                        alert("Please select row.");
                    } else {

                        const {
                            value: email
                        } = await Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            input: "text",
                            inputLabel: 'Type management/delete to delete item',
                            inputPlaceholder: 'Type management/delete to delete item',
                            showCancelButton: true,
                            inputValidator: (value) => {
                                return new Promise((resolve) => {
                                    if (value != "management/delete") {
                                        resolve("Type management/delete to delete item")
                                    } else {
                                        resolve()
                                    }
                                })
                            },
                        })
                        if (email) {


                            var join_selected_values = allVals.join(",");

                            $.ajax({
                                url: $(this).data('url'),
                                type: 'get',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: 'ids=' + join_selected_values,
                                success: function(data) {
                                    if (data['success']) {
                                        $(".sub_chk:checked").each(function() {
                                            $(this).parents("tr").remove();
                                        });
                                        // alert(data['success']);
                                    } else if (data['error']) {
                                        alert(data['error']);
                                    } else {
                                        alert('Whoops Something went wrong!!');
                                    }
                                },
                                error: function(data) {
                                    alert(data.responseText);
                                }
                            });


                            $.each(allVals, function(index, value) {
                                $('table tr').filter("[data-row-id='" + value + "']").remove();
                            });
                        }
                    }
                });


                $('[data-toggle=confirmation]').confirmation({
                    rootSelector: '[data-toggle=confirmation]',
                    onConfirm: function(event, element) {
                        element.trigger('confirm');
                    }
                });


                $(document).on('confirm', function(e) {
                    var ele = e.target;
                    e.preventDefault();


                    $.ajax({
                        url: ele.href,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data['success']) {
                                //  $("#" + data['tr']).slideUp("slow");
                                //  alert(data['success']);
                                location.reload();
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });


                    return false;
                });
            });
        </script>
    @endsection
@else
    <script>
        window.location.href = "{{ route('notfound') }}";
    </script>
@endif
