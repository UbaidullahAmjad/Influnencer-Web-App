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
        <h3>Influencer list</h3>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('breadcrumb-items'); ?>

        <li class="breadcrumb-item active">Influencer list</li>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>
        <div class="container-fluid">
            <div class="row">
                <!-- Individual column searching (text inputs) Starts-->

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="d-flex flex-row-reverse mb-3">
                                    <a class="p-1" href="<?php echo e(route('csv_form')); ?>"><button
                                            class="btn btn-primary">CSV</button></a>
                                    <a class="p-1" href="<?php echo e(route('influencer_csv_export')); ?>"><button
                                            class="btn btn-warning">Export</button></a>
                                    <a class="p-1" href="<?php echo e(route('influencer.create')); ?>"><button
                                            class="btn btn-success">Add</button></a>

                                    <button style="margin-bottom: 10px" class="btn btn-danger delete_all mt-1"
                                        data-url="<?php echo e(url('myinfluencrDeleteAll')); ?>">Bulk Delete</button>

                                </div>



                               
                                

                                
                                <div class="product-table">
                                    <table class="display" id="data-table">
                                        <?php if($message = Session::get('success')): ?>
                                            <div class="alert alert-success">
                                                <p><?php echo e($message); ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($message = Session::get('error')): ?>
                                            <div class="alert alert-danger">
                                                <p><?php echo e($message); ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <thead>
                                            <tr>
                                                <th> <input type="checkbox" id="master"> </th>

                                                <th>Image</th>
                                                <th>First Name</th>
                                                <th>Handle Name</th>
                                                <th>Publisher ID</th>
                                                <!-- <th>Login ID</th> -->

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
                ajax: "<?php echo e(route('influencer.index')); ?>",
                columns: [
                    { data: 'id',orderable: false, render: function (id) {
                    return '<input type="checkbox" class="sub_chk" data-id="'+id+'"> ';
                } },
                { data: 'inf_image',orderable: false, render: function (image) {
                    return '<img src="'+ image +'" height="60" width="60">';
                } },
                    { "data": "f_name" },
                    { "data": "inf_handle_name" },
                    
                    { "data": "pub_id" },

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

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\influencer_app\resources\views/influencer/index.blade.php ENDPATH**/ ?>