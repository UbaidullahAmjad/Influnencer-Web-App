<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Management;
use App\Models\Coupon;
use App\Models\Influencer;
use App\Models\CouponInfluencer;
use App\Models\Brand;
use App\Models\Association;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LineGraphController extends Controller
{
    public function index()
    {
        // dd("hello");
        $brands = [];
        $coupons = [];
        $currencies = [];
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
            
            return view('line_graph.graph', compact('brands', 'coupons','currencies'));
            // dd($associations);
        }else{
            $brands = Brand::all();
            $coupons = Coupon::all();
            $influencers = User::where('user_type',2)->get();
            $currencies = Coupon::distinct()->get(['currency']);
            // $currencies =
            // dd($influencers) ;
            // dd($countries);
          
            return view('line_graph.graph', compact('brands', 'coupons', 'influencers','currencies'));
        }
        
    }

    public function search(Request $request)
    {
        //   dd($request->all());
        $currency = $request->currency;
        $brand = $request->brand;
        $coupon = $request->coupon;
        $influencer = $request->influencer;
        $daterange = $request->daterange;
        $filter = $request->filter;
        $influencers = User::all();
        $countries = DB::table('countries')->get();
        $brands = [];
        $coupons = [];
        $currencies = [];
        
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
        
        

        $date = explode('-', $daterange);
        

        
    //    dd($period);
             
        $fa = strtotime($date[0]);
        $la = strtotime($date[1]);
        $start_date = Carbon::parse($fa)->format('Y-m-d');
        $end_date = Carbon::parse($la)->format('Y-m-d');

    //     $period = new \DatePeriod(
    //         new \DateTime($start_date),
    //         new \DateInterval('P1D'),
    //         new \DateTime($end_date),
    //    );
       $dates = [];
    //    dd($period);
    //    foreach ($period as $key => $value) {
        
    //     $d = $value->format('d/m/Y');
    //         if($d){
    //             array_push($dates, $d);
    //         }
    //     }
    $period = \Carbon\CarbonPeriod::create($start_date, $end_date);

// Iterate over the period
    foreach ($period as $date) {
        // dump();
        array_push($dates, $date->format('d/m/Y'));
    }

    // Convert the period to an array of dates
    // $dates = $period->toArray();
        // dd($dates);
    // dd('stop');
    $total_revenues = 0;
    $total_aov = 0;
    $total_sale_amount = 0;
    $total_orders = 0;
    if(!empty($brand) && empty($coupon) && empty($influencer) && empty($filter) && empty($currency)){
        $all_data = CouponInfluencer::where('date', ">=", $start_date)->where('date', "<=", $end_date)->where('brand_id',$brand)->get();
        if(count($all_data) > 0){
            foreach($all_data as $dat){
                if($dat->date >= $start_date && $dat->date <= $end_date){
                    $total_revenues = $total_revenues + $dat->revenue;
                    // $total_aov = $total_aov + $dat->aov;
                    $total_sale_amount = $total_sale_amount + $dat->sale_ammount;
                    $total_orders = $total_orders + $dat->order;

                    // array_push($all_data,$dat);
                }
            }
        }
        // $a_data = $all_data->paginate(10);
        dd($all_data);
        return view('line_graph.search', compact('currencies','brands', 'coupons', 'influencers','all_data','filter','currency','coupon','influencer','daterange','countries','brand','dates','total_revenues','total_sale_amount','total_orders'));

    }
    if(empty($brand) && !empty($coupon) && empty($influencer) && empty($filter) && empty($currency)){
        $all_data = CouponInfluencer::where('date', ">=", $start_date)->where('date', "<=", $end_date)->where('coupon_id',$coupon)->get();
        if(count($all_data) > 0){
            foreach($all_data as $dat){
                if($dat->date >= $start_date && $dat->date <= $end_date){
                    $total_revenues = $total_revenues + $dat->revenue;
                    // $total_aov = $total_aov + $dat->aov;
                    $total_sale_amount = $total_sale_amount + $dat->sale_ammount;
                    $total_orders = $total_orders + $dat->order;

                    // array_push($all_data,$dat);
                }
            }
        }
        return view('line_graph.search', compact('currencies','brands', 'coupons', 'influencers','all_data','filter','currency','coupon','influencer','daterange','countries','brand','dates','total_revenues','total_sale_amount','total_orders'));

    }
    // dd($dates);
    $all_data = [];
        $al_data = [];
        if(empty($brand) && empty($coupon) && empty($influencer) && empty($filter) && empty($currency)){
            $all_data = CouponInfluencer::where('date', ">=", $start_date)->where('date', "<=", $end_date)->get();
            if(count($all_data) > 0){
                foreach($all_data as $dat){
                    if($dat->date >= $start_date && $dat->date <= $end_date){
                        $total_revenues = $total_revenues + $dat->revenue;
                        // $total_aov = $total_aov + $dat->aov;
                        $total_sale_amount = $total_sale_amount + $dat->sale_ammount;
                        $total_orders = $total_orders + $dat->order;

                        // array_push($all_data,$dat);
                    }
                }
            }
                // dd($dates);
            return view('line_graph.search', compact('currencies','brands', 'coupons', 'influencers','all_data','filter','currency','coupon','influencer','daterange','countries','brand','dates','total_revenues','total_sale_amount','total_orders'));

        }
        if(empty($filter)){
            if($brand && $coupon && empty($influencer)){
                $al_data = Association::join('coupons','coupons.id','associations.coupon_id')
                ->join('coupon_influencers','coupon_influencers.coupon_id','coupons.id')
                ->join('brands','brands.id','coupon_influencers.brand_id') 
                ->join('users','users.id','associations.influencer_id')                          
                ->where('associations.brand_id',$brand)
                
                ->where('associations.coupon_id',$coupon)
                ->orWhere('coupons.currency',$currency)
                ->select('coupon_influencers.*')->distinct()->get();
            }else if(empty($brand) && $coupon && $influencer){
                $al_data = Association::join('coupons','coupons.id','associations.coupon_id')
                ->join('coupon_influencers','coupon_influencers.coupon_id','coupons.id')
                ->join('brands','brands.id','coupon_influencers.brand_id') 
                ->join('users','users.id','associations.influencer_id')                          
                
                ->where('associations.influencer_id',$influencer)
                ->where('associations.coupon_id',$coupon)
                ->orWhere('coupons.currency',$currency)
                ->select('coupon_influencers.*')->distinct()->get();
            }else if($brand && empty($coupon) && $influencer){
                $al_data = Association::join('coupons','coupons.id','associations.coupon_id')
                ->join('coupon_influencers','coupon_influencers.coupon_id','coupons.id')
                ->join('brands','brands.id','coupon_influencers.brand_id') 
                ->join('users','users.id','associations.influencer_id')                          
                ->where('associations.brand_id',$brand)
                ->where('associations.influencer_id',$influencer)
                
                ->orWhere('coupons.currency',$currency)
                ->select('coupon_influencers.*')->distinct()->get();
            }else{
                $al_data = Association::join('coupons','coupons.id','associations.coupon_id')
                ->join('coupon_influencers','coupon_influencers.coupon_id','coupons.id')
                ->join('brands','brands.id','coupon_influencers.brand_id') 
                ->join('users','users.id','associations.influencer_id')                          
                ->where('associations.brand_id',$brand)
                ->where('associations.influencer_id',$influencer)
                ->where('associations.coupon_id',$coupon)
                ->orWhere('coupons.currency',$currency)
                ->select('coupon_influencers.*')->distinct()->get();
            }
            
            // dd($request->all());
            // dd($al_data);
            if(count($al_data) > 0){
                foreach($al_data as $dat){
                    if($dat->date >= $start_date && $dat->date <= $end_date){
                        $total_revenues = $total_revenues + $dat->revenue;
                        // $total_aov = $total_aov + $dat->aov;
                        $total_sale_amount = $total_sale_amount + $dat->sale_ammount;
                        $total_orders = $total_orders + $dat->order;

                        array_push($all_data,$dat);
                    }
                }
            }
            
            
        }else if(!empty($filter)){
            if($brand && $coupon && empty($influencer)){
                $al_data = Association::join('coupons','coupons.id','associations.coupon_id')
                ->join('coupon_influencers','coupon_influencers.coupon_id','coupons.id')
                ->join('brands','brands.id','coupon_influencers.brand_id') 
                ->join('users','users.id','associations.influencer_id')                          
                ->where('associations.brand_id',$brand)
                
                ->where('associations.coupon_id',$coupon)
                ->orWhere('coupons.currency',$currency)
                ->select('coupon_influencers.*')->distinct()->get();
            }else if(empty($brand) && $coupon && $influencer){
                $al_data = Association::join('coupons','coupons.id','associations.coupon_id')
                ->join('coupon_influencers','coupon_influencers.coupon_id','coupons.id')
                ->join('brands','brands.id','coupon_influencers.brand_id') 
                ->join('users','users.id','associations.influencer_id')                          
                
                ->where('associations.influencer_id',$influencer)
                ->where('associations.coupon_id',$coupon)
                ->orWhere('coupons.currency',$currency)
                ->select('coupon_influencers.*')->distinct()->get();
            }else if($brand && empty($coupon) && $influencer){
                $al_data = Association::join('coupons','coupons.id','associations.coupon_id')
                ->join('coupon_influencers','coupon_influencers.coupon_id','coupons.id')
                ->join('brands','brands.id','coupon_influencers.brand_id') 
                ->join('users','users.id','associations.influencer_id')                          
                ->where('associations.brand_id',$brand)
                ->where('associations.influencer_id',$influencer)
                
                ->orWhere('coupons.currency',$currency)
                ->select('coupon_influencers.*')->distinct()->get();
            }else{
                $al_data = Association::join('coupons','coupons.id','associations.coupon_id')
                ->join('coupon_influencers','coupon_influencers.coupon_id','coupons.id')
                ->join('brands','brands.id','coupon_influencers.brand_id') 
                ->join('users','users.id','associations.influencer_id')                          
                ->where('associations.brand_id',$brand)
                ->where('associations.influencer_id',$influencer)
                ->where('associations.coupon_id',$coupon)
                ->orWhere('coupons.currency',$currency)
                ->select('coupon_influencers.*')->distinct()->get();
            }
            
            if(count($al_data) > 0){
                foreach($al_data as $dat){
                    if($dat->date >= $start_date && $dat->date <= $end_date){
                        $total_revenues = $total_revenues + $dat->revenue;
                        // $total_aov = $total_aov + $dat->aov;
                        $total_sale_amount = $total_sale_amount + $dat->sale_ammount;
                        $total_orders = $total_orders + $dat->order;
                        array_push($all_data,$dat);
                    }
                }
            }
        //    dd($all_data);
        }
        // dd($dates);
        // $a_data = $all_data->paginate(10);
        // dd($a_data);
        return view('line_graph.search', compact('currencies','brands', 'coupons', 'influencers','all_data','filter','currency','coupon','influencer','daterange','countries','brand','dates','total_revenues','total_sale_amount','total_orders'));
        
    }
}
