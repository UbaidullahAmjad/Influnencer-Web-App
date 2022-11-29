@if (auth()->user()->user_type == 2)
    @extends('layouts.simple.master')
    @section('title', '')

    @section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/owlcarousel.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/rating.css') }}">
        <style>
            .card-header{
                padding:5px !important;
                background:#51bb25 !important;
                color:white;
            }
            .card-body{
                padding:15px !important;
            }
            .card-footer{
                padding:10px !important;
            }
        </style>
    @endsection

    @section('style')
    @endsection

    @section('breadcrumb-title')
        <h3>My Commissions</h3>
    @endsection

    @section('breadcrumb-items')

        <li class="breadcrumb-item active">My Commissions</li>
    @endsection

    @section('content')
        <div class="container-fluid">
            <div class="row">
                <!-- Individual column searching (text inputs) Starts-->

                <div class="col-sm-12">
                    <div class="container">
                        <form class="card" style="padding: 16px" action="{{ route('searchcommissionCal') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom01">From *</label>
                                <!-- <div class="col-form-label">Select Coupons</div> -->
                                <select class="js-example-placeholder-multiple col-sm-12 form-control" name="from_month" required>
                                <option value="from">Select Month</option>
                                <option value="1">January</option>
                                <option value="2">Februay</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>

                            
                                </select>
                                
                            </div>
                            <div class="col-md-3 mb-3">
                                    <label for="validationCustom01">To *</label>
                                            <!-- <div class="col-form-label">Select Coupons</div> -->
                                            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="to_month" required>
                                            <option value="to">Select Month</option>
                                            <option value="1">January</option>
                                            <option value="2">Februay</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>

                                        
                                            </select>
                                
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom01">Year</label>
                                <!-- <div class="col-form-label">Select Coupons</div> -->
                                <select class="js-example-placeholder-multiple col-sm-12 form-control" name="year">
                                        <option value="-2">Select Year</option>
                                        @foreach(range( $latest_year, $earliest_year ) as $i)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endforeach
                                    
                                </select>
                            </div>
                            <div class="col-md-3 mb-3" style="margin-top:29px">
                                <button class="btn btn-success" type="submit">Search</button>
                            </div>
                            
                        </div>
                        
                        </form>
                        <div class="row">
                            @if(count($commission_calculation) > 0)
                                @foreach($commission_calculation as $c)
                                    @if(isset($c['coupon']) && isset($c['brand']))
                                    <div class="col-lg-2 card me-2" style="padding:5px">
                                        <h4 class="text-center card-header" >{{ isset($c['coupon']) ? $c['coupon']->coupon_code : '' }}</h4>
                                        <h5 class="text-center card-body">{{ isset($c['brand']) ? $c['brand']->company_name : '' }}</h5>
                                        <h6 class="text-center card-footer">$ {{ round($c['total'],2) }}</h6>
                                    </div>
                                    @endif
                                @endforeach
                            @else
                            <p class="text-center text-danger">No Commission Found !</p>
                            @endif
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
                }, 2000);
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
