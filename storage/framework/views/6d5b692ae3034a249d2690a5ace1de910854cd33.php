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
<h3>Gallery list</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>

<li class="breadcrumb-item active">Multiple Images</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
     
      <div class="col-sm-12">
         <div class="card">
            <div class="card-body">
               <div class="row csv-button-row">
                  <div class="col-lg-12">
                  <div class="row">
                  <div class="col-sm-12">
                     <div class="">
                        
                        <div class="card-body">
                           <form class="needs-validation" action="<?php echo e(route('back.item.images.multiple')); ?>" method="post" enctype="multipart/form-data">
                              <?php echo csrf_field(); ?>
                              <div class="row">
                                 <!--  -->
                                    <?php if($errors->any()): ?>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="alert alert-danger alert-dismissible p-2">
                                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                       <strong>Error!</strong> <?php echo e($error); ?>.
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                  <!--  -->
                                 <div class="col-md-4 mb-3">
                                    <label for="validationCustom01">Gallery Images</label>
                                    <input class="form-control" name="images[]" type="file" placeholder="Images" accept="image/*" required="" multiple>
                                 </div>
                                 <div class="col-md-2 mb-3" style="margin-top: 29px;">
                                    <button class="btn btn-primary" type="submit">Upload</button>
                                 </div>
                                 
                              </div>
                              <div class="mb-3">
                                 
                              </div>
                              
                           </form>
                        </div>
                     </div>
                     
                  </div>
	</div>
                  </div>
                  
                  
               </div>
            

            
            
               <div class="table-responsive product-table">
               <?php if($message = Session::get('success')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <p><?php echo e($message); ?></p>
                    </div>
                <?php endif; ?>
                <?php if($message = Session::get('error')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <p><?php echo e($message); ?></p>
                    </div>
                <?php endif; ?>
                  
               </div>
                <div class="container">
                    <div class="row">
                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-3 mb-2 mt-2">
                                    <div class="row">
                                    <div class="image-box" style="position:relative;">
                                        <img src="<?php echo e(isset($image->image) ? (file_exists(public_path('/assets/images/gallery_images/'. $image->image)) ? asset('/assets/images/gallery_images/' . $image->image) : asset('images/brand/thumbnail.png')) : asset('images/brand/thumbnail.png')); ?>" alt="" height="200" width="200">

                                        
                                        <a href="<?php echo e(route('remove.image',$image->id)); ?>"><i class="fa fa-trash" style="position:absolute;margin-left: -24px;margin-top:11px"></i></a>
                                    </div>
                                    </div>
                                    <div class="row">
                                       <p class="text-center"><?php echo e($image->image); ?></p>
                                    </div>
                                    
                                    
                                    <br>
                                </div>
                                
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <?php echo e($images->links()); ?>

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
    setTimeout(function() {
    $('.alert-success').fadeOut('fast');
}, 3000);
</script>
<script>
    setTimeout(function() {
    $('.alert-danger').fadeOut('fast');
}, 3000);
</script>
<?php $__env->stopSection(); ?>
<?php else: ?>
<script>
    window.location.href = "<?php echo e(route('notfound')); ?>";
   
</script>
<?php endif; ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\influencer_app\resources\views/images_gallery/index.blade.php ENDPATH**/ ?>