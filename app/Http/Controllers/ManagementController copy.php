<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Management;
use App\Models\Coupon;
use App\Models\Influencer;
use App\Models\User;
use App\Models\CouponInfluencer;
use App\Models\Brand;
use App\Models\Association;
use App\Models\Template;
use App\Models\TemplateColumn;
use App\Models\ArabyAds;
use App\Models\Ounass;
use App\Models\Styli;
use App\Models\ArabyAdsValidation;
use App\Models\ShoshValidation;
use App\Models\StyliValidation;
use App\Models\OunassValidation;
use App\Models\MarketerHubValidation;
use App\Models\MarketerHub;


use App\Models\Shosh;


use Illuminate\Support\Facades\DB;
use File;
use Carbon\Carbon;

class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managements = [];
        $temp1 = ArabyAds::orderBy('id', 'DESC')->get();
        $temp2 = Ounass::orderBy('id', 'DESC')->get();
        $temp3 = Styli::orderBy('id', 'DESC')->get();
        $temp4 = MarketerHub::orderBy('id', 'DESC')->get();
        $temp5 = Shosh::orderBy('id', 'DESC')->get();
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        $brands = Brand::orderBy('id', 'DESC')->get();
        $currencies = DB::table('countries')->get();
        return view('management.index',compact('temp1','temp2','temp3','temp4', 'temp5', 'coupons','brands','currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Coupons = Coupon::orderBy('id', 'DESC')->get();
        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('management.create',compact('Coupons','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'coupon' => 'required',
            'brand' => 'required',
            'revenue' =>'required|max:20',
            'sale_ammount' =>'required|max:20',
            'sale_ammount_usd' =>'required|max:20',
            'date' =>'required',
            'automation' => 'required|max:20',
            'customer_type' => 'required|max:20',
            'ad_set' => 'required|max:20',
            'aov' => 'required|max:20',
            'order' => 'required|max:20',
            'aov_usd' => 'required|max:20',

        ]);

        $date = Carbon::now()->format('H:i:s');
        $last_updated_at = $date;
            $data = new CouponInfluencer();
            $data->coupon_id = $request->coupon;
            $data->date = $request->date;
            $data->brand_id = $request->brand;
            $data->revenue = $request->revenue;
            $data->sale_ammount = $request->sale_ammount;
            $data->sale_ammount_usd = $request->sale_ammount_usd;
            $data->automation = $request->automation;
            $data->customer_type = $request->customer_type;
            $data->ad_set = $request->ad_set;
            $data->aov = $request->aov;
            $data->order = $request->order;
            $data->aov_usd = $request->aov_usd;
            $data->last_updated_at = $last_updated_at;
            $data->save();
        return redirect()->route('management.create')->with('success','Data Add successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ids = explode('---',$id);
        // dd($ids);
        $managements = [];
        $temp1 = ArabyAds::where('id',$ids[0])->where('temp_id',$ids[1])->first();
        $temp2 = Ounass::where('id',$ids[0])->where('temp_id',$ids[1])->first();
        $temp3 = Styli::where('id',$ids[0])->where('temp_id',$ids[1])->first();
        $Coupons = Coupon::orderBy('id', 'DESC')->get();
        $brands = Brand::orderBy('id', 'DESC')->get();
        if(!empty($temp1)){
            $managements = $temp1;
        }else if(!empty($temp2)){
            $managements = $temp2;
        }else if(!empty($temp3)){
            $managements = $temp3;
        }else if(!empty($temp5)){
            $managements = $temp5;
        }
        else{
            return back()->with('error','No record found');
        }
        return view('management.edit',compact('brands','Coupons','managements'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //   dd($id);
        $request->validate([
            'coupon' => 'required',
            'brand' => 'required',
            'revenue' =>'max:20',
            'sale_ammount' =>'max:20',
            'sale_ammount_usd' =>'max:20',
            'date' =>'required',
            'automation' => 'max:20',
            'customer_type' => 'max:20',
            'ad_set' => 'max:20',
            'aov' => 'max:20',
            'orders' => 'max:20',
            'aov_usd' => 'max:20',

        ]);

         
        $date = Carbon::now()->format('H:i:s');
        $last_updated_at = $date;

           $ids = explode('---',$id);
        //    dd($ids);

            $data1 = ArabyAds::where('id',$ids[0])->where('temp_id',$ids[1])->first();
            $data2 = Ounass::where('id',$ids[0])->where('temp_id',$ids[1])->first();
            $data3 = Styli::where('id',$ids[0])->where('temp_id',$ids[1])->first();
            if(!empty($data1)){
                $data1->coupon_id = $request->coupon;
                $data1->brand_id = $request->brand;
                $data1->sale_amount = $request->sale_amount;
                $data1->sale_amount_usd = $request->sale_amount_usd;
                $data1->aov = $request->aov;
                $data1->last_update = $request->time;
                $data1->date = $request->date;
                $data1->update();
                return redirect()->back()->with('success','Data Updated successfully');
            }else if(!empty($data2)){
                $data2->coupon_id = $request->coupon;
                $data2->brand_id = $request->brand;
                $data2->last_update = $request->time;
                $data2->date = $request->date;
                $data2->orders = $request->orders;
                $data2->aov_usd = $request->aov_usd;
                $data2->update();
                return redirect()->back()->with('success','Data Updated successfully');
            }elseif($data3){
                $data3->coupon_id = $request->coupon;
                $data3->brand_id = $request->brand;
                $data3->last_update = $request->time;
                $data3->date = $request->date;
                $data3->customer_type = $request->customer_type;
                $data3->revenue = $request->revenue;
                $data3->automation = $request->automation;
                $data3->ad_set = $request->ad_set;
                $data3->update();
                return redirect()->back()->with('success','Data Updated successfully');
            }else{
                return redirect()->back()->with('error','Data Not Found');
            }
           
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = explode('---',$id);
        // dd($ids);
        $temp1 = ArabyAds::where('id',$ids[0])->where('temp_id',$ids[1])->first();
        $temp2 = Ounass::where('id',$ids[0])->where('temp_id',$ids[1])->first();
        $temp3 = Styli::where('id',$ids[0])->where('temp_id',$ids[1])->first();
        // dump($temp1);
        // dump($temp2);
        // dd($temp3);

        if(!empty($temp1)){
            $temp1->delete();
            return response()->json('true');
        }elseif(!empty($temp2)){
            $temp2->delete();
            return response()->json('true');
        }if(!empty($temp3)){
            $temp3->delete();
            return response()->json('true');
        }else{
            return redirect()->back();
        }
       
    }

    public function csvForm()
    {
        $templates = Template::all();
        return view('management.csv_management',compact('templates'));
    }


    public function csvUpload(Request $request)
    {
     
        $id = $request->template;
        set_time_limit(600000000000000);
        $file = $request->file('csv');

        $ex = $file->getClientOriginalExtension();
        if($ex != 'csv'){
            return back()->with('error','Invalid CSV File.');
        }
        if($file = $request->file('csv')){

            $filename = time().'-'.$file->getClientOriginalExtension();
            $file->move('assets/temp_files',$filename);
        }
       

        $file = fopen(public_path('assets/temp_files/'.$filename),"r");
        $row  = fgetcsv($file);
        if($row){
            $item_fields = $this->setUpItemFields($row);

        }else{
            return back()->withErrors('Invalid CSV File.');
        }

        // dd($item_fields);
       if($id == 1){
            $temp_cols1 = new ArabyAds();
            $fills = [
            'campaign_name',
            'campaign_logo',
            'code',
            'customer_type',
            'orders',
            'sales_amount_usd',
            'revenue',
            'date',
            'original_currency',
            'country',
            'ad_set',
            'month',
            'month_number',
            'last_updated_at',
            'order_id',
            'aov',
            'net_orders',
            'net_revenue',
            'net_sales_amount',
            'net_sales_amount_usd',
            'net_aov_usd',
            'sales_amount',
            'sales_amount_usd',
            'aov_usd',

            ];
            // dd($fills);
          if(count($fills) > count($item_fields)){
            return redirect()->back()->with('error','Invalid CSV');
          }else{
             for($cp1 = 0; $cp1 < count($fills); $cp1++ ){
                if(!in_array($fills[$cp1],$item_fields)){
                    dump($fills[$cp1]);
                    // return redirect()->back()->with('error','Invalid CSV');
                }
                // dump('yaHAN');
             }
            //  dd('dd');
          }
       }
       else if($id == 2){
        $temp_cols2 = new Ounass();
        $fills = [
            '003_so_coupon_code',
            '004_orders',
            '006_qty_ordered',
            '_qty_cancelled',
            '_qty_returned',
            '_qty_open',
            '_qty_completed',
            '_aov',
            '009_gmv',
            '010_nmv',
            '_cancellation_rate',
            '_return_rate'
        ];
        // dd($fills);
        if(count($fills) > count($item_fields)){
        // dd("stop");
        return redirect()->back()->with('error','Invalid CSV');
        }else{
            for($cp2 = 0; $cp2 < count($fills); $cp2++ ){
                if(!in_array($fills[$cp2],$item_fields)){
                    // dump($fills[$cp2]);
                    return redirect()->back()->with('error','Invalid CSV');
                }
                // dump('yaHAN');
            }
        }
    //   dd("dd");
   }else if($id == 3){
    $temp_cols3 = new Styli();
    $fills = [
        'Order Date',
        'customer_flag',
        'Order Id',
        'Coupon',
        'country',
        'Order Value (AED)',
        'Payout (AED)',
        'Order Value (USD)',
        'Payout (USD)'
    ];
    // dd($fills);
  if(count($fills) > count($item_fields)){
    // dd("stop");
    return redirect()->back()->with('error','Invalid CSV');
  }else{
     for($cp3 = 0; $cp3 < count($fills); $cp3++ ){
        if(!in_array($fills[$cp3],$item_fields)){
            // dump($fills[$cp3]);
            return redirect()->back()->with('error','Invalid CSV');
        }
        // dump('yaHAN');
     }
  }
//   dd("dd");
}else if($id == 4){
    $temp_cols6 = new MarketerHub();
    $fills = [
        'campaign_name',
        'Coupon',
        'customer_type',
        'Valid ORDERS',
        'Valid SALE',
        'Valid Revenu',
        'revenue',
        'orders',
        'sales_amount_usd'
        
    ];
    // dd($fills);
        if(count($fills) > count($item_fields)){
            // dd("stop");
            return redirect()->back()->with('error','Invalid CSV');
        }else{
            for($cp6 = 0; $cp6 < count($fills); $cp6++ ){
                if(!in_array($fills[$cp6],$item_fields)){
                    // dump($fills[$cp6]);
                    return redirect()->back()->with('error','Invalid CSV');
                }
                // dump('yaHAN');
            }
            // dd('yahan');
        }
}else if($id == 5){
    $temp_cols5 = new Shosh();
    $fills = [
        'code',
        'Orders',
        'Sale Amount',
        'Revenue',
    ];
    // dd($fills);
  if(count($fills) > count($item_fields)){
    // dd("stop");
    return redirect()->back()->with('error','Invalid CSV');
  }else{
     for($cp5 = 0; $cp5 < count($fills); $cp5++ ){
        if(!in_array($fills[$cp5],$item_fields)){
            // dump($fills[$cp5]);
            return redirect()->back()->with('error','Invalid CSV');
        }
        // dump('yaHAN');
     }
  }
}else if($id == 6){
    $temp_cols6 = new ArabyAdsValidation();
    $fills = [
        'cycle',
        'full_count',
        'campaign_name',
        'code',
        'validated_orders',
        'validated_revenue',
        'validated_sales_amount_usd',
        'bonus',
        'fine',
    ];
    // dd($fills);
        if(count($fills) > count($item_fields)){
            // dd("stop");
            return redirect()->back()->with('error','Invalid CSV');
        }else{
            for($cp6 = 0; $cp6 < count($fills); $cp6++ ){
                if(!in_array($fills[$cp6],$item_fields)){
                    // dump($fills[$cp3]);
                    return redirect()->back()->with('error','Invalid CSV');
                }
                // dump('yaHAN');
            }
        }
}else if($id == 7){
    $temp_cols6 = new Ounass();
    $fills = [
        'Date',
        'Row Labels',
        'Sum of _nmv',
        'Status',
        'Coupon',
        'Country',
        'New customer',
        'Category',
        'Designer',
        'Product Name',
        'Gender',
        
    ];
    // dd($fills);
        if(count($fills) > count($item_fields)){
            // dd("stop");
            return redirect()->back()->with('error','Invalid CSV');
        }else{
            for($cp6 = 0; $cp6 < count($fills); $cp6++ ){
                if(!in_array($fills[$cp6],$item_fields)){
                    // dump($fills[$cp6]);
                    return redirect()->back()->with('error','Invalid CSV');
                }
                // dump('yaHAN');
            }
            // dd('yahan');
        }
}else if($id == 8){
    $temp_cols6 = new StyliValidation();
    $fills = [
        'Order Date',
        'Flag',
        'country',
        'Order Id',
        'status',
        'Coupon Category',
        'Coupon Partner',
        'Coupon',
        'Order Value (AED)*',
        'Affiliate Payout (AED)',
        '% of payout',
        'Order value',
        'Order status',
        'Final Payout',
    ];
    // dd($fills);
        if(count($fills) > count($item_fields)){
            // dd("stop");
            return redirect()->back()->with('error','Invalid CSV');
        }else{
            for($cp6 = 0; $cp6 < count($fills); $cp6++ ){
                if(!in_array($fills[$cp6],$item_fields)){
                    // dump($fills[$cp6]);
                    return redirect()->back()->with('error','Invalid CSV');
                }
                // dump('yaHAN');
            }
            // dd('yahan');
        }
}else if($id == 9){
    $temp_cols6 = new MarketerHubValidation();
    $fills = [
        'campaign_name',
        'Coupon',
        'customer_type',
        'Valid ORDERS',
        'Valid SALE',
        'Valid Revenu',
        
    ];
    // dd($fills);
        if(count($fills) > count($item_fields)){
            // dd("stop");
            return redirect()->back()->with('error','Invalid CSV');
        }else{
            for($cp6 = 0; $cp6 < count($fills); $cp6++ ){
                if(!in_array($fills[$cp6],$item_fields)){
                    // dump($fills[$cp6]);
                    return redirect()->back()->with('error','Invalid CSV');
                }
                // dump('yaHAN');
            }
            // dd('yahan');
        }
}else if($id == 10){
    $temp_cols6 = new ShoshValidation();
    $fills = [
        'code',
        'VallidOrders',
        'Valid Sale Amount',
        'Valid Revenue',
    ];
    // dd($fills);
        if(count($fills) > count($item_fields)){
            // dd("stop");
            return redirect()->back()->with('error','Invalid CSV');
        }else{
            for($cp6 = 0; $cp6 < count($fills); $cp6++ ){
                if(!in_array($fills[$cp6],$item_fields)){
                    // dump($fills[$cp6]);
                    return redirect()->back()->with('error','Invalid CSV');
                }
                // dump('yaHAN');
            }
            // dd('sfdf');
        }
}
    //    dd("stop");

        $i = 0;
        while(($row = (fgetcsv($file))) !== false){
            DB::beginTransaction();
            try{
                $item = $this->fillItemFields($item_fields,$row);
                // dd($item);
                // if(!isset($item['revenue'])){
                //     return back()->with('error','InCorrect Data.');
                // }

                   
                        $brand = [];

                            if($request->month_date){
                                $brand = $this->createManagement($item,$id,$request->month_date);
                            }else{
                                $brand = $this->createManagement($item,$id);
                            }


                            DB::commit();
                  



            }catch(Exception $e){
                DB::rollback();

            }

            $i++;

        }

        fclose($file);


        return back()->with('success','CSV Imported Successfully.');
    }

    public function setUpItemFields($columnFields):array
    {
        $fieldsArray = [];
        foreach($columnFields as $field){
            $fieldsArray[] = $field;
        }

        return $fieldsArray;
    }


    public function fillItemFields($itemFields,$row):array
    {
        $item = [];
        foreach($itemFields as $index => $name){
            $item[$name] = ( !empty($row[$index])) ? $row[$index] : null;
        }

        return $item;
    }

    public function createManagement($item,$id,$month_date=null)
    {
            // Template 1
        //    dd($item);
         if ($id == 1 ) { // Araby Ads template
             if ($item['campaign_name'] != null) {

                 $brand = Brand::where('company_name', $item['campaign_name'])->first();
                 if (empty($brand)) {
                     $brand = new Brand();
                     $brand->company_name = $item['campaign_name'];
                     $brand->save();
                 }

                 $coupon = Coupon::where('coupon_code', $item['code'])->first();
                 if (empty($coupon)) {
                     $da = strtotime($item['date']);
                     $date = Carbon::parse($da)->format('Y-m-d');
                     $coupon = new Coupon();
                     $brand = Brand::where('company_name', $item['campaign_name'])->first();
                     $coupon->coupon_code = $item['code'];
                     $coupon->currency = $item['original_currency'];
                     $coupon->brand_id = $brand->id;
     
                     $coupon->date = $date;
                     $coupon->save();
                 }
                //  dd($item['date']);
                 if(str_contains($item['date'],"-")){
                    // dd('yahan');
                    $date = Carbon::parse($item['date'])->format('Y-m-d');
                    
                }
                else{
                    $date = Carbon::parse($item['date'])->format('Y-m-d');
                }
                $convert_time = strtotime(date($item['last_updated_at']));
                $time = date('Y-m-d H:i:s',$convert_time);
                // dd($time);
                // $araby = ArabyAds::where('coupon_id',$coupon->id)->where('brand_id',$brand->id)->first();
                    
                    $araby = ArabyAds::where('coupon_id', $coupon->id)->first();
                    $month = Null;
                    if($araby){
                        $month = date("m",strtotime($araby->date)); 
                    }
                   

               
                if ($araby != null || $month == $month_date) {
                    $management = ArabyAds::find($araby->id);
                    $management->coupon_id = $coupon->id;
                    $management->brand_id = $brand->id;
                    $management->date = $date;
                    $management->last_updated_at = $time;
                    $management->automation = $item['automation'];
                    $management->sales_amount = $item['sales_amount'];
                    $management->sale_amount_usd = $item['sales_amount_usd'];
                    $management->net_sales_amount = $item['net_sales_amount'];
                    $management->net_sales_amount_usd = $item['net_sales_amount_usd'];
                    $management->aov = $item['aov'];
                    $management->aov_usd = $item['aov_usd'];
                    $management->net_aov_usd = $item['net_aov_usd'];
                    $management->origional_currency = $item['original_currency'];
                    $management->revenue = $item['revenue'];
                    $management->customer_type = $item['customer_type'];
                    $management->orders = $item['orders'];
                    $management->country = $item['country'];
                    $management->ad_set = $item['ad_set'];
                    $management->month = $item['month'];
                    $management->month_number = $item['month_number'];
                    $management->order_id = $item['order_id'];
                    $management->net_orders = $item['net_orders'];
                    $management->net_revenue = $item['net_revenue'];
                    $management->orders = $item['orders'];
                    // $management->full_count = $item['full_count'];
                    // $management->validated_orders = $item['validated_orders'];
                    // $management->validated_revenue = $item['validated_revenue'];
                    // $management->validated_sales_amount_usd = $item['validated_sales_amount_usd'];
                    // $management->bonus = $item['bonus'];
                    // $management->fine = $item['fine'];
                    $management->temp_id = 1;
                    $management->update();
                }else{
                    $management = new ArabyAds();
                    $management->coupon_id = $coupon->id;
                    $management->brand_id = $brand->id;
                    $management->date = $date;
                    $management->last_updated_at = $time;
                    // $management->automation = $item['automation'];
                    $management->sales_amount = $item['sales_amount'];
                    $management->sale_amount_usd = $item['sales_amount_usd'];
                    $management->net_sales_amount = $item['net_sales_amount'];
                    $management->net_sales_amount_usd = $item['net_sales_amount_usd'];
                    $management->aov = $item['aov'];
                    $management->aov_usd = $item['aov_usd'];
                    $management->net_aov_usd = $item['net_aov_usd'];
                    $management->origional_currency = $item['original_currency'];
                    $management->revenue = $item['revenue'];
                    $management->customer_type = $item['customer_type'];
                    $management->orders = $item['orders'];
                    $management->country = $item['country'];
                    $management->ad_set = $item['ad_set'];
                    $management->month = $item['month'];
                    $management->month_number = $item['month_number'];
                    $management->order_id = $item['order_id'];
                    $management->net_orders = $item['net_orders'];
                    $management->net_revenue = $item['net_revenue'];
                    $management->orders = $item['orders'];
                    // $management->full_count = $item['full_count'];
                    // $management->validated_orders = $item['validated_orders'];
                    // $management->validated_revenue = $item['validated_revenue'];
                    // $management->validated_sales_amount_usd = $item['validated_sales_amount_usd'];
                    // $management->bonus = $item['bonus'];
                    // $management->fine = $item['fine'];
                    $management->temp_id = 1;
                    $management->save();
                }
             }
         }

        // End Template 1

        // Template 2  == Ounass

        else if ($id == 2) {
            if ($item['004_orders'] != null ) {
                $brand = new Brand;
                    $brand->company_name = "Ounass_".rand(1000,9999999);
                    $brand->save();
                // $brand = Brand::where('company_name', $item['campaign_name'])->first();
                // if (empty($brand)) {
                //     $brand = new Brand();
                //     if (file_exists(public_path() . '/assets/images/gallery_images/' . $item['campaign_logo'])) {
                //         File::copy(public_path().'/assets/images/gallery_images/'.$item['campaign_logo'], public_path().'/images/brand/'.$item['campaign_logo']);
                //         $brand->image = $item['campaign_logo'];
                //     }
                    
                // }

                $coupon = Coupon::where('coupon_code', $item['003_so_coupon_code'])->first();
                if (empty($coupon)) {
                    // $da = strtotime($item['date']);
                    // $date = Carbon::parse($da)->format('Y-m-d');
                    $coupon = new Coupon();
                    // $brand = Brand::where('company_name', $brand->company_name)->first();
                    $coupon->coupon_code = $item['003_so_coupon_code'];
                    // $coupon->currency = $item['original_currency'];
                    $coupon->brand_id = $brand->id;
    
                    // $coupon->date = $date;
                    $coupon->save();
                    $coupon_id = $coupon->id;
                }
                else
                {
                    $coupon_id = $coupon->id;
                }

            //     if(str_contains($item['date'],"-")){
            //        $date = Carbon::createFromFormat('d-m-y', $item['date'])->format('Y-m-d');
            //    }
            //    else{
            //        $date = Carbon::createFromFormat('d/m/Y', $item['date'])->format('Y-m-d');
            //    }
            //    $convert_time = strtotime(date($item['last_updated_at']));
            //    $time = date('H:i:s',$convert_time);
               $ounass = Ounass::where('coupon_id',$coupon_id)->where('month',$month_date)->first();
            //    dd($ounass->id);
               if (empty($ounass)) {
                   $management = new Ounass();
                   $management->coupon_id = $coupon->id;
                   $management->brand_id = $brand->id;
                //    $management->date = $date;
                //    $management->orders = $item['orders'];
                   $management->_004_orders = $item['004_orders'];
                   $management->_006_qty_ordered = $item['006_qty_ordered'];
                   $management->_qty_cancelled = $item['_qty_cancelled'];
                   $management->_qty_returned = $item['_qty_returned'];
                   $management->_qty_open = $item['_qty_open'];
                   $management->_qty_completed = $item['_qty_completed'];
                   $management->_aov = $item['_aov'];
                   $management->_009_gmv = $item['009_gmv'];
                   $management->_010_nmv = $item['010_nmv'];
                   $management->_cancellation_rate = $item['_cancellation_rate'];
                   $management->_return_rate = $item['_return_rate'];
                   $management->month = $month_date;
                //    $management->last_update = $time;
                   $management->temp_id = 2;
                   $management->save();
               }
               else{
                $management = Ounass::find($ounass->id);
                   $management->coupon_id = $coupon->id;
                   $management->brand_id = $brand->id;
                //    $management->date = $date;
                //    $management->orders = $item['orders'];
                   $management->_004_orders = $item['004_orders'];
                   $management->_006_qty_ordered = $item['006_qty_ordered'];
                   $management->_qty_cancelled = $item['_qty_cancelled'];
                   $management->_qty_returned = $item['_qty_returned'];
                   $management->_qty_open = $item['_qty_open'];
                   $management->_qty_completed = $item['_qty_completed'];
                   $management->_aov = $item['_aov'];
                   $management->_009_gmv = $item['009_gmv'];
                   $management->_010_nmv = $item['010_nmv'];
                   $management->_cancellation_rate = $item['_cancellation_rate'];
                   $management->_return_rate = $item['_return_rate'];
                //    $management->last_update = $time;
                   $management->temp_id = 2;
                   $management->month = $month_date;
                   $management->update();

               }
            }
        }

        // End Tamplate 2

        else if ($id == 3) {
            // dd($item);
            if ($item['customer_flag'] != null) {
                    // $brand = new Brand;
                    // $brand->company_name = "Styli".rand(1000,9999999);
                    // $brand->save();
                // $brand = Brand::where('company_name', $item['campaign_name'])->first();
                // if (empty($brand)) {
                    // $brand = new Brand();
                    // if (file_exists(public_path() . '/assets/images/gallery_images/' . $item['campaign_logo'])) {
                    //     File::copy(public_path().'/assets/images/gallery_images/'.$item['campaign_logo'], public_path().'/images/brand/'.$item['campaign_logo']);
                    //     $brand->image = $item['campaign_logo'];
                    // }
                // }
                $coupon = Coupon::where('coupon_code', $item['Coupon'])->first();
                if (empty($coupon)) {
                    // $da = strtotime($item['date']);
                    // $date = Carbon::parse($da)->format('Y-m-d');
                    $coupon = new Coupon();
                    // $brand = Brand::where('company_name', $item['campaign_name'])->first();
                    $coupon->coupon_code = $item['Coupon'];
                    // $coupon->currency = $item['original_currency'];
                    // $coupon->brand_id = $brand->id;
    
                    // $coupon->date = $date;
                    $coupon->save();
                    $coupon_id = $coupon->id;
                }
                else
                {
                    $coupon_id = $coupon->id;
                }
                

                // dd();
            //    if(str_contains($item['Order Date'],"-")){
            //        $date = Carbon::createFromFormat('d-m-y', $item['Order Date'])->format('Y-m-d');
            //    }
            //    else{
            //        $date = Carbon::createFromFormat('d/m/Y', $item['Order Date'])->format('Y-m-d');
            //    }
            //    $convert_time = strtotime(date($item['last_updated_at']));
            //    $time = date('H:i:s',$convert_time);
                        $month = date("m",strtotime($item['Order Date'])); 
                        $month = explode('0',$month)[1];
               $styli = Styli::where('coupon_id', $coupon_id)->where('month', $month)->first();
               if (empty($styli)) {
                    $brand = new Brand;
                    $brand->company_name = "Styli".rand(1000,9999999);
                    $brand->save();
                    $coupon = Coupon::find($coupon_id);
                    $coupon->brand_id = $brand->id;
                    $coupon->update();
                    $management = new Styli();
                    $management->brand_id = $brand->id;
                    $management->coupon_id = $coupon->id;
                    $management->order_date = $item['Order Date'];
                    $management->customer_flag = $item['customer_flag'];
                    $management->order_id = $item['Order Id'];
                    $management->country = $item['country'];
                    $management->order_value_aed = $item['Order Value (AED)'];
                    $management->payout_aed = $item['Payout (AED)'];
                    $management->order_usd = explode('$',$item['Order Value (USD)'])[1];
                    $management->payout_usd = explode('$',$item['Payout (USD)'])[1];
                    $management->month = $month;
                    $management->temp_id = 3;
                    $management->save();
               }
               else
               {
                $management = Styli::find($styli->id);
                $coupon = Coupon::find($coupon_id);
                $brand_id = $coupon->brand_id;
                if(empty($brand_id))
                {
                    $brand = new Brand;
                    $brand->company_name = "Styli".rand(1000,9999999);
                    $brand->save();
                    $coupon->brand_id = $brand->id;
                    $management->brand_id = $brand->id;
                }
                else{
                    $management->brand_id = $brand_id;
                }
                    $management->coupon_id = $coupon->id;
                    $management->order_date = $item['Order Date'];
                    $management->customer_flag = $item['customer_flag'];
                    $management->order_id = $item['Order Id'];
                    $management->country = $item['country'];
                    $management->order_value_aed = $item['Order Value (AED)'];
                    $management->payout_aed = $item['Payout (AED)'];
                    $management->order_usd = explode('$',$item['Order Value (USD)'])[1];
                    $management->payout_usd = explode('$',$item['Payout (USD)'])[1];
                    $management->month = $month;
                    $management->temp_id = 3;
                    $management->update();
               }
            }
        
        }else if ($id == 4) { // Marketer hub 
            if ($item['campaign_name'] != null) {
                $brand = Brand::where('company_name', $item['campaign_name'])->first();
                if (empty($brand)) {
                    $brand = new Brand();
                    $brand->company_name = $item['campaign_name'];
                    $brand->save();
                }

                $coupon = Coupon::where('coupon_code', $item['Coupon'])->first();
                if (empty($coupon)) {
                    
                    $coupon = new Coupon();
                    $brand = Brand::where('company_name', $item['campaign_name'])->first();
                    $coupon->coupon_code = isset($item['Coupon']) ? $item['Coupon'] : 000;
                    // $coupon->currency = $item['original_currency'];
                    $coupon->brand_id = $brand->id;
    
                    // $coupon->date = $date;
                    $coupon->save();
                    $coupon_id = $coupon->id;
                }
                else
                {
                    $coupon_id = $coupon->id;
                }
               //  dd($item['date']);
               
              
               $marketerhub = MarketerHub::where('coupon_id',$coupon_id)->where('date',$month_date)->first();
               if (empty($marketerhub)) {
                   $management = new MarketerHub();
                   $management->coupon_id = $coupon->id;
                   $management->brand_id = $brand->id;
                   $management->customer_type = $item['customer_type'];
                   $management->orders = $item['orders'];
                   $management->revenue = isset($item['revenue']) ? str_replace(',','',explode('$',$item['revenue'])[1]) : 0;
                   $management->sales_amount_usd = isset($item['sales_amount_usd']) ? str_replace(',','',explode('$',$item['sales_amount_usd'])[1]) : 0;
                   $management->valid_orders = $item['Valid ORDERS'];
                   $management->valid_sale = isset($item['Valid SALE']) ? str_replace(',','',explode('$',$item['Valid SALE'])[1]) : 0;
                   $management->valid_revenue = isset($item['Valid Revenu']) ? str_replace(',', '', explode('$', $item['Valid Revenu'])[1]) : 0;
                   $management->date = $month_date;
                   $management->temp_id = 9;
                   $management->save();
               }
               else
               {
                $management = MarketerHub::find($marketerhub->id);
                   $management->coupon_id = $coupon->id;
                   $management->brand_id = $brand->id;
                   $management->customer_type = $item['customer_type'];
                   $management->orders = $item['orders'];
                   $management->revenue = isset($item['revenue']) ? str_replace(',','',explode('$',$item['revenue'])[1]) : 0;
                   $management->sales_amount_usd = isset($item['sales_amount_usd']) ? str_replace(',','',explode('$',$item['sales_amount_usd'])[1]) : 0;
                   $management->valid_orders = $item['Valid ORDERS'];
                   $management->valid_sale = isset($item['Valid SALE']) ? str_replace(',','',explode('$',$item['Valid SALE'])[1]) : 0;
                   $management->valid_revenue = isset($item['Valid Revenu']) ? str_replace(',', '', explode('$', $item['Valid Revenu'])[1]) : 0;
                   $management->date = $month_date;
                   $management->temp_id = 9;
                   $management->update();
               }
            }
        
        }else if ($id == 5) {
            // dd($item);
            if ($item['code'] != null) {
                    $brand = new Brand;
                    $brand->company_name = "Shosh".rand(1000,9999999);
                    $brand->save();
                $coupon = Coupon::where('coupon_code', $item['code'])->first();
                if (empty($coupon)) {
                    // $da = strtotime($item['date']);
                //     // $date = Carbon::parse($da)->format('Y-m-d');
                    $coupon = new Coupon();
                    $coupon->coupon_code = $item['code'];
                    $coupon->brand_id = $brand->id;
                    $coupon->save();
                    $coupon_id = $coupon->id;
                }
                else
                {
                    $coupon_id = $coupon->id;
                }

            

               $shosh = Shosh::where('coupon_id',$coupon->id)->where('month' , $month_date)->first();
            
               if (empty($shosh)) {
                   $management = new Shosh();
                   $management->coupon_id = $coupon_id ;
                   $management->brand_id = $brand->id;
                   $management->sale_amount = isset($item['Sale Amount']) ? explode('$',$item['Sale Amount'])[1] : 0.0;
                   $management->orders = $item['Orders'];
                   $management->revenue = isset($item['Revenue']) ? explode('$',$item['Revenue'])[1] : 0.0;   
                   $management->temp_id = 5;
                   $management->month = $month_date;
                   $management->save();
               }
               else
               {
                    $management = Shosh::find($shosh->id);
                    $management->coupon_id = $coupon_id ;
                    $management->brand_id = $brand->id;
                    $management->sale_amount = isset($item['Sale Amount']) ? explode('$',$item['Sale Amount'])[1] : 0.0;
                    $management->orders = $item['Orders'];
                    $management->revenue = isset($item['Revenue']) ? explode('$',$item['Revenue'])[1] : 0.0;   
                    $management->temp_id = 5;
                    $management->month = $month_date;
                    $management->update();
               }
            }
        
        }else if ($id == 6) { // Araby Ads validation template
            if ($item['campaign_name'] != null) {
                $brand = Brand::where('company_name', $item['campaign_name'])->first();
                if (empty($brand)) {
                    $brand = new Brand();
                    $brand->company_name = $item['campaign_name'];
                    $brand->save();
                }

                $coupon = Coupon::where('coupon_code', $item['code'])->first();
                if (empty($coupon)) {
                    $da = strtotime($item['cycle']);
                    $date = Carbon::parse($da)->format('Y-m-d');
                    $coupon = new Coupon();
                    $brand = Brand::where('company_name', $item['campaign_name'])->first();
                    $coupon->coupon_code = $item['code'];
                    // $coupon->currency = $item['original_currency'];
                    $coupon->brand_id = $brand->id;
                    $coupon->date = $date;
                    $coupon->save();
                }
               //  dd($item['date']);
                if(str_contains($item['cycle'],"-")){
                   // dd('yahan');
                   $date = Carbon::parse($item['cycle'])->format('Y-m-d');
                   
               }
               else{
                   $date = Carbon::parse($item['cycle'])->format('Y-m-d');
               }
              
            //    $araby = ArabyAds::where('coupon_id',$coupon->id)->where('brand_id',$brand->id)->where('month', $month_date)->first();
            $araby = ArabyAds::where('coupon_id', $coupon->id)->first();
            $month = NULL;
            if ($araby) {
                $month = date("m", strtotime($araby->date));
            }

            if ($araby == null || $month != $month_date) {
                    $management = new ArabyAds();
                   $management->coupon_id = $coupon->id;
                   $management->brand_id = $brand->id;
                   $management->date = $date;
                   $management->full_count = $item['full_count'];
                   $management->validated_orders = $item['validated_orders'];
                   $management->validated_revenue = $item['validated_revenue'];
                   $management->validated_sales_amount_usd = $item['validated_sales_amount_usd'];
                   $management->bonus = $item['bonus'];
                   $management->fine = $item['fine'];
                   $management->temp_id = 1;
                   $management->month = $month_date;
                   $management->save();
               }
               else
               {
                $management = ArabyAds::find($araby->id);
                   $management->coupon_id = $coupon->id;
                   $management->brand_id = $brand->id;
                   $management->date = $date;
                   $management->full_count = $item['full_count'];
                   $management->validated_orders = $item['validated_orders'];
                   $management->validated_revenue = $item['validated_revenue'];
                   $management->validated_sales_amount_usd = $item['validated_sales_amount_usd'];
                   $management->bonus = $item['bonus'];
                   $management->fine = $item['fine'];
                   $management->temp_id = 1;
                   $management->month = $month_date;
                   $management->update();
               }
            }
        }else if ($id == 7) { // Oanus validation template
            if ($item['Coupon'] != null) {
                $brand = new Brand;
                    $brand->company_name = "Oanus".rand(1000,9999999);
                    $brand->save();
                $coupon = Coupon::where('coupon_code', $item['Coupon'])->first();
                if (empty($coupon)) {
                    // $da = strtotime($item['cycle']);
                    // $date = Carbon::parse($da)->format('Y-m-d');
                    $coupon = new Coupon();
                    // $brand = Brand::where('company_name', $item['campaign_name'])->first();
                    $coupon->coupon_code = $item['Coupon'];
                    // $coupon->currency = $item['original_currency'];
                    $coupon->brand_id = $brand->id;
    
                    // $coupon->date = $date;
                    $coupon->save();
                    $coupon_id = $coupon->id;
                }
                else{
                    $coupon_id = $coupon->id;
                }
               //  dd($item['date']);
               $date = null;
                if(str_contains($item['Date'],"-")){
                   // dd('yahan');
                   if(!str_contains($item['Date'],"#")){
                    $date = Carbon::parse($item['Date'])->format('Y-m-d');
                   }
                  
                   
               }
               else{
                if(!str_contains($item['Date'],"#")){
                    $date = Carbon::parse($item['Date'])->format('Y-m-d');
                   }
               }
              
               $ounass = Ounass::where('coupon_id',$coupon_id)->where('month',$month_date)->first();
               if (empty($ounass)) {
                   $management = new Ounass();
                   $management->coupon_id = $coupon->id;
                   $management->brand_id = $brand->id;
                   $management->date = $date;
                   $management->row_label = $item['Row Labels'];
                   $management->sum_of_nmv = $item['Sum of _nmv'];
                   $management->country = $item['Country'];
                   $management->status = $item['Status'];
                   $management->new_customer = $item['New customer'];
                   $management->category = $item['Category'];
                   $management->designer = $item['Designer'];
                   $management->product_name = $item['Product Name'];
                   $management->gender = $item['Gender'];
                   $management->temp_id = 7;
                   $management->month = $month_date;
                   $management->save();
               }
               else
               {
                    $management = Ounass::find($ounass->id);
                    $management->coupon_id = $coupon->id;
                    $management->brand_id = $brand->id;
                    $management->date = $date;
                    $management->row_label = $item['Row Labels'];
                    $management->sum_of_nmv = $item['Sum of _nmv'];
                    $management->country = $item['Country'];
                    $management->status = $item['Status'];
                    $management->new_customer = $item['New customer'];
                    $management->category = $item['Category'];
                    $management->designer = $item['Designer'];
                    $management->product_name = $item['Product Name'];
                    $management->gender = $item['Gender'];
                    $management->temp_id = 7;
                    $management->month = $month_date;
                    $management->update();
            }
            }
        }else if ($id == 8) { // Stylii validation template
            if ($item['Coupon'] != null) {
                // $brand = new Brand;
                //     $brand->company_name = "Styli".rand(1000,9999999);
                //     $brand->save();

                $coupon = Coupon::where('coupon_code', $item['Coupon'])->first();
                if (empty($coupon)) {
                    // $da = strtotime($item['cycle']);
                    // $date = Carbon::parse($da)->format('Y-m-d');
                    $coupon = new Coupon();
                    // $brand = Brand::where('company_name', $item['campaign_name'])->first();
                    $coupon->coupon_code = $item['Coupon'];
                    // $coupon->currency = $item['original_currency'];
                    // $coupon->brand_id = $brand->id;
    
                    // $coupon->date = $date;
                    $coupon->save();
                    $coupon_id = $coupon->id;
                }
                {
                    $coupon_id = $coupon->id;
                }
               //  dd($item['date']);
                if(str_contains($item['Order Date'],"-")){
                   // dd('yahan');
                   $date = Carbon::parse($item['Order Date'])->format('Y-m-d');
                   
               }
               else{
                   $date = Carbon::parse($item['Order Date'])->format('Y-m-d');
                }
                        $month = date("m",strtotime($item['Order Date'])); 
                        $month = explode('0',$month)[1];
                        // dd($month);
                $styli = Styli::where('coupon_id', $coupon_id)->where('month', $month)->first();
                if (empty($styli)) {
                    $management = new Styli;
                $coupon = Coupon::find($coupon_id);
                $brand_id = $coupon->brand_id;
                if(empty($brand_id))
                {
                    $brand = new Brand;
                    $brand->company_name = "Styli".rand(1000,9999999);
                    $brand->save();
                    $coupon->brand_id = $brand->id;
                    $coupon->update();
                    $management->brand_id = $brand->id;
                }
                else{
                    $management->brand_id = $brand_id;
                }
                    $management->coupon_id = $coupon->id;
                    $management->order_date = $date;
                    $management->customer_flag = $item['Flag'];
                    $management->country = $item['country'];
                    $management->order_id = str_contains($item['Order Id'],"#") ? rand(2000,99999) : $item['Order Id'];
                    $management->status = $item['status'];
                    $management->coupon_category = $item['Coupon Category'];
                    $management->coupon_partner = $item['Coupon Partner'];
                    $management->order_value_aed = $item['Order Value (AED)*'];
                    $management->payout_aed = $item['Affiliate Payout (AED)'];
                    $management->payout_percentage = isset($item['% of Payout']) ? explode('%',$item['% of Payout'])[0] : NULL;
                    $management->new_repeat = $item['New/Repeat'];
                    $management->order_usd = $item['Order value'];
                    $management->order_status = $item['Order status'];
                    $management->payout_usd = $item['Final Payout'];
                    $management->month = $month;
                    $management->temp_id = 8;
                    $management->save();
            }
            else
            {
                $management = Styli::find($styli->id);
                $coupon = Coupon::find($coupon_id);
                $brand_id = $coupon->brand_id;
                if(empty($brand_id))
                {
                    $brand = new Brand;
                    $brand->company_name = "Styli".rand(1000,9999999);
                    $brand->save();
                    $coupon->brand_id = $brand->id;
                    $coupon->update();
                    $management->brand_id = $brand->id;
                }
                else{
                    $management->brand_id = $brand_id;
                }
                    $management->coupon_id = $coupon->id;
                    $management->order_date = $date;
                    $management->customer_flag = $item['Flag'];
                    $management->country = $item['country'];
                    $management->order_id = str_contains($item['Order Id'],"#") ? rand(2000,99999) : $item['Order Id'];
                    $management->status = $item['status'];
                    $management->coupon_category = $item['Coupon Category'];
                    $management->coupon_partner = $item['Coupon Partner'];
                    $management->order_value_aed = $item['Order Value (AED)*'];
                    $management->payout_aed = $item['Affiliate Payout (AED)'];
                    $management->payout_percentage = isset($item['% of Payout']) ? explode('%',$item['% of Payout'])[0] : NULL;
                    $management->new_repeat = $item['New/Repeat'];
                    $management->order_usd = $item['Order value'];
                    $management->order_status = $item['Order status'];
                    $management->payout_usd = $item['Final Payout'];
                    $management->month = $month;
                    $management->temp_id = 8;
                    $management->update();
            }
            }
        }else if ($id == 9) { // Marketer Hub validation template
            if ($item['campaign_name'] != null) {
                $brand = Brand::where('company_name', $item['campaign_name'])->first();
                if (empty($brand)) {
                    $brand = new Brand();
                    $brand->company_name = $item['campaign_name'];
                    $brand->save();
                }

                $coupon = Coupon::where('coupon_code', $item['Coupon'])->first();
                if (empty($coupon)) {
                    
                    $coupon = new Coupon();
                    $brand = Brand::where('company_name', $item['campaign_name'])->first();
                    $coupon->coupon_code = isset($item['Coupon']) ? $item['Coupon'] : 000;
                    // $coupon->currency = $item['original_currency'];
                    $coupon->brand_id = $brand->id;
    
                    // $coupon->date = $date;
                    $coupon->save();
                    $coupon_id = $coupon->id;
                }
                else
                {
                    $coupon_id = $coupon->id;
                }
               //  dd($item['date']);
            
                $marketerhub = MarketerHub::where('coupon_id',$coupon_id)->where('date',$month_date)->first();
                if (empty($marketerhub)) {
                    $management = new MarketerHub();
                    $management->coupon_id = $coupon->id;
                    $management->brand_id = $brand->id;
                    $management->customer_type = $item['customer_type'];
                    $management->valid_orders = $item['Valid ORDERS'];
                    $management->valid_sale = isset($item['Valid SALE']) ? str_replace(',','',explode('$',$item['Valid SALE'])[1]) : 0;
                    $management->valid_revenue = isset($item['Valid Revenu']) ? str_replace(',', '', explode('$', $item['Valid Revenu'])[1]) : 0;
                    $management->date = $month_date;
                    $management->temp_id = 9;
                    $management->save();
                }
                else
                {
                $management = MarketerHub::find($marketerhub->id);
                    $management->coupon_id = $coupon->id;
                    $management->brand_id = $brand->id;
                    $management->customer_type = $item['customer_type'];
                    $management->valid_orders = $item['Valid ORDERS'];
                    $management->valid_sale = isset($item['Valid SALE']) ? str_replace(',','',explode('$',$item['Valid SALE'])[1]) : 0;
                    $management->valid_revenue = isset($item['Valid Revenu']) ? str_replace(',', '', explode('$', $item['Valid Revenu'])[1]) : 0;
                    $management->date = $month_date;
                    $management->temp_id = 9;
                    $management->update();
                }
            }
        }else if($id == 10){ // shosh validation
            if ($item['code'] != null) {
                $brand = new Brand;
                    $brand->company_name = "Shosh Validation".rand(1000,9999999);
                    $brand->save();

                $coupon = Coupon::where('coupon_code', $item['code'])->first();
                if (empty($coupon)) {
                    // $da = strtotime($item['date']);
                //     // $date = Carbon::parse($da)->format('Y-m-d');
                    $coupon = new Coupon();
                    $coupon->coupon_code = $item['code'];
                    $coupon->brand_id = $brand->id;
                    $coupon->save();
                    $coupon_id = $coupon->id;
                }
                else
                {
                    $coupon_id = $coupon->id;
                }

            

               $shosh = Shosh::where('coupon_id',$coupon->id)->where('month',$month_date
               )->first();
            
               if (empty($shosh)) {
                   $management = new Shosh();
                   $management->coupon_id = $coupon->id ;
                   $management->brand_id = $brand->id;
                   $management->valid_sale_amount = isset($item['Valid Sale Amount']) ? explode('$',$item['Valid Sale Amount'])[1] : 0.0;
                   $management->valid_orders = $item['VallidOrders'];
                   $management->valid_revenue = isset($item['Revenue']) ? explode('$',$item['Valid Revenue'])[1] : 0.0;   
                   $management->temp_id = 10;
                   $management->save();
               }
               else
               {
                    $management = Shosh::find($shosh->id);
                    $management->coupon_id = $coupon->id ;
                    $management->brand_id = $brand->id;
                    $management->valid_sale_amount = isset($item['Valid Sale Amount']) ? explode('$',$item['Valid Sale Amount'])[1] : 0.0;
                    $management->valid_orders = $item['VallidOrders'];
                    $management->valid_revenue = isset($item['Revenue']) ? explode('$',$item['Valid Revenue'])[1] : 0.0;   
                    $management->temp_id = 10;
                    $management->month = $month_date;
                    $management->update();
               }
            }
        }


    }

    public function export()
    {
        $headers = [
            'Cache-Control'        => 'must-revalidate, post-check=0, pre-check=0'
            ,'Content-type'        => 'text/csv'
            ,'Content-Disposition' => 'attachment; filename=management_csv_export.csv'
            ,'Expires'             => '0'
            ,'Pragma'              => 'public',
        ];

        $lists    = CouponInfluencer::all()->toArray();
        // dd($lists);
       if (count($lists) > 0) {
           $new_list = [];
           foreach ($lists as $list) {
               $coupon_influencer_list = [];
               $coupon = Coupon::find($list['coupon_id']);
               $brand = Brand::find($list['brand_id']);
               if ($coupon && $brand) {
                    $coupon_influencer_list['campaign_logo'] = $brand->image;
                   $coupon_influencer_list['campaign_name'] = $brand->company_name;
                   $coupon_influencer_list['code'] = $coupon->coupon_code;
                   $coupon_influencer_list['original_currency'] = $coupon->currency;
                   $coupon_influencer_list['revenue'] = $list['revenue'];
                   $coupon_influencer_list['sales_amount'] = $list['sale_ammount'];
                   $coupon_influencer_list['sales_amount_usd'] = $list['sale_ammount_usd'];
                   $coupon_influencer_list['automation'] = $list['automation'];
                   $coupon_influencer_list['customer_type'] = $list['customer_type'];
                   $coupon_influencer_list['ad_set'] = $list['ad_set'];
                   $coupon_influencer_list['date'] = $list['date'];

                   $coupon_influencer_list['aov'] = $list['aov'];
                   $coupon_influencer_list['orders'] = $list['order'];
                   $coupon_influencer_list['aov_usd'] = $list['aov_usd'];
                   $coupon_influencer_list['last_updated_at'] = $list['last_updated_at'];


                   unset($list['id']);
                   unset($list['coupon_id']);
                   unset($list['influencer_id']);
                   unset($list['created_at']);
                   unset($list['updated_at']);
                   array_push($new_list, $coupon_influencer_list);
               }
           }

           array_unshift($new_list, array_keys($new_list[0]));


           $callback = function () use ($new_list) {
               $FH = fopen('php://output', 'w');
               foreach ($new_list as $row) {
                   //dd($row);
                   fputcsv($FH, $row);
               }
               fclose($FH);
           };

           return response()->stream($callback, 200, $headers);
       }
       else{
           return back()->with('error','Record not found');
       }
    }

    public function bulk_delete(Request $request)
    {
        // dd($request->all());
        $ids = $request->ids;
        $ids = explode(',',$ids);
        // dd($ids);
        foreach($ids as $id){
            $id = explode('---',$id);
            // dd($id);
            $temp1 = ArabyAds::where('id',$id[0])->where('temp_id',$id[1])->first();
            $temp2 = Ounass::where('id',$id[0])->where('temp_id',$id[1])->first();
            $temp3 = Styli::where('id',$id[0])->where('temp_id',$id[1])->first();
            // dd($temp2);
            if(!empty($temp1)){
                $temp1->delete();
            }else  if(!empty($temp2)){
                $temp2->delete();
            } if(!empty($temp3)){
                $temp3->delete();
            }
        }
        // DB::table("coupon_influencers")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Data Deleted successfully."]);
    }

    public function searchData(Request $request)
    {
        // dd($request->all());
        $selected_brand = -1;
        $selected_coupon = -1;
        $selected_currency = -1;
        if($request->brand){
            $selected_brand = $request->brand;
        }
        if($request->coupon){
            $selected_coupon = $request->coupon;
        }
        if($request->currency){
            $selected_currency = $request->currency;
        }
        if(empty($request->brand) && empty($request->coupon) && empty($request->currency)){
            $managements = CouponInfluencer::where('brand_id',-1111111111111111111111)->get();
            $coupons = Coupon::orderBy('id', 'DESC')->get();
            $brands = Brand::orderBy('id', 'DESC')->get();
            $currencies = DB::table('countries')->get();
            return view('management.search',compact('managements','coupons','brands','currencies','selected_brand','selected_coupon','selected_currency'));
        }else{
            $managements = CouponInfluencer::join('coupons','coupons.id','coupon_influencers.coupon_id')
                ->join('brands','brands.id','coupons.brand_id')
                ->where('coupon_influencers.brand_id',$request->brand)
                ->orWhere('coupon_influencers.coupon_id',$request->coupon)
                ->orWhere('coupons.currency')->select('coupon_influencers.*')->get();
            $coupons = Coupon::orderBy('id', 'DESC')->get();
            $brands = Brand::orderBy('id', 'DESC')->get();
            $currencies = DB::table('countries')->get();
            return view('management.search',compact('managements','coupons','brands','currencies','selected_brand','selected_coupon','selected_currency'));

        }
        
    }
}
