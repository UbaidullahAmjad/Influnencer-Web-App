<?php if(auth()->user()->user_type != 2): ?>
    
    <?php $__env->startSection('title', 'Product list'); ?>

    <?php $__env->startSection('css'); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/owlcarousel.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/rating.css')); ?>">
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('style'); ?>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('breadcrumb-title'); ?>
        <h3>Coupon list</h3>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('breadcrumb-items'); ?>

        <li class="breadcrumb-item active">Coupon list</li>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>

        <?php

            $today_date = Carbon\Carbon::today();
        ?>
        <div class="container-fluid">
            <div class="row">
                <!-- Individual column searching (text inputs) Starts-->

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="d-flex flex-row-reverse mb-3">
                                    <a class="p-1" href="<?php echo e(route('coupon_csv_form')); ?>"><button
                                            class="btn btn-primary">CSV</button></a>
                                    <a class="p-1" href="<?php echo e(route('coupon_csv_export')); ?>"><button
                                            class="btn btn-warning">Export</button></a>
                                    <a class="p-1" href="<?php echo e(route('coupon.create')); ?>"><button
                                            class="btn btn-success">Add</button></a>

                                    <button style="margin-bottom: 10px" class="btn btn-danger delete_all mt-1"
                                        data-url="<?php echo e(url('mycouponDeleteAll')); ?>">Bulk Delete</button>

                                </div>


                                <!-- <div class="row">
                                    <div class="col-lg-4">
                                        <form id="b_module" action="<?php echo e(route('get_data_by_pages')); ?>" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <span>Show </span>
                                            <select name="module_val" id="module" class="module_select">
                                                <option value="10" <?php echo e(isset($records) && $records == 10 ? 'selected' : ''); ?>>10</option>
                                                <option value="25" <?php echo e(isset($records) && $records == 25 ? 'selected' : ''); ?>>25</option>
                                                <option value="100" <?php echo e(isset($records) && $records == 100 ? 'selected' : ''); ?>>100</option>
                                                <option value="500" <?php echo e(isset($records) && $records == 500 ? 'selected' : ''); ?>>500</option>
                                                <option value="500" <?php echo e(isset($records) && $records == 1000 ? 'selected' : ''); ?>>1000</option>
                                            </select>
                                            <span>Entries </span>
                                            <input type="hidden" name="module" value="coupon">
                                            
                                            
                                        </form>
                                    </div>
                                    <div class="col-lg-8">
                                    <form action="<?php echo e(route('search_coupons')); ?>" method="post" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                            <div class="row mb-5">
                                                <div class="col-lg-9">
                                                    <input type="text" name="search" class="form-control" placeholder="Search Coupons By Coupon Code, Currency">
                                                </div>
                                                
                                                <div class="col-lg-1">
                                                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>  
                                        </form>
                                    </div>
                                </div> -->
                                
                                
                                <div class="product-table">

                                    <table class="display" id="data-table">
                                        <?php if($message = Session::get('success')): ?>
                                            <div class="alert alert-success">
                                                <p><?php echo e($message); ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($message = Session::get('error')): ?>
                                            <div class="alert alert-danger">
                                                <p>
                                                    
                                                        <?php echo e($message); ?>

                                                    
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                        <thead>
                                            <tr>
                                                <th> <input type="checkbox" id="master"> </th>


                                                
                                                <th>Brand</th>
                                                <th>Coupons Code</th>
                                                <th>Currency</th>
                                                <th>Symbol</th>
                                                <th>Amount</th>

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
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('script'); ?>
        <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/rating/jquery.barrating.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/rating/rating-script.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/owlcarousel/owl.carousel.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/ecommerce.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/product-list-custom.js')); ?>"></script>
        <script>
           
            $(document).ready(function() {


                $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "<?php echo e(route('coupon.index')); ?>",
                columns: [
                    { data: 'id',orderable: false, render: function (id) {
                    return '<input type="checkbox" class="sub_chk" data-id="'+id+'"> ';
                } },
                    { "data": "brand_name" },
                    { "data": "coupon_code" },
                    { "data": "currency" },
                    { "data": "symbol" },
                    { "data": "amount" },

                    {"data": 'action', name: 'action', orderable: false, searchable: false}
                ],
            });
            var allVals = [];
            $(document).on('change', '.sub_chk', function () {
  var id = $(this).data('id');
  allVals.push(id);
});
                $('#master').on('click', function(e) {
                    // if ($(this).is(':checked', true)) {
                    //     $(".sub_chk").prop('checked', true);
                    // } else {
                    //     $(".sub_chk").prop('checked', false);
                    // }
                    var table= $(e.target).closest('table');
                    $('td input:checkbox',table).prop('checked',this.checked);
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
                            inputLabel: 'Type coupon/delete to delete item',
                            inputPlaceholder: 'Type coupon/delete to delete item',
                            showCancelButton: true,
                            inputValidator: (value) => {
                                return new Promise((resolve) => {
                                    if (value != "coupon/delete") {
                                        resolve("Type coupon/delete to delete item")
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
            $('#module').on('change', function() {
                document.getElementById("b_module").submit();
            });
        </script>
    <?php $__env->stopSection(); ?>
<?php else: ?>
    <script>
        window.location.href = "<?php echo e(route('notfound')); ?>";
    </script>
<?php endif; ?>

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\influencer_app\resources\views/coupons/index.blade.php ENDPATH**/ ?>