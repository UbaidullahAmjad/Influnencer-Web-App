<?php if(auth()->user()->user_type != 2): ?>

<?php $__env->startSection('title', 'Validation Forms'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Edit Brand</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('brands.index')); ?>">Brand List</a></li>
<li class="breadcrumb-item active">Edit Brand</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-body">
                    <div class="container">
                        <div class="d-flex flex-row-reverse">
                            <a class="p-1" href="<?php echo e(route('brands.index')); ?>"><button
                                    class="btn btn-primary">Back</button></a>
                        </div>
                        <form id="brand_form" class="needs-validation" action="<?php echo e(route('brands.update',$brands->id)); ?>"
                            method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="row">
                                <!-- <img src="<?php echo e(asset('images/brand/'.$brands->image)); ?>"> -->
                                <div class="col-md-12 mb-3">
                                    <!--  -->
                                    <?php if($errors->any()): ?>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="alert alert-danger alert-dismissible p-2">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                                        <strong>Error!</strong> <?php echo e($error); ?>.
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                    <?php if($message = Session::get('error')): ?>
                                    <div class="alert alert-danger">
                                        <p><?php echo e($message); ?></p>
                                    </div>
                                    <?php endif; ?>

                                    <?php if($message = Session::get('success')): ?>
                                    <div class="alert alert-success">
                                        <p><?php echo e($message); ?></p>
                                    </div>
                                    <?php endif; ?>
                                    <!--  -->
                                    <p class="text-center" p style="font-weight: bold;font-size: 15px;"><label
                                            class="text-center" for="validationCustom01">Brand Logo</label></p>
                                    <p class="text-center"><img
                                            src="<?php echo e(isset($brands->image) ? (file_exists(public_path('images/brand/'.$brands->image)) ? asset('images/brand/'.$brands->image) : asset('images/brand/thumbnail.png')) : asset('images/brand/thumbnail.png')); ?>"
                                            id="img" class="mb-2" height="200" width="200"></p>
                                    <input class="form-control" id="img" onchange="readURL(this)" name="image"
                                        type="file" placeholder="Brand Logo" accept="image/*">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p style="font-weight: bold;font-size: 15px;">Company Name*</p>
                                    <input class="form-control" id="validationCustom02"
                                        value="<?php echo e($brands->company_name); ?>" name="company_name" type="text"
                                        placeholder="Company Name" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p style="font-weight: bold;font-size: 15px;">Country</p>
                                    <select class="js-example-placeholder-multiple col-sm-8 form-control"
                                        name="country">
                                        <option value="Afganistan"
                                            <?php echo e($brands->country == 'Afganistan' ? 'selected' : ''); ?>>Afghanistan</option>
                                        <option value="Albania" <?php echo e($brands->country == 'Albania' ? 'selected' : ''); ?>>
                                            Albania</option>
                                        <option value="Algeria" <?php echo e($brands->country == 'Algeria' ? 'selected' : ''); ?>>
                                            Algeria</option>
                                        <option value="American Samoa"
                                            <?php echo e($brands->country == 'American Samoa' ? 'selected' : ''); ?>>American Samoa
                                        </option>
                                        <option value="Andorra" <?php echo e($brands->country == 'Andorra' ? 'selected' : ''); ?>>
                                            Andorra</option>
                                        <option value="Angola" <?php echo e($brands->country == 'Angola' ? 'selected' : ''); ?>>Angola
                                        </option>
                                        <option value="Anguilla" <?php echo e($brands->country == 'Anguilla' ? 'selected' : ''); ?>>
                                            Anguilla</option>
                                        <option value="Antigua & Barbuda"
                                            <?php echo e($brands->country == 'Antigua & Barbuda' ? 'selected' : ''); ?>>Antigua &
                                            Barbuda</option>
                                        <option value="Argentina" <?php echo e($brands->country == 'Argentina' ? 'selected' : ''); ?>>
                                            Argentina</option>
                                        <option value="Armenia" <?php echo e($brands->country == 'Armenia' ? 'selected' : ''); ?>>
                                            Armenia</option>
                                        <option value="Aruba" <?php echo e($brands->country == 'Aruba' ? 'selected' : ''); ?>>Aruba
                                        </option>
                                        <option value="Australia" <?php echo e($brands->country == 'Australia' ? 'selected' : ''); ?>>
                                            Australia</option>
                                        <option value="Austria" <?php echo e($brands->country == 'Austria' ? 'selected' : ''); ?>>
                                            Austria</option>
                                        <option value="Azerbaijan"
                                            <?php echo e($brands->country == 'Azerbaijan' ? 'selected' : ''); ?>>Azerbaijan</option>
                                        <option value="Bahamas" <?php echo e($brands->country == 'Bahamas' ? 'selected' : ''); ?>>
                                            Bahamas</option>
                                        <option value="Bahrain" <?php echo e($brands->country == 'Bahrain' ? 'selected' : ''); ?>>
                                            Bahrain</option>
                                        <option value="Bangladesh"
                                            <?php echo e($brands->country == 'Bangladesh' ? 'selected' : ''); ?>>Bangladesh</option>
                                        <option value="Barbados" <?php echo e($brands->country == 'Barbados' ? 'selected' : ''); ?>>
                                            Barbados</option>
                                        <option value="Belarus" <?php echo e($brands->country == 'Belarus' ? 'selected' : ''); ?>>
                                            Belarus</option>
                                        <option value="Belgium" <?php echo e($brands->country == 'Belgium' ? 'selected' : ''); ?>>
                                            Belgium</option>
                                        <option value="Belize" <?php echo e($brands->country == 'Belize' ? 'selected' : ''); ?>>Belize
                                        </option>
                                        <option value="Benin" <?php echo e($brands->country == 'Benin' ? 'selected' : ''); ?>>Benin
                                        </option>
                                        <option value="Bermuda" <?php echo e($brands->country == 'Bermuda' ? 'selected' : ''); ?>>
                                            Bermuda</option>
                                        <option value="Bhutan" <?php echo e($brands->country == 'Bhutan' ? 'selected' : ''); ?>>Bhutan
                                        </option>
                                        <option value="Bolivia" <?php echo e($brands->country == 'Bolivia' ? 'selected' : ''); ?>>
                                            Bolivia</option>
                                        <option value="Bonaire" <?php echo e($brands->country == 'Bonaire' ? 'selected' : ''); ?>>
                                            Bonaire</option>
                                        <option value="Bosnia & Herzegovina"
                                            <?php echo e($brands->country == 'Bosnia & Herzegovina' ? 'selected' : ''); ?>>Bosnia &
                                            Herzegovina</option>
                                        <option value="Botswana" <?php echo e($brands->country == 'Fiji' ? 'selected' : ''); ?>>
                                            Botswana</option>
                                        <option value="Brazil" <?php echo e($brands->country == 'Brazil' ? 'selected' : ''); ?>>Brazil
                                        </option>
                                        <option value="British Indian Ocean Ter"
                                            <?php echo e($brands->country == 'British Indian Ocean Ter' ? 'selected' : ''); ?>>British
                                            Indian Ocean Ter</option>
                                        <option value="Brunei" <?php echo e($brands->country == 'Brunei' ? 'selected' : ''); ?>>Brunei
                                        </option>
                                        <option value="Bulgaria" <?php echo e($brands->country == 'Bulgaria' ? 'selected' : ''); ?>>
                                            Bulgaria</option>
                                        <option value="Burkina Faso"
                                            <?php echo e($brands->country == 'Burkina Faso' ? 'selected' : ''); ?>>Burkina Faso
                                        </option>
                                        <option value="Burundi" <?php echo e($brands->country == 'Burundi' ? 'selected' : ''); ?>>
                                            Burundi</option>
                                        <option value="Cambodia" <?php echo e($brands->country == 'Cambodia' ? 'selected' : ''); ?>>
                                            Cambodia</option>
                                        <option value="Cameroon" <?php echo e($brands->country == 'Cameroon' ? 'selected' : ''); ?>>
                                            Cameroon</option>
                                        <option value="Canada" <?php echo e($brands->country == 'Canada' ? 'selected' : ''); ?>>Canada
                                        </option>
                                        <option value="Canary Islands"
                                            <?php echo e($brands->country == 'Canary Islands' ? 'selected' : ''); ?>>Canary Islands
                                        </option>
                                        <option value="Cape Verde"
                                            <?php echo e($brands->country == 'Cape Verde' ? 'selected' : ''); ?>>Cape Verde</option>
                                        <option value="Cayman Islands"
                                            <?php echo e($brands->country == 'Cayman Islands' ? 'selected' : ''); ?>>Cayman Islands
                                        </option>
                                        <option value="Central African Republic"
                                            <?php echo e($brands->country == 'Fiji' ? 'selected' : ''); ?>>Central African Republic
                                        </option>
                                        <option value="Chad" <?php echo e($brands->country == 'Chad' ? 'selected' : ''); ?>>Chad
                                        </option>
                                        <option value="Channel Islands"
                                            <?php echo e($brands->country == 'Channel Islands' ? 'selected' : ''); ?>>Channel Islands
                                        </option>
                                        <option value="Chile" <?php echo e($brands->country == 'Chile' ? 'selected' : ''); ?>>Chile
                                        </option>
                                        <option value="China" <?php echo e($brands->country == 'China' ? 'selected' : ''); ?>>China
                                        </option>
                                        <option value="Christmas Island"
                                            <?php echo e($brands->country == 'Christmas Island' ? 'selected' : ''); ?>>Christmas
                                            Island</option>
                                        <option value="Cocos Island"
                                            <?php echo e($brands->country == 'Cocos Island' ? 'selected' : ''); ?>>Cocos Island
                                        </option>
                                        <option value="Colombia" <?php echo e($brands->country == 'Colombia' ? 'selected' : ''); ?>>
                                            Colombia</option>
                                        <option value="Comoros" <?php echo e($brands->country == 'Comoros' ? 'selected' : ''); ?>>
                                            Comoros</option>
                                        <option value="Congo" <?php echo e($brands->country == 'Congo' ? 'selected' : ''); ?>>Congo
                                        </option>
                                        <option value="Cook Islands"
                                            <?php echo e($brands->country == 'Cook Islands' ? 'selected' : ''); ?>>Cook Islands
                                        </option>
                                        <option value="Costa Rica"
                                            <?php echo e($brands->country == 'Costa Rica' ? 'selected' : ''); ?>>Costa Rica</option>
                                        <option value="Cote DIvoire"
                                            <?php echo e($brands->country == 'Cote DIvoire' ? 'selected' : ''); ?>>Cote DIvoire
                                        </option>
                                        <option value="Croatia" <?php echo e($brands->country == 'Croatia' ? 'selected' : ''); ?>>
                                            Croatia</option>
                                        <option value="Cuba" <?php echo e($brands->country == 'Cuba' ? 'selected' : ''); ?>>Cuba
                                        </option>
                                        <option value="Curaco" <?php echo e($brands->country == 'Curacao' ? 'selected' : ''); ?>>
                                            Curacao</option>
                                        <option value="Cyprus" <?php echo e($brands->country == 'Cyprus' ? 'selected' : ''); ?>>Cyprus
                                        </option>
                                        <option value="Czech Republic"
                                            <?php echo e($brands->country == 'Czech Republic' ? 'selected' : ''); ?>>Czech Republic
                                        </option>
                                        <option value="Denmark" <?php echo e($brands->country == 'Denmark' ? 'selected' : ''); ?>>
                                            Denmark</option>
                                        <option value="Djibouti" <?php echo e($brands->country == 'Djibouti' ? 'selected' : ''); ?>>
                                            Djibouti</option>
                                        <option value="Dominica" <?php echo e($brands->country == 'Dominica' ? 'selected' : ''); ?>>
                                            Dominica</option>
                                        <option value="Dominican Republic"
                                            <?php echo e($brands->country == 'Dominican Republic' ? 'selected' : ''); ?>>Dominican
                                            Republic</option>
                                        <option value="East Timor"
                                            <?php echo e($brands->country == 'East Timor' ? 'selected' : ''); ?>>East Timor</option>
                                        <option value="Ecuador" <?php echo e($brands->country == 'Ecuador' ? 'selected' : ''); ?>>
                                            Ecuador</option>
                                        <option value="Egypt" <?php echo e($brands->country == 'Egypt' ? 'selected' : ''); ?>>Egypt
                                        </option>
                                        <option value="El Salvador"
                                            <?php echo e($brands->country == 'El Salvador' ? 'selected' : ''); ?>>El Salvador</option>
                                        <option value="Equatorial Guinea"
                                            <?php echo e($brands->country == 'Equatorial Guinea' ? 'selected' : ''); ?>>Equatorial
                                            Guinea</option>
                                        <option value="Eritrea" <?php echo e($brands->country == 'Eritrea' ? 'selected' : ''); ?>>
                                            Eritrea</option>
                                        <option value="Estonia" <?php echo e($brands->country == 'Estonia' ? 'selected' : ''); ?>>
                                            Estonia</option>
                                        <option value="Ethiopia" <?php echo e($brands->country == 'Ethiopia' ? 'selected' : ''); ?>>
                                            Ethiopia</option>
                                        <option value="Falkland Islands"
                                            <?php echo e($brands->country == 'Falkland Islands' ? 'selected' : ''); ?>>Falkland
                                            Islands</option>
                                        <option value="Faroe Islands"
                                            <?php echo e($brands->country == 'Faroe Islands' ? 'selected' : ''); ?>>Faroe Islands
                                        </option>
                                        <option value="Fiji" <?php echo e($brands->country == 'Fiji' ? 'selected' : ''); ?>>Fiji
                                        </option>
                                        <option value="Finland" <?php echo e($brands->country == 'Finland' ? 'selected' : ''); ?>>
                                            Finland</option>
                                        <option value="France" <?php echo e($brands->country == 'France' ? 'selected' : ''); ?>>France
                                        </option>
                                        <option value="French Guiana"
                                            <?php echo e($brands->country == 'French Guiana' ? 'selected' : ''); ?>>French Guiana
                                        </option>
                                        <option value="French Polynesia"
                                            <?php echo e($brands->country == 'French Polynesia' ? 'selected' : ''); ?>>French
                                            Polynesia</option>
                                        <option value="French Southern Ter"
                                            <?php echo e($brands->country == 'French Southern Ter' ? 'selected' : ''); ?>>French
                                            Southern Ter</option>
                                        <option value="Gabon" <?php echo e($brands->country == 'Gabon' ? 'selected' : ''); ?>>Gabon
                                        </option>
                                        <option value="Gambia" <?php echo e($brands->country == 'Gambia' ? 'selected' : ''); ?>>Gambia
                                        </option>
                                        <option value="Georgia" <?php echo e($brands->country == 'Georgia' ? 'selected' : ''); ?>>
                                            Georgia</option>
                                        <option value="Germany" <?php echo e($brands->country == 'Germany' ? 'selected' : ''); ?>>
                                            Germany</option>
                                        <option value="Ghana" <?php echo e($brands->country == 'Ghana' ? 'selected' : ''); ?>>Ghana
                                        </option>
                                        <option value="Gibraltar" <?php echo e($brands->country == 'Gibraltar' ? 'selected' : ''); ?>>
                                            Gibraltar</option>
                                        <option value="Great Britain"
                                            <?php echo e($brands->country == 'Great Britain' ? 'selected' : ''); ?>>Great Britain
                                        </option>
                                        <option value="Greece" <?php echo e($brands->country == 'Greece' ? 'selected' : ''); ?>>Greece
                                        </option>
                                        <option value="Greenland" <?php echo e($brands->country == 'Greenland' ? 'selected' : ''); ?>>
                                            Greenland</option>
                                        <option value="Grenada" <?php echo e($brands->country == 'Grenada' ? 'selected' : ''); ?>>
                                            Grenada</option>
                                        <option value="Guadeloupe"
                                            <?php echo e($brands->country == 'Guadeloupe' ? 'selected' : ''); ?>>Guadeloupe</option>
                                        <option value="Guam" <?php echo e($brands->country == 'Guam' ? 'selected' : ''); ?>>Guam
                                        </option>
                                        <option value="Guatemala" <?php echo e($brands->country == 'Guatemala' ? 'selected' : ''); ?>>
                                            Guatemala</option>
                                        <option value="Guinea" <?php echo e($brands->country == 'Guinea' ? 'selected' : ''); ?>>Guinea
                                        </option>
                                        <option value="Guyana" <?php echo e($brands->country == 'Guyana' ? 'selected' : ''); ?>>Guyana
                                        </option>
                                        <option value="Haiti" <?php echo e($brands->country == 'Haiti' ? 'selected' : ''); ?>>Haiti
                                        </option>
                                        <option value="Hawaii" <?php echo e($brands->country == 'Hawaii' ? 'selected' : ''); ?>>Hawaii
                                        </option>
                                        <option value="Honduras" <?php echo e($brands->country == 'Honduras' ? 'selected' : ''); ?>>
                                            Honduras</option>
                                        <option value="Hong Kong" <?php echo e($brands->country == 'Hong Kong' ? 'selected' : ''); ?>>
                                            Hong Kong</option>
                                        <option value="Hungary" <?php echo e($brands->country == 'Hungary' ? 'selected' : ''); ?>>
                                            Hungary</option>
                                        <option value="Iceland" <?php echo e($brands->country == 'Iceland' ? 'selected' : ''); ?>>
                                            Iceland</option>
                                        <option value="Indonesia" <?php echo e($brands->country == 'Indonesia' ? 'selected' : ''); ?>>
                                            Indonesia</option>
                                        <option value="India" <?php echo e($brands->country == 'India' ? 'selected' : ''); ?>>India
                                        </option>
                                        <option value="Iran" <?php echo e($brands->country == 'Iran' ? 'selected' : ''); ?>>Iran
                                        </option>
                                        <option value="Iraq" <?php echo e($brands->country == 'Iraq' ? 'selected' : ''); ?>>Iraq
                                        </option>
                                        <option value="Ireland" <?php echo e($brands->country == 'Ireland' ? 'selected' : ''); ?>>
                                            Ireland</option>
                                        <option value="Isle of Man"
                                            <?php echo e($brands->country == 'Isle of Man' ? 'selected' : ''); ?>>Isle of Man</option>
                                        <option value="Israel" <?php echo e($brands->country == 'Israel' ? 'selected' : ''); ?>>Israel
                                        </option>
                                        <option value="Italy" <?php echo e($brands->country == 'Italy' ? 'selected' : ''); ?>>Italy
                                        </option>
                                        <option value="Jamaica" <?php echo e($brands->country == 'Jamaica' ? 'selected' : ''); ?>>
                                            Jamaica</option>
                                        <option value="Japan" <?php echo e($brands->country == 'Japan' ? 'selected' : ''); ?>>Japan
                                        </option>
                                        <option value="Jordan" <?php echo e($brands->country == 'Jordan' ? 'selected' : ''); ?>>Jordan
                                        </option>
                                        <option value="Kazakhstan"
                                            <?php echo e($brands->country == 'Kazakhstan' ? 'selected' : ''); ?>>Kazakhstan</option>
                                        <option value="Kenya" <?php echo e($brands->country == 'Kenya' ? 'selected' : ''); ?>>Kenya
                                        </option>
                                        <option value="Kiribati" <?php echo e($brands->country == 'Kiribati' ? 'selected' : ''); ?>>
                                            Kiribati</option>
                                        <option value="Korea North"
                                            <?php echo e($brands->country == 'Korea North' ? 'selected' : ''); ?>>Korea North</option>
                                        <option value="Korea Sout"
                                            <?php echo e($brands->country == 'Korea South' ? 'selected' : ''); ?>>Korea South</option>
                                        <option value="Kuwait" <?php echo e($brands->country == 'Kuwait' ? 'selected' : ''); ?>>Kuwait
                                        </option>
                                        <option value="Kyrgyzstan"
                                            <?php echo e($brands->country == 'Kyrgyzstan' ? 'selected' : ''); ?>>Kyrgyzstan</option>
                                        <option value="Laos" <?php echo e($brands->country == 'Laos' ? 'selected' : ''); ?>>Laos
                                        </option>
                                        <option value="Latvia" <?php echo e($brands->country == 'Latvia' ? 'selected' : ''); ?>>Latvia
                                        </option>
                                        <option value="Lebanon" <?php echo e($brands->country == 'Lebanon' ? 'selected' : ''); ?>>
                                            Lebanon</option>
                                        <option value="Lesotho" <?php echo e($brands->country == 'Lesotho' ? 'selected' : ''); ?>>
                                            Lesotho</option>
                                        <option value="Liberia" <?php echo e($brands->country == 'Liberia' ? 'selected' : ''); ?>>
                                            Liberia</option>
                                        <option value="Libya" <?php echo e($brands->country == 'Libya' ? 'selected' : ''); ?>>Libya
                                        </option>
                                        <option value="Liechtenstein" <?php echo e($brands->country == 'Fiji' ? 'selected' : ''); ?>>
                                            Liechtenstein</option>
                                        <option value="Lithuania" <?php echo e($brands->country == 'Fiji' ? 'selected' : ''); ?>>
                                            Lithuania</option>
                                        <option value="Luxembourg" <?php echo e($brands->country == 'Fiji' ? 'selected' : ''); ?>>
                                            Luxembourg</option>
                                        <option value="Macau" <?php echo e($brands->country == 'Macau' ? 'selected' : ''); ?>>Macau
                                        </option>
                                        <option value="Macedonia" <?php echo e($brands->country == 'Macedonia' ? 'selected' : ''); ?>>
                                            Macedonia</option>
                                        <option value="Madagascar"
                                            <?php echo e($brands->country == 'Madagascar' ? 'selected' : ''); ?>>Madagascar</option>
                                        <option value="Malaysia" <?php echo e($brands->country == 'Malaysia' ? 'selected' : ''); ?>>
                                            Malaysia</option>
                                        <option value="Malawi" <?php echo e($brands->country == 'Malawi' ? 'selected' : ''); ?>>Malawi
                                        </option>
                                        <option value="Maldives" <?php echo e($brands->country == 'Maldives' ? 'selected' : ''); ?>>
                                            Maldives</option>
                                        <option value="Mali" <?php echo e($brands->country == 'Mali' ? 'selected' : ''); ?>>Mali
                                        </option>
                                        <option value="Malta" <?php echo e($brands->country == 'Malta' ? 'selected' : ''); ?>>Malta
                                        </option>
                                        <option value="Marshall Islands"
                                            <?php echo e($brands->country == 'Marshall Islands' ? 'selected' : ''); ?>>Marshall
                                            Islands</option>
                                        <option value="Martinique"
                                            <?php echo e($brands->country == 'Martinique' ? 'selected' : ''); ?>>Martinique</option>
                                        <option value="Mauritania"
                                            <?php echo e($brands->country == 'Mauritania' ? 'selected' : ''); ?>>Mauritania</option>
                                        <option value="Mauritius" <?php echo e($brands->country == 'Mauritius' ? 'selected' : ''); ?>>
                                            Mauritius</option>
                                        <option value="Mayotte" <?php echo e($brands->country == 'Mayotte' ? 'selected' : ''); ?>>
                                            Mayotte</option>
                                        <option value="Mexico" <?php echo e($brands->country == 'Mexico' ? 'selected' : ''); ?>>Mexico
                                        </option>
                                        <option value="Midway Islands"
                                            <?php echo e($brands->country == 'Midway Islands' ? 'selected' : ''); ?>>Midway Islands
                                        </option>
                                        <option value="Moldova" <?php echo e($brands->country == 'Moldova' ? 'selected' : ''); ?>>
                                            Moldova</option>
                                        <option value="Monaco" <?php echo e($brands->country == 'Monaco' ? 'selected' : ''); ?>>Monaco
                                        </option>
                                        <option value="Mongolia" <?php echo e($brands->country == 'Mongolia' ? 'selected' : ''); ?>>
                                            Mongolia</option>
                                        <option value="Montserrat"
                                            <?php echo e($brands->country == 'Montserrat' ? 'selected' : ''); ?>>Montserrat</option>
                                        <option value="Morocco" <?php echo e($brands->country == 'Morocco' ? 'selected' : ''); ?>>
                                            Morocco</option>
                                        <option value="Mozambique"
                                            <?php echo e($brands->country == 'Mozambique' ? 'selected' : ''); ?>>Mozambique</option>
                                        <option value="Myanmar" <?php echo e($brands->country == 'Myanmar' ? 'selected' : ''); ?>>
                                            Myanmar</option>
                                        <option value="Nambia" <?php echo e($brands->country == 'Nambia' ? 'selected' : ''); ?>>Nambia
                                        </option>
                                        <option value="Nauru" <?php echo e($brands->country == 'Nauru' ? 'selected' : ''); ?>>Nauru
                                        </option>
                                        <option value="Nepal" <?php echo e($brands->country == 'Nepal' ? 'selected' : ''); ?>>Nepal
                                        </option>
                                        <option value="Netherland Antilles"
                                            <?php echo e($brands->country == 'Netherland Antilles' ? 'selected' : ''); ?>>Netherland
                                            Antilles</option>
                                        <option value="Netherlands"
                                            <?php echo e($brands->country == 'Netherlands (Holland, Europe)' ? 'selected' : ''); ?>>
                                            Netherlands (Holland, Europe)</option>
                                        <option value="Nevis" <?php echo e($brands->country == 'Nevis' ? 'selected' : ''); ?>>Nevis
                                        </option>
                                        <option value="New Caledonia"
                                            <?php echo e($brands->country == 'New Caledonia' ? 'selected' : ''); ?>>New Caledonia
                                        </option>
                                        <option value="New Zealand"
                                            <?php echo e($brands->country == 'New Zealand' ? 'selected' : ''); ?>>New Zealand</option>
                                        <option value="Nicaragua" <?php echo e($brands->country == 'Nicaragua' ? 'selected' : ''); ?>>
                                            Nicaragua</option>
                                        <option value="Niger" <?php echo e($brands->country == 'Niger' ? 'selected' : ''); ?>>Niger
                                        </option>
                                        <option value="Nigeria" <?php echo e($brands->country == 'Nigeria' ? 'selected' : ''); ?>>
                                            Nigeria</option>
                                        <option value="Niue" <?php echo e($brands->country == 'Niue' ? 'selected' : ''); ?>>Niue
                                        </option>
                                        <option value="Norfolk Island"
                                            <?php echo e($brands->country == 'Norfolk Island' ? 'selected' : ''); ?>>Norfolk Island
                                        </option>
                                        <option value="Norway" <?php echo e($brands->country == 'Norway' ? 'selected' : ''); ?>>Norway
                                        </option>
                                        <option value="Oman" <?php echo e($brands->country == 'Oman' ? 'selected' : ''); ?>>Oman
                                        </option>
                                        <option value="Pakistan" <?php echo e($brands->country == 'Pakistan' ? 'selected' : ''); ?>>
                                            Pakistan</option>
                                        <option value="Palau Island"
                                            <?php echo e($brands->country == 'Palau Island' ? 'selected' : ''); ?>>Palau Island
                                        </option>
                                        <option value="Palestine" <?php echo e($brands->country == 'Palestine' ? 'selected' : ''); ?>>
                                            Palestine</option>
                                        <option value="Panama" <?php echo e($brands->country == 'Panama' ? 'selected' : ''); ?>>Panama
                                        </option>
                                        <option value="Papua New Guinea"
                                            <?php echo e($brands->country == 'Papua New Guinea' ? 'selected' : ''); ?>>Papua New
                                            Guinea</option>
                                        <option value="Paraguay" <?php echo e($brands->country == 'Paraguay' ? 'selected' : ''); ?>>
                                            Paraguay</option>
                                        <option value="Peru" <?php echo e($brands->country == 'Peru' ? 'selected' : ''); ?>>Peru
                                        </option>
                                        <option value="Phillipines"
                                            <?php echo e($brands->country == 'Philippines' ? 'selected' : ''); ?>>Philippines</option>
                                        <option value="Pitcairn Island"
                                            <?php echo e($brands->country == 'Pitcairn Island' ? 'selected' : ''); ?>>Pitcairn Island
                                        </option>
                                        <option value="Poland" <?php echo e($brands->country == 'Poland' ? 'selected' : ''); ?>>Poland
                                        </option>
                                        <option value="Portugal" <?php echo e($brands->country == 'Portugal' ? 'selected' : ''); ?>>
                                            Portugal</option>
                                        <option value="Puerto Rico"
                                            <?php echo e($brands->country == 'Puerto Rico' ? 'selected' : ''); ?>>Puerto Rico</option>
                                        <option value="Qatar" <?php echo e($brands->country == 'Qatar' ? 'selected' : ''); ?>>Qatar
                                        </option>
                                        <option value="Republic of Montenegro"
                                            <?php echo e($brands->country == 'Republic of Montenegro' ? 'selected' : ''); ?>>Republic
                                            of Montenegro</option>
                                        <option value="Republic of Serbia"
                                            <?php echo e($brands->country == 'Republic of Serbia' ? 'selected' : ''); ?>>Republic of
                                            Serbia</option>
                                        <option value="Reunion" <?php echo e($brands->country == 'Reunion' ? 'selected' : ''); ?>>
                                            Reunion</option>
                                        <option value="Romania" <?php echo e($brands->country == 'Romania' ? 'selected' : ''); ?>>
                                            Romania</option>
                                        <option value="Russia" <?php echo e($brands->country == 'Russia' ? 'selected' : ''); ?>>Russia
                                        </option>
                                        <option value="Rwanda" <?php echo e($brands->country == 'Rwanda' ? 'selected' : ''); ?>>Rwanda
                                        </option>
                                        <option value="St Barthelemy"
                                            <?php echo e($brands->country == 'St Barthelemy' ? 'selected' : ''); ?>>St Barthelemy
                                        </option>
                                        <option value="St Eustatius"
                                            <?php echo e($brands->country == 'St Eustatius' ? 'selected' : ''); ?>>St Eustatius
                                        </option>
                                        <option value="St Helena" <?php echo e($brands->country == 'St Helena' ? 'selected' : ''); ?>>
                                            St Helena</option>
                                        <option value="St Kitts-Nevis"
                                            <?php echo e($brands->country == 'St Kitts-Nevis' ? 'selected' : ''); ?>>St Kitts-Nevis
                                        </option>
                                        <option value="St Lucia" <?php echo e($brands->country == 'St Lucia' ? 'selected' : ''); ?>>St
                                            Lucia</option>
                                        <option value="St Maarten"
                                            <?php echo e($brands->country == 'St Maarten' ? 'selected' : ''); ?>>St Maarten</option>
                                        <option value="St Pierre & Miquelon"
                                            <?php echo e($brands->country == 'St Pierre & Miquelon' ? 'selected' : ''); ?>>St Pierre &
                                            Miquelon</option>
                                        <option value="St Vincent & Grenadines"
                                            <?php echo e($brands->country == 'St Vincent & Grenadines' ? 'selected' : ''); ?>>St
                                            Vincent & Grenadines</option>
                                        <option value="Saipan" <?php echo e($brands->country == 'Saipan' ? 'selected' : ''); ?>>Saipan
                                        </option>
                                        <option value="Samoa" <?php echo e($brands->country == 'Samoa' ? 'selected' : ''); ?>>Samoa
                                        </option>
                                        <option value="Samoa American"
                                            <?php echo e($brands->country == 'Samoa American' ? 'selected' : ''); ?>>Samoa American
                                        </option>
                                        <option value="San Marino" <?php echo e($brands->country == 'Fiji' ? 'selected' : ''); ?>>San
                                            Marino</option>
                                        <option value="Sao Tome & Principe"
                                            <?php echo e($brands->country == 'Sao Tome & Principe' ? 'selected' : ''); ?>>Sao Tome &
                                            Principe</option>
                                        <option value="Saudi Arabia"
                                            <?php echo e($brands->country == 'Saudi Arabia' ? 'selected' : ''); ?>>Saudi Arabia
                                        </option>
                                        <option value="Senegal" <?php echo e($brands->country == 'Senegal' ? 'selected' : ''); ?>>
                                            Senegal</option>
                                        <option value="Seychelles"
                                            <?php echo e($brands->country == 'Seychelles' ? 'selected' : ''); ?>>Seychelles</option>
                                        <option value="Sierra Leone"
                                            <?php echo e($brands->country == 'Sierra Leone' ? 'selected' : ''); ?>>Sierra Leone
                                        </option>
                                        <option value="Singapore" <?php echo e($brands->country == 'Singapore' ? 'selected' : ''); ?>>
                                            Singapore</option>
                                        <option value="Slovakia" <?php echo e($brands->country == 'Slovakia' ? 'selected' : ''); ?>>
                                            Slovakia</option>
                                        <option value="Slovenia" <?php echo e($brands->country == 'Slovenia' ? 'selected' : ''); ?>>
                                            Slovenia</option>
                                        <option value="Solomon Islands"
                                            <?php echo e($brands->country == 'Solomon Islands' ? 'selected' : ''); ?>>Solomon Islands
                                        </option>
                                        <option value="Somalia" <?php echo e($brands->country == 'Somalia' ? 'selected' : ''); ?>>
                                            Somalia</option>
                                        <option value="South Africa"
                                            <?php echo e($brands->country == 'South Africa' ? 'selected' : ''); ?>>South Africa
                                        </option>
                                        <option value="Spain" <?php echo e($brands->country == 'Spain' ? 'selected' : ''); ?>>Spain
                                        </option>
                                        <option value="Sri Lanka" <?php echo e($brands->country == 'Sri Lanka' ? 'selected' : ''); ?>>
                                            Sri Lanka</option>
                                        <option value="Sudan" <?php echo e($brands->country == 'Sudan' ? 'selected' : ''); ?>>Sudan
                                        </option>
                                        <option value="Suriname" <?php echo e($brands->country == 'Suriname' ? 'selected' : ''); ?>>
                                            Suriname</option>
                                        <option value="Swaziland" <?php echo e($brands->country == 'Swaziland' ? 'selected' : ''); ?>>
                                            Swaziland</option>
                                        <option value="Sweden" <?php echo e($brands->country == 'Sweden' ? 'selected' : ''); ?>>Sweden
                                        </option>
                                        <option value="Switzerland"
                                            <?php echo e($brands->country == 'Switzerland' ? 'selected' : ''); ?>>Switzerland</option>
                                        <option value="Syria" <?php echo e($brands->country == 'Syria' ? 'selected' : ''); ?>>Syria
                                        </option>
                                        <option value="Tahiti" <?php echo e($brands->country == 'Tahiti' ? 'selected' : ''); ?>>Tahiti
                                        </option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan"
                                            <?php echo e($brands->country == 'Tajikistan' ? 'selected' : ''); ?>>Tajikistan</option>
                                        <option value="Tanzania" <?php echo e($brands->country == 'Tanzania' ? 'selected' : ''); ?>>
                                            Tanzania</option>
                                        <option value="Thailand" <?php echo e($brands->country == 'Thailand' ? 'selected' : ''); ?>>
                                            Thailand</option>
                                        <option value="Togo" <?php echo e($brands->country == 'Togo' ? 'selected' : ''); ?>>Togo
                                        </option>
                                        <option value="Tokelau" <?php echo e($brands->country == 'Tokelau' ? 'selected' : ''); ?>>
                                            Tokelau</option>
                                        <option value="Tonga" <?php echo e($brands->country == 'Tonga' ? 'selected' : ''); ?>>Tonga
                                        </option>
                                        <option value="Trinidad & Tobago"
                                            <?php echo e($brands->country == 'Trinidad & Tobago' ? 'selected' : ''); ?>>Trinidad &
                                            Tobago</option>
                                        <option value="Tunisia" <?php echo e($brands->country == 'Tunisia' ? 'selected' : ''); ?>>
                                            Tunisia</option>
                                        <option value="Turkey" <?php echo e($brands->country == 'Turkey' ? 'selected' : ''); ?>>Turkey
                                        </option>
                                        <option value="Turkmenistan"
                                            <?php echo e($brands->country == 'Turkmenistan' ? 'selected' : ''); ?>>Turkmenistan
                                        </option>
                                        <option value="Turks & Caicos Is"
                                            <?php echo e($brands->country == 'Turks & Caicos Is' ? 'selected' : ''); ?>>Turks & Caicos
                                            Is</option>
                                        <option value="Tuvalu" <?php echo e($brands->country == 'Tuvalu' ? 'selected' : ''); ?>>Tuvalu
                                        </option>
                                        <option value="Uganda" <?php echo e($brands->country == 'Uganda' ? 'selected' : ''); ?>>Uganda
                                        </option>
                                        <option value="United Kingdom"
                                            <?php echo e($brands->country == 'United Kingdom' ? 'selected' : ''); ?>>United Kingdom
                                        </option>
                                        <option value="Ukraine" <?php echo e($brands->country == 'Ukraine' ? 'selected' : ''); ?>>
                                            Ukraine</option>
                                        <option value="United Arab Erimates"
                                            <?php echo e($brands->country == 'United Arab Emirates' ? 'selected' : ''); ?>>United Arab
                                            Emirates</option>
                                        <option value="United States of America"
                                            <?php echo e($brands->country == 'United States of America' ? 'selected' : ''); ?>>United
                                            States of America</option>
                                        <option value="Uraguay" <?php echo e($brands->country == 'Uruguay' ? 'selected' : ''); ?>>
                                            Uruguay</option>
                                        <option value="Uzbekistan"
                                            <?php echo e($brands->country == 'Uzbekistan' ? 'selected' : ''); ?>>Uzbekistan</option>
                                        <option value="Vanuatu" <?php echo e($brands->country == 'Vanuatu' ? 'selected' : ''); ?>>
                                            Vanuatu</option>
                                        <option value="Vatican City State"
                                            <?php echo e($brands->country == 'Vatican City State' ? 'selected' : ''); ?>>Vatican City
                                            State</option>
                                        <option value="Venezuela" <?php echo e($brands->country == 'Venezuela' ? 'selected' : ''); ?>>
                                            Venezuela</option>
                                        <option value="Vietnam" <?php echo e($brands->country == 'Vietnam' ? 'selected' : ''); ?>>
                                            Vietnam</option>
                                        <option value="Virgin Islands (Brit)"
                                            <?php echo e($brands->country == 'Virgin Islands (Brit)' ? 'selected' : ''); ?>>Virgin
                                            Islands (Brit)</option>
                                        <option value="Virgin Islands (USA)"
                                            <?php echo e($brands->country == 'Virgin Islands (USA)' ? 'selected' : ''); ?>>Virgin
                                            Islands (USA)</option>
                                        <option value="Wake Island"
                                            <?php echo e($brands->country == 'Wake Island' ? 'selected' : ''); ?>>Wake Island</option>
                                        <option value="Wallis & Futana Is"
                                            <?php echo e($brands->country == 'Wallis & Futana Is' ? 'selected' : ''); ?>>Wallis &
                                            Futana Is</option>
                                        <option value="Yemen" <?php echo e($brands->country == 'Yemen' ? 'selected' : ''); ?>>Yemen
                                        </option>
                                        <option value="Zaire" <?php echo e($brands->country == 'Zaire' ? 'selected' : ''); ?>>Zaire
                                        </option>
                                        <option value="Zambia" <?php echo e($brands->country == 'Zambia' ? 'selected' : ''); ?>>Zambia
                                        </option>
                                        <option value="Zimbabwe" <?php echo e($brands->country == 'Zimbabwe' ? 'selected' : ''); ?>>
                                            Zimbabwe</option>

                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <p style="font-weight: bold;font-size: 15px;"> Status</p>
                                    <select class="js-example-placeholder-multiple col-sm-8 form-control" id="status"
                                        name="status" required="">
                                        <option value="1" <?php echo e($brands->status == 1 ? 'selected' : ''); ?>>Active</option>
                                        <option value="0" <?php echo e($brands->status == 0 ? 'selected' : ''); ?>>In Active</option>
                                    </select>
                                </div>
                            </div>
                            <?php if(isset($commission)): ?>
                            <?php if($commission->type == "fixed single"): ?>
                            <div class="row exsit_commission">
                                <?php $__currentLoopData = $singledata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datasingle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $datasingle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datasng): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($datasng->id): ?>
                                <div class="col-md-4">
                                    <p style="font-weight: bold;font-size: 15px;">Existing Fixed Commission Single Value:
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input class="form-control" id="single_value" name="single_value" type="number"
                                            step="any" value="<?php echo e($datasng->value); ?>">
                                    </div>
                                </div>
                            </div>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php if($commission->type == "Fixed  Dual"): ?>
                                <?php $__currentLoopData = $dualdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datadual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $datadual; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datadl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($datadl->id): ?>
                                <div class="row exsit_commission">
                                    <p style="font-weight: bold;font-size: 15px;">Existing Fixed Commission Dual Value:
                                    </p>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="fixed_dual_min_value"
                                                name="dual_min_value[]" type="number" step="any"
                                                value="<?php echo e($datadl->min_value); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="fixed_dual_max_value"
                                                name="dual_max_value[]" type="number" step="any"
                                                value="<?php echo e($datadl->max_value); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1" align="center">
                                        <p style="font-weight: bold;font-size: 15px;">=</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="fixed_dual_commission_value"
                                                name="dual_total_value[]" type="number" step="any"
                                                value="<?php echo e($datadl->total_value); ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php if($commission->type == "Fixed  Multiple"): ?>
                                <?php $__currentLoopData = $multipledata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datamultiple): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $datamultiple; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datamulti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($datamulti->id): ?>
                                <div class="row exsit_commission">
                                    <p style="font-weight: bold;font-size: 15px;">Existing Fixed Commission Multiple Value:
                                    </p>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="multiple_newuser_value"
                                                name="multiple_newuser_value" type="number" step="any"
                                                value="<?php echo e($datamulti->new_user); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="multiple_olduser_value"
                                                name="multiple_olduser_value" type="number" step="any"
                                                value="<?php echo e($datamulti->old_user); ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php if($commission->type == "Percentage Single"): ?>
                            
                                <?php $__currentLoopData = $singledata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datasingle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $datasingle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datasng): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($datasng->id): ?>
                                <div class="row exsit_commission">
                                    <div class="col-md-4">
                                        <label for="single_value">
                                            <p style="font-weight: bold;font-size: 15px;">Existing Percentage Commission
                                                Single Value:</p>
                                        </label>
                                        <div class="input-group">
                                            <input class="form-control" id="percentage_updated_single_value"
                                                name="percentage_updated_single_value" type="number" step="any"
                                                value="<?php echo e($datasng->value); ?>">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php if($commission->type == "Percentage Multiple"): ?>
                                <?php $__currentLoopData = $multipledata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datamultiple): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $datamultiple; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datamulti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($datamulti->id): ?>
                                <div class="row exsit_commission">
                                    <p style="font-weight: bold;font-size: 15px;">Existing Percentage Commission Multiple Value:</p>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input class="form-control" id="percentage_updated_multiple_newuser_value"
                                                name="percentage_updated_multiple_newuser_value" type="number" step="any"
                                                value="<?php echo e($datamulti->new_user); ?>">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input class="form-control" id="percentage_updated_multiple_olduser_value"
                                                name="percentage_updated_multiple_olduser_value" type="number" step="any"
                                                value="<?php echo e($datamulti->old_user); ?>">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <a class="btn btn-primary" id="change_commission" href="#">Change Commission</a>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="row exsit_commission ">
                                <div class="col-md-4 mt-3">
                                    <p style="font-weight: bold;font-size: 15px;"> No Existing Commission</p>
                                    <a class="btn btn-primary" id="add_change_commission" href="#">Add Commission</a>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="row change_commission" style="display:none;">
                                <div class="col-md-4">
                                    <?php if(isset($commission)): ?>
                                    <p style="font-weight: bold;font-size: 15px;"> Change Commission</p>
                                    <?php endif; ?>
                                    <?php if(!isset($commission)): ?>
                                    <p style="font-weight: bold;font-size: 15px;"> Add Commission</p>
                                    <?php endif; ?>
                                    <div class="btn-group dropend com_drop">
                                        <button type="button" class="btn dropdown-toggle dropdown_main"
                                            aria-expanded="false">
                                            Commission
                                        </button>
                                        <ul class="dropdown-menu main_dropmenu ">
                                            <li>
                                                <div class="btn-group dropend">
                                                    <button type="button" class="btn dropdown-toggle dropdown_fix"
                                                        aria-expanded="false">
                                                        Fixed
                                                    </button>
                                                    <ul class="dropdown-menu fix_dropmenu">
                                                        <?php if(isset($commission)): ?>
                                                        <?php if($commission->type != 'fixed single'): ?>
                                                        <li><a class="dropdown-item" href="" id="fixed_single" >Single</a></li>
                                                        <?php endif; ?>
                                                        <?php if($commission->type != 'Fixed  Dual'): ?>
                                                        <li><a class="dropdown-item" href="" id="fixed_dual">Dual</a></li>
                                                        <?php endif; ?>
                                                        <?php if($commission->type != 'Fixed  Multiple'): ?>
                                                        <li><a class="dropdown-item" href="" id="fixed_multiple">Multiple</a></li>
                                                        <?php endif; ?>
                                                        <?php else: ?>
                                                        <li><a class="dropdown-item" href="" id="fixed_single" >Single</a></li>
                                                        <li><a class="dropdown-item" href="" id="fixed_dual">Dual</a></li>
                                                        <li><a class="dropdown-item" href="" id="fixed_multiple">Multiple</a></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="btn-group dropend">
                                                    <button type="button"
                                                        class="btn dropdown-toggle dropdown_percentage"
                                                        aria-expanded="false">
                                                        Percentage
                                                    </button>
                                                    <ul class="dropdown-menu percentage_dropmenu">
                                                    <?php if(isset($commission)): ?>
                                                        <?php if($commission->type != 'Percentage Single' ): ?>
                                                        <li><a class="dropdown-item" href="" id="percentage_single">Single</a></li>
                                                        <?php endif; ?>
                                                        <?php if($commission->type != 'Percentage Multiple'): ?>
                                                        <li><a class="dropdown-item" href="" id="percentage_multiple">Multiple</a></li>
                                                        <?php endif; ?>
                                                        <?php else: ?>
                                                        <li><a class="dropdown-item" href="" id="percentage_single">Single</a></li>
                                                        <li><a class="dropdown-item" href="" id="percentage_multiple">Multiple</a></li>
                                                        <?php endif; ?>

                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="fixed_single_value_show" style="display:none;">
                                <div class="col-md-4">
                                    <label for="fixed_single_value">
                                        <p style="font-weight: bold;font-size: 15px;">Fixed Commission Single Value:</p>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input class="form-control" id="fixed_single_value" name="fixed_single_value"
                                            type="number" step="any" placeholder="Fixed Single Commission Value">
                                    </div>
                                </div>
                            </div>
                            <div id="fixed_dual_value_show" style="display:none;">
                                <div class="row" style="">
                                    <div class="col-md-11">
                                        <p style="font-weight: bold;font-size: 15px;">Fixed Commission Dual Value:</p>
                                    </div>
                                    <div class="col-md-1 mb-2" align="right">
                                        <a class="btn btn-primary" href="" id="add_row">
                                            <p style="font-weight: bold;font-size: 15px;">+</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="row mb-3" id="dual_data">
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="fixed_dual_min_value"
                                                name="fixed_dual_min_value[]" type="number" step="any"
                                                placeholder="Minimum Value">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="fixed_dual_max_value"
                                                name="fixed_dual_max_value[]" type="number" step="any"
                                                placeholder="Maximum Value">
                                        </div>
                                    </div>
                                    <div class="col-md-1" align="center">
                                        <p style="font-weight: bold;font-size: 15px;">=</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="fixed_dual_commission_value"
                                                name="fixed_dual_total_value[]" type="number" step="any"
                                                placeholder="Commission Value">
                                        </div>
                                    </div>
                                    <div class="col-md-1 offset-1" align="right">
                                        <a class="btn btn-danger" href="" id="removeRow">
                                            <p style="font-weight: bold;font-size: 15px;">-</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="fixed_multiple_value_show" style="display:none;">
                                <p style="font-weight: bold;font-size: 15px;">Fixed Commission Multiple Value:</p>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input class="form-control" id="fixed_multiple_newuser_value"
                                            name="fixed_multiple_newuser_value" type="number" step="any"
                                            placeholder="Fixed Multiple New User Commission Value">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input class="form-control" id="fixed_multiple_olduser_value"
                                            name="fixed_multiple_olduser_value" type="number" step="any"
                                            placeholder="Fixed Multiple Old User Commission Value">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="percentage_single_value_show" style="display:none;">
                                <div class="col-md-4">
                                    <p style="font-weight: bold;font-size: 15px;">Percentage Commission Single Value:</p>
                                    <div class="input-group">
                                        <input class="form-control" id="percentage_single_value"
                                            name="percentage_single_value" type="number" step="any"
                                            placeholder="Percentage Single Commission Value">
                                        <span class="input-group-text">%</span>

                                    </div>
                                </div>
                            </div>
                            <div class="row" id="percentage_multiple_value_show" style="display:none;">
                                <p style="font-weight: bold;font-size: 15px;">Percentage Commission Multiple Value:</p>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input class="form-control" id="percentage_multiple_newuser_value"
                                            name="percentage_multiple_newuser_value" type="number" step="any"
                                            placeholder="Percentage Multiple New User Commission Value">
                                        <span class="input-group-text">%</span>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input class="form-control" id="percentage_multiple_olduser_value"
                                            name="percentage_multiple_olduser_value" type="number" step="any"
                                            placeholder="Percentage Multiple Old User Commission Value">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mt-5 col-md-2">
                                    <button class="btn btn-success" id="update" type="button">Update</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$('#update').click(async function(event) {
    Swal.fire({
        title: 'Are you sure to Update the brand?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Update it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $("#brand_form").submit();
        }
    })
});
</script>
<script src="<?php echo e(asset('assets/js/form-validation-custom.js')); ?>"></script>
<script>
function readURL(input) {
    if (input.files && input.files[0]) {

        var reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector("#img").setAttribute("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
    $('#removeRow').css('display','none');
$(document).ready(function() {
    $("#change_commission").click(function() {
        event.preventDefault();
        $(".change_commission").show();
        $(this).hide();
        $(".exsit_commission").hide();

    });
    $("#add_change_commission").click(function() {
        event.preventDefault();
        $(".change_commission").show();
        $(this).hide();
        $(".exsit_commission").hide();

    });
    $(".dropdown_main").click(function() {
        $(".main_dropmenu").show();
    });
    $(".dropdown_fix").click(function() {
        $(".fix_dropmenu").show();
        $(".percentage_dropmenu").hide();
    });
    $(".dropdown_percentage").click(function() {
        $(".percentage_dropmenu").show();
        $(".fix_dropmenu").hide();

    });
    $("#fixed_single").click(function() {
        event.preventDefault();
        $("#fixed_single_value_show").show();
        $("#fixed_dual_value_show, #fixed_multiple_value_show, #percentage_multiple_value_show, #percentage_single_value_show, .dropdown-menu")
            .hide();
        $("#fixed_dual_value_show, #fixed_multiple_value_show, #percentage_multiple_value_show, #percentage_single_value_show")
            .find("input[type=number]").val("");

    });

    $("#fixed_dual").click(function() {
        event.preventDefault();
        $("#fixed_dual_value_show").show();
        $("#fixed_single_value_show, #fixed_multiple_value_show, #percentage_multiple_value_show, #percentage_single_value_show, .dropdown-menu")
            .hide();
        $("#fixed_single_value_show, #fixed_multiple_value_show, #percentage_multiple_value_show, #percentage_single_value_show")
            .find("input[type=number]").val("");

    });

    $("#fixed_multiple").click(function() {
        event.preventDefault();
        $("#fixed_multiple_value_show").show();
        $("#fixed_single_value_show, #fixed_dual_value_show, #percentage_multiple_value_show, #percentage_single_value_show, .dropdown-menu")
            .hide();
        $("#fixed_single_value_show, #fixed_dual_value_show, #percentage_multiple_value_show, #percentage_single_value_show")
            .find("input[type=number]").val("");
    });

    $("#percentage_single").click(function() {
        event.preventDefault();
        $("#percentage_single_value_show").show();
        $("#fixed_dual_value_show, #fixed_multiple_value_show, #percentage_multiple_value_show, #fixed_single_value_show, .dropdown-menu")
            .hide();
        $("#fixed_dual_value_show, #fixed_multiple_value_show, #percentage_multiple_value_show, #fixed_single_value_show")
            .find("input[type=number]").val("");
    });

    $("#percentage_multiple").click(function() {
        event.preventDefault();
        $("#percentage_multiple_value_show").show();
        $("#fixed_dual_value_show, #fixed_multiple_value_show, #fixed_single_value_show, #percentage_single_value_show, .dropdown-menu")
            .hide();
        $("#fixed_dual_value_show, #fixed_multiple_value_show, #fixed_single_value_show, #percentage_single_value_show")
            .find("input[type=number]").val("");
    });

    $("#add_row").click(function() {
        event.preventDefault();
        var form = $("#dual_data").eq(0).clone();
        form.find("input[type=number]").val("");
        form.show().insertBefore("#dual_data");
        $('#removeRow').css('display','block');

        // var $input = $('<input type="button" value="new button" />');
        // $input.appendTo("#removebutton");
    });
    $(document).on('click', '#removeRow', function () {
        event.preventDefault();
            $(this).closest('#dual_data').remove();
        });
});
</script>
<?php $__env->stopSection(); ?>
<?php else: ?>
<script>
window.location.href = "<?php echo e(route('notfound')); ?>";
</script>
<?php endif; ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\influencer_app\resources\views/brands/edit.blade.php ENDPATH**/ ?>