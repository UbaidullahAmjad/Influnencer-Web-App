@extends('layouts.simple.master')
@section('title', 'Apex Chart')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/daterange-picker.css')}}">

@endsection

@section('style')
@endsection

@section('breadcrumb-title')

@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Charts</li>

@endsection

@section('content')

<!-- Fields -->
<!-- End Fields -->


<div class="container-fluid">
	<div class="row">
        
		<div class="col-sm-12 col-xl-12 box-col-12">
			<div class="card">
                
            <!-- <div class="card-header">
					<h5>Mixed Chart</h5>
				</div> -->

                <form class="needs-validation search_form"  novalidate="" action="{{route('search_data')}}" method="post" enctype="multipart/form-data">
					@csrf
						<div class="row">

                                                        
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
									<div class="col-md-2 mb-2">
                                       <p style="font-weight: bold;font-size: 15px;">Select Brand</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="brand">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $br)
                                                @if(isset($brand) && $brand == $br->company_name)
                                                <option value="{{ $br->company_name }}" selected>{{ $br->company_name }}</option>
                                                @else
                                                <option value="{{ $br->company_name }}">{{ $br->company_name }}</option>
                                                @endif
                                            @endforeach
                                            
										</select>
										
									</div>

                                    <div class="col-md-2 mb-2">
                                       <p style="font-weight: bold;font-size: 15px;">Select Coupon</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="coupon">
                                        <option value="">Select Coupon</option>
                                      
                                        @foreach($coupons as $c)
                                            @if(isset($coupon) && $coupon == $c->coupon_code)
											<option value="{{$c->coupon_code}}" selected>{{$c->coupon_code}}</option>
                                            @else
                                            <option value="{{$c->coupon_code}}">{{$c->coupon_code}}</option>
                                            @endif
											@endforeach
										</select>
										
									</div>

                                    <div class="col-md-3 mb-2">
                                       <p style="font-weight: bold;font-size: 15px;">Select Influencer</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
                                        @if(auth()->user()->user_type != 2)
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="influencer">
                                        <option value="">Select Influencer</option>
                                        @foreach($influencers as $in)
                                            @if(isset($influencer) && $influencer == $in->f_name)
											<option value="{{$in->f_name}}" selected>{{$in->f_name}}</option>
                                            @else
                                            <option value="{{$in->f_name}}">{{$in->f_name}}</option>
                                            @endif
											@endforeach
										</select>
                                        @else
                                        <input type="text" name="influencer" class="form-control" value="{{ auth()->user()->f_name }}" readonly>
                                        @endif
										
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
                                       <p style="font-weight: bold;font-size: 15px;"> Select Filter</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="filter">
										
                                            <option value="">Select Filter</option>
											<option value="revenue" {{ (isset($filter) && $filter == "revenue") ? 'selected': ''  }} >Revenue</option>
                                            <option value="sa" {{ (isset($filter) && $filter == "sa") ? 'selected': ''  }}>Sale Amount</option>
                                            <option value="aov" {{ (isset($filter) && $filter == "aov") ? 'selected': ''  }}>AOV</option>
                                            <option value="order" {{ (isset($filter) && $filter == "order") ? 'selected': ''  }}>Orders</option>
											<option value="commission" {{ (isset($filter) && $filter == "commission") ? 'selected': ''  }}>Commission</option>
										</select>
										
									</div>
                                    <div class="col-md-2 mb-2">
                                       <p style="font-weight: bold;font-size: 15px;">Select Currency</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="currency">
                                            <option value="">Select Currency</option>
                                            @foreach($currencies as $curr)
                                                @if(isset($currency) && $currency == $curr->currency)
                                                <option value="{{ $curr->currency }}" selected>{{ $curr->currency }}</option>
                                                @else
                                                <option value="{{ $curr->currency }}">{{ $curr->currency }}</option>
                                                @endif
                                            @endforeach
                                            
										</select>
										
									</div>

                                       <div class="theme-form">
						<div class="col-md-3 mb-3">
                        <p style="font-weight: bold;font-size: 15px;"> Select Date</p>

							<input class="form-control digits" type="text" value="{{ isset($daterange) ? $daterange : '' }}" name="daterange" >
						</div>
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
        <div class="col-sm-12 col-xl-12 box-col-12">
            <div class="row justify-content-center m-0">
                <div class="col-sm-2 px-1">
                    <div class="card data_show h-100">
                        <h5 class="text-center p-2">Total Revenues</h5>
                        <h5 class="text-center">{{ $total_revenues }}</h5>
                    </div>
                </div>
                <div class="col-sm-2 px-1">
                    <div class="card data_show h-100">
                        <h5 class="text-center p-2">Total Sale Amount</h5>
                        <h5 class="text-center"> {{ $total_sale_amount }} </h5>
                    </div>
                </div>
                <div class="col-sm-2 px-1">
                    <div class="card data_show h-100">
                        <h5 class="text-center p-2">Total AOV</h5>
                        <h5 class="text-center">{{ $total_aov }}</h5>
                    </div>
                </div>
                <div class="col-sm-2 px-1">
                    <div class="card data_show h-100">
                        <h5 class="text-center p-2">Total Orders</h5>
                        <h5 class="text-center">{{ $total_orders }}</h5>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/chart-custom.js')}}"></script>
