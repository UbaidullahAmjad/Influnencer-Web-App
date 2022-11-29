
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
        <h3>Payment Details</h3>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('breadcrumb-items'); ?>

        <li class="breadcrumb-item active">Payment Details</li>
    <?php $__env->stopSection(); ?>
	
    <?php $__env->startSection('content'); ?>
        <div class="container-fluid">
            <div class="row">
                <!-- Individual column searching (text inputs) Starts-->

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">

                                    <?php if($message = Session::get('error')): ?>
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <?php echo e($message); ?>

                                                
                                                </div>
                                                <?php endif; ?>

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
                                        <div class="row mb-5">
                                            <div class="col-lg-9">
                                            <form action="<?php echo e(route('search_payments')); ?>" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                                <div class="row mb-5">
                                                    <div class="col-lg-11">
                                                        <input type="text" name="search" class="form-control" value="<?php echo e(isset($search) ? $search : ''); ?>" placeholder="Search Payments By Publisher ID, Bank or IBAN">
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                                
                                                
                                            </form>
                                            </div>
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-2">
                                                <a class="btn btn-primary" href="<?php echo e(route('export-payments')); ?>">Export</a>
                                            </div>

                                        </div>
                                        <table class="display" id="basic-2">
                                                                <?php if($message = Session::get('success')): ?>
                                                                    <div class="alert alert-success">
                                                                        <p><?php echo e($message); ?></p>
                                                                    </div>
                                                                <?php endif; ?>

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
                                                                    <?php $loop_var = 1; ?>
                                                                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <tr>
                                                                                <th scope="row"><?php echo e($loop_var++); ?></th>
                                                                                <td>
                                                                                    <div class="some_text">
                                                                                        <?php echo e($payment->publisher); ?>

                                                                                    </div>
                                                                                </td>
                                                                                
                                                                                <td>
                                                                                    <div class="some_text">
                                                                                    <?php echo e($payment->country); ?>

                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="some_text">
                                                                                    <?php echo e($payment->bank_name); ?>

                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="some_text">
                                                                                    <?php echo e($payment->bank_city); ?>

                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="some_text">
                                                                                    <?php echo e($payment->account_number); ?>

                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                <div class="row">
                                                                                <div class="col-md-1">
                                                                                            <a href="<?php echo e(route('payment_view', $payment->id)); ?>">
                                                                                            
                                                                                           
                                                                                            <i class="fa fa-eye"></i></a>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <select name="transfer" id="transfer_<?php echo e($payment->id); ?>">
                                                                                        <option value="1" <?php echo e($payment->transfer == 1 ? 'selected' : ''); ?>>Transfer</option>
                                                                                        <option value="0" <?php echo e($payment->transfer == 0 ? 'selected' : ''); ?>>Not Transfer</option>
                                                                                    </select>
                                                                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                                                                                    <script>
                                                                                        // var id = "";
                                                                                        $('#transfer_<?php echo e($payment->id); ?>').on('change', function() {
                                                                                            var val = this.value;

                                                                                            $.ajax({
                                                                                                url : "/public/change_payment_data",
                                                                                                method: "GET",
                                                                                                data: {id:'<?php echo e($payment->id); ?>',
                                                                                                  val:val},
                                                                                                success: function(data){
                                                                                                    if(data == '1'){
                                                                                                        window.location.reload();
                                                                                                    }else{
                                                                                                        alert('some thing went wrong')
                                                                                                    }
                                                                                                    
                                                                                                }
                                                                                            });
                                                                                            });
                                                                                    </script>
                                                                                </div>
                                                                                </div>
                                                                                
                                                            </td>
                                                            
                                                                            </tr>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    <?php $__env->stopSection(); ?>
<?php else: ?>
    <script>
        window.location.href = "<?php echo e(route('notfound')); ?>";
    </script>
<?php endif; ?>

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\influencer_app\resources\views/payment/payment_detail.blade.php ENDPATH**/ ?>