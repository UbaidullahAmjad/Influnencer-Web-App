<?php if(auth()->user()->user_type != 2): ?>

<?php $__env->startSection('title', 'Apex Chart'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/daterange-picker.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Charts</li>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Fields -->
<!-- End Fields -->

<div class="container-fluid">
    <div class="row">

        <div class="col-sm-12 col-xl-12 box-col-12">
            <div class="card">

                <!-- <div class="card-header">
					<h5>Mixed Chart</h5>
				</div> -->

                <form class="needs-validation search_form" novalidate="" action="<?php echo e(route('search_data')); ?>" method="post"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">


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
                        <!-- <p style="font-weight: bold;font-size: 15px;">Select Brand</p> -->
                        <div class="col-md-2 mb-2">
                            <label for="validationCustom01">Select Brand</label>
                            <!-- <div class="col-form-label">Select Brand</div> -->
                            <?php if(auth()->user()->user_type != 2): ?>
                            <select class="js-example-placeholder-multiple col-sm-12 form-control" id="brand_id"
                                name="brand" data-href="<?php echo e(route('get_coupons')); ?>">
                                <option value="">Select Brand</option>
                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->company_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php else: ?>
                            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="brand">
                                <option value="">Select Brand</option>
                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->company_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php endif; ?>

                        </div>

                        <div class="col-md-2 mb-2">
                            <label for="validationCustom01">Influencer Status</label>
                            <!-- <div class="col-form-label">Select Coupons</div> -->
                            <select class="js-example-placeholder-multiple col-sm-12 form-control" id="status"
                                name="status" data-href="<?php echo e(route('get_influencers')); ?>">
                                <option value="-2">Select</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>


                            </select>
                        </div>

                        <?php if(auth()->user()->user_type != 2): ?>
                        <div class="col-md-2 mb-2" id="influencer">

                            <label for="validationCustom01">Select Influencer</label>
                            <!-- <div class="col-form-label">Select Brand</div> -->

                            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="influencer"
                                id="influencer_id">
                                <option value="">Select Influencer</option>
                                <?php $__currentLoopData = $influencers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $influencer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($influencer->id); ?>"><?php echo e($influencer->f_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>


                        </div>
                        <?php else: ?>
                        <input type="hidden" name="influencer" class="form-control" value="<?php echo e(auth()->user()->id); ?>"
                            readonly>

                        <?php endif; ?>
                        <div class="col-md-2 mb-2">
                            <label for="validationCustom01">Select Coupon</label>
                            <!-- <div class="col-form-label">Select Brand</div> -->
                            <?php if(auth()->user()->user_type != 2): ?>
                            <select class="js-example-placeholder-multiple col-sm-12 form-control" id="coupon_id"
                                name="coupon">
                                <option value="">Select Coupon</option>
                                <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($coupon->id); ?>"><?php echo e($coupon->coupon_code); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php else: ?>
                            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="coupon">
                                <option value="">Select Coupon</option>
                                <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($coupon->id); ?>"><?php echo e($coupon->coupon_code); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php endif; ?>

                        </div>



                        <!-- <div class="col-md-2 mb-2">
                                       <p style="font-weight: bold;font-size: 15px;">Date</p>
										<div class="col-form-label">Select Brand</div>
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="influencer">
                                        <option value="" disabled selected>Select Date</option>
											<option value=""></option>
											
										</select>
										
									</div> -->

                        <div class="col-md-2 mb-2">
                            <label for="validationCustom01"> Select Filter</label>
                            <!-- <div class="col-form-label">Select Brand</div> -->
                            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="filter">

                                <option value="">Select Filter</option>
                                <option value="revenue">Revenue</option>
                                <option value="sa">Sale Amount</option>
                                <!-- <option value="aov">AOV</option> -->
                                <option value="order">Orders</option>
                                <!-- <option value="commission">Commission</option> -->


                            </select>

                        </div>
                        <?php if(count($currencies) > 0): ?>
                        <div class="col-md-2 mb-2">
                            <label for="validationCustom01">Select Currency</label>
                            <!-- <div class="col-form-label">Select Brand</div> -->
                            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="currency">
                                <option value="">Select Currency</option>
                                <?php if(auth()->user()->user_type != 2): ?>
                                <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($currency->currency != null): ?>
                                <option value="<?php echo e($currency->currency); ?>"><?php echo e($currency->currency); ?></option>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($currency != null): ?>
                                <option value="<?php echo e($currency); ?>"><?php echo e($currency); ?></option>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>

                        </div>
                        <?php endif; ?>

                        <div class="col-md-3 mb-3">
                            <label for="validationCustom01">From *</label>
                            <!-- <div class="col-form-label">Select Coupons</div> -->
                            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="from_month"
                                required>
                                <option value="-1">Select Month</option>
                                <option value="1" <?php echo e($from_month == 1 ? 'selected' : ''); ?>>January</option>
                                <option value="2" <?php echo e($from_month == 2 ? 'selected' : ''); ?>>Februay</option>
                                <option value="3" <?php echo e($from_month == 3 ? 'selected' : ''); ?>>March</option>
                                <option value="4" <?php echo e($from_month == 4 ? 'selected' : ''); ?>>April</option>
                                <option value="5" <?php echo e($from_month == 5 ? 'selected' : ''); ?>>May</option>
                                <option value="6" <?php echo e($from_month == 6 ? 'selected' : ''); ?>>June</option>
                                <option value="7" <?php echo e($from_month == 7 ? 'selected' : ''); ?>>July</option>
                                <option value="8" <?php echo e($from_month == 8 ? 'selected' : ''); ?>>August</option>
                                <option value="9" <?php echo e($from_month == 9 ? 'selected' : ''); ?>>September</option>
                                <option value="10" <?php echo e($from_month == 10 ? 'selected' : ''); ?>>October</option>
                                <option value="11" <?php echo e($from_month == 11 ? 'selected' : ''); ?>>November</option>
                                <option value="12" <?php echo e($from_month == 12 ? 'selected' : ''); ?>>December</option>


                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom01">To *</label>
                            <!-- <div class="col-form-label">Select Coupons</div> -->
                            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="to_month"
                                required>
                                <option value="-1">Select Month</option>
                                <option value="1" <?php echo e($to_month == 1 ? 'selected' : ''); ?>>January</option>
                                <option value="2" <?php echo e($to_month == 2 ? 'selected' : ''); ?>>Februay</option>
                                <option value="3" <?php echo e($to_month == 3 ? 'selected' : ''); ?>>March</option>
                                <option value="4" <?php echo e($to_month == 4 ? 'selected' : ''); ?>>April</option>
                                <option value="5" <?php echo e($to_month == 5 ? 'selected' : ''); ?>>May</option>
                                <option value="6" <?php echo e($to_month == 6 ? 'selected' : ''); ?>>June</option>
                                <option value="7" <?php echo e($to_month == 7 ? 'selected' : ''); ?>>July</option>
                                <option value="8" <?php echo e($to_month == 8 ? 'selected' : ''); ?>>August</option>
                                <option value="9" <?php echo e($to_month == 9 ? 'selected' : ''); ?>>September</option>
                                <option value="10" <?php echo e($to_month == 10 ? 'selected' : ''); ?>>October</option>
                                <option value="11" <?php echo e($to_month == 11 ? 'selected' : ''); ?>>November</option>
                                <option value="12" <?php echo e($to_month == 12 ? 'selected' : ''); ?>>December</option>


                            </select>

                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom01">Year</label>
                            <!-- <div class="col-form-label">Select Coupons</div> -->
                            <select class="js-example-placeholder-multiple col-sm-12 form-control" name="year">
                                <option value="-2">Select Year</option>
                                <?php $__currentLoopData = range( $latest_year, $earliest_year ); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($i); ?>" <?php echo e($i == $year ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                        </div>


                    </div>
                    <div class="mb-3">

                    </div>
                    <button class="btn btn-success" type="submit">Search</button>
                </form>


                <div class="card-body">
                    <div id="mixedchart"></div>
                </div>
            </div>
        </div>



    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/chart/apex-chart/apex-chart.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/chart/apex-chart/stock-prices.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/chart/apex-chart/chart-custom.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datepicker/daterange-picker/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datepicker/daterange-picker/daterangepicker.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datepicker/daterange-picker/daterange-picker.custom.js')); ?>"></script>

<?php if(isset($all_data) && empty($filter)): ?>

<script>
var cont = "<?php echo e(count($all_data)); ?>";
var options7 = {
    chart: {
        height: 350,
        type: 'line',
        stacked: false,
        toolbar: {
            show: false
        }
    },
    stroke: {
        // width: [0, 2, 5],
        curve: 'smooth'
    },
    plotOptions: {
        bar: {
            columnWidth: '50%'
        }
    },
    series: [{
        name: 'Revenue',
        type: 'column',
        data: [<?php foreach($all_data as $data){         
                echo $data->revenue.",";
            } ?>]
    }, {
        name: 'Sale Amount',
        type: 'column',
        data: [<?php foreach($all_data as $data){         
                echo $data->sale_ammount.",";
            } ?>]
    }, {
        name: 'AOV',
        type: 'column',
        data: [<?php foreach($all_data as $data){         
                echo $data->aov.",";
            } ?>]
    }, {
        name: 'Orders',
        type: 'column',
        data: [<?php foreach($all_data as $data){         
                echo $data->order.",";
            } ?>]
    }],
    fill: {
        opacity: [0.85, 0.25, 1],
        gradient: {
            inverseColors: false,
            shade: 'light',
            type: "vertical",
            opacityFrom: 0.85,
            opacityTo: 0.55,
            stops: [0, 100, 100, 100]
        }
    },
    labels: ['01/01/2003', '02/01/2003', '03/01/2003', '04/01/2003', '05/01/2003', '06/01/2003', '07/01/2003',
        '08/01/2003', '09/01/2003', '10/01/2003', '11/01/2003'
    ],
    markers: {
        size: 0
    },
    xaxis: {
        type: 'datetime'
    },
    yaxis: {
        min: 0
    },
    tooltip: {
        shared: true,
        intersect: false,
        y: {
            formatter: function(y) {
                if (typeof y !== "undefined") {
                    return y.toFixed(0) + " views";
                }
                return y;

            }
        }
    },
    legend: {
        labels: {
            useSeriesColors: true
        },
    },
    colors: [CubaAdminConfig.secondary, '#51bb25', CubaAdminConfig.primary]
}
var chart7 = new ApexCharts(
    document.querySelector("#mixedchart"),
    options7
);

chart7.render();
</script>
<?php elseif(isset($all_data) && isset($filter) && !empty($filter)): ?>

<script>
var filter = "";
<?php if($filter == "revenue"){?>
filter = 'Revenue';
<?php }else if($filter == "sa"){?>
filter = 'Sale Amount';
<?php }else if($filter == "aov"){?>
filter = 'AOV';
<?php }else if($filter == "order"){?>
filter = 'Orders';
<?php } ?>;

var options7 = {
    chart: {
        height: 350,
        type: 'line',
        stacked: false,
        toolbar: {
            show: false
        }
    },
    stroke: {
        // width: [0, 2, 5],
        curve: 'smooth'
    },
    plotOptions: {
        bar: {
            columnWidth: '50%'
        }
    },
    series: [{
        name: filter,
        type: 'column',
        data: [<?php foreach($all_data as $data){ 
            if($filter == "revenue"){
                echo $data->revenue.",";
            }else if($filter == "sa"){
                echo $data->sale_ammount.",";
            }else if($filter == "aov"){
                echo $data->aov.",";
            }else if($filter == "order"){
                echo $data->order.",";
            }
             
            
            } ?>]
    }],
    fill: {
        opacity: [0.85, 0.25, 1],
        gradient: {
            inverseColors: false,
            shade: 'light',
            type: "vertical",
            opacityFrom: 0.85,
            opacityTo: 0.55,
            stops: [0, 100, 100, 100]
        }
    },
    labels: ['01/01/2003', '02/01/2003', '03/01/2003', '04/01/2003', '05/01/2003', '06/01/2003', '07/01/2003',
        '08/01/2003', '09/01/2003', '10/01/2003', '11/01/2003'
    ],
    markers: {
        size: 0
    },
    xaxis: {
        type: 'datetime'
    },
    yaxis: {
        min: 0
    },
    tooltip: {
        shared: true,
        intersect: false,
        y: {
            formatter: function(y) {
                if (typeof y !== "undefined") {
                    return y.toFixed(0) + " views";
                }
                return y;

            }
        }
    },
    legend: {
        labels: {
            useSeriesColors: true
        },
    },
    colors: [CubaAdminConfig.secondary, '#51bb25', CubaAdminConfig.primary]
}
var chart7 = new ApexCharts(
    document.querySelector("#mixedchart"),
    options7
);

chart7.render();
</script>

<?php endif; ?>
<script>
$('#influencer').css('display', 'none');
$(document).on('change', '#brand_id', function() {
    let brand_id = $(this).val();
    let url = $(this).attr('data-href');
    getCategory(url, brand_id);
});

function getCategory(url, brand_id) {
    $.get(url + '?brand_id=' + brand_id, function(data) {
        let response = data.data;
        let view_html = ``;
        $.each(response, function(key, value) {
            view_html += `<option value="${value.id}">${value.coupon_code}</option>`;
        });
        console.log(view_html)
        let start = `<option value="">Select One</option>`;
        $('#coupon_id').html(start + view_html);
    })
}

$(document).on('change', '#status', function() {
    // $('#influencer').css('display','none');
    let status = $(this).val();
    if (status != -2) {
        let url = $(this).attr('data-href');
        getInfluencers(url, status);
    } else if (status == -2) {
        $('#influencer').css('display', 'none');
    }

});

function getInfluencers(url, status) {
    $.get(url + '?status=' + status, function(data) {
        $('#influencer').css('display', 'block');

        let response = data.data;
        let view_html = ``;
        $.each(response, function(key, value) {
            view_html += `<option value="${value.id}">${value.f_name}</option>`;
        });
        console.log(view_html)
        let start = `<option value="">Select One</option>`;
        $('#influencer_id').html(start + view_html);
    })
}
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
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\influencer_app\resources\views/graph/graph.blade.php ENDPATH**/ ?>