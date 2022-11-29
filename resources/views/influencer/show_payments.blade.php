@if (auth()->user()->user_type != 2)
    @extends('layouts.simple.master')
    @section('title', 'Influencers Payment')

    @section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/owlcarousel.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/rating.css') }}">
    @endsection

    @section('style')
    @endsection

    @section('breadcrumb-title')
        <h3>Influencers Payment</h3>
    @endsection

    @section('breadcrumb-items')

        <li class="breadcrumb-item active">Influencers Payment</li>
    @endsection

    @section('content')
        <div class="container-fluid">
            <div class="row">
                <!-- Individual column searching (text inputs) Starts-->

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                

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
                                        @if ($message = Session::get('error'))
                                            <div class="alert alert-danger">
                                                <p>{{ $message }}</p>
                                            </div>
                                        @endif
                                        <thead>
                                            <tr>
                                               

                                                <th>#</th>
                                                <th>Influencer</th>
                                                <th>Paypal Email</th>
                                                <th>Wallet ID</th>
                                                <th>Bank Name</th>
                                                <th>Account No</th>
                                                <!-- <th>Login ID</th> -->

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payments as $payment)
                                                <tr>
                                                    
                                                    @php $inf = App\Models\User::find($payment->influencer_id); @endphp
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ !empty($inf) ? $inf->name : 'N/A' }}</td>
                                                    <td>
                                                        <div class="some_text">
                                                            {{ $payment->paypal_email }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="some_text">
                                                            {{ $payment->wallet_id }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="some_text">
                                                            {{ $payment->bank_name }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="some_text">{{ $payment->bank_account_no }}
                                                        </div>
                                                    </td>

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
                }, 1000);
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
                            inputLabel: 'Type influencer/delete to delete item',
                            inputPlaceholder: 'Type influencer/delete to delete item',
                            showCancelButton: true,
                            inputValidator: (value) => {
                                return new Promise((resolve) => {
                                    if (value != "influencer/delete") {
                                        resolve("Type influencer/delete to delete item")
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
