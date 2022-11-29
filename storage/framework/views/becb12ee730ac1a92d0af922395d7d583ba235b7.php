<?php if(auth()->user()->user_type != 2): ?>

<?php $__env->startSection('title', 'Validation Forms'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Add New Brand</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('brands.index')); ?>">Brand List</a></li>
<li class="breadcrumb-item active">Add Brands</li>
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


                        <form class="needs-validation" novalidate="" action="<?php echo e(route('brands.store')); ?>" method="post"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">

                                <?php if($message = Session::get('success')): ?>
                                <div class="alert alert-success">
                                    <p><?php echo e($message); ?></p>
                                </div>
                                <?php endif; ?>
                                <!--  -->
                                <?php if($message = Session::get('error')): ?>
                                <div class="alert alert-danger">
                                    <p><?php echo e($message); ?></p>
                                </div>
                                <?php endif; ?>
                                <?php if($errors->any()): ?>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="alert alert-danger alert-dismissible p-2">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                                    <strong>Error!</strong> <?php echo e($error); ?>.
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                                <!--  -->
                                <div class="col-md-4 mb-3">
                                    <p style="font-weight: bold;font-size: 15px;">Brand Logo*</p>
                                    <input class="form-control" id="validationCustom01" name="image" type="file"
                                        placeholder="Brand Logo" required="" accept="image/* ">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <p style="font-weight: bold;font-size: 15px;">Company Name*</p>
                                    <input class="form-control" id="validationCustom02" value="<?php echo e(old('company_name')); ?>" name="company_name" type="text"
                                        placeholder="Company Name" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>


                                <div class="col-md-4 mb-3">
                                    <p style="font-weight: bold;font-size: 15px;"> Select Country</p>
                                    <select class="js-example-placeholder-multiple col-sm-8 form-control" value="<?php echo e(old('country')); ?>" id="counrty"
                                        name="country">
                                        <option value="">Select Country</option>
                                        <option value="Afganistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bonaire">Bonaire</option>
                                        <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                        <option value="Brunei">Brunei</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Canary Islands">Canary Islands</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Channel Islands">Channel Islands</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos Island">Cocos Island</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote DIvoire">Cote DIvoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Curaco">Curacao</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="East Timor">East Timor</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands">Falkland Islands</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Ter">French Southern Ter</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Great Britain">Great Britain</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Hawaii">Hawaii</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="India">India</option>
                                        <option value="Iran">Iran</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Isle of Man">Isle of Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea North">Korea North</option>
                                        <option value="Korea Sout">Korea South</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libya">Libya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macau">Macau</option>
                                        <option value="Macedonia">Macedonia</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Midway Islands">Midway Islands</option>
                                        <option value="Moldova">Moldova</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Nambia">Nambia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherland Antilles">Netherland Antilles</option>
                                        <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                        <option value="Nevis">Nevis</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau Island">Palau Island</option>
                                        <option value="Palestine">Palestine</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Phillipines">Philippines</option>
                                        <option value="Pitcairn Island">Pitcairn Island</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Republic of Montenegro">Republic of Montenegro</option>
                                        <option value="Republic of Serbia">Republic of Serbia</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russia</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="St Barthelemy">St Barthelemy</option>
                                        <option value="St Eustatius">St Eustatius</option>
                                        <option value="St Helena">St Helena</option>
                                        <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                        <option value="St Lucia">St Lucia</option>
                                        <option value="St Maarten">St Maarten</option>
                                        <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                                        <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                                        <option value="Saipan">Saipan</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="Samoa American">Samoa American</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syria</option>
                                        <option value="Tahiti">Tahiti</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Erimates">United Arab Emirates</option>
                                        <option value="United States of America">United States of America</option>
                                        <option value="Uraguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Vatican City State">Vatican City State</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Vietnam</option>
                                        <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                        <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                        <option value="Wake Island">Wake Island</option>
                                        <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zaire">Zaire</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>

                                    </select>
                                    <!-- <input class="form-control" id="validationCustom03" name="country" type="text" placeholder="Country" required=""> -->
                                    <div class="invalid-feedback">Please provide a valid city.</div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <p style="font-weight: bold;font-size: 15px;"> Status</p>
                                    <select class="js-example-placeholder-multiple col-sm-8 form-control" value="<?php echo e(old('status')); ?>" id="status"
                                        name="status" required="">
                                        <option value="">Select Status</option>
                                        <?php if(old('status') == 1): ?>
                                        <option value="1" selected>Active</option>
                                        <option value="0">In Active</option>
                                        <?php elseif(old('status') == 1): ?>
                                        <option value="1">Active</option>
                                        <option value="0" selected>In Active</option>
                                        <?php else: ?>
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                        <?php endif; ?>
                                    </select>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p style="font-weight: bold;font-size: 15px;"> Commission Management</p>
                                    <div class="btn-group dropend com_drop">
                                        <button type="button" class="btn dropdown-toggle dropdown_main"
                                            aria-expanded="false">
                                            Commission
                                        </button>
                                        <ul class="dropdown-menu main_dropmenu">
                                            <li>
                                                <div class="btn-group dropend">
                                                    <button type="button" class="btn dropdown-toggle dropdown_fix "
                                                        aria-expanded="false">
                                                        Fixed
                                                    </button>
                                                    <ul class="dropdown-menu fix_dropmenu">
                                                        <li><a class="dropdown-item" href=""
                                                                id="fixed_single">Single</a></li>
                                                        <li><a class="dropdown-item" href="" id="fixed_dual">Dual</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href=""
                                                                id="fixed_multiple">Multiple</a></li>
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
                                                    <ul class="dropdown-menu percentage_dropmenu ">
                                                        <li><a class="dropdown-item" href=""
                                                                id="percentage_single">Single</a></li>
                                                        <li><a class="dropdown-item" href=""
                                                                id="percentage_multiple">Multiple</a></li>
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
                                            type="number" step="any" min=0 placeholder="Fixed Single Commission Value">
                                    </div>
                                </div>
                            </div>
                            <div id="fixed_dual_value_show" style="display:none;">
                                <div class="row mb3" style="">
                                    <div class="col">
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
                                                name="fixed_dual_min_value[]" type="number" step="any" min=0
                                                placeholder="Minimum Value">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="fixed_dual_max_value"
                                                name="fixed_dual_max_value[]" type="number" step="any" min=0
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
                                                name="fixed_dual_total_value[]" type="number" min=0 step="any"
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
                            
                           
                    </div>
                    <div class="row" id="fixed_multiple_value_show" style="display:none;">
                        <p style="font-weight: bold;font-size: 15px;">Fixed Commission Multiple Value:</p>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input class="form-control" id="fixed_multiple_newuser_value"
                                    name="fixed_multiple_newuser_value" type="number" min=0 step="any"
                                    placeholder="Fixed Multiple New User Commission Value">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input class="form-control" id="fixed_multiple_olduser_value"
                                    name="fixed_multiple_olduser_value" type="number" min=0 step="any"
                                    placeholder="Fixed Multiple Old User Commission Value">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="percentage_single_value_show" style="display:none;">
                        <div class="col-md-4">
                            <p style="font-weight: bold;font-size: 15px;">Percentage Commission Single Value:</p>
                            <div class="input-group">
                                <input class="form-control" id="percentage_single_value" name="percentage_single_value"
                                    type="number" min=0 step="any" placeholder="Percentage Single Commission Value">
                                <span class="input-group-text">%</span>

                            </div>
                        </div>
                    </div>
                    <div class="row" id="percentage_multiple_value_show" style="display:none;">
                        <p style="font-weight: bold;font-size: 15px;">Percentage Commission Multiple Value:</p>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input class="form-control" id="percentage_multiple_newuser_value"
                                    name="percentage_multiple_newuser_value" type="number" min=0 step="any"
                                    placeholder="Percentage Multiple New User Commission Value">
                                <span class="input-group-text">%</span>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input class="form-control" id="percentage_multiple_olduser_value"
                                    name="percentage_multiple_olduser_value" type="number" min=0 step="any"
                                    placeholder="Percentage Multiple Old User Commission Value">
                                <span class="input-group-text">%</span>

                            </div>
                        </div>
                    </div>


                    <div class="mb-3">

                    </div>
                    <button class="btn btn-success" type="submit">Submit</button>
                    </form>
                </div>
                <!-- <div class="mb-3">
							
                     </div>
                   <a  href="<?php echo e(route('brands.index')); ?>">  <button class="btn btn-primary" type="button">Back</button></a> -->
            </div>
        </div>

    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/form-validation-custom.js')); ?>"></script>
<script>
  $('#removeRow').css('display','none');
$(document).ready(function() {
    $(".dropdown_main").click(function() {
        $(".main_dropmenu").toggle();
        $(".fix_dropmenu").hide();
        $(".percentage_dropmenu").hide();
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
        $("#fixed_single_value_show, #fixed_single_value_show, #fixed_dual_value_show, #percentage_multiple_value_show, #percentage_single_value_show, .dropdown-menu")
            .hide();
        $("#fixed_single_value_show, #fixed_single_value_show, #percentage_multiple_value_show, #percentage_single_value_show")
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
</script>
<?php endif; ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\influencer_app\resources\views/brands/create.blade.php ENDPATH**/ ?>