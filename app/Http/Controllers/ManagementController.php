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
use App\Models\NoonEg;
use App\Models\Shosh;
use App\Models\Country;


use Yajra\DataTables\DataTables;

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
    public function index(Request $request)
    {
        // dd();
//         foreach(NoonEg::all() as $n){
// $n->delete();
//         }
        $managements = [];
        
        

       
        if ($request->ajax()) {
            $temp1 = ArabyAds::orderBy('id', 'DESC')->get();
            $temp2 = Ounass::orderBy('id', 'DESC')->get();
            $temp3 = Styli::orderBy('id', 'DESC')->get();
            $temp4 = MarketerHub::orderBy('id', 'DESC')->get();
            $temp5 = Shosh::orderBy('id', 'DESC')->get();
            $temp6 = NoonEg::orderBy('id', 'DESC')->get();

            foreach($temp1 as $c){
                $brand = Brand::find($c->brand_id);
                $coupon = Coupon::find($c->coupon_id);
                $c['month'] = $c->month;
                $c['brand_name'] = !empty($brand) ? $brand->company_name : NULL;
                $c['coupon_name'] = !empty($coupon) ? $coupon->coupon_code : NULL;
                $c['temp'] = $c['id']."---".$c['temp_id'];
                array_push($managements,$c);
            }
            foreach($temp2 as $c){
                $brand = Brand::find($c->brand_id);
                $coupon = Coupon::find($c->coupon_id);
                $c['month'] = $c->month;
                $c['brand_name'] = !empty($brand) ? $brand->company_name : NULL;
                $c['coupon_name'] = !empty($coupon) ? $coupon->coupon_code : NULL;
                $c['temp'] = $c['id']."---".$c['temp_id'];
                array_push($managements,$c);
            }
            foreach($temp3 as $c){
                $brand = Brand::find($c->brand_id);
                $coupon = Coupon::find($c->coupon_id);
                $c['month'] = $c->month;
                $c['brand_name'] = !empty($brand) ? $brand->company_name : NULL;
                $c['coupon_name'] = !empty($coupon) ? $coupon->coupon_code : NULL;
                $c['temp'] = $c['id']."---".$c['temp_id'];
                array_push($managements,$c);
            }
            foreach($temp4 as $c){
                $brand = Brand::find($c->brand_id);
                $coupon = Coupon::find($c->coupon_id);
                $c['month'] = $c->month;
                $c['brand_name'] = !empty($brand) ? $brand->company_name : NULL;
                $c['coupon_name'] = !empty($coupon) ? $coupon->coupon_code : NULL;
                $c['temp'] = $c['id']."---".$c['temp_id'];
                array_push($managements,$c);
            }
            foreach($temp5 as $c){
                $brand = Brand::find($c->brand_id);
                $coupon = Coupon::find($c->coupon_id);
                $c['month'] = $c->month;
                $c['brand_name'] = !empty($brand) ? $brand->company_name : NULL;
                $c['coupon_name'] = !empty($coupon) ? $coupon->coupon_code : NULL;
                $c['temp'] = $c['id']."---".$c['temp_id'];
                array_push($managements,$c);
            }
            foreach($temp6 as $c){
                $brand = Brand::find($c->compaign_name);
                $coupon = Coupon::find($c->code);
                $c['month'] = $c->month;
                $c['brand_name'] = !empty($brand) ? $brand->company_name : NULL;
                $c['coupon_name'] = !empty($coupon) ? $coupon->coupon_code : NULL;
                $c['temp'] = $c['id']."---".$c['temp_id'];
                array_push($managements,$c);
            }
            // dd($managements);
            $k = 1;
            return Datatables::of($managements)
                    ->addIndexColumn('temp')
                    ->addColumn('action', function($row){
                        // dd($row["temp"]);
                         $btn = '<div class="row">
                         <div class="col-md-3">
         
                             <button class="btn btn-danger btn-xs" type="button"
                                 data-original-title="btn btn-danger btn-xs"
                                 id="show_confirm_'.$row["temp"].'"
                                 
                                 data-toggle="tooltip"><i
                                     class="fa fa-trash"></i></button>
         
                         </div>
                         <div class="col-md-2">
                         <a href="management/'.$row["temp"].'/edit"> <button
                                     class="btn btn-success btn-xs " type="button"
                                     data-original-title="btn btn-danger btn-xs"
                                     title=""><i class="fa fa-edit"></i></button></a>
                         </div>
                     </div><script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                     <script type="text/javascript">
                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $(`meta[name="csrf-token"]`).attr("content")
                            }
                        });
                        </script>

                     <script type="text/javascript">
                         
                         $("#show_confirm_'. $row["temp"].'").click(async function(event) {
                 
                             const {
                                 value: email
                             } = await Swal.fire({
                                 title: "Are you sure?",
                                 text: "You wont be able to revert this!",
                                 icon: "warning",
                                 input: "text",
                                 inputLabel: "Type management/delete to delete item",
                                 inputPlaceholder: "Type management/delete to delete item",
                                 showCancelButton: true,
                                 inputValidator: (value) => {
                                     return new Promise((resolve) => {
                                         if (value != "management/delete") {
                                             resolve("Type management/delete to delete item")
                                         } else {
                                             resolve()
                                         }
                                     })
                                 },
                             })
                             if (email) {
                                 $.ajax({
                                     url: "management/'.$row["temp"].'",
                                     type: "DELETE",
                                     cache: false,
                                     data: {
                                         "_token": "{{ csrf_token() }}",
                                     },
                                     success: function(data) {
                                         $("#show_confirm_'.$row["temp"].'").parents("tr").remove();
                                     }
                 
                                 })
                             }
                         });</script>';
                           
                           
                            return $btn;
                    })
                    ->rawColumns(['action'])->make(true);
               
         }

         return view('management.index');
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
        // dd('djdjkdkj');

        $ids = explode('---',$id);
        // dd($id);
        $managements = [];
        $temp1 = ArabyAds::where('id',$ids[0])->where('temp_id',$ids[1])->first();
        $temp2 = Ounass::where('id',$ids[0])->where('temp_id',$ids[1])->first();
        $temp3 = Styli::where('id',$ids[0])->where('temp_id',$ids[1])->first();
        $temp5 = Shosh::where('id',$ids[0])->where('temp_id',$ids[1])->first();
        $temp4 = MarketerHub::where('id',$ids[0])->where('temp_id',$ids[1])->first();
        $Coupons = Coupon::orderBy('id', 'DESC')->get();
        $brands = Brand::orderBy('id', 'DESC')->get();
        $countries = DB::table('countries')->get();
        // dd($countries);
        $management = "";
        if(!empty($temp1)){
            $management = $temp1;
            return view('management.araby_edit',compact('brands','Coupons','management'));
        }else if(!empty($temp2)){
            $management = $temp2;
            return view('management.ounass_edit',compact('brands','Coupons','management'));
        }else if(!empty($temp3)){
            $management = $temp3;
            return view('management.styli_edit',compact('brands','Coupons','management','countries'));
        }else if(!empty($temp5)){
            $management = $temp5;
            return view('management.shosh_edit',compact('brands','Coupons','management'));
        }else if(!empty($temp4)){
            $management = $temp4;
            return view('management.marketer_edit',compact('brands','Coupons','management'));
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
        // dd('ddjdkjdkjdkjdkj');
        // dd($request->all());
         
        $date = Carbon::now()->format('H:i:s');
        $date2 = Carbon::now()->format('Y-m-d');

        $last_updated_at = $date;

           $ids = explode('---',$id);
        //    dd($ids);

            $data1 = ArabyAds::where('id',$ids[0])->where('temp_id',$ids[1])->first();
            $data2 = Ounass::where('id',$ids[0])->where('temp_id',$ids[1])->first();
            $data3 = Styli::where('id',$ids[0])->where('temp_id',$ids[1])->first();
            $data4 = MarketerHub::where('id',$ids[0])->where('temp_id',$ids[1])->first();
            $data5 = Shosh::where('id',$ids[0])->where('temp_id',$ids[1])->first();

            if(!empty($data1)){
                $management = $data1;
                    $management->coupon_id = $request->coupon;
                    $management->brand_id = $request->brand;
                    $management->date = $date2;
                    $management->last_updated_at = $request->last_updated_at;
                    $management->automation = $request->automation;
                    $management->sales_amount = $request->sale_amount;
                    $management->sale_amount_usd = $request->sale_amount_usd;
                    
                    $management->aov = $request->aov;
                    $management->aov_usd = $request->aov_usd;
                    $management->net_aov_usd = $request->net_aov_usd;
                    $management->revenue = $request->revenue;
                    $management->customer_type = $request->customer_type;
                    $management->orders =  $request->orders;
                    $management->ad_set = $request->ad_set;
                    
                    $management->update();
                return redirect()->back()->with('success','Data Updated successfully');
            }else if(!empty($data2)){
                $management = $data2;
                $management->brand_id = $request->brand;
                $management->coupon_id = $request->coupon;
                    $management->date = $date;
                    $management->row_label = $request->row_label;
                    $management->month = $request->month;
                    $management->sum_of_nmv = $request->sum_of_nmv;
                    $management->country = $request->country;
                    $management->new_customer = $request->new_customer;
                    $management->category = $request->category;
                    $management->designer = $request->designer;
                    $management->_004_orders = $request->_004_orders;
                    $management->_010_nmv = $request->_010_nmv;
                $management->update();
                return redirect()->back()->with('success','Data Updated successfully');
            }elseif($data3){
                $management = $data3;
                $management->brand_id = $request->brand;
                $management->coupon_id = $request->coupon;
                    $management->order_date = $request->order_date;
                    $management->customer_flag = $request->customer_flag;
                    $management->country = $request->country;
                    $management->order_value_aed = $request->order_value_aed;
                    $management->payout_aed = $request->payout_aed;
                    $management->order_usd = $request->order_value_usd;
                    $management->payout_usd = $request->payout_usd;
                    $management->payout_percentage = $request->payout_percentage;
                    // $management->month = $month;
                $management->update();
                return redirect()->back()->with('success','Data Updated successfully');
            }else if(!empty($data4)){
                // dd($request->sale_amount_usd);
                $management = $data4;
                // dd($management);
                $management->brand_id = $request->brand;
                $management->coupon_id = $request->coupon;
                $management->customer_type = $request->customer_type;
                   $management->orders = $request->orders;
                   $management->revenue = $request->revenue;
                   $management->sales_amount_usd = $request->sale_amount_usd;
                   $management->month = $request->month;
                   $management->update();
                   return redirect()->back()->with('success','Data Updated successfully');
            }else if(!empty($data5)){
                $management = $data5;
                $management->brand_id = $request->brand;
                $management->coupon_id = $request->coupon;
                
                   $management->orders = $request->orders;
                   $management->revenue = $request->revenue;
                   $management->sale_amount = $request->sale_amount;
                   $management->month = $request->month;
                   $management->update();
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
// $str = '>=100';
// dd(explode('>=', $str));
        return view('management.csv_management',compact('templates'));
    }


    public function csvUpload(Request $request)
    {
        // dd($request->all());
        $id = $request->template;
        if(!$id){
            return back()->with('error','Please select a template.');
        }
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
                    // dump($fills[$cp1]);
                    return redirect()->back()->with('error','Invalid CSV');
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
}else if($id == 11){
    $temp_cols6 = new NoonEg();
    $fills = [
        'campaign_name',
        'code',
        'aov',
        'orders',
        'revenue',
    ];
    // dump($fills);
    // dd($item_fields);
    if(count($fills) != count($item_fields))
    {
        return redirect()->back()->with('error','Invalid CSV');
    }
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
        $year = Carbon::now()->format('Y');
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
                    
                    // $araby = ArabyAds::where('coupon_id', $coupon->id)->first();
                    // $month = Null;
                    // if($araby){
                    //     $month = date("m",strtotime($araby->date)); 
                    //     $month = explode('0',$month)[1];
                    // }
                    $araby = ArabyAds::where('coupon_id',$coupon->id)->where('month',$month_date)->first();
                   

               
                if ($araby != null && $month_date) {
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
                    $management->month = $month_date;
                    $management->month_number = $item['month_number'];
                    $management->order_id = $item['order_id'];
                    $management->net_orders = $item['net_orders'];
                    $management->net_revenue = $item['net_revenue'];
                    $management->orders = $item['orders'];
                    $management->year = $year;
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
                    $management->month = $month_date;
                    $management->month_number = $item['month_number'];
                    $management->order_id = $item['order_id'];
                    $management->net_orders = $item['net_orders'];
                    $management->net_revenue = $item['net_revenue'];
                    $management->orders = $item['orders'];
                    $management->year = $year;
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
            if ($item['003_so_coupon_code'] != null ) {
                // $brand = new Brand;
                //     $brand->company_name = "Ounass_".rand(1000,9999999);
                //     $brand->save();
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
                    // $coupon->brand_id = $brand->id;
    
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
                $management = new Ounass;
                $coupon = Coupon::find($coupon_id);
                $brand_id = $coupon->brand_id;
                if(empty($brand_id))
                {
                    $brand = new Brand;
                    $brand->company_name = "Ounass".rand(1000,9999999);
                    $brand->save();
                    $coupon->brand_id = $brand->id;
                    $coupon->update();
                    $management->brand_id = $brand->id;
                }
                else{
                    $management->brand_id = $brand_id;
                }
                   $management->coupon_id = $coupon->id;
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
                   $management->year = $year;
                //    $management->last_update = $time;
                   $management->temp_id = 2;
                   $management->save();
               }
               else{
                $management = Ounass::find($ounass->id);
                $coupon = Coupon::find($coupon_id);
                $brand_id = $coupon->brand_id;
                if(empty($brand_id))
                {
                    $brand = new Brand;
                    $brand->company_name = "Ounass".rand(1000,9999999);
                    $brand->save();
                    $coupon->brand_id = $brand->id;
                    $coupon->update();
                    $management->brand_id = $brand->id;
                }
                else{
                    $management->brand_id = $brand_id;
                }

                   $management->coupon_id = $coupon->id;
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
                   $management->year = $year;
                   $management->update();

               }
            }
        }

        // End Tamplate 2

        else if ($id == 3) {
            // dd($item);
            if ($item['Coupon'] != null) {
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
                        // $month = date("m",strtotime($item['Order Date'])); 
                        // $month = explode('0',$month)[1];
                        
               $styli = Styli::where('coupon_id', $coupon->id)->where('month', $month_date)->first();
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
                    $management->order_date = $item['Order Date'];
                    $management->customer_flag = $item['customer_flag'];
                    $management->order_id = $item['Order Id'];
                    $management->country = $item['country'];
                    $management->order_value_aed = $item['Order Value (AED)'];
                    $management->payout_aed = $item['Payout (AED)'];
                    $management->order_usd = str_contains($item['Order Value (USD)'],'$' ) ? explode('$',$item['Order Value (USD)'])[1] : 0;
                    $management->payout_usd = str_contains($item['Payout (USD)'],'$' ) ? explode('$',$item['Payout (USD)'])[1] : 0;
                    $management->month = $month_date;
                    $management->temp_id = 3;
                    $management->year = $year;
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
                    $management->order_usd = str_contains($item['Order Value (USD)'],'$' ) ? explode('$',$item['Order Value (USD)'])[1] : 0;
                    $management->payout_usd = str_contains($item['Payout (USD)'],'$' ) ? explode('$',$item['Payout (USD)'])[1] : 0;
                    $management->month = $month_date;
                    $management->temp_id = 3;
                    $management->year = $year;
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
                   $management->revenue = str_contains("$",$item['revenue']) ? (isset($item['revenue']) ? str_replace(',','',explode('$',$item['revenue'])[1]) : 0) : (isset($item['revenue']) ? str_replace(',','',$item['revenue']) : 0);
                   $management->sales_amount_usd = isset($item['sales_amount_usd']) ? str_replace(',','',explode('$',$item['sales_amount_usd'])[1]) : 0;
                   $management->valid_orders = $item['Valid ORDERS'];
                   $management->valid_sale = isset($item['Valid SALE']) ? str_replace(',','',explode('$',$item['Valid SALE'])[1]) : 0;
                   $management->valid_revenue = isset($item['Valid Revenu']) ? str_replace(',', '', explode('$', $item['Valid Revenu'])[1]) : 0;
                   $management->month = $month_date;
                   $management->temp_id = 4;
                   $management->year = $year;
                   $management->save();
               }
               else
               {
                $management = MarketerHub::find($marketerhub->id);
                   $management->coupon_id = $coupon->id;
                   $management->brand_id = $brand->id;
                   $management->customer_type = $item['customer_type'];
                   $management->orders = $item['orders'];
                   $management->revenue = str_contains($item['revenue'],"$") ? str_replace(',','',explode('$',$item['revenue'])[1]) : 0;
                   $management->sales_amount_usd = str_contains($item['sales_amount_usd'],"$") ? str_replace(',','',explode('$',$item['sales_amount_usd'])[1]) : 0;
                   $management->valid_orders = $item['Valid ORDERS'];
                   $management->valid_sale = str_contains($item['Valid SALE'],"$") ? str_replace(',','',explode('$',$item['Valid SALE'])[1]) : 0;
                   $management->valid_revenue = str_contains($item['Valid Revenu'],"$") ? str_replace(',', '', explode('$', $item['Valid Revenu'])[1]) : 0;
                   $management->date = $month_date;
                   $management->temp_id = 4;
                   $management->year = $year;
                   $management->update();
               }
            }
        
        }else if ($id == 5) {
            // dd($item);
            if ($item['code'] != null) {
                    // $brand = new Brand;
                    // $brand->company_name = "Shosh".rand(1000,9999999);
                    // $brand->save();
                $coupon = Coupon::where('coupon_code', $item['code'])->first();
                if (empty($coupon)) {
                    // $da = strtotime($item['date']);
                //     // $date = Carbon::parse($da)->format('Y-m-d');
                    $coupon = new Coupon();
                    $coupon->coupon_code = $item['code'];
                    // $coupon->brand_id = $brand->id;
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
                   $coupon = Coupon::find($coupon_id);
                $brand_id = $coupon->brand_id;
                if(empty($brand_id))
                {
                    $brand = new Brand;
                    $brand->company_name = "Shosh".rand(1000,9999999);
                    $brand->save();
                    $coupon->brand_id = $brand->id;
                    $coupon->update();
                    $management->brand_id = $brand->id;
                }
                else{
                    $management->brand_id = $brand_id;
                }
                   $management->coupon_id = $coupon_id;
                   $management->sale_amount = str_contains($item['Sale Amount'],'$' ) ? explode('$',$item['Sale Amount'])[1] : 0.0;
                   $management->orders = $item['Orders'];
                   $management->revenue = str_contains($item['Revenue'],'$' ) ? explode('$',$item['Revenue'])[1] : 0.0;   
                   $management->temp_id = 5;
                   $management->month = $month_date;
                   $management->year = $year;
                   $management->save();
               }
               else
               {
                    $management = Shosh::find($shosh->id);
                    $coupon = Coupon::find($coupon_id);
                $brand_id = $coupon->brand_id;
                if(empty($brand_id))
                {
                    $brand = new Brand;
                    $brand->company_name = "Shosh".rand(1000,9999999);
                    $brand->save();
                    $coupon->brand_id = $brand->id;
                    $coupon->update();
                    $management->brand_id = $brand->id;
                }
                else{
                    $management->brand_id = $brand_id;
                }
                    $management->coupon_id = $coupon_id;
                    $management->sale_amount = str_contains($item['Sale Amount'],'$' ) ? explode('$',$item['Sale Amount'])[1] : 0.0;
                    $management->orders = $item['Orders'];
                    $management->revenue = str_contains($item['Revenue'],'$' ) ? explode('$',$item['Revenue'])[1] : 0.0;   
                    $management->temp_id = 5;
                    $management->month = $month_date;
                    $management->year = $year;
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
            // $araby = ArabyAds::where('coupon_id', $coupon->id)->first();
            $araby = ArabyAds::where('coupon_id', $coupon->id)->where('month', $month_date)->first();
            // $month = NULL;
            // if ($araby) {
            //     $month = date("m", strtotime($araby->date));
            //     $month = explode('0',$month)[1];
            // }

            if ($araby == null && $month_date) {
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
                   $management->year = $year;
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
                   $management->year = $year;
                   $management->update();
               }
            }
        }else if ($id == 7) { // Oanus validation template
            if ($item['Coupon'] != null) {
                // $brand = new Brand;
                //     $brand->company_name = "Oanus".rand(1000,9999999);
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
                $management = new Ounass;
                $coupon = Coupon::find($coupon_id);
                $brand_id = $coupon->brand_id;
                    if(empty($brand_id))
                    {
                        $brand = new Brand;
                        $brand->company_name = "Ounass".rand(1000,9999999);
                        $brand->save();
                        $coupon->brand_id = $brand->id;
                        $coupon->update();
                        $management->brand_id = $brand->id;
                    }
                    else{
                        $management->brand_id = $brand_id;
                    }
                   $management->coupon_id = $coupon->id;
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
                   $management->temp_id = 2;
                   $management->month = $month_date;
                   $management->year = $year;
                   $management->save();
               }
               else
               {
                $management = Ounass::find($ounass->id);
                $coupon = Coupon::find($coupon_id);
                $brand_id = $coupon->brand_id;
                if(empty($brand_id))
                {
                    $brand = new Brand;
                    $brand->company_name = "Ounass".rand(1000,9999999);
                    $brand->save();
                    $coupon->brand_id = $brand->id;
                    $coupon->update();
                    $management->brand_id = $brand->id;
                }
                else{
                    $management->brand_id = $brand_id;
                }
                    
                $management->coupon_id = $coupon->id;
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
                $management->temp_id = 2;
                $management->month = $month_date;
                $management->year = $year;
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
                        if($month > 10){
                $month = explode('0',$month)[1];
                }
                        // dd($month);
                    $styli = Styli::where('coupon_id', $coupon->id)->where('month', $month_date)->first();
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
                    $management->month = $month_date;
                    $management->year = $year;
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
                    $management->month = $month_date;
                    $management->year = $year;
                    $management->temp_id = 3;
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
                    $management->year = $year;
                    $management->temp_id = 4;
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
                    $management->year = $year;
                    $management->temp_id = 4;
                    $management->update();
                }
            }
        }else if($id == 10){ // shosh validation
            if ($item['code'] != null) {
                // $brand = new Brand;
                //     $brand->company_name = "Shosh Validation".rand(1000,9999999);
                //     $brand->save();

                $coupon = Coupon::where('coupon_code', $item['code'])->first();
                if (empty($coupon)) {
                    // $da = strtotime($item['date']);
                //     // $date = Carbon::parse($da)->format('Y-m-d');
                    $coupon = new Coupon();
                    $coupon->coupon_code = $item['code'];
                    // $coupon->brand_id = $brand->id;
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
                   $coupon = Coupon::find($coupon_id);
                $brand_id = $coupon->brand_id;
                if(empty($brand_id))
                {
                    $brand = new Brand;
                    $brand->company_name = "Shosh".rand(1000,9999999);
                    $brand->save();
                    $coupon->brand_id = $brand->id;
                    $coupon->update();
                    $management->brand_id = $brand->id;
                }
                else{
                    $management->brand_id = $brand_id;
                }
                   $management->coupon_id = $coupon->id ;
                   $management->sale_amount = isset($item['Valid Sale Amount']) ? explode('$',$item['Valid Sale Amount'])[1] : 0.0;
                   $management->orders = $item['VallidOrders'];
                   $management->revenue = isset($item['Revenue']) ? explode('$',$item['Valid Revenue'])[1] : 0.0; 
                   $management->year = $year;  
                   $management->month = $month_date;
                   $management->temp_id = 5;
                   $management->save();
               }
               else
               {
                    $management = Shosh::find($shosh->id);
                    $coupon = Coupon::find($coupon_id);
                $brand_id = $coupon->brand_id;
                if(empty($brand_id))
                {
                    $brand = new Brand;
                    $brand->company_name = "Shosh".rand(1000,9999999);
                    $brand->save();
                    $coupon->brand_id = $brand->id;
                    $coupon->update();
                    $management->brand_id = $brand->id;
                }
                else{
                    $management->brand_id = $brand_id;
                }
                    $management->coupon_id = $coupon->id ;
                    $management->sale_amount = isset($item['Valid Sale Amount']) ? explode('$',$item['Valid Sale Amount'])[1] : 0.0;
                    $management->orders = $item['VallidOrders'];
                    $management->revenue = isset($item['Revenue']) ? explode('$',$item['Valid Revenue'])[1] : 0.0;   
                    $management->temp_id = 5;
                    $management->month = $month_date;
                    $management->year = $year;
                    $management->update();
               }
            }
        }else if ($id == 11) {
            // dd($item);
            if ($item['code'] != null) {
                    // $brand = new Brand;
                    // $brand->company_name = "Shosh".rand(1000,9999999);
                    // $brand->save();
                $brand = Brand::where('company_name', $item['campaign_name'])->first();
                if($brand){
                    $coupon = Coupon::where('coupon_code', $item['code'])->first();
                    if (empty($coupon)) {
                        // $da = strtotime($item['date']);
                    //     // $date = Carbon::parse($da)->format('Y-m-d');
                        $coupon = new Coupon();
                        $coupon->coupon_code = $item['code'];
                        // $coupon->brand_id = $brand->id;
                        $coupon->save();
                        $coupon_id = $coupon->id;
                    }
                    else
                    {
                        $coupon_id = $coupon->id;
                    }
                    $min_aov = 0;
                    $max_aov = NULL;
                    if(str_contains($item['aov'],'-')){
                        $aov = explode('-', $item['aov']);
                        $min_aov = $aov[0];
                        $max_aov = $aov[1];
                    }else if(str_contains($item['aov'],'>=')){
                        $aov = explode('>=', $item['aov']);
                        $min_aov = $aov[1];
                        // $max_aov = $aov[1];
                    }else if(str_contains($item['aov'],'>')){
                        $aov = explode('>', $item['aov']);
                        $min_aov = $aov[1] + (int)1;
                        // $max_aov = $aov[1];
                    }else if(str_contains($item['aov'],'<=')){
                        $aov = explode('<=', $item['aov']);
                        // $min_aov 
                        $max_aov = $aov[1];
                    }else if(str_contains($item['aov'],'<')){
                        $aov = explode('<', $item['aov']);
                        // $min_aov 
                        $max_aov = $aov[1] - (int)1;
                    }

                    $noon = NoonEg::where('code',$coupon->id)->where('compaign_name',$brand->id)->first();
                    if($noon){
                        $noon->code = $coupon_id;
                        // $management->sale_amount = str_contains($item['Sale Amount'],'$' ) ? explode('$',$item['Sale Amount'])[1] : 0.0;
                        $noon->orders = $item['orders'];
                        $noon->revenue = $item['revenue'];  
                        $noon->aov = $item['aov'];   

                        $noon->temp_id = 11;
                        $noon->month = $month_date;
                        // $management->year = $year;
                        $noon->compaign_name = $brand->id;
                        $noon->min_aov = $min_aov;  
                        $noon->max_aov = $max_aov;  
                        $noon->save();
                    }else{
                        $noon = new NoonEg();
                        $noon->code = $coupon_id;
                        // $management->sale_amount = str_contains($item['Sale Amount'],'$' ) ? explode('$',$item['Sale Amount'])[1] : 0.0;
                        $noon->orders = $item['orders'];
                        $noon->revenue = $item['revenue'];  
                        $noon->aov = $item['aov']; 
                        $noon->temp_id = 11;
                        // $management->month = $month_date;
                        // $management->year = $year;
                        $noon->compaign_name = $brand->id;
                        $noon->month = $month_date;
                        $noon->min_aov = $min_aov;  
                        $noon->max_aov = $max_aov;  
                        $noon->save();
                    }
                    
                }
                

            

               
            
               
            }
        
        }


    }

    public function export(Request $request)
    {
       
       

        $template = $request->template;
        if($template == -1){
            return back()->with('error','Please select the template to export');
        }

        if($template == 1){

            $headers = [
                'Cache-Control'        => 'must-revalidate, post-check=0, pre-check=0'
                ,'Content-type'        => 'text/csv'
                ,'Content-Disposition' => 'attachment; filename=ArabyAds_csv_export.csv'
                ,'Expires'             => '0'
                ,'Pragma'              => 'public',
            ];

            $lists    = ArabyAds::all()->toArray();
            if (count($lists) > 0) {
                $new_list = [];
                foreach ($lists as $list) {
                    $coupon_influencer_list = [];
                    $coupon = Coupon::find($list['coupon_id']);
                    $brand = Brand::find($list['brand_id']);
    
                    if(isset($coupon->coupon_code))
                    {
                        $coupon_influencer_list['campaign_name'] = isset($brand->company_name) ? $brand->company_name : "";
                        $coupon_influencer_list['campaign_logo'] = isset($brand->image) ? $brand->image : "";
                        $coupon_influencer_list['automation'] = $list['automation'];
                        $coupon_influencer_list['last_updated_at'] = $list['last_updated_at'];
                        $coupon_influencer_list['code'] = isset($coupon->coupon_code) ? $coupon->coupon_code : "";
                        $coupon_influencer_list['date'] = $list['date'];
                        $coupon_influencer_list['original_currency'] = isset($coupon->currency) ? $coupon->currency : "";  
                        $coupon_influencer_list['country'] = $list['country'];
                        $coupon_influencer_list['customer_type'] = $list['customer_type'];
                        $coupon_influencer_list['ad_set'] = $list['ad_set'];
                        $coupon_influencer_list['month'] = $list['month'];
                        $coupon_influencer_list['month_number'] = $list['month_number'];
                        $coupon_influencer_list['order_id'] = $list['order_id'];
                        $coupon_influencer_list['aov'] = $list['aov'];
                        $coupon_influencer_list['net_orders'] = $list['net_orders'];
                        $coupon_influencer_list['net_revenue'] = $list['net_revenue'];
                        $coupon_influencer_list['net_sales_amount'] = $list['net_sales_amount'];
                        $coupon_influencer_list['net_sales_amount_usd'] = $list['net_sales_amount_usd'];
                        $coupon_influencer_list['net_aov_usd'] = $list['net_aov_usd'];
                        $coupon_influencer_list['orders'] = $list['orders'];
                        $coupon_influencer_list['revenue'] = $list['revenue'];
                        $coupon_influencer_list['sales_amount'] = $list['sales_amount'];
                        $coupon_influencer_list['sales_amount_usd'] = $list['sale_amount_usd'];
                        $coupon_influencer_list['aov_usd'] = $list['aov_usd'];
     
     
                        unset($list['id']);
                        unset($list['coupon_id']);
                        unset($list['brand_id']);
                        unset($list['full_count']);
                        unset($list['validated_orders']);
                        unset($list['validated_revenue']);
                        unset($list['validated_sales_amount_usd']);
                        unset($list['bonus']);
                        unset($list['fine']);
                        unset($list['created_at']);
                        unset($list['updated_at']);
                        array_push($new_list, $coupon_influencer_list);
                    }
                    
                }
     
                if(count($new_list)>0)
                {
                    array_unshift($new_list, array_keys($new_list[0]));
                }else
                {
                    return back()->with('error','Valid Record not found');
                }
     
     
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
        }else if($template == 2){
     
            $headers = [
                'Cache-Control'        => 'must-revalidate, post-check=0, pre-check=0'
                ,'Content-type'        => 'text/csv'
                ,'Content-Disposition' => 'attachment; filename=Ounass_csv_export.csv'
                ,'Expires'             => '0'
                ,'Pragma'              => 'public',
            ];

            $lists    = Ounass::all()->toArray();
           
            if (count($lists) > 0) {
                $new_list = [];
                foreach ($lists as $list) {
                    $coupon_influencer_list = [];
                    $coupon = Coupon::find($list['coupon_id']);

                    if(isset($coupon->coupon_code))
                    {
                        $coupon_influencer_list['003_so_coupon_code'] = isset($coupon->coupon_code) ? $coupon->coupon_code : "";
                        $coupon_influencer_list['004_orders'] = $list['_004_orders'];
                        $coupon_influencer_list['006_qty_ordered'] = $list['_006_qty_ordered'];
                        $coupon_influencer_list['_qty_cancelled'] = $list['_qty_cancelled'];
                        $coupon_influencer_list['_qty_returned'] = $list['_qty_returned'];
                        $coupon_influencer_list['_qty_open'] = $list['_qty_open'];
                        $coupon_influencer_list['_qty_completed'] = $list['_qty_completed'];
                        $coupon_influencer_list['_aov'] = $list['_aov'];
                        $coupon_influencer_list['009_gmv'] = $list['_009_gmv'];
                        $coupon_influencer_list['010_nmv'] = "AED ".$list['_010_nmv'];
                        $coupon_influencer_list['_cancellation_rate'] = $list['_cancellation_rate'];
                        $coupon_influencer_list['_return_rate'] = $list['_return_rate'];
     
                        unset($list['id']);
                        unset($list['coupon_id']);
                        unset($list['row_label']);
                        unset($list['sum_of_nmv']);
                        unset($list['date']);
                        unset($list['status']);
                        unset($list['country']);
                        unset($list['new_customer']);
                        unset($list['category']);
                        unset($list['designer']);
                        unset($list['product_name']);
                        unset($list['gender']);
                        unset($list['created_at']);
                        unset($list['updated_at']);
                        array_push($new_list, $coupon_influencer_list);
                    }
                    
                }
     
                if(count($new_list)>0)
                {
                    array_unshift($new_list, array_keys($new_list[0]));
                }else
                {
                    return back()->with('error','Valid Record not found');
                }
     
     
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
        }else if($template == 3){
     
            $headers = [
                'Cache-Control'        => 'must-revalidate, post-check=0, pre-check=0'
                ,'Content-type'        => 'text/csv'
                ,'Content-Disposition' => 'attachment; filename=Styli_csv_export.csv'
                ,'Expires'             => '0'
                ,'Pragma'              => 'public',
            ];

            $lists    = Styli::all()->toArray();
           
            if (count($lists) > 0) {
                $new_list = [];
                foreach ($lists as $list) {
                    $coupon_influencer_list = [];
                    $coupon = Coupon::find($list['coupon_id']);
                    if(isset($coupon->coupon_code))
                    {
                        $coupon_influencer_list['Order Date'] = $list['order_date'];
                        $coupon_influencer_list['customer_flag'] = $list['customer_flag'];
                        $coupon_influencer_list['Order Id'] = $list['order_id'];
                        $coupon_influencer_list['Coupon'] = isset($coupon->coupon_code) ? $coupon->coupon_code : "";
                        $coupon_influencer_list['country'] = $list['country'];
                        $coupon_influencer_list['Order Value (AED)'] = $list['order_value_aed'];
                        $coupon_influencer_list['Payout (AED)'] = $list['payout_aed'];
                        $coupon_influencer_list['Order Value (USD)'] = "$".$list['order_usd'];
                        $coupon_influencer_list['Payout (USD)'] = "$".$list['payout_usd'];
     
                        unset($list['id']);
                        unset($list['coupon_id']);
                        unset($list['status']);
                        unset($list['coupon_category']);
                        unset($list['coupon_partner']);
                        unset($list['new_repeat']);  
                        unset($list['order_status']);
                        unset($list['payout_percentage']);
                        unset($list['created_at']);
                        unset($list['updated_at']);
                        array_push($new_list, $coupon_influencer_list);
                    }
                    
                }
     
                if(count($new_list)>0)
                {
                    array_unshift($new_list, array_keys($new_list[0]));
                }else
                {
                    return back()->with('error','Valid Record not found');
                }
     
     
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
        }else if($template == 4){
     
            $headers = [
                'Cache-Control'        => 'must-revalidate, post-check=0, pre-check=0'
                ,'Content-type'        => 'text/csv'
                ,'Content-Disposition' => 'attachment; filename=Marketer Hub_csv_export.csv'
                ,'Expires'             => '0'
                ,'Pragma'              => 'public',
            ];

            $lists    = MarketerHub::all()->toArray();
           
            if (count($lists) > 0) {
                $new_list = [];
                foreach ($lists as $list) {
                    $coupon_influencer_list = [];
                    $coupon = Coupon::find($list['coupon_id']);
                    $brand = Brand::find($list['brand_id']);
                    if(isset($coupon->coupon_code))
                    {
                        $coupon_influencer_list['campaign_name'] = isset($brand->company_name) ? $brand->company_name : "";
                        $coupon_influencer_list['Coupon'] = isset($coupon->coupon_code) ? $coupon->coupon_code : "";
                        $coupon_influencer_list['customer_type'] = $list['customer_type'];
                        $coupon_influencer_list['orders'] = $list['orders'];
                        $coupon_influencer_list['revenue'] = "$".$list['revenue'];
                        $coupon_influencer_list['sales_amount_usd'] = "$".$list['sales_amount_usd']; 
                        $coupon_influencer_list['Valid ORDERS'] = $list['valid_orders'];
                        $coupon_influencer_list['Valid SALE'] = "$".$list['valid_sale'];
                        $coupon_influencer_list['Valid Revenu'] = "$".$list['valid_revenue'];
     
                        unset($list['id']);
                        unset($list['coupon_id']);
                        unset($list['brand_id']);
                        unset($list['created_at']);
                        unset($list['updated_at']);
                        array_push($new_list, $coupon_influencer_list);
                    }
                }
     
                if(count($new_list)>0)
                {
                    array_unshift($new_list, array_keys($new_list[0]));
                }else
                {
                    return back()->with('error','Valid Record not found');
                }
     
     
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
        }else if($template == 5){
     
            $headers = [
                'Cache-Control'        => 'must-revalidate, post-check=0, pre-check=0'
                ,'Content-type'        => 'text/csv'
                ,'Content-Disposition' => 'attachment; filename=Shosh_csv_export.csv'
                ,'Expires'             => '0'
                ,'Pragma'              => 'public',
            ];

            $lists    = Shosh::all()->toArray();
           
            if (count($lists) > 0) {
                $new_list = [];
                foreach ($lists as $list) {
                    $coupon_influencer_list = [];
                    $coupon = Coupon::find($list['coupon_id']);
                    if(isset($coupon->coupon_code))
                    {
                        $coupon_influencer_list['code'] = isset($coupon->coupon_code) ? $coupon->coupon_code : "";
                        $coupon_influencer_list['Sale Amount'] = "$".$list['sale_amount'];
                        $coupon_influencer_list['Orders'] = $list['orders'];
                        $coupon_influencer_list['Revenue'] = "$".$list['revenue'];

                        unset($list['id']);
                        unset($list['coupon_id']);
                        unset($list['brand_id']);
                        unset($list['created_at']);
                        unset($list['updated_at']);
                        array_push($new_list, $coupon_influencer_list);
                    
                    }
                }
     
                if(count($new_list)>0)
                {
                    array_unshift($new_list, array_keys($new_list[0]));
                }else
                {
                    return back()->with('error','Valid Record not found');
                }
     
     
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
        }else if($template == 6){
     
            $headers = [
                'Cache-Control'        => 'must-revalidate, post-check=0, pre-check=0'
                ,'Content-type'        => 'text/csv'
                ,'Content-Disposition' => 'attachment; filename=Noon_Egypt_csv_export.csv'
                ,'Expires'             => '0'
                ,'Pragma'              => 'public',
            ];

            $lists    = NoonEg::all()->toArray();
// dd($lists[0]);
            if (count($lists) > 0) {
                // dd($lists);
                $new_list = [];
                foreach ($lists as $list) {
                    $coupon_influencer_list = [];
                    $coupon = Coupon::find($list['code']);
                    $brand = Brand::find($list['compaign_name']);
                    if(isset($coupon->coupon_code))
                    {
                        $coupon_influencer_list['code'] = isset($coupon->coupon_code) ? $coupon->coupon_code : "";
                        $coupon_influencer_list['campaign_name'] = isset($brand->company_name) ? $brand->company_name : "";
                        $coupon_influencer_list['orders'] = $list['orders'];
                        $coupon_influencer_list['revenue'] = $list['revenue'];
                        $coupon_influencer_list['aov'] = $list['aov'];


                        unset($list['id']);
                        // unset($list['coupon_id']);
                        // unset($list['brand_id']);
                        unset($list['created_at']);
                        unset($list['updated_at']);
                        array_push($new_list, $coupon_influencer_list);
                    }
                    
                }
                if(count($new_list)>0)
                {
                    array_unshift($new_list, array_keys($new_list[0]));
                }else
                {
                    return back()->with('error','Valid Record not found');
                }
     
     
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
            $temp4 = Shosh::where('id',$id[0])->where('temp_id',$id[1])->first();
            $temp5 = MarketerHub::where('id',$id[0])->where('temp_id',$id[1])->first();
            // dd($temp2);
            if(!empty($temp1)){
                $temp1->delete();
            }else if(!empty($temp2)){
                $temp2->delete();
            }else if(!empty($temp3)){
                $temp3->delete();
            }else if(!empty($temp4)){
                $temp4->delete();
            }else if(!empty($temp5)){
                $temp5->delete();
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
