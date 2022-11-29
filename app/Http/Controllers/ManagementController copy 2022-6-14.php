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
use App\Models\CouponInfluencer1;
use App\Models\CouponInfluencer2;
use App\Models\CouponInfluencer3;
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
        $managements = CouponInfluencer::orderBy('id', 'DESC')->paginate(10);
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        $brands = Brand::orderBy('id', 'DESC')->get();
        $currencies = DB::table('countries')->get();
        return view('management.index',compact('managements','coupons','brands','currencies'));
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
        $managements = CouponInfluencer::find($id);
        if(!empty($managements)){
            $Coupons = Coupon::orderBy('id', 'DESC')->get();
            $Influencers = User::orderBy('id', 'DESC')->get();
            $brands = Brand::orderBy('id', 'DESC')->get();
            return view('management.edit',compact('brands','Coupons','Influencers','managements'));
        }
        else{
            return back()->with('error','No record found');
        }

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
            'order' => 'max:20',
            'aov_usd' => 'max:20',

        ]);

        $date = Carbon::now()->format('H:i:s');
        $last_updated_at = $date;
            $data = CouponInfluencer::find($id);

            $data->coupon_id = $request->coupon;
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
            $data->update();
            return redirect()->back()->with('success','Data Updated successfully');;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = CouponInfluencer::find($id);
        // return response()->json($check);
        if (!empty($check)) {

            $check->delete();

            return response()->json(['data'=>"true",'id'=>$id]);
        }else{
            return response()->json("false");
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

        // $temp_cols = TemplateColumn::where('temp_id',$request->template)->get();
        // dump($temp_cols);

        // dd($item_fields);

        $i = 0;
        while(($row = (fgetcsv($file))) !== false){
            DB::beginTransaction();
            try{
                $item = $this->fillItemFields($item_fields,$row);
                // dd($item);
                // if(!isset($item['revenue'])){
                //     return back()->with('error','InCorrect Data.');
                // }

                    if(array_key_exists("revenue",$item)){
                        $brand = [];

                            $brand = $this->createManagement($item,$id);


                            DB::commit();
                    }else{
                        return back()->with('error','incorrect Data.');
                    }



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

    public function createManagement($item,$id)
    {
            // Template 1

         if ($id == 1) {
             if ($item['campaign_name'] != null) {
                 $brand = Brand::where('company_name', $item['campaign_name'])->first();
                 if (empty($brand)) {
                     $brand = new Brand();
                     if (file_exists(public_path() . '/assets/images/gallery_images/' . $item['campaign_logo'])) {
                         File::copy(public_path().'/assets/images/gallery_images/'.$item['campaign_logo'], public_path().'/images/brand/'.$item['campaign_logo']);
                         $brand->image = $item['campaign_logo'];
                     }
                     $brand->company_name = $item['campaign_name'];
                     $brand->country = $item['country'];
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

                 if(str_contains($item['date'],"-")){
                    $date = Carbon::createFromFormat('d-m-y', $item['date'])->format('Y-m-d');
                }
                else{
                    $date = Carbon::createFromFormat('d/m/Y', $item['date'])->format('Y-m-d');
                }
                $convert_time = strtotime(date($item['last_updated_at']));
                $time = date('H:i:s',$convert_time);

                $management = CouponInfluencer1::where('last_update','like','%'. $time.'%')->where('date','like','%'.$date.'%')->
                where('coupon_id',$coupon->id)->where('brand_id',$brand->id)
                ->first();
                if (empty($management)) {
                    $management = new CouponInfluencer1();
                    $management->coupon_id = $coupon->id;
                    $management->brand_id = $brand->id;
                    $management->date = $date;
                    $management->sale_amount = $item['sales_amount'];
                    $management->sale_amount_usd = $item['sales_amount_usd'];
                    $management->aov = $item['aov'];
                    $management->last_update = $time;
                    $management->save();
                }
             }
         }

        if($item['campaign_name'] != null){


             //    Brand Upload
            // dd(file_exists(public_path() . '/assets/images/gallery_images/' . $item['campaign_logo']));
            $brand = Brand::where('company_name', $item['campaign_name'])->first();
            if (empty($brand)) {
                $brand = new Brand();
                if (file_exists(public_path() . '/assets/images/gallery_images/' . $item['campaign_logo'])) {
                    File::copy(public_path().'/assets/images/gallery_images/'.$item['campaign_logo'], public_path().'/images/brand/'.$item['campaign_logo']);
                    $brand->image = $item['campaign_logo'];
                }
                $brand->company_name = $item['campaign_name'];
                $brand->country = $item['country'];
                $brand->save();
                // dump('inside');
            // dump($brand);
            }
            // dump('outside');
            // dump($brand);
            // End Brand Upload

            // Coupon Upload
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



            // End Coupon Upload

            // Upload Data

            // dump($item['last_updated_at']);
            // dd($item['date']);
            if(str_contains($item['date'],"-")){
                $date = Carbon::createFromFormat('d-m-y', $item['date'])->format('Y-m-d');
            }
            else{
                $date = Carbon::createFromFormat('d/m/Y', $item['date'])->format('Y-m-d');
            }
            // dd($date);
            // dump((float) $item['revenue']);
            $convert_time = strtotime(date($item['last_updated_at']));
            $time = date('H:i:s',$convert_time);

            // if($brand != null && $coupon!= null){
                // where('last_updated_at', $time)->where('date',$date)
                $management = CouponInfluencer::where('last_updated_at','like','%'. $time.'%')->where('date','like','%'.$date.'%')->
                where('coupon_id',$coupon->id)->where('brand_id',$brand->id)
                ->where('revenue','like','%'.$item['revenue'].'%')
                ->where('sale_ammount','like','%'.$item['sales_amount'].'%')
                ->where('sale_ammount_usd','like','%'.$item['sales_amount_usd'].'%')
                ->where('automation','like','%'.$item['automation'].'%')
                ->where('customer_type','like','%'.$item['customer_type'].'%')
                ->where('ad_set','like','%'.$item['ad_set'])
                ->where('aov','like','%'.$item['aov'].'%')
                ->where('order','like','%'.$item['orders'].'%')
                ->where('aov_usd','like','%'.$item['aov_usd'].'%')
                ->first();
            // }
            // dump($item);
            // dump($time);
            // dump($date);
            // dump($coupon->id);
            // dump($brand->id);
            // dump($management);
            // dd(CouponInfluencer::first());
            // if($management != null)
            // {
            //     dd($management);
            // }
            if (empty($management)) {
                // $da = strtotime($item['date']);

                // dump($item);
                $management12 = CouponInfluencer::where('last_updated_at','like','%'. $time.'%')->where('date','like','%'.$date.'%')->
                where('coupon_id',$coupon->id)->where('brand_id',$brand->id)
                ->where('revenue','like','%'.$item['revenue'].'%')
                ->where('sale_ammount','like','%'.$item['sales_amount'].'%')
                ->where('sale_ammount_usd','like','%'.$item['sales_amount_usd'].'%')
                ->where('automation','like','%'.$item['automation'].'%')
                ->where('customer_type','like','%'.$item['customer_type'].'%')
                ->where('ad_set','like','%'.$item['ad_set'])
                ->where('aov','like','%'.$item['aov'].'%')
                ->where('order','like','%'.$item['orders'].'%')
                // ->where('aov_usd','like','%'.$item['aov_usd'].'%')
                ->first();
                // dump($management12);
                // dd($management);
                // dump($item['date']);
                // $date = Carbon::parse($da)->format('d/m/Y');
                // $get_date = explode("-",$item['date']);
                // $y_m_d = $get_date[0]. "/". $get_date[1]."/".$get_date[2];
                // dump($y_m_d);
                // dd($date);

                // $brand =Brand::where('company_name', $item['campaign_name'])->first();
                // $coupon = Coupon::where('coupon_code', $item['code'])->first();
                // if ($coupon && $brand) {
                    $management = new CouponInfluencer();
                    $management->coupon_id = $coupon->id;
                    $management->brand_id = $brand->id;
                    $management->date = $date;
                    $management->revenue = $item['revenue'];
                    $management->sale_ammount = $item['sales_amount'];
                    $management->sale_ammount_usd = $item['sales_amount_usd'];
                    $management->automation = $item['automation'];
                    $management->customer_type = $item['customer_type'];
                    $management->ad_set = $item['ad_set'];
                    $management->aov = $item['aov'];
                    $management->order = $item['orders'];
                    $management->aov_usd = $item['aov_usd'];
                    $management->last_updated_at = $time;
                    $management->save();
                // }
            }
        }
        // End Upload Data

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
        $ids = $request->ids;
        DB::table("coupon_influencers")->whereIn('id',explode(",",$ids))->delete();
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
