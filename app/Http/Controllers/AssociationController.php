<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Association;
use App\Models\Coupon;
use App\Models\Brand;
use App\Models\Influencer;
use App\Models\User;
use App\Models\ArabyAds;
use App\Models\Ounass;
use App\Models\Styli;
use App\Models\MarketerHub;
use App\Models\Shosh;
use DB;
use Yajra\DataTables\DataTables;


class AssociationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //  $a = Association::orderBy('id', 'DESC')->get();
        // foreach($a as $r){
        //     $r->delete();
        // }
        $associations = [];
        if ($request->ajax()) {
            $as = Association::orderBy('id', 'DESC')->get();
            foreach($as as $c){
                $brand = Brand::find($c->brand_id);
                $coupon = Coupon::find($c->coupon_id);
                $inf = User::where('pub_id',$c->influencer_id)->first();
                $c['brand_name'] = !empty($brand) ? $brand->company_name : NULL;
                $c['coupon_name'] = !empty($coupon) ? $coupon->coupon_code : NULL;
                $c['inf_name'] = !empty($inf) ? $inf->f_name : NULL;

                array_push($associations,$c);
            }
            // dd($coupons);
            $k = 1;
            return Datatables::of($associations)
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
                         <a href="assciate/'.$row["id"].'/edit"> <button
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
                                 inputLabel: "Type association/delete to delete item",
                                 inputPlaceholder: "Type association/delete to delete item",
                                 showCancelButton: true,
                                 inputValidator: (value) => {
                                     return new Promise((resolve) => {
                                         if (value != "association/delete") {
                                             resolve("Type association/delete to delete item")
                                         } else {
                                             resolve()
                                         }
                                     })
                                 },
                             })
                             if (email) {
                                 $.ajax({
                                     url: "assciate/'.$row["id"].'",
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

        return view('association.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $influencers = User::where('user_type',2)->orderBy('id', 'DESC')->get();
        $brands = Brand::orderBy('id', 'DESC')->get();
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        // dd($coupons);
        return view('association.create', compact('influencers','brands','coupons'));
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
            'brand' => 'required',
            'coupon' => 'required',
            'influencer' => 'required',

        ]);
        // dd($request->all());
        $check = Association::where('influencer_id',$request->influencer)->where('brand_id',$request->brand)->where('coupon_id',$request->coupon)->first();
        //   dd($check);
        if (!empty($check)) {
            return redirect()->route('assciate.create')
            ->with('error', 'Data Already Exist');

        }
        else{
            // dd($check);
            $associations= new Association();
            $associations->coupon_id=$request->coupon;
            $associations->influencer_id = $request->influencer;
            $associations->brand_id = $request->brand;
            $associations->save();
            return back()->with('success', 'Association create successfully');
        }
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
        $associations = Association::find($id);
        if(!empty($associations)){
            $brands = Brand::orderBy('id', 'DESC')->get();
            $coupons = Coupon::orderBy('id', 'DESC')->get();
            $influencers = User::orderBy('id', 'DESC')->get();
            return view('association.edit', compact('associations','brands','coupons','influencers'));
        }
        else{
            return back()->with('error','No record found');
        }
        // $associations = Association::orderBy('id', 'DESC')->get();;

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
            'coupon' => 'required',
            'influencer' => 'required',

        ]);

        $check = Association::where('influencer_id',$request->influencer)->where('brand_id',$request->brand)->where('coupon_id',$request->coupon)->first();
        //   dd($check);
        if (!empty($check)) {
            return redirect()->route('assciate.create')
            ->with('error', 'Data Already Exist');

        }
        else{
            // dd($check);
            $associations= Association::find($id);
            $associations->coupon_id=$request->coupon;
            $associations->influencer_id = $request->influencer;
            $associations->brand_id = $request->brand;
            $associations->Update();

            return back()->with('success', 'Association Update successfully');
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
        $check = Association::find($id);
        if(!empty($check)){
            $check->delete();
            return response()->json(['data'=>"true",'id'=>$id]);
        }

    }

    public function csvForm()
    {
        return view('association.csv');
    }

    public function csvUpload(Request $request)
    {
        // dd("hello");
        // $csv = $request->all();
        // dd($csv);
        // Excel::import(new BrandImport,$csv);

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
                // dd($item);

                if(array_key_exists("Influencer Pub ID",$item)){
                    // dd($item);
                    $brand = [];
                    $brand = $this->createManagement($item);
                    DB::commit();
                }else{
                    return back()->with('error','incorrect Data.');
                }

            //    dump($brand);

            }catch(Exception $e){
                DB::rollback();
                // return
                // dump($e);
            }

            $i++;
        }
        // dd('stop');
        fclose($file);
        return back()->with('success','Association(s) Imported Successfully.');
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

    public function createManagement($item)
    {
    //    dd($item);

            $brand =Brand::where('company_name',$item['Brand'])->first();

            $coupon = Coupon::where('coupon_code',$item['Coupon Code'])->first();
            $influ = User::where('pub_id',$item['Influencer Pub ID'])->first();

            if ($coupon && $influ && $brand) {
                 $check = Association::where('coupon_id',$coupon->id)->where('brand_id',$brand->id)->where('influencer_id',$influ->pub_id)->first();
                //  dd($check);
                    if (empty($check)) {
                        $management = new Association();
                        $management->coupon_id = $coupon->id;
                        $management->brand_id = $brand->id;
                        $management->influencer_id = $influ->pub_id ;
                        $management->save();
                    }
            }


        return true;
    }

    public function export()
    {
        $headers = [
            'Cache-Control'        => 'must-revalidate, post-check=0, pre-check=0'
            ,'Content-type'        => 'text/csv'
            ,'Content-Disposition' => 'attachment; filename=Association_csv_export.csv'
            ,'Expires'             => '0'
            ,'Pragma'              => 'public',
        ];

        $lists    = Association::all()->toArray();
        //dd($lists);
         if (count($lists) > 0) {
             $new_list = [];
             foreach ($lists as $list) {
                 $coupon_influencer_list = [];
                 $influencer = User::where('pub_id',$list['influencer_id'])->first();
                 $coupon = Coupon::find($list['coupon_id']);
                 $brand = Brand::find($list['brand_id']);
                 if ($influencer && $coupon && $brand) {
                     $coupon_influencer_list['Brand'] = $brand->company_name;
                     $coupon_influencer_list['Coupon Code'] = $coupon->coupon_code;
                     $coupon_influencer_list['Influencer Pub ID'] = $influencer->pub_id;


                     //dd($coupon_influencer_list);
                     unset($list['id']);
                     unset($list['coupon_id']);
                     unset($list['influencer_id']);
                     unset($list['created_at']);
                     unset($list['updated_at']);
                     array_push($new_list, $coupon_influencer_list);
                 }
                 // unset($list['id']);

            // unset($list['subcategory_id']);
             }
             
             # add headers for each column in the CSV download
             if(count($new_list) > 0){
                 array_unshift($new_list, array_keys($new_list[0]));
             // foreach($new_list as $row_list)
             // {
             //     dump($row_list);
             // }
             // dd($new_list);

             $callback = function () use ($new_list) {
                 $FH = fopen('php://output', 'w');
                 foreach ($new_list as $row) {
                     //dd($row);
                     fputcsv($FH, $row);
                 }
                 fclose($FH);
             };

                return response()->stream($callback, 200, $headers);
             }else{
                 return back()->with('error','Invalid data to export');
             }
             
         }
         else{
             return back()->with('error','Reocord not found');
         }
    }

    public function bulk_delete(Request $request)
    {
        $ids = $request->ids;
        // dd($ids);
        DB::table("associations")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Data Deleted successfully."]);
    }


    public function getCoupons(Request $request)
    {

        if($request->brand_id){
            $data = Brand::findOrFail($request->brand_id);
            $data = Coupon::where('brand_id',$data->id)->get();
            $count = count($data);
        }else{
            $data = [];
        }

        return response()->json(['data'=>$data]);
    }


    public function searchData(Request $request)
    {
        $selected_brand = -1;
        $selected_coupon = -1;
        $selected_influencer = -1;
        if($request->brand){
            $selected_brand = $request->brand;
        }
        if($request->coupon){
            $selected_coupon = $request->coupon;
        }
        if($request->influencer){
            $selected_influencer = $request->influencer;
        }

        
            $associations = Association::where('brand_id',$request->brand)
                            ->orWhere('coupon_id',$request->coupon)
                            ->orWhere('influencer_id',$request->influencer)->get();
            $influencers = User::where('user_type',2)->orderBy('id', 'DESC')->get();
            $brands = Brand::orderBy('id', 'DESC')->get();
            $coupons = Coupon::orderBy('id', 'DESC')->get();
            return view('association.search',compact('associations','coupons','brands','influencers','selected_brand','selected_coupon','selected_influencer'));
        
        
        
    }
}
