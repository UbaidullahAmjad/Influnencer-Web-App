

<?php $__env->startSection('title', $title); ?>
<style>
    tr.group.group-start {
        display: none;
    }
    .ellipsis {
    position: relative;
    }
    .ellipsis:before {
        content: '&nbsp;';
        visibility: hidden;
    }
    .ellipsis span {
        position: absolute;
        left: 0;
        right: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

</style>
<?php $__env->startSection('header'); ?>
    <button type="button" class="btn btn-sm" style="background:white;" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus"></i> Create New Backup
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <form action="<?php echo e(route('backupmanager_create')); ?>" method="post" id="frmNew">
                <?php echo csrf_field(); ?>
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Database Information</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <label style="
    color: black;">Database Name</label>
                        <input type="text" name="db_name" class="form-control" placeholder="Enter Database Name" id="db_name" maxLength="50">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="modal_submit" class="btn btn-success">Ok</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <a href="<?php echo e(route('brands.index')); ?>" class="btn btn-sm" style="background:white;"><i
            class="fa fa-arrow-left"></i> Back to Admin</a>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <form id="frm" action="<?php echo e(route('backupmanager_restore_delete')); ?>" method="post"> 
        <?php echo csrf_field(); ?>

        <table class="table" style="font-size: 14px; color: #777777;">
            <thead>
                <tr>
                    <th style="text-align: center;" width="1">#</th>
                    <th>Name</th>
                    <!-- <th>Date</th> -->
                    <th>Size</th>
                    <th style="text-align: center;">Health</th>
                    <th style="text-align: center;">Type</th>
                    <th style="text-align: center;">Download</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;" width="1">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $backups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $backup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <?php $db_name = App\Models\DatabaseInformation::where('database_storage_name', $backup['name'])->first(); ?>
                        <td style="text-align: center;"><?php echo e(++$index); ?></td>
                        
                        <?php if($db_name != null): ?>
                            <td style=" <?php if($db_name->status == 1): ?> font-weight:bold; <?php endif; ?>" class="ellipsis"><span><?php echo e($db_name->name); ?></span></td>
                        <?php else: ?>
                            <td class="ellipsis"><span><?php echo e($backup['name']); ?></span></td>
                        <?php endif; ?>
                        <!-- <td class="date"><?php echo e($backup['date']); ?></td> -->
                        <td><?php echo e($backup['size']); ?></td>
                        <td style="text-align: center;">
                            <?php
                            $okSizeBytes = 1024;
                            $isOk = $backup['size_raw'] >= $okSizeBytes;
                            $text = $isOk ? 'Good' : 'Bad';
                            $icon = $isOk ? 'success' : 'danger';

                            echo "<span class='col-sm-8 badge badge-$icon'>$text</span>";
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <span
                                class="col-sm-8 badge badge-success ">Database</span>
                        </td>
                        <td style="text-align: center;">
                            <a href="<?php echo e(route('backupmanager_download', [$backup['name']])); ?>">
                                <i class="fa fa-download btn btn-primary"></i>
                            </a>
                        </td>
                        <td style="text-align:center;">
                            <?php if($db_name != null): ?>
                                <?php if($db_name->status == 1): ?>
                                    <span class="badge badge-success" >Active</span>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="badge badge-danger" >Not Active</span>
                            <?php endif; ?>

                        </td>
                        <td style="text-align: center;width:10%">
                            <input type="radio" name="backups" class="chkBackup" value="<?php echo e($backup['name']); ?>"
                                style="float: left">
                                
        </form>
                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal_edit_<?php echo e(preg_split('/[^\w]/',explode('.',$backup['name'])[0])[0]); ?>">
                                <i class="fa fa-edit text-white"></i></a>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal_edit_<?php echo e(preg_split('/[^\w]/',explode('.',$backup['name'])[0])[0]); ?>" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                            <div class="modal-content">
                                                <form action="<?php echo e(route('database_updation')); ?>" method="POST" id="edit_form<?php echo e(explode('.',$backup['name'])[0]); ?>">
                                                <?php echo e(csrf_field()); ?>

                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Database Edit</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" class="form-control"
                                                            name="db_name"
                                                            placeholder="Enter Database Name"
                                                            value="<?php echo e($backup['name']); ?>"
                                                            id="db_name_<?php echo e(explode('.',$backup['name'])[0]); ?>">
                                                        <label>Database Name</label>
                                                        <input type="text" class="form-control" name="db_name_edit"
                                                            placeholder="Enter Database Name"
                                                            maxLength="50" value="<?php echo e(explode('.',$backup['name'])[0]); ?>"
                                                            id="db_name_edit_<?php echo e(explode('.',$backup['name'])[0]); ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" id="modal_edit"
                                                            class="btn btn-success" formaction="<?php echo e(route('database_updation')); ?>">Ok</button>
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                    
                                                </form>
                                            </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <br><br>

        <?php if(count($backups)): ?>
            <input type="hidden" name="type" value="restore" id="type">
            <!-- <a href="" class="btn btn-danger" disabled="disabled">
                                                                                                                                                                                                                                                                                                                                                    <i class="fa fa-remove"></i>
                                                                                                                                                                                                                                                                                                                                                    <small><strong>Delete</strong></small>
                                                                                                                                                                                                                                                                                                                                            </a> -->
            <div class="pull-right" style="margin-right: 15px;">
                
                <button type="button" id="btnReset" class="btn btn-danger">
                    <i class="fa fa-remove"></i>
                    <small><strong>Reset</strong></small>
                </button>
                <button type="submit" id="btnSubmit" class="btn btn-success" disabled="disabled" form="frm" formaction="<?php echo e(route('backupmanager_restore_delete')); ?>" >
                    <i class="fa fa-refresh"></i>
                    <small><strong>Restore</strong></small>
                </button>
                <button type="submit" id="btnDelete" class="btn btn-danger" disabled="disabled" form="frm" formaction="<?php echo e(route('backupmanager_restore_delete')); ?>" >
                    <i class="fa fa-remove"></i>
                    <small><strong>Delete</strong></small>
                </button>
            </div>
            <div class="clearfix"></div>
        <?php endif; ?>

    <!--</form>-->

    <div id="overlay">
        <div class="spinner"></div>
        <span class="overlay-message">Working, please wait...</span>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        #overlay {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 9999999999;
        }

        #overlay .overlay-message {
            position: fixed;
            left: 50%;
            top: 57%;
            height: 100px;
            width: 250px;
            margin-left: -120px;
            margin-top: -50px;
            color: #fff;
            font-size: 20px;
            text-align: center;
            font-weight: bold;
        }

        .spinner {
            position: fixed;
            left: 50%;
            top: 40%;
            height: 80px;
            width: 80px;
            margin-left: -40px;
            margin-top: -40px;
            -webkit-animation: rotation .9s infinite linear;
            -moz-animation: rotation .9s infinite linear;
            -o-animation: rotation .9s infinite linear;
            animation: rotation .9s infinite linear;
            border: 6px solid rgba(255, 255, 255, .15);
            border-top-color: rgba(255, 255, 255, .8);
            border-radius: 100%;
        }

        @-webkit-keyframes rotation {
            from {
                -webkit-transform: rotate(0deg);
            }

            to {
                -webkit-transform: rotate(359deg);
            }
        }

        @-moz-keyframes rotation {
            from {
                -moz-transform: rotate(0deg);
            }

            to {
                -moz-transform: rotate(359deg);
            }
        }

        @-o-keyframes rotation {
            from {
                -o-transform: rotate(0deg);
            }

            to {
                -o-transform: rotate(359deg);
            }
        }

        @keyframes  rotation {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(359deg);
            }
        }

        table.dataTable tr.group td {
            background-image: radial-gradient(#fff, #eee);
            border: none;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $('.table').DataTable({
            "order": [],
            "responsive": true,
            "pageLength": 10,
            "autoWidth": false,
            aoColumnDefs: [{
                bSortable: false,
                aTargets: [-1]
            }],
            rowGroup: {
                dataSrc: 2
            }
        });

        var $btnSubmit = $('#btnSubmit');
        var $btnDelete = $('#btnDelete');
        var $btnReset = $('#btnReset');
        var $type = $('#type');
        var type = 'restore';

        $btnSubmit.on('click', function() {
            $type.val('restore');
            type = 'restore';
        });

        $btnReset.on('click', function() {
            $type.val('reset');
            type = "reset";
        });

        $btnDelete.on('click', function() {
            $type.val('delete');
            type = 'delete';
        });

        $(document).on('click', '.chkBackup', function() {
            var checkedCount = $('.chkBackup:checked').length;

            if (checkedCount > 0) {
                $btnSubmit.attr('disabled', false);
                $btnDelete.attr('disabled', false);
            } else {
                $btnSubmit.attr('disabled', true);
                $btnDelete.attr('disabled', true);
            }

            if (this.checked) {
                $(this).closest('tr').addClass('warning');
            } else {
                $(this).closest('tr').removeClass('warning');
            }
        });

        $('#frm').submit(function() {
            var $this = this;
            var checkedCount = $('.chkBackup:checked').length;
            var $btn = $('#btnSubmit');

            console.log("TYPEEEEEEE", type);

            if (!checkedCount) {
                swal("Please select backup(s) first!");
                return false;
            }

            if (checkedCount > 2 && type === 'restore') {
                swal("Please select one or two backups max.");
                return false;
            }

            var msg = 'Continue with restoration process ?';

            if (type === 'delete') {
                msg = 'Are you sure you want to delete selected backups ?';
            }




            swal({
                title: "Confirm",
                text: msg,
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then(function(response) {
                if (response) {
                    $btn.attr('disabled', true);

                    $this.submit();

                    showOverlay();
                }
            });

            return false;
        });

        $btnReset.on('click', function() {

            console.log("RESETTTTT", type);
            var msg = "Are you sure you want to reset database ?";
            swal({
                title: "Confirm",
                text: msg,
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then(function(response) {
                if (response) {
                    window.location.href = "<?php echo e(route('reset_data')); ?>";
                    showOverlay();
                }
            });
        });
        
        $('#modal_edit').on('click',function(){
            console.log("CLICKED",$(this).attr('class'));
            // console.log("DB_NAME",$('#db_name').val());
            
            // console.log("EDIT_DB_NAME",$('#db_name_edit').val());
            // $.ajax({
                
            //     type:"POST",
            //     url:"<?php echo e(route('database_updation')); ?>",
            //     data:{
            //         "_token":"<?php echo e(csrf_token()); ?>",
                    
            //     }
            // })
        });

        // $('#frmNew').submit(function() {
        //     this.submit();

        //     showOverlay();
        // });

        // $('#modal_submit').on('click', function() {
        //     var input_value = $('#db_name').val();
        //     $.ajax({
        //         url: "<?php echo e(route('backupmanager_create')); ?>",
        //         type: "POST",
        //         data: {
        //             "_token": "<?php echo e(csrf_token()); ?>",
        //             database_name: input_value
        //         },
        //         success: function() {}
        //     });
        // });


        function showOverlay() {
            $('#overlay').show();
        }

        function hideOverlay() {
            $('#overlay').show();
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backupmanager::layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\influencer_app\vendor\sarfraznawaz2005\backupmanager\src/Views/index.blade.php ENDPATH**/ ?>