<script src="{{asset('assets/js/datepicker/daterange-picker/moment.min.js')}}"></script>
<script src="{{asset('assets/js/datepicker/daterange-picker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/daterange-picker/daterange-picker.custom.js')}}"></script>

@if(isset($all_data) && empty($filter))

<script>
var cont = "{{ count($all_data) }}";
var options7 = {
    chart: {
        height: 350,
        type: 'line',
        stacked: false,
        toolbar:{
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
        type: 'line',
        data: [<?php foreach ($all_data as $data) {
    echo $data->revenue.",";
} ?>]
    }, {
        name: 'Sale Amount',
        type: 'line',
        data: [<?php foreach ($all_data as $data) {
    echo $data->sale_ammount.",";
} ?>]
    }, 
    {
        name: 'AOV',
        type: 'line',
        data: [<?php foreach ($all_data as $data) {
    echo $data->aov.",";
} ?>]
    },
     {
        name: 'Orders',
        type: 'line',
        data: [<?php foreach ($all_data as $data) {
    echo $data->order.",";
} ?>]
    }],
    fill: {
        opacity: [0.85,0.25,1],
        gradient: {
            inverseColors: false,
            shade: 'light',
            type: "vertical",
            opacityFrom: 0.85,
            opacityTo: 0.55,
            stops: [0, 100, 100, 100]
        }
    },
    labels: 
        [<?php
            if (count($dates) > 0) {
                $kkk=0;
                foreach ($dates as $date) {
                    if ($kkk != (count($dates) -1)) {
                        echo "'".$date . "',";
                    } else {
                        echo "'".$date."'";
                    }
                    $kkk++;
                }
            }
            ?>],
    markers: {
        size: 0
    },
    xaxis: {
        type:'date'
    },
    yaxis: {
        min: 0
    },
    tooltip: {
        shared: true,
        intersect: false,
        y: {
            formatter: function (y) {
                if(typeof y !== "undefined") {
                    return  y.toFixed(0) + " views";
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
    colors:[CubaAdminConfig.secondary , '#51bb25' , CubaAdminConfig.primary ]
}
    var chart7 = new ApexCharts(
    document.querySelector("#mixedchart"),
    options7
);

chart7.render();
</script>
@elseif(isset($all_data) && isset($filter) && !empty($filter))

<script>
var filter = "";
<?php if ($filter == "revenue") {?>
            filter = 'Revenue';
            <?php } elseif ($filter == "sa") {?>
                filter = 'Sale Amount';
            <?php } elseif ($filter == "aov") {?>
                filter = 'AOV';
            <?php } elseif ($filter == "order") {?>
                filter = 'Orders';
            <?php } ?>;

var options7 = {
    chart: {
        height: 350,
        type: 'line',
        stacked: false,
        toolbar:{
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
        type: 'line',
        data: [<?php $k=0; foreach ($all_data as $data) {
                if ($k != (count($all_data) - 1)) {
                    if ($filter == "revenue") {
                        echo $data->revenue.",";
                    } elseif ($filter == "sa") {
                        echo $data->sale_ammount.",";
                    } elseif ($filter == "aov") {
                        echo $data->aov.",";
                    } elseif ($filter == "order") {
                        echo $data->order.",";
                    } elseif ($filter == "commission") {
                        echo $data->commission_validation.",";
                    }
                } else {
                    if ($filter == "revenue") {
                        echo $data->revenue;
                    } elseif ($filter == "sa") {
                        echo $data->sale_ammount;
                    } elseif ($filter == "aov") {
                        echo $data->aov;
                    } elseif ($filter == "order") {
                        echo $data->order;
                    } elseif ($filter == "commission") {
                        echo $data->commission_validation;
                    }
                }
            
             
                $k++;
            } ?>]
    }],
    fill: {
        opacity: [0.85,0.25,1],
        gradient: {
            inverseColors: false,
            shade: 'light',
            type: "vertical",
            opacityFrom: 0.85,
            opacityTo: 0.55,
            stops: [0, 100, 100, 100]
        }
    },
    labels: [<?php
            if (count($dates) > 0) {
                $kkk=0;
                foreach ($dates as $date) {
                    if ($kkk != (count($dates) -1)) {
                        echo "'".$date . "',";
                    } else {
                        echo "'".$date."'";
                    }
                    $kkk++;
                }
            }
            ?>],//['01/01/2003', '02/01/2003','03/01/2003','04/01/2003','05/01/2003','06/01/2003','07/01/2003','08/01/2003','09/01/2003','10/01/2003','11/01/2003'],
    markers: {
        size: 0
    },
    xaxis: {
        type:'date'
    },
    yaxis: {
        min: 0
    },
    tooltip: {
        shared: true,
        intersect: false,
        y: {
            formatter: function (y) {
                if(typeof y !== "undefined") {
                    return  y.toFixed(0) + " views";
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
    colors:[CubaAdminConfig.secondary , '#51bb25' , CubaAdminConfig.primary ]
}
    var chart7 = new ApexCharts(
    document.querySelector("#mixedchart"),
    options7
);

chart7.render();
</script>

@endif
@endsection