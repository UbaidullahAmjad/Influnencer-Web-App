<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Brand;
use App\Models\CouponInfluencer;
use App\Models\Association;
use carbon\Carbon;


use File;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $coupons = [];
        if ($request->ajax()) {
            $Coupons = Coupon::orderBy('id', 'DESC')->get();
            foreach($Coupons as $c){
                $brand = Brand::find($c->brand_id);
                $c['brand_name'] = $brand->company_name;
                array_push($coupons,$c);
            }
            // dd($coupons);
            $k = 1;
            return Datatables::of($coupons)
                    ->addIndexColumn('id')
                    ->addColumn('action', function($row){
                         $btn = '<div class="row">
                         <div class="col-md-3">
         
                             <button class="btn btn-danger btn-xs" type="button"
                                 data-original-title="btn btn-danger btn-xs"
                                 id="show_confirm_'.$row["id"].'"
                                 data-toggle="tooltip"><i
                                     class="fa fa-trash"></i></button>
         
                         </div>
                         <div class="col-md-2">
                         <a href="coupon/'.$row["id"].'/edit"> <button
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
                         
                         $("#show_confirm_'. $row["id"].'").click(async function(event) {
                 
                             const {
                                 value: email
                             } = await Swal.fire({
                                 title: "Are you sure?",
                                 text: "You wont be able to revert this!",
                                 icon: "warning",
                                 input: "text",
                                 inputLabel: "Type coupon/delete to delete item",
                                 inputPlaceholder: "Type coupon/delete to delete item",
                                 showCancelButton: true,
                                 inputValidator: (value) => {
                                     return new Promise((resolve) => {
                                         if (value != "coupon/delete") {
                                             resolve("Type coupon/delete to delete item")
                                         } else {
                                             resolve()
                                         }
                                     }) 
                                 },
                             })
                             if (email) {
                                 $.ajax({
                                     url: "coupon/'.$row["id"].'",
                                     type: "DELETE",
                                     cache: false,
                                     data: {
                                         "_token": "{{ csrf_token() }}",
                                     },
                                     success: function(data) {
                                         $("#show_confirm_'.$row['id'].'").parents("tr").remove();
                                     }
                 
                                 })
                             }
                         });</script>';
                           
                           
                            return $btn;
                    })
                    ->rawColumns(['action'])->make(true);
               
         }

        return view('coupons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::orderBy('id', 'DESC')->get();
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('coupons.create',compact('brands','coupons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'coupon_code' => 'unique:coupons|regex:/^[a-zA-Z0-9%]+$/u|max:30',
            'currency' => 'required',
            'symbol' => 'required',
            'amount' => 'required|max:20',
            'currency' => 'required',
            'date' => 'required',
            'brand' => 'required',
        ]);
        // dd($request->all());
        $Coupon= new Coupon();
        $Coupon->coupon_code = $request->coupon_code;
        $Coupon->currency = $request->currency;
        $Coupon->brand_id = $request->brand;
        $Coupon->symbol = $request->symbol;
        if($request->symbol == "%" && $request->amount > 100){
            return back()->with('error','Value must be less then 100');
        }else{
            $Coupon->amount = $request->amount;
        }
        $Coupon->date = $request->date;
        $Coupon->save();

        return redirect()->route('coupon.create')
                        ->with('success','Coupon Add successfully');
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
        $Coupons = Coupon::find($id);
        if(!empty($Coupons)){
            return view('coupons.edit',compact('Coupons'));
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
            'coupon_code' => 'regex:/^[a-zA-Z0-9%]+$/u|max:30',
            'currency' => 'required',
            'symbol' => 'required',
            'amount' => 'required|max:10',
            'currency' => 'required',
            'date' => 'required',
            'brand' => 'required',
        ]);
        // dd($request->all());
        $Coupon = Coupon::find($id);
        $Coupon->coupon_code=$request->coupon_code;
        $Coupon->currency = $request->currency;
        $Coupon->brand_id = $request->brand;
        $Coupon->symbol = $request->symbol;
        if ($request->symbol == "%" && $request->amount <= 100) {
            $Coupon->amount = $request->amount;
        }else if($request->symbol == "$" && $request->amount){
            $Coupon->amount = $request->amount;
        }else{
            return back()->with('error','Value must be less then 100');
        }
        $Coupon->date = $request->date;
        $Coupon->update();
        return redirect()->route('coupon.edit',$Coupon->id)
                        ->with('success','Coupon Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $check = Coupon::find($id);
        if(!empty($check)){
            $influ = Association::where('coupon_id',$id)->get();
            if(count($influ) > 0){
                foreach($influ as $in){
                    $in->delete();
                }
            }
            $check->delete();
            return response()->json(['data'=>"true",'id'=>$id]);
        }else{
            return response()->json("false");
        }
    }

    public function csvForm()
    {
        return view('coupons.csv_coupone');
    }

    public function csvUpload(Request $request)
    {

        $file = $request->file('csv');
        $ex = $file->getClientOriginalExtension();
        $check_array = [];
        if($ex != 'csv'){
            return back()->with('error','Invalid CSV File.');
        }
        if($file = $request->file('csv')){

            $filename = time().'-'.$file->getClientOriginalExtension();
            $file->move('assets/temp_files',$filename);
        }

        $file = fopen(public_path('assets/temp_files/'.$filename),"r");
        $row  = fgetcsv($file);
        
        // dd($row);
        if($row){
            $item_fields = $this->setUpItemFields($row);
            // dd($item_fields);

            // $attribute_options = $this->setUpProductAttributeOptions($item_fields);

        }else{
            return back()->withErrors('Invalid CSV File.');
        }

        $i = 0;
        while(($row = (fgetcsv($file))) !== false){
            DB::beginTransaction();

            try{
                $item = $this->fillItemFields($item_fields,$row);
                if(!array_key_exists('Coupon Code',$item)){
                    return back()->with('error','In Correct Data.');
                }
                // dd($item);
                    $br = Brand::where('company_name',$item['Brand'])->first();
                    if(empty($br)){
                        array_push($check_array,$item['Coupon Code']);
                    }
                    $brand = $this->createCoupon($item);



                


                DB::commit();


            }catch(Exception $e){
                DB::rollback();
                // return
                // dump($e);
            }

            $i++;
        }
        // dd('stop');
        fclose($file);
        if(count($check_array) < 1){
            
            return back()->with('success','Coupon(s) imported successfully');
        }else{
            return back()->with('error',$check_array);
        }
        
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

    public function createCoupon($item)
    {
        // dd($item['date']);
        // $d = Carbon::createFromFormat('Y-m-d',$item['date'])->format('yy-m-d');
        // dd($d);
        //$da = strtotime($item['date']);
    $status = 0;
    if($item['Status'] == 'Active'){
        $status = 1;
    }
   //$date = Carbon::parse($da)->format('Y-m-d');
        
        $brand = Brand::where('company_name',$item['Brand'])->first();
        $coupon = Coupon::where('coupon_code',$item['Coupon Code'])->first();
        if($brand && empty($coupon) && isset($item['Coupon Code'])){
            $coupon = new Coupon();
        $coupon->coupon_code = $item['Coupon Code'];
        //$coupon->currency = $item['original_currency'];
        $coupon->brand_id = $brand->id;
        //$coupon->symbol = $item['symbol'];
        //$coupon->amount = $item['amount'];
        //$coupon->date = $date;
         $coupon->notes = $item['notes'];
         $coupon->status = $status;
        $coupon->save();
        }
    }

    public function export()
    {
        $headers = [
            'Cache-Control'        => 'must-revalidate, post-check=0, pre-check=0'
            ,'Content-type'        => 'text/csv'
            ,'Content-Disposition' => 'attachment; filename=coupon_csv_export.csv'
            ,'Expires'             => '0'
            ,'Pragma'              => 'public',
        ];

        $lists    = Coupon::all()->toArray();
        // dd($lists);
        if (count($lists) > 0) {
            $new_list = [];
            foreach ($lists as $list) {
                $coupon_list = [];
                $brand = Brand::find($list['brand_id']);
                if($brand){
                    $coupon_list['Brand'] = $brand->company_name;
                }
                
                $coupon_list['Coupon Code'] = $list['coupon_code'];
                
                $coupon_list['notes'] = $list['notes'];
                $coupon_list['Status'] = $list['status'];
               


                // $list['brand'] = $brand->company_name;
                unset($list['brand_id']);
                unset($list['password']);
                unset($list['created_at']);
                unset($list['updated_at']);
                // unset($list['subcategory_id']);
                array_push($new_list, $coupon_list);
            }

            # add headers for each column in the CSV download
            array_unshift($new_list, array_keys($new_list[0]));

            $callback = function () use ($new_list) {
                $FH = fopen('php://output', 'w');
                foreach ($new_list as $row) {
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
        $c_array = explode(',', $ids);
        if(count($c_array) > 0){
            foreach($c_array as $id){
                $influ = Association::where('coupon_id',$id)->get();
                if(count($influ) > 0){
                    foreach($influ as $in){
                        $in->delete();
                    }
                }
                $in = CouponInfluencer::where('coupon_id',$id)->get();
                if(count($in) > 0){
                    foreach($in as $i){
                        $i->delete();
                    }
                }
                Coupon::find($id)->delete();
            }
        }
        
        // DB::table("coupons")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Coupons Deleted successfully."]);
    }

    public function searchCoupons (Request $request){
        // dd($request->all());
        $date_check = Carbon::parse($request->date)->format('Y-m-d');
        // dd($date_check);
        if($request->search != null || $date_check != null){
            if($request->search == null){
                $Coupons = Coupon::where('date', $date_check)
                ->get();
            }else if($request->date == null){
                $Coupons = Coupon::where('coupon_code', 'like', '%'. $request->search. '%')
                
                ->orWhere('currency', 'like', '%'. $request->search. '%')
                ->get();
            }else{
                $Coupons = Coupon::where('coupon_code', 'like', '%'. $request->search. '%')
                ->orWhere('date', $date_check)
                ->orWhere('currency', 'like', '%'. $request->search. '%')
                ->get();
            }
            
            // dd($Coupons);
            $search = $request->search;
            $date = $request->date;
            return view('coupons.search', compact('Coupons','search','date'));
        }else{
            
            return redirect()->route('coupon.index')->with('error','please put some data to search Coupons');
        }
        
    }

}
