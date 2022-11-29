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
        <h3>Brand list</h3>
    @endsection

    @section('breadcrumb-items')

        <li class="breadcrumb-item active">Brand list</li>
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
                                    <a class="p-1" href="{{ route('csv_brands') }}"><button
                                            class="btn btn-primary">CSV</button></a>
                                    <a class="p-1" href="{{ route('brand.export') }}"><button
                                            class="btn btn-warning">Export</button></a>
                                    <a class="p-1" href="{{ route('brands.create') }}"><button
                                            class="btn btn-success">Add</button></a>

                                    <button style="margin-bottom: 10px" class="btn btn-danger delete_all mt-1"
                                        data-url="{{ url('myproductsDeleteAll') }}">Bulk Delete</button>

                                </div>


                                <form action="{{ route('search_brands') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="row mb-5">
                                        <div class="col-lg-11">
                                            <input type="text" name="search" class="form-control" value="{{ $search }}" placeholder="Search Brands By Name or Country">
                                        </div>
                                        <div class="col-lg-1">
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
                                                <th>Logo</th>
                                                <th>Company Name</th>
                                                <th>Country</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($i = 1)
                                            @foreach ($brands as $brand)
                                                <tr>
                                                    <td><input type="checkbox" class="sub_chk"
                                                            data-id="{{ $brand->id }}"></td>
                                                    </td>

                                                    <th scope="row">{{ $loop->iteration }}</th>

                                                    <td><img src="{{ isset($brand->image) ? (file_exists(public_path('images/brand/' . $brand->image)) ? asset('images/brand/' . $brand->image) : asset('images/brand/thumbnail.png')) : asset('images/brand/thumbnail.png')}}"
                                                            style="height:40px; width:70px;"></td>

                                                    <td>
                                                        <div class="some_text">
                                                            {{ $brand->company_name }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $brand->country }}</td>

                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-2">

                                                                <button class="btn btn-danger btn-xs" type="button"
                                                                    data-original-title="btn btn-danger btn-xs"
                                                                    id="show_confirm_{{ $brand->id }}"
                                                                    data-toggle="tooltip" title='Delete'><i
                                                                        class="fa fa-trash"></i></button>

                                                            </div>
                                                            <div class="col-md-2">
                                                                <a href="{{ route('brands.edit', $brand->id) }}"> <button
                                                                        class="btn btn-success btn-xs " type="button"
                                                                        data-original-title="btn btn-danger btn-xs"
                                                                        title=""><i class="fa fa-edit"></i></button></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            
                                                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                <script type="text/javascript">
                                                    var brand = "{{ $brand->id }}";
                                                    $('#show_confirm_' + brand).click(async function(event) {

                                                        const {
                                                            value: email
                                                        } = await Swal.fire({
                                                            title: 'Are you sure?',
                                                            text: "You won't be able to revert this!",
                                                            icon: 'warning',
                                                            input: "text",
                                                            inputLabel: 'Type brand/delete to delete item',
                                                            inputPlaceholder: 'Type brand/delete to delete item',
                                                            showCancelButton: true,
                                                            inputValidator: (value) => {
                                                                return new Promise((resolve) => {
                                                                    if (value != "brand/delete") {
                                                                        resolve("Type brand/delete to delete item")
                                                                    } else {
                                                                        resolve()
                                                                    }
                                                                })
                                                            },
                                                        })
                                                        if (email) {
                                                            $.ajax({
                                                                url: "{{ route('brands.destroy', $brand->id) }}",
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


                        // var check = confirm("Are you sure you want to delete this row?");
                        const {
                            value: email
                        } = await Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            input: "text",
                            inputLabel: 'Type brand/delete to delete item',
                            inputPlaceholder: 'Type brand/delete to delete item',
                            showCancelButton: true,
                            inputValidator: (value) => {
                                return new Promise((resolve) => {
                                    if (value != "brand/delete") {
                                        resolve("Type brand/delete to delete item")
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
