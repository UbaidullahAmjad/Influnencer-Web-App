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

class InfluencerGraphController extends Controller
{
    public function index()
    {
        $brands = [];
        $coupons = [];
        $currencies = [];
        $currently_selected = date('Y'); 
        $earliest_year = 1900; 
        $latest_year = date('Y');
       
        // $daterange = $request->daterange;
        
        $all_data = [];
        $year = date('Y');
        $from_month = date('m');
        $to_month = date('m');
        // dd($from_month);
        if($from_month < 10){
            $from_month = explode('0', $from_month)[1];
        }
        if($to_month < 10){
            $to_month = explode('0', $to_month)[1];
        }
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
         
        
    
  
    $total_revenues = 0.0;
    $total_aov = 0;
    $total_sale_amount = 0.0;
    $total_orders = 0.0;
    $araby = [];
    $styli = [];
    $marketerHub = [];
    $shosh = [];
    $ounass = [];

 
    
    // dd($dates);
    $all_data = [];
       
            
            $araby = ArabyAds::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)
                ->get();
            // dd($araby);
            $styli = Styli::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)
            ->get();

            $marketerHub = MarketerHub::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)
            ->get();

            $shosh = Shosh::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)
            ->get();

            $ounass = Ounass::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)
            ->get();
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
        // $a_data = $all_data->paginate(10);
        // dd($a_data);
        $max = max($total_sale_amount,$total_revenues,$total_orders);
        // dd($max);
        return view('graph.influencer_search', compact('currently_selected','month','all_data','dates','total_revenues','total_sale_amount','total_orders','araby','styli','marketerHub','ounass','shosh', 'max','earliest_year','latest_year','year','from_month','to_month'));

            
            // dd($associations);
        
        
    }

    public function search(Request $request)
    {
        
        // dd($request->all());
        $earliest_year = 1900; 
        $latest_year = date('Y');
       
        // $daterange = $request->daterange;
        
        $all_data = [];
        $year = $request->year;
        $from_month = $request->from_month;
        $to_month = $request->to_month;
        $comm_before = $request->comm_before;
        $comm_after = $request->comm_after;

        

        if($from_month == "from"){
            return redirect('/influencer_graph')->with('error', 'Please select Start Month');
        }
        if($to_month == "to"){
            return redirect('/influencer_graph')->with('error', 'Please select End Month');
        }
        // dump($to_month);
        // dd($from_month);
        if($from_month > $to_month){
            return redirect('/influencer_graph')->with('error', 'From Month should be less/equal to End Month');
        }
        
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
         
        
    
  
    $total_revenues = 0.0;
    $total_aov = 0;
    $total_sale_amount = 0.0;
    $total_orders = 0.0;
    $araby = [];
    $styli = [];
    $marketerHub = [];
    $shosh = [];
    $ounass = [];

 
    
    // dd($dates);
    $all_data = [];
       
            
            $araby = ArabyAds::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)
                ->orWhere('comm_before_validation',$comm_before)->orWhere('comm_before_validation',$comm_after)->get();

            $styli = Styli::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)
            ->orWhere('comm_before_validation',$comm_before)->orWhere('comm_before_validation',$comm_after)->get();

            $marketerHub = MarketerHub::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)
            ->orWhere('comm_before_validation',$comm_before)->orWhere('comm_before_validation',$comm_after)->get();

            $shosh = Shosh::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)
            ->orWhere('comm_before_validation',$comm_before)->orWhere('comm_before_validation',$comm_after)->get();

            $ounass = Ounass::where('month','>=', $from_month)->where('month','<=',$to_month)->where('year',$year)
            ->orWhere('comm_before_validation',$comm_before)->orWhere('comm_before_validation',$comm_after)->get();
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
        // $a_data = $all_data->paginate(10);
        // dd($a_data);
        $max = max($total_sale_amount,$total_revenues,$total_orders);
        // dd($all_data);
        return view('graph.influencer_search', compact('comm_before','comm_after','month','all_data','dates','total_revenues','total_sale_amount','total_orders','araby','styli','marketerHub','ounass','shosh', 'max','earliest_year','latest_year','year','from_month','to_month'));
        
        
    }
}
