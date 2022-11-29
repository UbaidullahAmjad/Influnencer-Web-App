<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Association;
use App\Models\ArabyAds;
use App\Models\Ounass;
use App\Models\Styli;
use App\Models\MarketerHub;
use App\Models\Shosh;
use App\Models\Coupon;
use App\Models\Brand;
use App\Models\Commission;
use App\Models\SingleCommission;
use App\Models\DualCommission;
use App\Models\MultipleCommission;
use Carbon\Carbon;

use Auth;

class CommissionCalulation extends Controller
{
    public function commissionCalulation(Request $request)
    {
       $associations = Association::where('influencer_id',auth()->user()->pub_id)->get();
    //    dd($associations);

       $currently_selected = date('Y'); 
        $earliest_year = 1900; 
        $latest_year = date('Y');
       $commission_calculation = [];
       foreach($associations as $assoc){
            $comm_brand = Brand::find($assoc->brand_id);
            $comm_coupon = Coupon::find($assoc->coupon_id);
            $arabyads = ArabyAds::where('coupon_id',$assoc->coupon_id)->get();
            $ounass = Ounass::where('coupon_id',$assoc->coupon_id)->get();
            $styli = Styli::where('coupon_id',$assoc->coupon_id)->get();
            $marketer_hub = MarketerHub::where('coupon_id',$assoc->coupon_id)->get();
            $shosh = Shosh::where('coupon_id',$assoc->coupon_id)->get();
            $total = 0;
            // dump($arabyads);
            foreach($arabyads as $a){
                $brand = Brand::find($a->brand_id);
                $commission = Commission::where('brand_id',$comm_brand->id)->first();
                // dump($commission);

                if(!empty($commission)){
                    if($commission->type == 'fixed single' || $commission->type == 'Percentage Single'){
                        $fixed_commission = SingleCommission::where('commission_id',$commission->id)->first();
                        if(!empty($fixed_commission)){
                            if($commission->type == 'Percentage Single'){
                                $total = $total + (($fixed_commission->value * $a->revenue)/100);
                            }else{
                                $total = $total + $fixed_commission->value;
                            }
                           
    
                            
                        }
                        // dump('ff55f');
                    }else if($commission->type == 'Fixed Multiple' || $commission->type == 'Percentage  Multiple'){
                        // dump('hello');
                        $multiple_commission = MultipleCommission::where('commission_id',$commission->id)->first();
                        
                        if(!empty($multiple_commission)){
                            if (auth()->user()->inf_type == 1) {
                                if($commission->type == 'Fixed Multiple'){
                                    $total = $total + $multiple_commission->new_user;
                                }else{
                                    $total = $total + (($multiple_commission->new_user * $a->revenue)/100);
                                }
                                
                                // dump($total);
                            }elseif(auth()->user()->inf_type == 2){
                                if($commission->type == 'Fixed Multiple'){
                                    $total = $total + $multiple_commission->old_user;
                                }else{
                                    $total = $total + (($multiple_commission->old_user * $a->revenue)/100);
                                }
                                // dump($total);
                            }
                        }
                        // dump('ffrrrrrr55f');
                    }else if($commission->type == 'Fixed Dual'){
                        $dual_commission = DualCommission::where('commission_id',$commission->id)->get();
                        // dump($dual_commission);
                        foreach($dual_commission as $d){
                            if($a->revenue >= $d->min_value && $a->revenue <= $d->max_value){
                                $total = $total + $d->total_value;
                                break;
                            }
                        }
                    }
                }
                // dump($total);
            }

            foreach($ounass as $a){
                $brand = Brand::find($a->brand_id);
                $commission = Commission::where('brand_id',$comm_brand->id)->first();
                // dump($commission);

                if(!empty($commission)){
                    if($commission->type == 'fixed single' || $commission->type == 'Percentage Single'){
                        $fixed_commission = SingleCommission::where('commission_id',$commission->id)->first();
                        if(!empty($fixed_commission)){
                            if($commission->type == 'Percentage Single'){
                                $total = $total + (($fixed_commission->value * $a->_aov)/100);
                            }else{
                                $total = $total + $fixed_commission->value;
                            }
                           
    
                            
                        }
                        // dump('ff55f');
                    }else if($commission->type == 'Fixed Multiple' || $commission->type == 'Percentage Multiple'){
                        // dump('hello');
                        $multiple_commission = MultipleCommission::where('commission_id',$commission->id)->first();
                        
                        if(!empty($multiple_commission)){
                            if (auth()->user()->inf_type == 1) {
                                if($commission->type == 'Fixed Multiple'){
                                    $total = $total + $multiple_commission->new_user;
                                }else{
                                    $total = $total + (($multiple_commission->new_user * $a->_aov)/100);
                                }
                                
                                // dump($total);
                            }elseif(auth()->user()->inf_type == 2){
                                if($commission->type == 'Fixed Multiple'){
                                    $total = $total + $multiple_commission->old_user;
                                }else{
                                    $total = $total + (($multiple_commission->old_user * $a->_aov)/100);
                                }
                                // dump($total);
                            }
                        }
                        // dump('ffrrrrrr55f');
                    }
                }
                // dump($total);
            }

            foreach($styli as $s){
                $brand = Brand::find($s->brand_id);
                $commission = Commission::where('brand_id',$comm_brand->id)->first();
                // dump($commission);
                if(!empty($commission)){
                    if($commission->type == 'fixed single' || $commission->type == 'Percentage Single'){
                        $fixed_commission = SingleCommission::where('commission_id',$commission->id)->first();
                        if(!empty($fixed_commission)){
                            if($commission->type == 'Percentage Single'){
                                $total = $total + ((($fixed_commission->value * $s->payout_usd)/100));
                            }else{
                                $total = $total + $fixed_commission->value;
                            }
                           
    
                            
                        }
                        // dump('ff55f');
                    }else if($commission->type == 'Fixed Multiple' || $commission->type == 'Percentage Multiple'){
                        // dump('hello');
                        $multiple_commission = MultipleCommission::where('commission_id',$commission->id)->first();
                        
                        if(!empty($multiple_commission)){
                            if (auth()->user()->inf_type == 1) {
                                if($commission->type == 'Fixed Multiple'){
                                    $total = $total + $multiple_commission->new_user;
                                }else{
                                    $total = $total + (($multiple_commission->new_user * $s->payout_usd)/100);
                                }
                                
                                // dump($total);
                            }elseif(auth()->user()->inf_type == 2){
                                if($commission->type == 'Fixed Multiple'){
                                    $total = $total + $multiple_commission->old_user;
                                }else{
                                    $total = $total + (($multiple_commission->old_user * $s->payout_usd)/100);
                                }
                                // dump($total);
                            }
                        }
                        // dump('ffrrrrrr55f');
                    }else if($commission->type == 'Fixed Dual'){
                        $dual_commission = DualCommission::where('commission_id',$commission->id)->get();
                        foreach($dual_commission as $d){
                            if($s->payout_usd >= $d->min_value && $s->payout_usd <= $d->max_value){
                                $total = $total + $d->total_value;
                                break;
                            }
                        }
                    }
                }
                
                // dump($total);
            }
            foreach($marketer_hub as $m){
                $brand = Brand::find($s->brand_id);
                $commission = Commission::where('brand_id',$comm_brand->id)->first();
                // dump($commission);

                if(!empty($commission)){
                    if($commission->type == 'fixed single' || $commission->type == 'Percentage Single'){
                        $fixed_commission = SingleCommission::where('commission_id',$commission->id)->first();
                        if(!empty($fixed_commission)){
                            if($commission->type == 'Percentage Single'){
                                $total = $total + ((($fixed_commission->value * $m->revenue)/100));
                            }else{
                                $total = $total + $fixed_commission->value;
                            }
                           
    
                            
                        }
                        // dump('ff55f');
                    }else if($commission->type == 'Fixed Multiple' || $commission->type == 'Percentage Multiple'){
                        // dump('hello');
                        $multiple_commission = MultipleCommission::where('commission_id',$commission->id)->first();
                        
                        if(!empty($multiple_commission)){
                            if (auth()->user()->inf_type == 1) {
                                if($commission->type == 'Fixed Multiple'){
                                    $total = $total + $multiple_commission->new_user;
                                }else{
                                    $total = $total + (($multiple_commission->new_user * $m->revenue)/100);
                                }
                                
                                // dump($total);
                            }elseif(auth()->user()->inf_type == 2){
                                if($commission->type == 'Fixed Multiple'){
                                    $total = $total + $multiple_commission->old_user;
                                }else{
                                    $total = $total + (($multiple_commission->old_user * $m->revenue)/100);
                                }
                                // dump($total);
                            }
                        }
                        // dump('ffrrrrrr55f');
                    }else if($commission->type == 'Fixed Dual'){
                        $dual_commission = DualCommission::where('commission_id',$commission->id)->get();
                        foreach($dual_commission as $d){
                            if($m->revenue >= $d->min_value && $m->revenue <= $d->max_value){
                                $total = $total + $d->total_value;
                            break;
                            }
                        }
                    }
                }
                // dump($total);
            }
            foreach($shosh as $sh){
                $brand = Brand::find($s->brand_id);
                $commission = Commission::where('brand_id',$comm_brand->id)->first();
                // dump($commission);

                if(!empty($commission)){
                    if($commission->type == 'fixed single' || $commission->type == 'Percentage Single'){
                        $fixed_commission = SingleCommission::where('commission_id',$commission->id)->first();
                        if(!empty($fixed_commission)){
                            if($commission->type == 'Percentage Single'){
                                $total = $total + ((($fixed_commission->value * $sh->revenue)/100));
                            }else{
                                $total = $total + $fixed_commission->value;
                            }
                           
    
                            
                        }
                        // dump('ff55f');
                    }else if($commission->type == 'Fixed Multiple' || $commission->type == 'Percentage Multiple'){
                        // dump('hello');
                        $multiple_commission = MultipleCommission::where('commission_id',$commission->id)->first();
                        
                        if(!empty($multiple_commission)){
                            if (auth()->user()->inf_type == 1) {
                                if($commission->type == 'Fixed Multiple'){
                                    $total = $total + $multiple_commission->new_user;
                                }else{
                                    $total = $total + (($multiple_commission->new_user * $sh->revenue)/100);
                                }
                                
                                // dump($total);
                            }elseif(auth()->user()->inf_type == 2){
                                if($commission->type == 'Fixed Multiple'){
                                    $total = $total + $multiple_commission->old_user;
                                }else{
                                    $total = $total + (($multiple_commission->old_user * $sh->revenue)/100);
                                }
                                // dump($total);
                            }
                        }
                        // dump('ffrrrrrr55f');
                    }else if($commission->type == 'Fixed Dual'){
                        $dual_commission = DualCommission::where('commission_id',$commission->id)->get();
                        foreach($dual_commission as $d){
                            if($sh->revenue >= $d->min_value && $sh->revenue <= $d->max_value){
                                $total = $total + $d->total_value;
                            break;
                            }
                        }
                    }
                }
                // dump($total);
            }
           
            // is k bad push krna h array m
            $res = [
                'total' => $total,
                'coupon' => $comm_coupon,
                'brand' => $comm_brand,

            ];
            array_push($commission_calculation,$res);
       }
    //    dd("stop");
    //    dd($commission_calculation);
    //    dd(auth()->user()->pub_id);
       return view('commissions.influencer_commission',compact('commission_calculation','currently_selected','earliest_year','latest_year'));
    }

