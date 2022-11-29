@extends('layouts.simple.master')
@section('title', 'Apex Chart')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/daterange-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/rating.css')}}">

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

                <form class="needs-validation search_form"  novalidate="" action="{{route('line_search_data')}}" method="post" enctype="multipart/form-data">
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
                                        @if(auth()->user()->user_type != 2)
										<select class="js-example-placeholder-multiple col-sm-12 form-control" id="brand_id" name="brand" data-href="{{ route('get_coupons') }}">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $br)
                                                @if(isset($brand) && $brand == $br->id)
                                                <option value="{{ $br->id }}" selected>{{ $br->company_name }}</option>
                                                @else
                                                <option value="{{ $br->id }}">{{ $br->company_name }}</option>
                                                @endif
                                            @endforeach
                                            
										</select>
                                        @else
                                        <select class="js-example-placeholder-multiple col-sm-12 form-control" name="brand">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $br)
                                                @if(isset($brand) && $brand == $br->id)
                                                <option value="{{ $br->id }}" selected>{{ $br->company_name }}</option>
                                                @else
                                                <option value="{{ $br->id }}">{{ $br->company_name }}</option>
                                                @endif
                                            @endforeach
                                            
										</select>
                                        @endif
										
									</div>
                                    @if(auth()->user()->user_type != 2)
                                    <div class="col-md-3 mb-2">
                                       <p style="font-weight: bold;font-size: 15px;">Select Influencer</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
                                        
										<select class="js-example-placeholder-multiple col-sm-12 form-control" name="influencer">
                                        <option value="">Select Influencer</option>
                                        @foreach($influencers as $in)
                                            @if(isset($influencer) && $influencer == $in->id)
											<option value="{{$in->id}}" selected>{{$in->f_name}}</option>
                                            @else
                                            <option value="{{$in->id}}">{{$in->f_name}}</option>
                                            @endif
											@endforeach
										</select>
                                       
										
									</div>
                                    @else
                                        <input type="hidden" name="influencer" class="form-control" value="{{ auth()->user()->id }}" readonly>

                                        @endif
                                    <div class="col-md-2 mb-2">
                                       <p style="font-weight: bold;font-size: 15px;">Select Coupon</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
                                        @if(auth()->user()->user_type != 2)
										<select class="js-example-placeholder-multiple col-sm-12 form-control" id="coupon_id" name="coupon">
                                        <option value="">Select Coupon</option>
                                      
                                        @foreach($coupons as $cop)
                                        <option value="{{ $cop->id }}"
												{{ $cop->id == (isset($coupon) ? $coupon : 0) ? 'selected' : '' }}>
												{{ $cop->coupon_code }}</option>
										@endforeach
										</select>
                                        @else
                                        <select class="js-example-placeholder-multiple col-sm-12 form-control" name="coupon">
                                        <option value="">Select Coupon</option>
                                      
                                        @foreach($coupons as $cop)
                                        <option value="{{ $cop->id }}"
												{{ $cop->id == (isset($coupon) ? $coupon : 0) ? 'selected' : '' }}>
												{{ $cop->coupon_code }}</option>
										@endforeach
										</select>
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
                                            <option value="order" {{ (isset($filter) && $filter == "order") ? 'selected': ''  }}>Orders</option>
										</select>
										
									</div>
                                    <div class="col-md-2 mb-2">
                                       <p style="font-weight: bold;font-size: 15px;">Select Currency</p>
										<!-- <div class="col-form-label">Select Brand</div> -->
                                        @if(auth()->user()->user_type != 2)
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
										@else
                                        <select class="js-example-placeholder-multiple col-sm-12 form-control" name="currency">
                                            <option value="">Select Currency</option>
                                            @foreach($currencies as $curr)
                                                @if(isset($currency) && $currency == $curr)
                                                <option value="{{ $curr }}" selected>{{ $curr}}</option>
                                                @else
                                                <option value="{{ $curr }}">{{ $curr }}</option>
                                                @endif
                                            @endforeach
                                            
										</select>
                                        @endif
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
                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
				</div>

                
			</div>
		    </div>
		
	
		
		</div>
        <div class="col-sm-12 col-xl-12 box-col-12">
            <div class="row justify-content-center m-0">
                <div class="col-sm-3 px-1">
                    <div class="card data_show h-100">
                        <h5 class="text-center p-2">Total Revenues</h5>
                        <h5 class="text-center" style="font-size: 34px;">{{ round($total_revenues,2) }}</h5>
                    </div>
                </div>
                <div class="col-sm-3 px-1">
                    <div class="card data_show h-100">
                        <h5 class="text-center p-2">Total Sale Amount</h5>
                        <h5 class="text-center" style="font-size: 34px;"> {{ round($total_sale_amount,2) }} </h5>
                    </div>
                </div>
                
                <div class="col-sm-3 px-1">
                    <div class="card data_show h-100">
                        <h5 class="text-center p-2">Total Orders</h5>
                        <h5 class="text-center" style="font-size: 34px;">{{ $total_orders }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 card p-5">
        <table class="display" id="basic-2">
                     <thead>
                        <tr>

                        <th>#</th>
                        <th>Brand</th>
                        <th>Coupon</th>
                        <th>Revenue</th>
                        <th>Sale Amount</th>
                        <th>Sale Amount USD</th>
                        <th>Orders</th>
                        <th>AOV</th>
                        <th>AOV USD</th>
                        <th>Date</th>
                           
                          
                        </tr>
                     </thead>
                     <tbody>
                     @php($i = 1)
                     @foreach($all_data as $all_dat)
                     <?php
                       $brand = app\Models\Brand::find($all_dat->brand_id);
                       $coupon = app\Models\Coupon::find($all_dat->coupon_id)
                     ?>
                     
                        <tr>

                        <th scope="row">{{$loop->iteration}}</th>
                        
                            <td>
                              <div class="some_text">
                                 {{ isset($brand) ? $brand->company_name : ''}}
                              </div>
                           </td>

                           <td>
                              <div class="some_text">
                                 {{ isset($coupon) ? $coupon->coupon_code : ''}}
                              </div>
                           </td>
                           
                           <td>
                              <div class="some_text">
                                 {{ $all_dat->revenue}}
                              </div>
                           </td>
                           <td>{{ $all_dat->sale_ammount}}</td>
                           <td>{{ $all_dat->sale_ammount_usd}}</td>
                           <td>{{ $all_dat->order}}</td>
                           <td>{{ $all_dat->aov}}</td>
                           <td>{{ $all_dat->aov_usd}}</td>
                           
                           <td>{{ $all_dat->date}}</td>
                        </tr>
            
                    @endforeach
                       
                     </tbody>
        </table>
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

<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/rating/jquery.barrating.js')}}"></script>
<script src="{{asset('assets/js/rating/rating-script.js')}}"></script>
<script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
<script src="{{asset('assets/js/ecommerce.js')}}"></script>
<script src="{{asset('assets/js/product-list-custom.js')}}"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>



@if(isset($all_data) && empty($filter))
<script>
    var cont = "{{ count($all_data) }}";
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
	title:{
		text: "Graph",
	},
	axisY:[{
		title: "Order",
		lineColor: "#C24642",
		tickColor: "#C24642",
		labelFontColor: "#C24642",
		titleFontColor: "#C24642",
		includeZero: true,
		suffix: "k"
	},
	{
		title: "Sale Amount",
		lineColor: "#369EAD",
		tickColor: "#369EAD",
		labelFontColor: "#369EAD",
		titleFontColor: "#369EAD",
		includeZero: true,
		suffix: "k"
	}],
	axisY2: {
		title: "Revenue",
		lineColor: "#7F6084",
		tickColor: "#7F6084",
		labelFontColor: "#7F6084",
		titleFontColor: "#7F6084",
		includeZero: true,
		prefix: "$",
		suffix: "k"
	},
	toolTip: {
		shared: true
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "line",
		name: "Sale Amount",
		color: "#369EAD",
		showInLegend: true,
		axisYIndex: 1,
		dataPoints: [<?php foreach ($all_data as $data) { $datenew = explode('-', $data->date) ;?>
                         {x: new Date(<?php echo $datenew[0]; ?>,<?php echo $datenew[1]; ?>,<?php echo $datenew[2]; ?>),y: <?php echo $data->sale_ammount; ?>}, 
                        
                     <?php } ?>]
	},
	{
		type: "line",
		name: "Order",
		color: "#C24642",
		axisYIndex: 0,
		showInLegend: true,
		dataPoints:  [<?php foreach ($all_data as $data) {
            $datenew = explode('-', $data->date) ;?>
            
            
                        { x: new Date(<?php echo $datenew[0]; ?>,<?php echo $datenew[1]; ?>,<?php echo $datenew[2]; ?>),y:<?php echo $data->order; ?> },
                        
                     <?php } ?>]
	},
	{
		type: "line",
		name: "Revenue",
		color: "#7F6084",
		axisYType: "secondary",
		showInLegend: true,
		dataPoints: [<?php foreach ($all_data as $data) { $datenew = explode('-', $data->date) ;
            ?>
                       {  x: new Date(<?php echo $datenew[0]; ?>,<?php echo $datenew[1]; ?>,<?php echo $datenew[2]; ?>),y:<?php echo $data->revenue; ?> },
                       
                        
                     <?php } ?>]
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}

}
</script>


@endif
@endsection