<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Management;
use App\Models\Coupon;
use App\Models\ArabyAds;
use App\Models\Styli;
use App\Models\Ounass;
use App\Models\MarketerHub;
use App\Models\Shosh;

use App\Models\Influencer;
use App\Models\Brand;
use App\Models\Association;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GraphController extends Controller
{
    public function index()
    {
        $brands = [];
        $coupons = [];
        $currencies = [];
        $currently_selected = date('Y'); 
        $earliest_year = 1900; 
        $latest_year = date('Y');

        $year = date('Y');
        $from_month = date('m');
        $to_month = date('m');
        if(auth()->user()->user_type == 2){
            $associations = Association::where('influencer_id', auth()->user()->id)->get();
            if(count($associations) > 0){
                foreach($associations as $assos){
                    $b = Brand::find($assos->brand_id);
                    $c = Coupon::find($assos->coupon_id);
                    if($b && !in_array($b,$brands)){
                        array_push($brands, $b);
                        
                    }
                    if($c && !in_array($c,$coupons)){
                        array_push($coupons, $c);
                        array_push($currencies, $c->currency);
                    }

                }
            }
            
            return view('graph.graph', compact('brands', 'coupons','currencies','currently_selected','earliest_year','latest_year','from_month','to_month','year'));
            // dd($associations);
        }else{
            $brands = Brand::all();
            $coupons = Coupon::all();
            $influencers = User::where('user_type',2)->get();
            $currencies = Coupon::distinct()->get(['currency']);
            //  dd($currencies);
            // $currencies =
            // dd($influencers) ;
            // dd($countries);
          
            return view('graph.graph', compact('brands', 'coupons', 'influencers','currencies','currently_selected','earliest_year','latest_year','from_month','to_month','year'));
        }
        
    }

// =========================== Old functionality ==========================
    public function search(Request $request)
    {
        
        //   dd($request->all());
        $earliest_year = 1900; 
        $latest_year = date('Y');
        $currency = $request->currency;
        $brand = $request->brand;
        $coupon = $request->coupon;
        $influencer = $request->influencer;
        // $daterange = $request->daterange;
        $filter = $request->filter;
        $influencers = User::all();
        $countries = DB::table('countries')->get();
        $brands = [];
        $coupons = [];
        $currencies = [];
        $all_data = [];
        $year = $request->year;
        $from_month = $request->from_month;
        $to_month = $request->to_month;
        

        if($from_month == "from"){
            return redirect('/graph')->with('error', 'Please select Start Month');
        }
        if($to_month == "to"){
            return redirect('/graph')->with('error', 'Please select End Month');
        }
        // dump($to_month);
        // dd($from_month);
        if($from_month > $to_month){
            return redirect('/graph')->with('error', 'From Month should be less/equal to End Month');
        }
        
        // dd($month);
        
        if (auth()->user()->user_type == 2) {
            $associations = Association::where('influencer_id', auth()->user()->id)->get();
            if (count($associations) > 0) {
                foreach ($associations as $assos) {
                    $b = Brand::find($assos->brand_id);
                    $c = Coupon::find($assos->coupon_id);
                    if($b && !in_array($b,$brands)){
                        array_push($brands, $b);
                        
                    }
                    if($c && !in_array($c,$coupons)){
                        array_push($coupons, $c);
                        array_push($currencies, $c->currency);
                    }
                }
            }
        }else{
            $currencies = Coupon::distinct()->get(['currency']);
            $brands = Brand::all();
            $coupons = Coupon::where('brand_id', $brand)->get();
            $influencers = User::where('user_type',2)->get();
            
        }
        
        

        // $date = explode('-', $daterange);
        // $fa = strtotime($date[0]);
        // $la = strtotime($date[1]);
        // $start_date = Carbon::parse($fa)->format('Y-m-d');
        // $end_date = Carbon::parse($la)->format('Y-m-d');
        $month_31 = [1,3,5,7,8,10,12];
        $month_30 = [4,6,9,11];
        $dates = [];
        $months = [];
        // $year = explode('-', $month_year)[0];
        // $start = $from_month
        for($month = $from_month; $month <= $to_month; $month++){
            if(in_array($month,$month_31)){
                if($year == -2){
                    $year = Carbon::now()->format('Y');
                }
                $period = new \DatePeriod(
                    new \DateTime('01-'.$month.'-'.$year),
                    new \DateInterval('P1D'),
                    new \DateTime('31-'.$month.'-'.$year),
               );
               foreach ($period as $key => $value) {
                
                $d = $value->format('d/m/Y');
                    if($d){
                        array_push($dates, $d);
                    }
                }
            }else if(in_array($month,$month_30)){
                if($year == -2){
                    $year = Carbon::now()->format('Y');
                }
                $period = new \DatePeriod(
                    new \DateTime('01-'.$month.'-'.$year),
                    new \DateInterval('P1D'),
                    new \DateTime('30-'.$month.'-'.$year),
               );
               foreach ($period as $key => $value) {
                
                $d = $value->format('d/m/Y');
                    if($d){
                        array_push($dates, $d);
                    }
                }
            }else{
                if($year == -2){
                    $year = Carbon::now()->format('Y');
                }
                $period = new \DatePeriod(
                    new \DateTime('01-'.$month.'-'.$year),
                    new \DateInterval('P1D'),
                    new \DateTime('29-'.$month.'-'.$year),
               );
               foreach ($period as $key => $value) {
                
                $d = $value->format('d/m/Y');
                    if($d){
                        array_push($dates, $d);
                    }
                }
            }
        }
         
        
    
    //    dd($period);
       
    // $period = \Carbon\CarbonPeriod::create($start_date, $end_date);

// Iterate over the period
    // foreach ($period as $date) {
    //     // dump();
    //     $month = date("m", strtotime($date));
    //     // dump($month);
    //     if(!in_array($month,$months)){
    //          if($month < 10){
    //             $month = explode('0',$month)[1];
    //          }
    //         array_push($months,$month);
    //     }
    //     array_push($dates, $date->format('d/m/Y'));
    // }
    // dd($months);
    // dd($months);
    // dd($months);
    // Convert the period to an array of dates
    // $dates = $period->toArray();
        // dd(count($dates));
    // dd('stop');
    $total_revenues = 0.0;
    $total_aov = 0;
    $total_sale_amount = 0.0;
    $total_orders = 0.0;
    $araby = [];
    $styli = [];
    $marketerHub = [];
    $shosh = [];
    $ounass = [];
    $status = $request->status;

 
    
    // dd($dates);
    $all_data = [];
        $al_data = [];
       
        if(empty($filter)){
            if($brand && $coupon && empty($influencer)){
                $arabyy = Association::join('coupons','coupons.id','associations.coupon_id')->join('araby_ads','araby_ads.coupon_id','coupons.id')->where('associations.brand_id',$brand)->where('associations.coupon_id',$coupon)->where('coupons.currency',$currency)->select('*')->distinct()->get();
                $stylii = Association::join('coupons','coupons.id','associations.coupon_id')->join('styli','styli.coupon_id','coupons.id')->where('associations.brand_id',$brand)->where('associations.coupon_id',$coupon)->where('coupons.currency',$currency)->select('*')->distinct()->get();
                $marketerHubb = Association::join('coupons','coupons.id','associations.coupon_id')->join('marketer_hub','marketer_hub.coupon_id','coupons.id')->where('associations.brand_id',$brand)->where('associations.coupon_id',$coupon)->where('coupons.currency',$currency)->select('*')->distinct()->get();
                $shoshh = Association::join('coupons','coupons.id','associations.coupon_id')->join('shoshes','shoshes.coupon_id','coupons.id')->where('associations.brand_id',$brand)->where('associations.coupon_id',$coupon)->where('coupons.currency',$currency)->select('*')->distinct()->get();
                $ounasss = Association::join('coupons','coupons.id','associations.coupon_id')->join('ounass','ounass.coupon_id','coupons.id')->where('associations.brand_id',$brand)->where('associations.coupon_id',$coupon)->where('coupons.currency',$currency)->select('*')->distinct()->get();
                
               
                if(count($arabyy) > 0){
                    foreach($arabyy as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->net_revenue,',')? str_replace(',',"",$dat->net_revenue) : (float)$dat->net_revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->net_sales_amount_usd,',')? str_replace(',',"",$dat->net_sales_amount_usd) : (float)$dat->net_sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->net_orders,',')? str_replace(',',"",$dat->net_orders) : (int)$dat->net_orders);
    
                            array_push($araby,$dat);
                        }
                    }
                }
                if(count($stylii) > 0){
                    foreach($stylii as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->payout_usd,',')? str_replace(',',"",$dat->payout_usd) : (float)$dat->payout_usd);
                            // $total_aov = $total_aov + $dat->aov;
                            // $total_sale_amount = $total_sale_amount + $dat->net_sales_amount_usd;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->order_usd,',')? str_replace(',',"",$dat->order_usd) : (float)$dat->order_usd);
    
                            array_push($styli,$dat);
                        }
                    }
                }
                if(count($marketerHubb) > 0){
                    foreach($marketerHubb as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sales_amount_usd,',')? str_replace(',',"",$dat->sales_amount_usd) : (float)$dat->sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($marketerHub,$dat);
                        }
                    }
                }
                if(count($shoshh) > 0){
                    foreach($shoshh as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sale_amount,',')? str_replace(',',"",$dat->sale_amount) : (float)$dat->sale_amount);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($shosh,$dat);
                        }
                    }
                }
                if(count($ounasss) > 0){
                    foreach($ounasss as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            // $total_revenues = $total_revenues + $dat->sum_of_nmv;
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sum_of_nmv,',')? str_replace(',',"",$dat->sum_of_nmv) : (float)$dat->sum_of_nmv);
                            $total_orders = $total_orders + (str_contains($dat->_004_orders,',')? str_replace(',',"",$dat->_004_orders) : (int)$dat->_004_orders);
    
                            array_push($ounass,$dat);
                        }
                    }
                }
            }
            else if($brand && empty($coupon) && $influencer){
                $arabyy = Association::join('brands','brands.id','associations.brand_id')->join('araby_ads','araby_ads.brand_id','brands.id')->where('associations.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();
                $stylii = Association::join('brands','brands.id','associations.brand_id')->join('styli','styli.brand_id','brands.id')->where('associations.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();
                $marketerHubb = Association::join('brands','brands.id','associations.brand_id')->join('marketer_hub','marketer_hub.brand_id','brands.id')->where('associations.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();
                $shoshh = Association::join('brands','brands.id','associations.brand_id')->join('shoshes','shoshes.brand_id','brands.id')->where('associations.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();
                $ounasss = Association::join('brands','brands.id','associations.brand_id')->join('ounass','ounass.brand_id','brands.id')->where('associations.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();
                                    
                if(count($arabyy) > 0){
                    foreach($arabyy as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->net_revenue,',')? str_replace(',',"",$dat->net_revenue) : (float)$dat->net_revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->net_sales_amount_usd,',')? str_replace(',',"",$dat->net_sales_amount_usd) : (float)$dat->net_sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->net_orders,',')? str_replace(',',"",$dat->net_orders) : (int)$dat->net_orders);
    
                            array_push($araby,$dat);
                        }
                    }
                }
                if(count($stylii) > 0){
                    foreach($stylii as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->payout_usd,',')? str_replace(',',"",$dat->payout_usd) : (float)$dat->payout_usd);
                            // $total_aov = $total_aov + $dat->aov;
                            // $total_sale_amount = $total_sale_amount + $dat->net_sales_amount_usd;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->order_usd,',')? str_replace(',',"",$dat->order_usd) : (float)$dat->order_usd);
    
                            array_push($styli,$dat);
                        }
                    }
                }
                if(count($marketerHubb) > 0){
                    foreach($marketerHubb as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sales_amount_usd,',')? str_replace(',',"",$dat->sales_amount_usd) : (float)$dat->sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($marketerHub,$dat);
                        }
                    }
                }
                if(count($shoshh) > 0){
                    foreach($shoshh as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sale_amount,',')? str_replace(',',"",$dat->sale_amount) : (float)$dat->sale_amount);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($shosh,$dat);
                        }
                    }
                }
                if(count($ounasss) > 0){
                    foreach($ounasss as $dat){
                        
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            // $total_revenues = $total_revenues + $dat->sum_of_nmv;
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sum_of_nmv,',')? str_replace(',',"",$dat->sum_of_nmv) : (float)$dat->sum_of_nmv);
                            $total_orders = $total_orders + (str_contains($dat->_004_orders,',')? str_replace(',',"",$dat->_004_orders) : (int)$dat->_004_orders);
    
                            array_push($ounass,$dat);
                        }
                    }
                }
            }
            else if(!empty($brand) && !empty($coupon) && !empty($influencer) && empty($currency))
            {
                $arabyy = Association::join('brands','brands.id','associations.brand_id')->join('araby_ads','araby_ads.brand_id','brands.id')->join('coupons','coupons.id','araby_ads.coupon_id')->where('araby_ads.coupon_id',$coupon)->where('araby_ads.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();
                $stylii = Association::join('brands','brands.id','associations.brand_id')->join('styli','styli.brand_id','brands.id')->join('coupons','coupons.id','styli.coupon_id')->where('styli.coupon_id',$coupon)->where('styli.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();

                $marketerHubb = Association::join('brands','brands.id','associations.brand_id')->join('marketer_hub','marketer_hub.brand_id','brands.id')->join('coupons','coupons.id','marketer_hub.coupon_id')->where('marketer_hub.coupon_id',$coupon)->where('marketer_hub.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();

                $shoshh = Association::join('brands','brands.id','associations.brand_id')->join('shoshes','shoshes.brand_id','brands.id')->join('coupons','coupons.id','shoshes.coupon_id')->where('shoshes.brand_id',$brand)->where('shoshes.coupon_id',$coupon)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();

                $ounasss = Association::join('brands','brands.id','associations.brand_id')->join('ounass','ounass.brand_id','brands.id')->join('coupons','coupons.id','ounass.coupon_id')->where('ounass.brand_id',$brand)->where('ounass.coupon_id',$coupon)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();
                if(count($arabyy) > 0){
                    foreach($arabyy as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->net_revenue,',')? str_replace(',',"",$dat->net_revenue) : (float)$dat->net_revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->net_sales_amount_usd,',')? str_replace(',',"",$dat->net_sales_amount_usd) : (float)$dat->net_sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->net_orders,',')? str_replace(',',"",$dat->net_orders) : (int)$dat->net_orders);
    
                            array_push($araby,$dat);
                        }
                    }
                }
                if(count($stylii) > 0){
                    foreach($stylii as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year ){
                            $total_revenues = $total_revenues + (str_contains($dat->payout_usd,',')? str_replace(',',"",$dat->payout_usd) : (float)$dat->payout_usd);
                            // $total_aov = $total_aov + $dat->aov;
                            // $total_sale_amount = $total_sale_amount + $dat->net_sales_amount_usd;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->order_usd,',')? str_replace(',',"",$dat->order_usd) : (float)$dat->order_usd);
    
                            array_push($styli,$dat);
                        }
                    }
                }
                if(count($marketerHubb) > 0){
                    foreach($marketerHubb as $dat){
                        if($dat->date == $month){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sales_amount_usd,',')? str_replace(',',"",$dat->sales_amount_usd) : (float)$dat->sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($marketerHub,$dat);
                        }
                    }
                }
                if(count($shoshh) > 0){
                    foreach($shoshh as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sale_amount,',')? str_replace(',',"",$dat->sale_amount) : (float)$dat->sale_amount);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($shosh,$dat);
                        }
                    }
                }
                if(count($ounasss) > 0){
                    foreach($ounasss as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            // $total_revenues = $total_revenues + $dat->sum_of_nmv;
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sum_of_nmv,',')? str_replace(',',"",$dat->sum_of_nmv) : (float)$dat->sum_of_nmv);
                            $total_orders = $total_orders + (str_contains($dat->_004_orders,',')? str_replace(',',"",$dat->_004_orders) : (int)$dat->_004_orders);
    
                            array_push($ounass,$dat);
                        }
                    }

                }
            }
            else{
                $arabyy = Association::join('brands','brands.id','associations.brand_id')->join('araby_ads','araby_ads.brand_id','brands.id')->join('coupons','coupons.id','araby_ads.coupon_id')->where('araby_ads.coupon_id',$coupon)->where('araby_ads.brand_id',$brand)->where('associations.influencer_id',$influencer)->where('coupons.currency',$currency)->select('*')->distinct()->get();
                $stylii = Association::join('brands','brands.id','associations.brand_id')->join('styli','styli.brand_id','brands.id')->join('coupons','coupons.id','styli.coupon_id')->where('styli.coupon_id',$coupon)->where('styli.brand_id',$brand)->where('associations.influencer_id',$influencer)->where('coupons.currency',$currency)->select('*')->distinct()->get();

                $marketerHubb = Association::join('brands','brands.id','associations.brand_id')->join('marketer_hub','marketer_hub.brand_id','brands.id')->join('coupons','coupons.id','marketer_hub.coupon_id')->where('marketer_hub.coupon_id',$coupon)->where('marketer_hub.brand_id',$brand)->where('associations.influencer_id',$influencer)->where('coupons.currency',$currency)->select('*')->distinct()->get();

                $shoshh = Association::join('brands','brands.id','associations.brand_id')->join('shoshes','shoshes.brand_id','brands.id')->join('coupons','coupons.id','shoshes.coupon_id')->where('shoshes.brand_id',$brand)->where('shoshes.coupon_id',$coupon)->where('associations.influencer_id',$influencer)->where('coupons.currency',$currency)->select('*')->distinct()->get();

                $ounasss = Association::join('brands','brands.id','associations.brand_id')->join('ounass','ounass.brand_id','brands.id')->join('coupons','coupons.id','ounass.coupon_id')->where('ounass.brand_id',$brand)->where('ounass.coupon_id',$coupon)->where('associations.influencer_id',$influencer)->where('coupons.currency',$currency)->select('*')->distinct()->get();
                // dd($araby);
                if(count($arabyy) > 0){
                    foreach($arabyy as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->net_revenue,',')? str_replace(',',"",$dat->net_revenue) : (float)$dat->net_revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->net_sales_amount_usd,',')? str_replace(',',"",$dat->net_sales_amount_usd) : (float)$dat->net_sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->net_orders,',')? str_replace(',',"",$dat->net_orders) : (int)$dat->net_orders);
    
                            array_push($araby,$dat);
                        }
                    }
                }
                if(count($stylii) > 0){
                    foreach($stylii as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->payout_usd,',')? str_replace(',',"",$dat->payout_usd) : (float)$dat->payout_usd);
                            // $total_aov = $total_aov + $dat->aov;
                            // $total_sale_amount = $total_sale_amount + $dat->net_sales_amount_usd;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->order_usd,',')? str_replace(',',"",$dat->order_usd) : (float)$dat->order_usd);
    
                            array_push($styli,$dat);
                        }
                    }
                }
                if(count($marketerHubb) > 0){
                    foreach($marketerHubb as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sales_amount_usd,',')? str_replace(',',"",$dat->sales_amount_usd) : (float)$dat->sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($marketerHub,$dat);
                        }
                    }
                }
                if(count($shoshh) > 0){
                    foreach($shoshh as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sale_amount,',')? str_replace(',',"",$dat->sale_amount) : (float)$dat->sale_amount);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($shosh,$dat);
                        }
                    }
                }
                if(count($ounasss) > 0){
                    foreach($ounasss as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            // $total_revenues = $total_revenues + $dat->sum_of_nmv;
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sum_of_nmv,',')? str_replace(',',"",$dat->sum_of_nmv) : (float)$dat->sum_of_nmv);
                            $total_orders = $total_orders + (str_contains($dat->_004_orders,',')? str_replace(',',"",$dat->_004_orders) : (int)$dat->_004_orders);
    
                            array_push($ounass,$dat);
                        }
                    }
                }
            
            }
        }
        else if(!empty($filter)){
            if($brand && $coupon && empty($influencer)){
                $arabyy = Association::join('coupons','coupons.id','associations.coupon_id')->join('araby_ads','araby_ads.coupon_id','coupons.id')->where('associations.brand_id',$brand)->where('associations.coupon_id',$coupon)->where('coupons.currency',$currency)->select('*')->distinct()->get();
                $stylii = Association::join('coupons','coupons.id','associations.coupon_id')->join('styli','styli.coupon_id','coupons.id')->where('associations.brand_id',$brand)->where('associations.coupon_id',$coupon)->where('coupons.currency',$currency)->select('*')->distinct()->get();
                $marketerHubb = Association::join('coupons','coupons.id','associations.coupon_id')->join('marketer_hub','marketer_hub.coupon_id','coupons.id')->where('associations.brand_id',$brand)->where('associations.coupon_id',$coupon)->where('coupons.currency',$currency)->select('*')->distinct()->get();
                $shoshh = Association::join('coupons','coupons.id','associations.coupon_id')->join('shoshes','shoshes.coupon_id','coupons.id')->where('associations.brand_id',$brand)->where('associations.coupon_id',$coupon)->where('coupons.currency',$currency)->select('*')->distinct()->get();
                $ounasss = Association::join('coupons','coupons.id','associations.coupon_id')->join('ounass','ounass.coupon_id','coupons.id')->where('associations.brand_id',$brand)->where('associations.coupon_id',$coupon)->where('coupons.currency',$currency)->select('*')->distinct()->get();
                
               
                if(count($arabyy) > 0){
                    foreach($arabyy as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->net_revenue,',')? str_replace(',',"",$dat->net_revenue) : (float)$dat->net_revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->net_sales_amount_usd,',')? str_replace(',',"",$dat->net_sales_amount_usd) : (float)$dat->net_sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->net_orders,',')? str_replace(',',"",$dat->net_orders) : (int)$dat->net_orders);
    
                            array_push($araby,$dat);
                        }
                    }
                }
                if(count($stylii) > 0){
                    foreach($stylii as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->payout_usd,',')? str_replace(',',"",$dat->payout_usd) : (float)$dat->payout_usd);
                            // $total_aov = $total_aov + $dat->aov;
                            // $total_sale_amount = $total_sale_amount + $dat->net_sales_amount_usd;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->order_usd,',')? str_replace(',',"",$dat->order_usd) : (float)$dat->order_usd);
    
                            array_push($styli,$dat);
                        }
                    }
                }
                if(count($marketerHubb) > 0){
                    foreach($marketerHubb as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sales_amount_usd,',')? str_replace(',',"",$dat->sales_amount_usd) : (float)$dat->sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($marketerHub,$dat);
                        }
                    }
                }
                if(count($shoshh) > 0){
                    foreach($shoshh as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sale_amount,',')? str_replace(',',"",$dat->sale_amount) : (float)$dat->sale_amount);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($shosh,$dat);
                        }
                    }
                }
                if(count($ounasss) > 0){
                    foreach($ounasss as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            // $total_revenues = $total_revenues + $dat->sum_of_nmv;
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sum_of_nmv,',')? str_replace(',',"",$dat->sum_of_nmv) : (float)$dat->sum_of_nmv);
                            $total_orders = $total_orders + (str_contains($dat->_004_orders,',')? str_replace(',',"",$dat->_004_orders) : (int)$dat->_004_orders);
    
                            array_push($ounass,$dat);
                        }
                    }
                }
            }
            else if($brand && empty($coupon) && $influencer){
                $arabyy = Association::join('brands','brands.id','associations.brand_id')->join('araby_ads','araby_ads.brand_id','brands.id')->where('associations.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();
                $stylii = Association::join('brands','brands.id','associations.brand_id')->join('styli','styli.brand_id','brands.id')->where('associations.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();
                $marketerHubb = Association::join('brands','brands.id','associations.brand_id')->join('marketer_hub','marketer_hub.brand_id','brands.id')->where('associations.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();
                $shoshh = Association::join('brands','brands.id','associations.brand_id')->join('shoshes','shoshes.brand_id','brands.id')->where('associations.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();
                $ounasss = Association::join('brands','brands.id','associations.brand_id')->join('ounass','ounass.brand_id','brands.id')->where('associations.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();
                                    
                if(count($arabyy) > 0){
                    foreach($arabyy as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->net_revenue,',')? str_replace(',',"",$dat->net_revenue) : (float)$dat->net_revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->net_sales_amount_usd,',')? str_replace(',',"",$dat->net_sales_amount_usd) : (float)$dat->net_sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->net_orders,',')? str_replace(',',"",$dat->net_orders) : (int)$dat->net_orders);
    
                            array_push($araby,$dat);
                        }
                    }
                }
                if(count($stylii) > 0){
                    foreach($stylii as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->payout_usd,',')? str_replace(',',"",$dat->payout_usd) : (float)$dat->payout_usd);
                            // $total_aov = $total_aov + $dat->aov;
                            // $total_sale_amount = $total_sale_amount + $dat->net_sales_amount_usd;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->order_usd,',')? str_replace(',',"",$dat->order_usd) : (float)$dat->order_usd);
    
                            array_push($styli,$dat);
                        }
                    }
                }
                if(count($marketerHubb) > 0){
                    foreach($marketerHubb as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sales_amount_usd,',')? str_replace(',',"",$dat->sales_amount_usd) : (float)$dat->sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($marketerHub,$dat);
                        }
                    }
                }
                if(count($shoshh) > 0){
                    foreach($shoshh as $dat){
                        // 
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sale_amount,',')? str_replace(',',"",$dat->sale_amount) : (float)$dat->sale_amount);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($shosh,$dat);
                        }
                    }
                }
                if(count($ounasss) > 0){
                    foreach($ounasss as $dat){
                        
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            // $total_revenues = $total_revenues + $dat->sum_of_nmv;
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sum_of_nmv,',')? str_replace(',',"",$dat->sum_of_nmv) : (float)$dat->sum_of_nmv);
                            $total_orders = $total_orders + (str_contains($dat->_004_orders,',')? str_replace(',',"",$dat->_004_orders) : (int)$dat->_004_orders);
    
                            array_push($ounass,$dat);
                        }
                    }
                }
            }
            else if(!empty($brand) && !empty($coupon) && !empty($influencer) && empty($currency))
            {
                $arabyy = Association::join('brands','brands.id','associations.brand_id')->join('araby_ads','araby_ads.brand_id','brands.id')->join('coupons','coupons.id','araby_ads.coupon_id')->where('araby_ads.coupon_id',$coupon)->where('araby_ads.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();
                $stylii = Association::join('brands','brands.id','associations.brand_id')->join('styli','styli.brand_id','brands.id')->join('coupons','coupons.id','styli.coupon_id')->where('styli.coupon_id',$coupon)->where('styli.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();

                $marketerHubb = Association::join('brands','brands.id','associations.brand_id')->join('marketer_hub','marketer_hub.brand_id','brands.id')->join('coupons','coupons.id','marketer_hub.coupon_id')->where('marketer_hub.coupon_id',$coupon)->where('marketer_hub.brand_id',$brand)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();

                $shoshh = Association::join('brands','brands.id','associations.brand_id')->join('shoshes','shoshes.brand_id','brands.id')->join('coupons','coupons.id','shoshes.coupon_id')->where('shoshes.brand_id',$brand)->where('shoshes.coupon_id',$coupon)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();

                $ounasss = Association::join('brands','brands.id','associations.brand_id')->join('ounass','ounass.brand_id','brands.id')->join('coupons','coupons.id','ounass.coupon_id')->where('ounass.brand_id',$brand)->where('ounass.coupon_id',$coupon)->where('associations.influencer_id',$influencer)->select('*')->distinct()->get();
                if(count($arabyy) > 0){
                    foreach($arabyy as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->net_revenue,',')? str_replace(',',"",$dat->net_revenue) : (float)$dat->net_revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->net_sales_amount_usd,',')? str_replace(',',"",$dat->net_sales_amount_usd) : (float)$dat->net_sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->net_orders,',')? str_replace(',',"",$dat->net_orders) : (int)$dat->net_orders);
    
                            array_push($araby,$dat);
                        }
                    }
                }
                if(count($stylii) > 0){
                    foreach($stylii as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year ){
                            $total_revenues = $total_revenues + (str_contains($dat->payout_usd,',')? str_replace(',',"",$dat->payout_usd) : (float)$dat->payout_usd);
                            // $total_aov = $total_aov + $dat->aov;
                            // $total_sale_amount = $total_sale_amount + $dat->net_sales_amount_usd;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->order_usd,',')? str_replace(',',"",$dat->order_usd) : (float)$dat->order_usd);
    
                            array_push($styli,$dat);
                        }
                    }
                }
                if(count($marketerHubb) > 0){
                    foreach($marketerHubb as $dat){
                        if($dat->date == $month){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sales_amount_usd,',')? str_replace(',',"",$dat->sales_amount_usd) : (float)$dat->sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($marketerHub,$dat);
                        }
                    }
                }
                if(count($shoshh) > 0){
                    foreach($shoshh as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sale_amount,',')? str_replace(',',"",$dat->sale_amount) : (float)$dat->sale_amount);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($shosh,$dat);
                        }
                    }
                }
                if(count($ounasss) > 0){
                    foreach($ounasss as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            // $total_revenues = $total_revenues + $dat->sum_of_nmv;
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sum_of_nmv,',')? str_replace(',',"",$dat->sum_of_nmv) : (float)$dat->sum_of_nmv);
                            $total_orders = $total_orders + (str_contains($dat->_004_orders,',')? str_replace(',',"",$dat->_004_orders) : (int)$dat->_004_orders);
    
                            array_push($ounass,$dat);
                        }
                    }

                }
            }
            else{
                $arabyy = Association::join('brands','brands.id','associations.brand_id')->join('araby_ads','araby_ads.brand_id','brands.id')->join('coupons','coupons.id','araby_ads.coupon_id')->where('araby_ads.coupon_id',$coupon)->where('araby_ads.brand_id',$brand)->where('associations.influencer_id',$influencer)->where('coupons.currency',$currency)->select('*')->distinct()->get();
                $stylii = Association::join('brands','brands.id','associations.brand_id')->join('styli','styli.brand_id','brands.id')->join('coupons','coupons.id','styli.coupon_id')->where('styli.coupon_id',$coupon)->where('styli.brand_id',$brand)->where('associations.influencer_id',$influencer)->where('coupons.currency',$currency)->select('*')->distinct()->get();

                $marketerHubb = Association::join('brands','brands.id','associations.brand_id')->join('marketer_hub','marketer_hub.brand_id','brands.id')->join('coupons','coupons.id','marketer_hub.coupon_id')->where('marketer_hub.coupon_id',$coupon)->where('marketer_hub.brand_id',$brand)->where('associations.influencer_id',$influencer)->where('coupons.currency',$currency)->select('*')->distinct()->get();

                $shoshh = Association::join('brands','brands.id','associations.brand_id')->join('shoshes','shoshes.brand_id','brands.id')->join('coupons','coupons.id','shoshes.coupon_id')->where('shoshes.brand_id',$brand)->where('shoshes.coupon_id',$coupon)->where('associations.influencer_id',$influencer)->where('coupons.currency',$currency)->select('*')->distinct()->get();

                $ounasss = Association::join('brands','brands.id','associations.brand_id')->join('ounass','ounass.brand_id','brands.id')->join('coupons','coupons.id','ounass.coupon_id')->where('ounass.brand_id',$brand)->where('ounass.coupon_id',$coupon)->where('associations.influencer_id',$influencer)->where('coupons.currency',$currency)->select('*')->distinct()->get();
                // dd($araby);
                if(count($arabyy) > 0){
                    foreach($arabyy as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->net_revenue,',')? str_replace(',',"",$dat->net_revenue) : (float)$dat->net_revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->net_sales_amount_usd,',')? str_replace(',',"",$dat->net_sales_amount_usd) : (float)$dat->net_sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->net_orders,',')? str_replace(',',"",$dat->net_orders) : (int)$dat->net_orders);
    
                            array_push($araby,$dat);
                        }
                    }
                }
                if(count($stylii) > 0){
                    foreach($stylii as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->payout_usd,',')? str_replace(',',"",$dat->payout_usd) : (float)$dat->payout_usd);
                            // $total_aov = $total_aov + $dat->aov;
                            // $total_sale_amount = $total_sale_amount + $dat->net_sales_amount_usd;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->order_usd,',')? str_replace(',',"",$dat->order_usd) : (float)$dat->order_usd);
    
                            array_push($styli,$dat);
                        }
                    }
                }
                if(count($marketerHubb) > 0){
                    foreach($marketerHubb as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sales_amount_usd,',')? str_replace(',',"",$dat->sales_amount_usd) : (float)$dat->sales_amount_usd);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($marketerHub,$dat);
                        }
                    }
                }
                if(count($shoshh) > 0){
                    foreach($shoshh as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sale_amount,',')? str_replace(',',"",$dat->sale_amount) : (float)$dat->sale_amount);
                            $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);
    
                            array_push($shosh,$dat);
                        }
                    }
                }
                if(count($ounasss) > 0){
                    foreach($ounasss as $dat){
                        if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                            // $total_revenues = $total_revenues + $dat->sum_of_nmv;
                            // $total_aov = $total_aov + $dat->aov;
                            $total_sale_amount = $total_sale_amount + (str_contains($dat->sum_of_nmv,',')? str_replace(',',"",$dat->sum_of_nmv) : (float)$dat->sum_of_nmv);
                            $total_orders = $total_orders + (str_contains($dat->_004_orders,',')? str_replace(',',"",$dat->_004_orders) : (int)$dat->_004_orders);
    
                            array_push($ounass,$dat);
                        }
                    }
                }
            
            }
        }
    if((!empty($brand) && empty($coupon) && empty($influencer) && !empty($filter) && empty($currency)) || (!empty($brand) && empty($coupon) && empty($influencer) && empty($filter) && empty($currency))){
        // dd('df');
        $araby = ArabyAds::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)->where('brand_id',$brand)->get();
        $styli = Styli::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)->where('brand_id',$brand)->get();
        $marketerHub = MarketerHub::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)->where('brand_id',$brand)->get();
        $shosh = Shosh::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)->where('brand_id',$brand)->get();
        $ounass = Ounass::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)->where('brand_id',$brand)->get();
        // dump($araby);
        // dump($styli);
        // dump($shosh);
        // dump($marketerHub);
        // dd($ounass);

        if(count($araby) > 0){
            foreach($araby as $dat){
                if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                    $total_revenues = $total_revenues + (str_contains($dat->net_revenue,',')? str_replace(',',"",$dat->net_revenue) : (float)$dat->net_revenue);
                    // $total_aov = $total_aov + $dat->aov;
                    $total_sale_amount = $total_sale_amount + (str_contains($dat->net_sales_amount_usd,',')? str_replace(',',"",$dat->net_sales_amount_usd) : (float)$dat->net_sales_amount_usd);
                    $total_orders = $total_orders + (str_contains($dat->net_orders,',')? str_replace(',',"",$dat->net_orders) : (int)$dat->net_orders);

                    array_push($all_data,$dat);
                }
            }
        }
        if(count($styli) > 0){
            foreach($styli as $dat){
                if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                    $total_revenues = $total_revenues + (str_contains($dat->payout_usd,',')? str_replace(',',"",$dat->payout_usd) : (float)$dat->payout_usd);
                    // $total_aov = $total_aov + $dat->aov;
                    $total_sale_amount = $total_sale_amount + (str_contains($dat->order_usd,',')? str_replace(',',"",$dat->order_usd) : (float)$dat->order_usd);
                    // $total_orders = $total_orders + (str_contains($dat->order_usd,',')? str_replace(',',"",$dat->order_usd) : (int)$dat->order_usd);

                    array_push($all_data,$dat);
                }
            }
        }

        if(count($marketerHub) > 0){
            foreach($marketerHub as $dat){
                if(in_array($dat->date,$months)){
                    $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                    // $total_aov = $total_aov + $dat->aov;
                    $total_sale_amount = $total_sale_amount + (str_contains($dat->sales_amount_usd,',')? str_replace(',',"",$dat->sales_amount_usd) : (float)$dat->sales_amount_usd);
                    $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);

                    array_push($all_data,$dat);
                }
            }
        }
       

        if(count($shosh) > 0){
            foreach($shosh as $dat){
                if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                    $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                    // $total_aov = $total_aov + $dat->aov;
                    $total_sale_amount = $total_sale_amount + (str_contains($dat->sale_amount,',') ? str_replace(',',"",$dat->sale_amount) : (float)$dat->sale_amount);
                    $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);

                    array_push($all_data,$dat);
                }
            }
        }
        //  dump($total_sale_amount);
        if(count($ounass) > 0){
            foreach($ounass as $dat){
                if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                    // $total_revenues = $total_revenues + $dat->sum_of_nmv;
                    // $total_aov = $total_aov + $dat->aov;
                    $total_sale_amount = $total_sale_amount + (str_contains($dat->sum_of_nmv,',')? str_replace(',',"",$dat->sum_of_nmv) : (float)$dat->sum_of_nmv);
                    $total_orders = $total_orders + (str_contains($dat->_004_orders,',')? str_replace(',',"",$dat->_004_orders) : (int)$dat->_004_orders);

                    array_push($all_data,$dat);
                }
            }
        }
        // dump($total_orders);
        // dump($total_revenues);
        
        // $a_data = $all_data->paginate(10);
        // dd('kkk');
        

    }
        if((empty($brand) && empty($coupon) && empty($influencer) && empty($currency) && empty($filter)) || (empty($brand) && empty($coupon) && empty($influencer) && empty($currency) && !empty($filter))){
            
            $araby = ArabyAds::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)->get();
            $styli = Styli::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)->get();
            $marketerHub = MarketerHub::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)->get();
            $shosh = Shosh::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)->get();
            $ounass = Ounass::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)->get();
            if(count($araby) > 0){
                foreach($araby as $dat){
                    if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                        $total_revenues = $total_revenues + (str_contains($dat->net_revenue,',')? str_replace(',',"",$dat->net_revenue) : (float)$dat->net_revenue);
                        // $total_aov = $total_aov + $dat->aov;
                        $total_sale_amount = $total_sale_amount + (str_contains($dat->net_sales_amount_usd,',')? str_replace(',',"",$dat->net_sales_amount_usd) : (float)$dat->net_sales_amount_usd);
                        $total_orders = $total_orders + (str_contains($dat->net_orders,',')? str_replace(',',"",$dat->net_orders) : (int)$dat->net_orders);

                        array_push($all_data,$dat);
                    }
                }
            }
            
            if(count($styli) > 0){
                foreach($styli as $dat){
                    if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                        $total_revenues = $total_revenues + str_contains($dat->payout_usd,',')? str_replace(',',"",$dat->payout_usd) : (float)$dat->payout_usd;
                        // $total_aov = $total_aov + $dat->aov;
                        // $total_sale_amount = $total_sale_amount + $dat->net_sales_amount_usd;
                        $total_sale_amount = $total_sale_amount + (str_contains($dat->order_usd,',')? str_replace(',',"",$dat->order_usd) : (float)$dat->order_usd);

                        array_push($all_data,$dat);
                    }
                }
            }
            
            if(count($marketerHub) > 0){
                foreach($marketerHub as $dat){
                    if(in_array($dat->date,$months)){
                        $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                        // $total_aov = $total_aov + $dat->aov;
                        $total_sale_amount = $total_sale_amount + (str_contains($dat->sales_amount_usd,',')? str_replace(',',"",$dat->sales_amount_usd) : (float)$dat->sales_amount_usd);
                        $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);

                        array_push($all_data,$dat);
                    }
                }
            }
            
            if(count($shosh) > 0){
                foreach($shosh as $dat){
                    if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                        $total_revenues = $total_revenues + (str_contains($dat->revenue,',')? str_replace(',',"",$dat->revenue) : (float)$dat->revenue);
                        // $total_aov = $total_aov + $dat->aov;
                        $total_sale_amount = $total_sale_amount + (str_contains($dat->sale_amount,',')? str_replace(',',"",$dat->sale_amount) : (float)$dat->sale_amount);
                        $total_orders = $total_orders + (str_contains($dat->orders,',')? str_replace(',',"",$dat->orders) : (int)$dat->orders);

                        array_push($all_data,$dat);
                    }
                }
            }
            
            if(count($ounass) > 0){
                foreach($ounass as $dat){
                    if($dat->month >= $from_month && $dat->month <= $to_month && $dat->year == $year){
                        // $total_revenues = $total_revenues + $dat->sum_of_nmv;
                        // $total_aov = $total_aov + $dat->aov;
                        $total_sale_amount = $total_sale_amount + (str_contains($dat->sum_of_nmv,',')? str_replace(',',"",$dat->sum_of_nmv) : (float)$dat->sum_of_nmv);
                        $total_orders = $total_orders + (str_contains($dat->_004_orders,',')? str_replace(',',"",$dat->_004_orders) : (int)$dat->_004_orders);

                        array_push($all_data,$dat);
                    }
                }
            }
            // dd($dates);
            // // dd($araby);
            // dump(count($ounass));
            // dump($total_sale_amount);
            // dd($total_orders);
            

        }
        // dd($dates);
        // $a_data = $all_data->paginate(10);
        // dd($a_data);
        $max = max($total_sale_amount,$total_revenues,$total_orders);
        // dd($max);
        return view('graph.search', compact('status','month','currencies','brands', 'coupons', 'influencers','all_data','filter','currency','coupon','influencer','countries','brand','dates','total_revenues','total_sale_amount','total_orders','araby','styli','marketerHub','ounass','shosh', 'max','earliest_year','latest_year','year','from_month','to_month'));
        
        
    }
}