    public function searchCommissionCalulation(Request $request)
    {
       $associations = Association::where('influencer_id',auth()->user()->pub_id)->get();
       $year = $request->year;
       if($year == -2){
        $year = Carbon::now()->format('Y');
       }
        $from_month = $request->from_month;
        $to_month = $request->to_month;
        // dd($year);
        

        if($from_month == "from"){
            return redirect('commissionCal')->with('error', 'Please select Start Month');
        }
        if($to_month == "to"){
            return redirect('commissionCal')->with('error', 'Please select End Month');
        }
        // dump($to_month);
        // dd($from_month);
        if($from_month > $to_month){
            return redirect('commissionCal')->with('error', 'From Month should be less/equal to End Month');
        }
       $currently_selected = date('Y'); 
        $earliest_year = 1900; 
        $latest_year = date('Y');
       $commission_calculation = [];
       foreach($associations as $assoc){
            $comm_brand = Brand::find($assoc->brand_id);
            $comm_coupon = Coupon::find($assoc->coupon_id);
            $arabyads = ArabyAds::where('coupon_id',$assoc->coupon_id)->get();
            $ounass = Ounass::where('coupon_id',$assoc->coupon_id)->get();
            $styli = Styli::where('coupon_id',$assoc->coupon_id)->get();
            $marketer_hub = MarketerHub::where('coupon_id',$assoc->coupon_id)->get();
            $shosh = Shosh::where('coupon_id',$assoc->coupon_id)->get();
            $total = 0;
            foreach($arabyads as $a){
                $brand = Brand::find($a->brand_id);
                if($a->month >= $from_month && $a->month <= $to_month && $a->year == $year){
                    $commission = Commission::where('brand_id',$comm_brand->id)->first();

                    if(!empty($commission)){
                        if($commission->type == 'fixed single' || $commission->type == 'Percentage Single'){
                            $fixed_commission = SingleCommission::where('commission_id',$commission->id)->first();
                            if(!empty($fixed_commission)){
                                if($commission->type == 'Percentage Single'){
                                    $total = $total + ((($fixed_commission->value * $a->revenue)/100));
                                }else{
                                    $total = $total + $fixed_commission->value;
                                }
                            

                                
                            }
                        
                        }else if($commission->type == 'Fixed Multiple' || $commission->type == 'Percentage Multiple'){
                            $multiple_commission = MultipleCommission::where('commission_id',$commission->id)->first();
                            
                            if(!empty($multiple_commission)){
                                if (auth()->user()->inf_type == 1) {
                                    if($commission->type == 'Fixed Multiple'){
                                        $total = $total + $multiple_commission->new_user;
                                    }else{
                                        $total = $total + (($multiple_commission->new_user * $a->revenue)/100);
                                    }
                                    
                                    // dump($total);
                                }elseif(auth()->user()->inf_type == 2){
                                    if($commission->type == 'Fixed Multiple'){
                                        $total = $total + $multiple_commission->old_user;
                                    }else{
                                        $total = $total + (($multiple_commission->old_user * $a->revenue)/100);
                                    }
                                    // dump($total);
                                }
                            }
                            // dump('ffrrrrrr55f');
                        }else if($commission->type == 'Fixed Dual'){
                            $dual_commission = DualCommission::where('commission_id',$commission->id)->get();
                            foreach($dual_commission as $d){
                                if($a->revenue >= $d->min_value && $a->revenue <= $d->max_value){
                                    $total = $total + $d->total_value;
                            break;
                                }
                            }
                        }
                    }
                }
            }

            foreach($ounass as $a){
                $brand = Brand::find($a->brand_id);
                if($a->month >= $from_month && $a->month <= $to_month && $a->year == $year){
                    $commission = Commission::where('brand_id',$comm_brand->id)->first();
                // dump($commission);
                    if(!empty($commission)){
                        if($commission->type == 'fixed single' || $commission->type == 'Percentage Single'){
                            $fixed_commission = SingleCommission::where('commission_id',$commission->id)->first();
                            if(!empty($fixed_commission)){
                                if($commission->type == 'Percentage Single'){
                                    $total = $total + ((($fixed_commission->value * $a->_aov)/100));
                                }else{
                                    $total = $total + $fixed_commission->value;
                                }
                            

                                
                            }
                        
                        }else if($commission->type == 'Fixed Multiple' || $commission->type == 'Percentage Multiple'){
                            // dump('hello');
                            $multiple_commission = MultipleCommission::where('commission_id',$commission->id)->first();
                            
                            if(!empty($multiple_commission)){
                                if (auth()->user()->inf_type == 1) {
                                    if($commission->type == 'Fixed Multiple'){
                                        $total = $total + $multiple_commission->new_user;
                                    }else{
                                        $total = $total + (($multiple_commission->new_user * $a->_aov)/100);
                                    }
                                    
                                    // dump($total);
                                }elseif(auth()->user()->inf_type == 2){
                                    if($commission->type == 'Fixed Multiple'){
                                        $total = $total + $multiple_commission->old_user;
                                    }else{
                                        $total = $total + (($multiple_commission->old_user * $a->_aov)/100);
                                    }
                                    // dump($total);
                                }
                            }
                            // dump('ffrrrrrr55f');
                        }
                    }
                        
                }
            }

            foreach($styli as $s){
                $brand = Brand::find($s->brand_id);
                if($s->month >= $from_month && $s->month <= $to_month && $s->year == $year){
                    $commission = Commission::where('brand_id',$comm_brand->id)->first();
                // dump($commission);
                    if(!empty($commission)){
                        if($commission->type == 'fixed single' || $commission->type == 'Percentage Single'){
                            $fixed_commission = SingleCommission::where('commission_id',$commission->id)->first();
                            if(!empty($fixed_commission)){
                                if($commission->type == 'Percentage Single'){
                                    $total = $total + ((($fixed_commission->value * $s->payout_usd)/100));
                                }else{
                                    $total = $total + $fixed_commission->value;
                                }
                            
    
                                
                            }
                            // dump('ff55f');
                        }else if($commission->type == 'Fixed Multiple' || $commission->type == 'Percentage Multiple'){
                            // dump('hello');
                            $multiple_commission = MultipleCommission::where('commission_id',$commission->id)->first();
                            
                            if(!empty($multiple_commission)){
                                if (auth()->user()->inf_type == 1) {
                                    if($commission->type == 'Fixed Multiple'){
                                        $total = $total + $multiple_commission->new_user;
                                    }else{
                                        $total = $total + (($multiple_commission->new_user * $s->payout_usd)/100);
                                    }
                                    
                                    // dump($total);
                                }elseif(auth()->user()->inf_type == 2){
                                    if($commission->type == 'Fixed Multiple'){
                                        $total = $total + $multiple_commission->old_user;
                                    }else{
                                        $total = $total + (($multiple_commission->old_user * $s->payout_usd)/100);
                                    }
                                    // dump($total);
                                }
                            }
                            // dump('ffrrrrrr55f');
                        }else if($commission->type == 'Fixed Dual'){
                            $dual_commission = DualCommission::where('commission_id',$commission->id)->get();
                            foreach($dual_commission as $d){
                                if($s->payout_usd >= $d->min_value && $s->payout_usd <= $d->max_value){
                                    $total = $total + $d->total_value;
                                break;
                                }
                            }
                        }
                    }
                    
                }
                
                
                // dump($total);
            }
            foreach($marketer_hub as $m){

                $brand = Brand::find($s->brand_id);
                if($m->month >= $from_month && $m->month <= $to_month && $m->year == $year){
                    $commission = Commission::where('brand_id',$comm_brand->id)->first();

                    if(!empty($commission)){
                        if($commission->type == 'fixed single' || $commission->type == 'Percentage Single'){
                            $fixed_commission = SingleCommission::where('commission_id',$commission->id)->first();
                            if(!empty($fixed_commission)){
                                if($commission->type == 'Percentage Single'){
                                    $total = $total + ((($fixed_commission->value * $m->revenue)/100));
                                }else{
                                    $total = $total + $fixed_commission->value;
                                }
                            
    
                                
                            }
                            // dump('ff55f');
                        }else if($commission->type == 'Fixed Multiple' || $commission->type == 'Percentage Multiple'){
                            // dump('hello');
                            $multiple_commission = MultipleCommission::where('commission_id',$commission->id)->first();
                            
                            if(!empty($multiple_commission)){
                                if (auth()->user()->inf_type == 1) {
                                    if($commission->type == 'Fixed Multiple'){
                                        $total = $total + $multiple_commission->new_user;
                                    }else{
                                        $total = $total + (($multiple_commission->new_user * $m->revenue)/100);
                                    }
                                    
                                    // dump($total);
                                }elseif(auth()->user()->inf_type == 2){
                                    if($commission->type == 'Fixed Multiple'){
                                        $total = $total + $multiple_commission->old_user;
                                    }else{
                                        $total = $total + (($multiple_commission->old_user * $m->revenue)/100);
                                    }
                                    // dump($total);
                                }
                            }
                            // dump('ffrrrrrr55f');
                        }else if($commission->type == 'Fixed Dual'){
                            $dual_commission = DualCommission::where('commission_id',$commission->id)->get();
                            foreach($dual_commission as $d){
                                if($m->revenue >= $d->min_value && $m->revenue <= $d->max_value){
                                    $total = $total + $d->total_value;
                                break;
                                }
                            }
                        }
                    }
                }
                
                // dump($total);
            }
            foreach($shosh as $sh){
                $brand = Brand::find($s->brand_id);
                if($sh->month >= $from_month && $sh->month <= $to_month && $sh->year == $year){
                    $commission = Commission::where('brand_id',$comm_brand->id)->first();
                // dump($commission);

                    if(!empty($commission)){
                        if($commission->type == 'fixed single' || $commission->type == 'Percentage Single'){
                            $fixed_commission = SingleCommission::where('commission_id',$commission->id)->first();
                            if(!empty($fixed_commission)){
                                if($commission->type == 'Percentage Single'){
                                    $total = $total + ((($fixed_commission->value * $sh->revenue)/100));
                                }else{
                                    $total = $total + $fixed_commission->value;
                                }
                            
    
                                
                            }
                            // dump('ff55f');
                        }else if($commission->type == 'Fixed Multiple' || $commission->type == 'Percentage Multiple'){
                            // dump('hello');
                            $multiple_commission = MultipleCommission::where('commission_id',$commission->id)->first();
                            
                            if(!empty($multiple_commission)){
                                if (auth()->user()->inf_type == 1) {
                                    if($commission->type == 'Fixed Multiple'){
                                        $total = $total + $multiple_commission->new_user;
                                    }else{
                                        $total = $total + (($multiple_commission->new_user * $sh->revenue)/100);
                                    }
                                    
                                    // dump($total);
                                }elseif(auth()->user()->inf_type == 2){
                                    if($commission->type == 'Fixed Multiple'){
                                        $total = $total + $multiple_commission->old_user;
                                    }else{
                                        $total = $total + (($multiple_commission->old_user * $sh->revenue)/100);
                                    }
                                    // dump($total);
                                }
                            }
                            // dump('ffrrrrrr55f');
                        }else if($commission->type == 'Fixed Dual'){
                            $dual_commission = DualCommission::where('commission_id',$commission->id)->get();
                            foreach($dual_commission as $d){
                                if($sh->revenue >= $d->min_value && $sh->revenue <= $d->max_value){
                                    $total = $total + $d->total_value;
                                break;
                                }
                            }
                        }
                    }
                }
            }
           
            // is k bad push krna h array m
            $res = [
                'total' => $total,
                'coupon' => $comm_coupon,
                'brand' => $comm_brand,

            ];
            array_push($commission_calculation,$res);
       }
       return view('commissions.search_influencer_commission',compact('commission_calculation','currently_selected','earliest_year','latest_year',
                                    'from_month','to_month','year'));
       
    }
}
