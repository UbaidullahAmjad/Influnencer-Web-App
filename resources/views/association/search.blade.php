@if (auth()->user()->user_type != 2)
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
        <h3>Association list</h3>
    @endsection

    @section('breadcrumb-items')

        <li class="breadcrumb-item active">Association list</li>
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
                                    <a class="p-1" href="{{ route('assciate_csv') }}"><button
                                            class="btn btn-primary">CSV</button></a>
                                    <a class="p-1" href="{{ route('assciate_csv_export') }}"><button
                                            class="btn btn-warning">Export</button></a>
                                    <a class="p-1" href="{{ route('assciate.create') }}"><button
                                            class="btn btn-success">Add</button></a>
                                    <button style="margin-bottom: 10px" class="btn btn-danger delete_all mt-1"
                                        data-url="{{ url('myassociateDeleteAll') }}">Bulk Delete</button>

                                </div>


                                <form action="{{ route('search_associated_data') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="row mb-5">
                                        <div class="col-lg-3">
                                            
                                            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="brand">
                                                <option value="">Select Brand</option>
                                                @foreach ($brands as $brand)
                                                    @if($selected_brand == $brand->id)
                                                    <option value="{{ $brand->id }}" selected>{{ $brand->company_name }}</option>
                                                    @else
                                                    <option value="{{ $brand->id }}">{{ $brand->company_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                           
                                            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="coupon">
                                                <option value="">Select Coupon</option>
                                                @foreach ($coupons as $Coupon)
                                                    @if($selected_coupon == $Coupon->id)
                                                    <option value="{{ $Coupon->id }}" selected>{{ $Coupon->coupon_code }}</option>
                                                    @else
                                                    <option value="{{ $Coupon->id }}">{{ $Coupon->coupon_code }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                           
                                            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="influencer">
                                                <option value="">Select Influencer</option>
                                                @foreach ($influencers as $influencer)
                                                    @if($selected_influencer == $influencer->pub_id)
                                                    <option value="{{ $influencer->pub_id }}" selected>{{ $influencer->f_name }}</option>
                                                    @else
                                                    <option value="{{ $influencer->pub_id }}">{{ $influencer->f_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>  
                                </form>
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
                                                <th> <input type="checkbox" id="master"> </th>

                                                <th>#</th>
                                                <th>Brand</th>
                                                <th>Coupon</th>
                                                <th>Influencer</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($associations as $association)
                                                <?php
                                                $brand = App\Models\Brand::find($association->brand_id);
                                                $coupon = App\Models\Coupon::find($association->coupon_id);
                                                $influencer = App\Models\User::find($association->influencer_id);

                                                ?>
                                                @if ($brand != null && $coupon != null && $influencer != null)
                                                    <tr>
                                                        <td><input type="checkbox" class="sub_chk"
                                                                data-id="{{ $association->id }}"></td>
                                                        </td>

                                                        <th scope="row">{{ $loop->iteration }}</th>

                                                        <td>{{ $brand->company_name }}</td>
                                                        <td>{{ $coupon->coupon_code }}</td>
                                                        <td>{{ $influencer->f_name }}</td>

                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <form method="POST"
                                                                        action="{{ route('assciate.destroy', $association->id) }}">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button class="btn btn-danger btn-xs" type="button"
                                                                            data-original-title="btn btn-danger btn-xs"
                                                                            id="show_confirm_{{ $association->id }}"
                                                                            data-toggle="tooltip" title='Delete'><i
                                                                                class="fa fa-trash"></i></button>
                                                                    </form>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <a
                                                                        href="{{ route('assciate.edit', $association->id) }}">
                                                                        <button class="btn btn-success btn-xs" type="button"
                                                                            data-original-title="btn btn-danger btn-xs"
                                                                            title=""><i
                                                                                class="fa fa-edit"></i></button></a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                        <script type="text/javascript">
                                                            var brand = "{{ $association->id }}";
                                                            $('#show_confirm_' + brand).click(async function(event) {
                                                                const {
                                                                    value: email
                                                                } = await Swal.fire({
                                                                    title: 'Are you sure?',
                                                                    text: "You won't be able to revert this!",
                                                                    icon: 'warning',
                                                                    input: "text",
                                                                    inputLabel: 'Type association/delete to delete item',
                                                                    inputPlaceholder: 'Type association/delete to delete item',
                                                                    showCancelButton: true,
                                                                    inputValidator: (value) => {
                                                                        return new Promise((resolve) => {
                                                                            if (value != "association/delete") {
                                                                                resolve("Type association/delete to delete item")
                                                                            } else {
                                                                                resolve()
                                                                            }
                                                                        })
                                                                    },
                                                                })
                                                                if (email) {
                                                                    $.ajax({
                                                                        url: "{{ route('assciate.destroy', $association->id) }}",
                                                                        type: "DELETE",
                                                                        cache: false,
                                                                        data: {
                                                                            "_token": "{{ csrf_token() }}",
                                                                        },
                                                                        success: function(data) {
                                                                            $('#show_confirm_' + data.id).parents("tr").remove();
                                                                        }
                                                                    })
                                                                }
                                                            });
                                                        </script>
                                                    </tr>
                                                @endif
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
                            inputLabel: 'Type association/delete to delete item',
                            inputPlaceholder: 'Type association/delete to delete item',
                            showCancelButton: true,
                            inputValidator: (value) => {
                                return new Promise((resolve) => {
                                    if (value != "association/delete") {
                                        resolve(
                                            "Type association/delete to delete item"
                                        )
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
