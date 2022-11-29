
@if(auth()->user()->user_type != 2)
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
        <h3>Upload list</h3>
    @endsection

    @section('breadcrumb-items')

        <li class="breadcrumb-item active">Upload list</li>
    @endsection
	
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <!-- Individual column searching (text inputs) Starts-->

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4 mb-3 mt-2">
                                    <form action="{{ route('management_csv_export') }}" method="Post" enctype="multipart/form-data">
                                @csrf
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="template" >
                                                                    <option value="-1">Export Template</option>
                                                                        <option value="1">Araby Ads</option> 
                                                                        <option value="2">Ounass</option>
                                                                        <option value="3">Styli</option>
                                                                        <option value="4">Marketer Hub</option>
                                                                        <option value="5">Shosh</option>
                                                                        <option value="6">Noon Egypt</option>    

                                                                </select>
                                                        </div>
                                                        <div class="col-lg-4">
                                                        <button class="btn btn-warning" type="submit">Export</button>
                                                        </div>
                                                    </div>
                                                                
                                                            
                                </form>
                                    </div>
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-6">
                                        <div class="d-flex flex-row-reverse mb-3">
                                            <a class="p-1" href="{{ route('management_csv') }}"><button
                                                    class="btn btn-primary">CSV</button></a>
                                            <!-- <a class="p-1" href="{{ route('management_csv_export') }}"><button
                                                    class="btn btn-warning">Export</button></a> -->
                                            
                                            <button style="margin-bottom: 10px" class="btn btn-danger delete_all mt-1"
                                                data-url="{{ url('myuploadDeleteAll') }}">Bulk Delete</button>

                                        </div>
                                    </div>

                                </div>
                                

                               
                               
                               
                                <div class="product-table">
                                    <table class="display" id="data-table">


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
                                                <th> <input type="checkbox" id="master"> </th>


                                                
                                                <th>Brand</th>
                                                <th>Coupon Code</th>
                                                
                                                <th>Month</th>
                                                <!-- <th>Sale Amount USD</th> -->
                                                <!-- <th>Commission Validation</th>
                                                                                           <th>Commission After Validation</th> -->
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                           

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
    setTimeout(function() {
    $('.alert-success').fadeOut('fast');
}, 3000);
</script>
<script>
    setTimeout(function() {
    $('.alert-danger').fadeOut('fast');
}, 3000);
</script>
        <script>
          
            $(document).ready(function() {


                $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('management.index') }}",
                columns: [
                    { data: 'temp', name: 'temp',orderable: false, render: function (temp) {
                        // console.log(temp_id)
                    return '<input type="checkbox" class="sub_chk" data-id="'+temp+'"> ';
                } },
                
                    { "data": "brand_name" },
                    { "data": "coupon_name" },
                    { data: 'month', render: function (month) {
                      var mm = "";
                      if(month == 1){ return "January"; }
                      else if(month == 2){ return "February"; } 
                      else if(month == 3){ return "March"; } 
                      else if(month == 4){ return "April"; } 
                      else if(month == 5){ return "May"; } 
                      else if(month == 6){ return "June"; } 
                      else if(month == 7){ return "July"; } 
                      else if(month == 8){ return "August"; } 
                      else if(month == 9){ return "September"; } 
                      else if(month == 10){ return "October"; } 
                      else if(month == 11){ return "November"; } 
                      else if(month == 12){ return "December"; } 

                } },
                   

                    {"data": 'action', name: 'action', orderable: false, searchable: false}
                ],
            });
            var allVals = [];
            $(document).on('change', '.sub_chk', function () {
  var id = $(this).data('id');
  console.log(id);
  allVals.push(id);
});
                $('#master').on('click', function(e) {
                    if ($(this).is(':checked', true)) {
                        $(".sub_chk").prop('checked', true);
                    } else {
                        $(".sub_chk").prop('checked', false);
                    }
                    // var table= $(e.target).closest('table');
                    // $('td input:checkbox',table).prop('checked',this.checked);
                });


                $('.delete_all').on('click', async function(e) {


                    
                    $(".sub_chk:checked").each(function() {
                        allVals.push($(this).attr('data-id'));
                    });
                   
                    // console.log(allVals);exit();
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
