<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Excel;
use App\Imports\BrandImport;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;
use App\Models\CouponInfluencer;
use App\Models\Association;
use App\Models\Commission;
use App\Models\SingleCommission;
use App\Models\DualCommission;
use App\Models\MultipleCommission;
use App\Models\User;

use Yajra\DataTables\DataTables;
use File;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $brands = Brand::orderBy('id', 'DESC')->where('company_name','!=', NULL)->get();
        // dd($brands);
        // return view('brands.index', compact('brands'));
        if ($request->ajax()) {
            $brands = Brand::orderBy('id','desc')->get();
        // dd($brands);s
            $k = 1;
            return Datatables::of($brands)
                    ->addIndexColumn('id')
                    ->addColumn('action', function ($row) {
                        $btn = '<div class="row">
                         <div class="col-md-2">
         
                             <button class="btn btn-danger btn-xs" type="button"
                                 data-original-title="btn btn-danger btn-xs"
                                 id="show_confirm_'.$row["id"].'"
                                 data-toggle="tooltip"><i
                                     class="fa fa-trash"></i></button>
         
                         </div>
                         <div class="col-md-2">
                         <a href="brands/'.$row["id"].'/edit"> <button
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
                                 inputLabel: "Type brand/delete to delete item",
                                 inputPlaceholder: "Type brand/delete to delete item",
                                 showCancelButton: true,
                                 inputValidator: (value) => {
                                     return new Promise((resolve) => {
                                         if (value != "brand/delete") {
                                             resolve("Type brand/delete to delete item")
                                         } else {
                                             resolve()
                                         }
                                     })
                                 },
                             })
                             if (email) {
                                 $.ajax({
                                     url: "brands/'.$row["id"].'",
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

        return view('brands.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $request->validate(
            [
            'company_name' => 'required|unique:brands|max:20',
            'country' => 'required',
            'status' => 'required',
            'image' =>'mimes:jpeg,jpg,png|required',
            'fixed_single_value'=> 'max:20',
            'fixed_dual_min_value.*'=> 'max:20|',
            'fixed_dual_max_value.*'=> 'max:20',
            'fixed_dual_total_value.*'=> 'max:20',
            'fixed_multiple_newuser_value'=> 'max:20',
            'fixed_multiple_olduser_value'=> 'max:20',
            'percentage_single_value'=> 'max:20',
            'percentage_multiple_newuser_value'=> 'max:20',
            'percentage_multiple_olduser_value'=> 'max:20',
        ],
            [
            'image.required' => 'The : Image type must be jpeg,jpg,png.',

      ]
        );
        DB::beginTransaction();
        try {
            $image = $request->file('image');
            // unlink(public_path('images/Product/') . $data->image);
            $imageName = time() . rand(1, 10000) . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('images/brand/'), $imageName);
            // $data->update([
            //     'image' => $imageName
            // ]);

            // dd(isset($request->fixed_dual_min_value));
            // dd($request->fixed_dual_min_value);
            if($request->fixed_dual_min_value[0] == null && count($request->fixed_dual_min_value) > 0){
                foreach($request->fixed_dual_min_value as $val){
                    if(!$val){
                        return redirect()->back()->with('error', 'Minimum value is required');
                    }
                }   
            }
            if($request->fixed_dual_max_value[0] == null && count($request->fixed_dual_max_value) > 0){
                //dd($request->fixed_dual_max_value);
                foreach($request->fixed_dual_max_value as $val){
                    if(!$val){
                        return redirect()->back()->with('error', 'Maximum value is required');
                    }
                }   
            }
            if($request->fixed_dual_total_value[0] == null && count($request->fixed_dual_total_value) > 0){
                foreach($request->fixed_dual_total_value as $val){
                    if(!$val){
                        return redirect()->back()->with('error', 'Total value is required');
                    }
                }   
            }

            // dd($request->all());

            if(empty($request->fixed_multiple_newuser_value) && !empty($request->fixed_multiple_olduser_value)){
                return redirect()->back()->with('error', 'Fixed Commision New user value is required');
            }
            if(!empty($request->fixed_multiple_newuser_value) && empty($request->fixed_multiple_olduser_value)){
                return redirect()->back()->with('error', 'Fixed Commision Old user value is required');
            }
            if(empty($request->percentage_multiple_newuser_value) && !empty($request->percentage_multiple_olduser_value)){
                return redirect()->back()->with('error', 'Percentage Commision New user value is required');
            }
            if(!empty($request->percentage_multiple_newuser_value) && empty($request->percentage_multiple_olduser_value)){
                return redirect()->back()->with('error', 'Percentage Commision Old user value is required');
            }
            $brand= new Brand();
            $brand->image=$imageName;
            $brand->company_name = $request->company_name;
            $brand->country = $request->country;
            $brand->status = $request->status;
            $brand->save();
            $commission = new Commission;
            if (!empty($request->fixed_single_value)) {
                
                $commission->type = "fixed single";
                $commission->brand_id = $brand->id;
                $commission->save();
                $single_commission= new SingleCommission;
                $single_commission->value = $request->fixed_single_value;
                $single_commission->commission_id = $commission->id;
                $single_commission->save();
            }
            for ($i=0; $i < count($request->fixed_dual_min_value); $i++) {
                if (!empty($request->fixed_dual_min_value[$i]) && !empty($request->fixed_dual_max_value[$i]) && !empty($request->fixed_dual_total_value[$i])) {
                    // dd($request->fixed_dual_min_value[$i]);
                    if ($request->fixed_dual_min_value[$i] >= $request->fixed_dual_max_value[$i]) {
                        return redirect()->back()->with('error', 'Mininum Commission value must be less than Maximum Commission Value');
                    }
                    $commission->type = "Fixed  Dual";
                    $commission->brand_id = $brand->id;
                    $commission->save();
                    $dual_commission= new DualCommission;
                    $dual_commission->min_value = $request->fixed_dual_min_value[$i];
                    $dual_commission->max_value = $request->fixed_dual_max_value[$i];
                    $dual_commission->total_value = $request->fixed_dual_total_value[$i];
                    $dual_commission->commission_id = $commission->id;
                    $dual_commission->save();
                } 
                // else {
                //     return redirect()->back()->with('error', 'Dual Commission requires Minimum, Maximum and Total Commission Values');
                // }
            }
            if (!empty($request->fixed_multiple_newuser_value) && !empty($request->fixed_multiple_olduser_value)) {
                $commission->type = "Fixed  Multiple";
                $commission->brand_id = $brand->id;
                $commission->save();
                $multiple_commission= new MultipleCommission;
                $multiple_commission->new_user = $request->fixed_multiple_newuser_value;
                $multiple_commission->old_user = $request->fixed_multiple_olduser_value;
                $multiple_commission->commission_id = $commission->id;
                $multiple_commission->save();
            }
            else if (!empty($request->percentage_single_value)) {
                if ($request->percentage_single_value >= 100) {
                    return redirect()->back()->with('error', ' Commission value must be less than 100%');
                }
                $commission->type = "Percentage Single";
                $commission->brand_id = $brand->id;
                $commission->save();
                $single_commission= new SingleCommission;
                $single_commission->value = $request->percentage_single_value;
                $single_commission->commission_id = $commission->id;
                $single_commission->save();
            }
            else if (!empty($request->percentage_multiple_newuser_value) && !empty($request->percentage_multiple_olduser_value)) {
                if ($request->percentage_multiple_newuser_value >= 100 || $request->percentage_multiple_olduser_value >= 100) {
                    return redirect()->back()->with('error', ' Commission value must be less than 100%');
                }
                $commission->type = "Percentage Multiple";
                $commission->brand_id = $brand->id;
                $commission->save();
                $multiple_commission= new MultipleCommission;
                $multiple_commission->new_user = $request->percentage_multiple_newuser_value;
                $multiple_commission->old_user = $request->percentage_multiple_olduser_value;
                $multiple_commission->commission_id = $commission->id;
                $multiple_commission->save();
            }
            else if (empty($request->percentage_multiple_newuser_value) && empty($request->percentage_multiple_olduser_value) && empty($request->percentage_single_value) && empty($request->fixed_multiple_newuser_value) && empty($request->fixed_multiple_olduser_value) && empty($request->fixed_single_value) && $request->fixed_dual_min_value[0] == null && $request->fixed_dual_max_value[0] == null && $request->fixed_dual_total_value[0] == null) {
                return redirect()->back()->with('error', 'Commission is required');
            }
                
            DB::commit();
            // return view('brands.show',compact('brand'))->with('success', 'brand Add successfully');
            return redirect()->back()->with('success', 'Brand added successfully');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = Brand::find($id);
        $countries = DB::table('countries')->get();
        $commission = Commission::select()->where('brand_id', $id)->first();
        // $commission = Commission::query()->where('brand_id', $id)->get();
        // $commission = DB::table('commissions')->where('brand_id', $id)->get();
        // $commission = DB::table('commissions')->where('brand_id', $id)->first();
        // $commission = DB::where('brand_id','=', $id)->get();
        if (!empty($brands)) {
        if ($commission) {
            $singledata =[];
            $dualdata = [];
            $multipledata=[];

            array_push($singledata, SingleCommission::select()->where('commission_id', $commission->id)->get());
            array_push($dualdata, DualCommission::select()->where('commission_id', $commission->id)->get());
            array_push($multipledata, MultipleCommission::select()->where('commission_id', $commission->id)->get());
            // dump(!empty($singledata[0][0]));
            // dump(!empty($dualdata[0][0]));
            // dd($multipledata);
                return view('brands.edit', compact('brands', 'countries', 'commission', 'singledata', 'dualdata', 'multipledata'));
        } else {
            return view('brands.edit', compact('brands', 'countries'));
        }
    }else {
        // dd('hjshjshs');
        return back()->with('error', 'No record found');
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
        $request->validate(
            [
            'company_name' => 'required|max:20',
            'country' => 'required',
            'fixed_single_value'=> 'max:20',
            'fixed_dual_min_value'=> 'max:20',
            'fixed_dual_max_value'=> 'max:20',
            'fixed_dual_total_value'=> 'max:20',
            'fixed_multiple_newuser_value'=> 'max:20',
            'fixed_multiple_olduser_value'=> 'max:20',
            'percentage_single_value'=> 'max:20',
            'percentage_multiple_newuser_value'=> 'max:20',
            'percentage_multiple_olduser_value'=> 'max:20',
            'single_value'=> 'max:20',
            'percentage_updated_single_value'=> 'max:20',
            'dual_min_value'=> 'max:20',
            'dual_max_value'=> 'max:20',
            'dual_total_value'=> 'max:20',
            'multiple_newuser_value'=> 'max:20',
            'multiple_olduser_value'=> 'max:20',
            'percentage_updated_multiple_olduser_value' => 'max:20',
            'percentage_updated_multiple_newuser_value' => 'max:20',

        ]
        );

        // dd($request->all());
        $image = $request->file('image');
        $commission = Commission::select()->where('brand_id', $id)->first();
        // dd($commission);
        if ($commission) {
            $singledata =[];
            $dualdata = [];
            $multipledata=[];
            array_push($singledata, SingleCommission::select()->where('commission_id', $commission->id)->get());
            array_push($dualdata, DualCommission::select()->where('commission_id', $commission->id)->get());
            array_push($multipledata, MultipleCommission::select()->where('commission_id', $commission->id)->get());
            // dd($dualdata);
            foreach ($singledata as $datasingle) {
                foreach ($datasingle as $datasng) {
                    if ($datasng->id) {
                        $single_commission = SingleCommission::find($datasng->id);
                        if (!empty($request->single_value)) {
                            $commission->type = "fixed single";
                            $commission->save();
                            $single_commission->value = $request->single_value;
                            $single_commission->save();
                        } elseif (!empty($request->percentage_updated_single_value)) {
                            $commission->type = "Percentage Single";
                            $commission->save();
                            if ($request->percentage_updated_single_value >= 100) {
                                return redirect()->back()->with('error', ' Commission value must be less than 100%');
                            }
                            $single_commission->value = $request->percentage_updated_single_value;
                            $single_commission->save();
                        }
                    }
                }
            }
            $i=0;
            foreach ($dualdata as $datadual) {
                // dd($datadual);
                foreach ($datadual as $datadl) {
                    // dd($datadl);
                    if ($datadl->id) {
                        // dd(count($request->dual_min_value));
                        // for ($j=0; $j<count($request->dual_min_value); $j++) {
                            if ($request->dual_min_value[$i] >= $request->dual_max_value[$i]) {
                                return redirect()->back()->with('error', 'Mininum Commission value must be less than Maximum Commission Value');
                            }
                            if (!empty($request->dual_min_value[$i]) && !empty($request->dual_max_value[$i]) && !empty($request->dual_total_value[$i])) {
                                // dd($request->dual_min_value[$j]);
                                $dual_commission = DualCommission::find($datadl->id);
                                $dual_commission->min_value = $request->dual_min_value[$i];
                                $dual_commission->max_value = $request->dual_max_value[$i];
                                $dual_commission->total_value = $request->dual_total_value[$i];
                                $dual_commission->update();
                                $i++;
                            } else {
                                // dd($i);
                                return redirect()->back()->with('error', 'ires Minimum, Maximum and Total Commission Values');
                            }
                        // }
                    }
                }
            }
            foreach ($multipledata as $datamultiple) {
                foreach ($datamultiple as $datamulti) {
                    if ($datamulti->id) {
                        $multiple_commission = MultipleCommission::find($datamulti->id);
                        if (!empty($request->multiple_newuser_value) && !empty($request->multiple_olduser_value)) {
                            $commission->type = "Fixed  Multiple";
                            $commission->save();
                            $multiple_commission->new_user = $request->multiple_newuser_value;
                            $multiple_commission->old_user = $request->multiple_olduser_value;
                        } elseif (!empty($request->percentage_updated_multiple_newuser_value) && !empty($request->percentage_updated_multiple_olduser_value)) {
                            if ($request->percentage_updated_multiple_newuser_value >= 100 || $request->percentage_updated_multiple_olduser_value >= 100) {
                                return redirect()->back()->with('error', ' Commission value must be less than 100%');
                            }
                            $multiple_commission->new_user = $request->percentage_updated_multiple_newuser_value;
                            $multiple_commission->old_user = $request->percentage_updated_multiple_olduser_value;
                            $commission->type = "Percentage Multiple";
                            $commission->save();
                        }
                    
                        $multiple_commission->update();
                    }
                }
            }
        }
        if (!empty($request->fixed_single_value)) {
            if ($commission) {
                foreach ($singledata as $datasingle) {
                    foreach ($datasingle as $datasng) {
                        if ($datasng->id) {
                            $datasng->delete();
                        }
                    }
                }
                foreach ($dualdata as $datadual) {
                    foreach ($datadual as $datadl) {
                        if ($datadl->id) {
                            $datadl->delete();
                        }
                    }
                }
                foreach ($multipledata as $datamultiple) {
                    foreach ($datamultiple as $datamulti) {
                        if ($datamulti->id) {
                            $datamulti->delete();
                        }
                    }
                }
                $commission->type = "fixed single";
                $commission->update();
                $single_commission= new SingleCommission;
                $single_commission->value = $request->fixed_single_value;
                $single_commission->commission_id = $commission->id;
                $single_commission->save();
            } else {
                $commission = new Commission;
                $commission->type = "fixed single";
                $commission->brand_id = $id;
                $commission->save();
                $single_commission= new SingleCommission;
                $single_commission->value = $request->fixed_single_value;
                $single_commission->commission_id = $commission->id;
                $single_commission->save();
            }
        }
        for ($i=0; $i < count($request->fixed_dual_min_value); $i++) {
            if (!empty($request->fixed_dual_min_value[$i]) && !empty($request->fixed_dual_max_value[$i]) && !empty($request->fixed_dual_total_value[$i])) {
                if ($request->fixed_dual_min_value[$i] >= $request->fixed_dual_max_value[$i]) {
                    return redirect()->back()->with('error', 'Mininum Commission value must be less than Maximum Commission Value');
                }
                if ($commission) {
                    foreach ($singledata as $datasingle) {
                        foreach ($datasingle as $datasng) {
                            if ($datasng->id) {
                                $datasng->delete();
                            }
                        }
                    }
                    foreach ($dualdata as $datadual) {
                        foreach ($datadual as $datadl) {
                            if ($datadl->id) {
                                $datadl->delete();
                            }
                        }
                    }
                    foreach ($multipledata as $datamultiple) {
                        foreach ($datamultiple as $datamulti) {
                            if ($datamulti->id) {
                                $datamulti->delete();
                            }
                        }
                    }
                    $commission->type = "Fixed  Dual";
                    $commission->update();
                    $dual_commission= new DualCommission;
                    $dual_commission->min_value = $request->fixed_dual_min_value[$i];
                    $dual_commission->max_value = $request->fixed_dual_max_value[$i];
                    $dual_commission->total_value = $request->fixed_dual_total_value[$i];
                    $dual_commission->commission_id = $commission->id;
                    $dual_commission->save();
                } else {
                    $commission = new Commission;
                    $commission->type = "Fixed  Dual";
                    $commission->brand_id = $id;
                    $commission->save();
                    $dual_commission= new DualCommission;
                    $dual_commission->min_value = $request->fixed_dual_min_value[$i];
                    $dual_commission->max_value = $request->fixed_dual_max_value[$i];
                    $dual_commission->total_value = $request->fixed_dual_total_value[$i];
                    $dual_commission->commission_id = $commission->id;
                    $dual_commission->save();
                }
            }
            // else{
            //     return redirect()->back()->with('error', 'Dual weession requires Minimum, Maximum and Total Commission Values');
            // }
        }

        if (!empty($request->fixed_multiple_newuser_value) && !empty($request->fixed_multiple_olduser_value)) {
            if ($commission) {
                foreach ($singledata as $datasingle) {
                    foreach ($datasingle as $datasng) {
                        if ($datasng->id) {
                            $datasng->delete();
                        }
                    }
                }
                foreach ($dualdata as $datadual) {
                    foreach ($datadual as $datadl) {
                        if ($datadl->id) {
                            $datadl->delete();
                        }
                    }
                }
                foreach ($multipledata as $datamultiple) {
                    foreach ($datamultiple as $datamulti) {
                        if ($datamulti->id) {
                            $datamulti->delete();
                        }
                    }
                }
                $commission->type = "Fixed  Multiple";
                $commission->update();
                $multiple_commission= new MultipleCommission;
                $multiple_commission->new_user = $request->fixed_multiple_newuser_value;
                $multiple_commission->old_user = $request->fixed_multiple_olduser_value;
                $multiple_commission->commission_id = $commission->id;
                $multiple_commission->save();
            } else {
                $commission = new Commission;
                $commission->type = "Fixed  Multiple";
                $commission->brand_id = $id;
                $commission->save();
                $multiple_commission= new MultipleCommission;
                $multiple_commission->new_user = $request->fixed_multiple_newuser_value;
                $multiple_commission->old_user = $request->fixed_multiple_olduser_value;
                $multiple_commission->commission_id = $commission->id;
                $multiple_commission->save();
            }
        }
        if (!empty($request->percentage_single_value)) {
            if ($request->percentage_single_value >= 100) {
                return redirect()->back()->with('error', ' Commission value must be less than 100%');
            }
            if ($commission) {
                foreach ($singledata as $datasingle) {
                    foreach ($datasingle as $datasng) {
                        if ($datasng->id) {
                            $datasng->delete();
                        }
                    }
                }
                foreach ($dualdata as $datadual) {
                    foreach ($datadual as $datadl) {
                        if ($datadl->id) {
                            $datadl->delete();
                        }
                    }
                }
                foreach ($multipledata as $datamultiple) {
                    foreach ($datamultiple as $datamulti) {
                        if ($datamulti->id) {
                            $datamulti->delete();
                        }
                    }
                }
                $commission->type = "Percentage Single";
                $commission->update();
                $single_commission= new SingleCommission;
                $single_commission->value = $request->percentage_single_value;
                $single_commission->commission_id = $commission->id;
                $single_commission->save();
            } else {
                $commission = new Commission;
                $commission->type = "Percentage Single";
                $commission->brand_id = $id;
                $commission->save();
                $single_commission= new SingleCommission;
                $single_commission->value = $request->percentage_single_value;
                $single_commission->commission_id = $commission->id;
                $single_commission->save();
            }
        }
        if (!empty($request->percentage_multiple_newuser_value) && !empty($request->percentage_multiple_olduser_value)) {
            if ($request->percentage_multiple_newuser_value >= 100 || $request->percentage_multiple_olduser_value >= 100) {
                return redirect()->back()->with('error', ' Commission value must be less than 100%');
            }
            if ($commission) {
                foreach ($singledata as $datasingle) {
                    foreach ($datasingle as $datasng) {
                        if ($datasng->id) {
                            $datasng->delete();
                        }
                    }
                }
                foreach ($dualdata as $datadual) {
                    foreach ($datadual as $datadl) {
                        if ($datadl->id) {
                            $datadl->delete();
                        }
                    }
                }
                foreach ($multipledata as $datamultiple) {
                    foreach ($datamultiple as $datamulti) {
                        if ($datamulti->id) {
                            $datamulti->delete();
                        }
                    }
                }

                $commission->type = "Percentage Multiple";
                $commission->update();
                $multiple_commission= new MultipleCommission;
                $multiple_commission->new_user = $request->percentage_multiple_newuser_value;
                $multiple_commission->old_user = $request->percentage_multiple_olduser_value;
                $multiple_commission->commission_id = $commission->id;
                $multiple_commission->save();
            } else {
                $commission = new Commission;
                $commission->type = "Percentage Multiple";
                $commission->brand_id = $id;
                $commission->save();
                $multiple_commission= new MultipleCommission;
                $multiple_commission->new_user = $request->percentage_multiple_newuser_value;
                $multiple_commission->old_user = $request->percentage_multiple_olduser_value;
                $multiple_commission->commission_id = $commission->id;
                $multiple_commission->save();
            }
        }

        if ($image) {
            // $image = $request->file('image');
            // unlink(public_path('images/Product/') . $data->image);
            $imageName = time() . rand(1, 10000) . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('images/brand/'), $imageName);
            //    dd($imageName);
            $brand = Brand::find($id);
            $brand->company_name=$request->company_name;
            $brand->country=$request->country;
            $brand->image=$imageName;
            $brand->update();

            return redirect()->back()->with('success', 'Brand updated successfully');
        // return view('brands.show',compact('brand'))->with('success', 'brand Update successfully');
        } else {
            $brand = Brand::find($id);
            $brand->company_name=$request->company_name;
            $brand->country=$request->country;
            $brand->status=$request->status;
            $brand->update();
            return redirect()->back()->with('success', 'Brand updated successfully');
            // return view('brands.show',compact('brand'))->with('success', 'brand Update successfully');
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
        // dd($id);
        // dd("hello");
        $image = Brand::find($id);
        // dd($image->image);
        if (!empty($image)) {
            $old_image = $image->image;
            $url = public_path('images/brand/'.$old_image); // Take a look at this Url, you might wanna change it

            if (file_exists($url) && $image->image) {
                // dd($url);

                unlink(public_path('/images/brand/') . $image->image);
            }
            $coupon = Coupon::where('brand_id', $id)->get();
            $associations = Association::where('brand_id', $id)->get();
            if (count($associations) > 0) {
                foreach ($associations as $association) {
                    $association->delete();
                }
            }
            if (count($coupon) > 0) {
                foreach ($coupon as $in) {
                    $influc = CouponInfluencer::where('coupon_id', $in->id)->get();
                    if (count($influc) > 0) {
                        foreach ($influc as $ini) {
                            $ini->delete();
                        }
                    }
                    $in->delete();
                }
            }
            $delete = Brand::find($id)->delete();
            return response()->json(['data'=>"true",'id'=>$id]);
        } else {
            return response()->json("false");
        }
    }
    public function csvForm()
    {
        return view('brands.csv_brands');
    }


    // ==================== CSV Upload =====================================
    public function csvUpload(Request $request)
    {
        // dd("hello");
        // $csv = $request->all();
        // dd($csv);
        // Excel::import(new BrandImport,$csv);

        $file = $request->file('csv');
        $ex = $file->getClientOriginalExtension();
        //dd($ex);
        if ($ex != 'csv') {
            return back()->with('error', 'Invalid CSV File.');
        }
        if ($file = $request->file('csv')) {
            $filename = time().'-'.$file->getClientOriginalExtension();
            $file->move('assets/temp_files', $filename);
        }

        $file = fopen(public_path('assets/temp_files/'.$filename), "r");
        $row  = fgetcsv($file);
        //dd($row);
        if ($row) {
            $item_fields = $this->setUpItemFields($row);

        // $attribute_options = $this->setUpProductAttributeOptions($item_fields);
        } else {
            return back()->withErrors('Invalid CSV File.');
        }
        //  new

        // dd($item_fields);

        // end new
        $i = 0;
        while (($row = (fgetcsv($file))) !== false) {
            DB::beginTransaction();

            try {
                $item = $this->fillItemFields($item_fields, $row);
                //dd($item);
                if (!array_key_exists('Brand Name', $item)) {
                    return back()->with('error', 'In Correct Data.');
                }
                // dump($item);
                $brand = [];
                $brand = $this->createBrand($item);
                // if( !Brand::where('company_name',$item['Brand Name'])->first()){
                    
                // if ($brand) {
                // dd('yahan');
                // if (isset($item['campaign_logo']) && file_exists(public_path() . '/assets/images/gallery_images/' . $item['campaign_logo'])) {
                //     File::copy(public_path('/assets/images/gallery_images/'.$item['campaign_logo']), public_path().'/images/brand/'.$item['campaign_logo']);
                //     $brand->image = $item['campaign_logo'];
                //     $brand->save();
                // }
                // }



                // }


                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                // return
                // dump($e);
            }

            $i++;
        }
        // dd('stop');
        fclose($file);

        return back()->with('success', 'Brand(s) Imported Successfully.');
    }


    public function setUpItemFields($columnFields):array
    {
        $fieldsArray = [];
        foreach ($columnFields as $field) {
            $fieldsArray[] = $field;
        }

        return $fieldsArray;
    }


    public function fillItemFields($itemFields, $row):array
    {
        $item = [];
        foreach ($itemFields as $index => $name) {
            $item[$name] = (!empty($row[$index])) ? $row[$index] : null;
        }
        // dd($item);

        return $item;
    }

    public function createBrand($item)
    {
        // dd($item);
        // dump($item);
        $check = Brand::where('company_name', $item['Brand Name'])
            ->where('country', $item['country'])->first();
        $stat = 0;
        if ($item['Status'] == 'Active') {
            $stat = 1;
        }
        if (empty($check)) {
            $brand = new Brand();
            // dd($item);
            $brand->company_name = $item['Brand Name'];
            $brand->country = $item['country'];
            $brand->status = $stat;
            $brand->save();
        } else {
            $brand = Brand::find($check->id);
            $brand->company_name = $item['Brand Name'];
            $brand->country = $item['country'];
            $brand->status = $stat;
            $brand->update();
        }
        // $brand->fill($item)->save();
        // return $brand;
        $comm = Commission::where('brand_id', $brand->id)->first();
        if(empty($comm)){
            if($item['Commission Management'] == "Fixed  Dual")
            {
                $commission = new Commission();
                    $commission->type = $item['Commission Management'];
                    $commission->brand_id = $brand->id;
                    $commission->save();
                // dd($item);
                // $a = str_replace('$','',$item['Commision inf']);
                // dd($a);

                $item_array = explode('$', $item['Commision inf']);
                // $item_array_new = explode('$\n', $item_array[0]);
                // dd($item_array);
                foreach($item_array as $item_arr )
                {
                    // dd($item_arr);
                    $item_arr = str_replace(' EGP ','',$item_arr);
                    if(str_contains($item_arr, '>=')){
                        $item_ar = trim(preg_replace('/\s\s+/', ' ', $item_arr));
                        $item_ar = str_replace('>=','',$item_ar);
                        // dd($item_ar);
                        $item_aray = explode('=',$item_ar);
                        // dd($item_aray);
                        $dual_commission = new DualCommission;
                        $dual_commission->min_value = $item_aray[0];
                        // $dual_commission->max_value = $item_aray[0];
                        $dual_commission->total_value = $item_aray[1];
                        $dual_commission->commission_id = $commission->id;
                        $dual_commission->save();
                    }
                    elseif(str_contains($item_arr, '>')){
                        $item_ar = trim(preg_replace('/\s\s+/', ' ', $item_arr));
                        $item_ar = str_replace('>','',$item_ar);
                        // dd($item_ar);
                        $item_aray = explode('=',$item_ar);
                        // dd($item_aray);
                        $dual_commission = new DualCommission;
                        $dual_commission->min_value = $item_aray[0]+1;
                        // $dual_commission->max_value = $item_aray[0];
                        $dual_commission->total_value = $item_aray[1];
                        $dual_commission->commission_id = $commission->id;
                        $dual_commission->save();
                    }
                    elseif(str_contains($item_arr, '<=')){
                        $item_ar = trim(preg_replace('/\s\s+/', ' ', $item_arr));
                        $item_ar = str_replace('<=','',$item_ar);
                        // dd($item_ar);
                        $item_aray = explode('=',$item_ar);
                        // dd($item_aray);
                        $dual_commission = new DualCommission;
                        $dual_commission->max_value = $item_aray[0];
                        $dual_commission->min_value = 0;
                        $dual_commission->total_value = $item_aray[1];
                        $dual_commission->commission_id = $commission->id;
                        $dual_commission->save();
                    }
                    elseif(str_contains($item_arr, '<')){

                        $item_ar = trim(preg_replace('/\s\s+/', ' ', $item_arr));
                        $item_ar = str_replace('<','',$item_ar);
                        // dd($item_ar);
                        $item_aray = explode('=',$item_ar);
                        // dd($item_aray[0]-1);
                        $dual_commission = new DualCommission;
                        $dual_commission->max_value = $item_aray[0]-1;
                        $dual_commission->min_value = 0;
                        $dual_commission->total_value = $item_aray[1];
                        $dual_commission->commission_id = $commission->id;
                        $dual_commission->save();
                    }
                    elseif(str_contains($item_arr, '-')){
                        // $item_ar = str_replace('','',$item_arr);
                        $item_ar = trim(preg_replace('/\s\s+/', ' ', $item_arr));
                        // dd($item_ar);
                        $item_ar = str_replace('-','=',$item_ar);
                        // dd($item_ar);
                        $item_aray = explode('=',$item_ar);
                        // dd($item_aray);
                        if($item_aray[0] < $item_aray[1]){
                        $dual_commission = new DualCommission;
                        $dual_commission->min_value = $item_aray[0];
                        $dual_commission->max_value = $item_aray[1];
                        $dual_commission->total_value = $item_aray[2];
                        $dual_commission->commission_id = $commission->id;
                        $dual_commission->save();
                        }
                    }


                }
                // dd($item_array);
            }
            elseif($item['Commission Management'] == "fixed single" || $item['Commission Management'] == "Percentage Single"){
                // if(is_numeric($item['Commision inf']) || str_contains('.',$item['Commision inf'])){
                $commission = new Commission();
                $commission->type = $item['Commission Management'];
                $commission->brand_id = $brand->id;
                $commission->save();
    
                $single_commission = new SingleCommission();
                $single_commission->value =  $item['Commision inf'];
                $single_commission->commission_id = $commission->id;
                $single_commission->save();
            // }
            } elseif ($item['Commission Management'] == "Fixed  Multiple" || $item['Commission Management'] == "Percentage Multiple") {
                // if ((is_numeric($item['Commision New user']) || str_contains('.',$item['Commision New user']))
                // && (is_numeric($item['Commision old user']) || str_contains('.',$item['Commision old user']))) {
                $commission = new Commission();
                $commission->type = $item['Commission Management'];
                $commission->brand_id = $brand->id;
                $commission->save();

                    $multiple_commission = new MultipleCommission();
                    $multiple_commission->new_user = $item['Commision New user'];
                    $multiple_commission->old_user = $item['Commision old user'];
                    $multiple_commission->commission_id = $commission->id;
                    $multiple_commission->save();
                // }
            }
        }else{
            if($item['Commission Management'] == "Fixed  Dual"){
                    $commission = $comm;
                    $commission->type = $item['Commission Management'];
                    $commission->brand_id = $brand->id;
                    $commission->save();
                    
                    $single_commission = SingleCommission::where('commission_id',$commission->id)->first();
                    $multiple_commission = MultipleCommission::where('commission_id',$commission->id)->first();
                    $dual_commission = DualCommission::where('commission_id',$commission->id)->get();
                    
                    isset($single_commission) ? $single_commission->delete() : '';
                    isset($multiple_commission) ? $multiple_commission->delete() : '';
                        foreach($dual_commission as $dual_commision){
                        // dd($dual_commision);
                            isset($dual_commision) ? $dual_commision->delete() : '';
                        }
                        $item_array = explode('$', $item['Commision inf']);
                        // $item_array_new = explode('$\n', $item_array[0]);
                        // dd($item_array);
                        foreach($item_array as $item_arr )
                        {
                            // dd($item_arr);
                            $item_arr = str_replace(' EGP ','',$item_arr);
                            if(str_contains($item_arr, '>=')){
                                $item_ar = trim(preg_replace('/\s\s+/', ' ', $item_arr));
                                $item_ar = str_replace('>=','',$item_ar);
                                // dd($item_ar);
                                $item_aray = explode('=',$item_ar);
                                // dd($item_aray);
                                $dual_commission = new DualCommission;
                                $dual_commission->min_value = $item_aray[0];
                                // $dual_commission->max_value = $item_aray[0];
                                $dual_commission->total_value = $item_aray[1];
                                $dual_commission->commission_id = $commission->id;
                                $dual_commission->save();
                            }
                            elseif(str_contains($item_arr, '>')){
                        $item_ar = trim(preg_replace('/\s\s+/', ' ', $item_arr));
                                $item_ar = str_replace('>','',$item_ar);
                                // dd($item_ar);
                                $item_aray = explode('=',$item_ar);
                                // dd($item_aray);
                                $dual_commission = new DualCommission;
                                $dual_commission->min_value = $item_aray[0]+1;
                                // $dual_commission->max_value = $item_aray[0];
                                $dual_commission->total_value = $item_aray[1];
                                $dual_commission->commission_id = $commission->id;
                                $dual_commission->save();
                            }
                            elseif(str_contains($item_arr, '<=')){
                        $item_ar = trim(preg_replace('/\s\s+/', ' ', $item_arr));
                                $item_ar = str_replace('<=','',$item_ar);
                                // dd($item_ar);
                                $item_aray = explode('=',$item_ar);
                                // dd($item_aray);
                                $dual_commission = new DualCommission;
                                $dual_commission->max_value = $item_aray[0];
                                $dual_commission->min_value = 0;
                                $dual_commission->total_value = $item_aray[1];
                                $dual_commission->commission_id = $commission->id;
                                $dual_commission->save();
                            }
                            elseif(str_contains($item_arr, '<')){
                        $item_ar = trim(preg_replace('/\s\s+/', ' ', $item_arr));
                                $item_ar = str_replace('<','',$item_ar);
                                // dd($item_ar);
                                $item_aray = explode('=',$item_ar);
                                // dd($item_aray[0]-1);
                                $dual_commission = new DualCommission;
                                $dual_commission->max_value = $item_aray[0]-1;
                                $dual_commission->min_value = 0;
                                $dual_commission->total_value = $item_aray[1];
                                $dual_commission->commission_id = $commission->id;
                                $dual_commission->save();
                            }
                            elseif(str_contains($item_arr, '-')){
                                // $item_ar = str_replace(' ','',$item_arr);
                            $item_ar = trim(preg_replace('/\s\s+/', ' ', $item_arr));
                                // dd($item_ar);
                                $item_ar = str_replace('-','=',$item_ar);
                                // dd($item_ar);
                                $item_aray = explode('=',$item_ar);
                                // dd($item_aray);
                                if($item_aray[0] < $item_aray[1]){
                                $dual_commission = new DualCommission;
                                $dual_commission->min_value = $item_aray[0];
                                $dual_commission->max_value = $item_aray[1];
                                $dual_commission->total_value = $item_aray[2];
                                $dual_commission->commission_id = $commission->id;
                                $dual_commission->save();
                                }
                            }        
                            
        
        
                        }
            }

            elseif($item['Commission Management'] == "fixed single" || $item['Commission Management'] == "Percentage Single"){
                // if(is_numeric($item['Commision inf']) || str_contains('.',$item['Commision inf'])){
                    $commission = $comm;
                    $commission->type = $item['Commission Management'];
                    $commission->brand_id = $brand->id;
                    $commission->save();
    
                    $single_commission = SingleCommission::where('commission_id',$commission->id)->first();
                    $multiple_commission = MultipleCommission::where('commission_id',$commission->id)->first();
                    $dual_commission = DualCommission::where('commission_id',$commission->id)->get();
                    // dd($dual_commission);
                        if(!$single_commission){
                        isset($multiple_commission) ? $multiple_commission->delete() : '';
                        foreach($dual_commission as $dual_commision){
                        // dd($dual_commision);
                            isset($dual_commision) ? $dual_commision->delete() : '';
                        }
                        $single_commission = new SingleCommission();
                        $single_commission->value =  $item['Commision inf'];
                        $single_commission->commission_id = $commission->id;
                        $single_commission->save();
                    }else{
                        $single_commission->value =  $item['Commision inf'];
                        $single_commission->commission_id = $commission->id;
                        $single_commission->save();
                    }
                    
                // }
            }else if($item['Commission Management'] == "Fixed  Multiple" || $item['Commission Management'] == "Percentage Multiple"){
                // if ((is_numeric($item['Commision New user']) || str_contains('.',$item['Commision New user'])) 
                // && (is_numeric($item['Commision old user']) || str_contains('.',$item['Commision old user']))) {
                    $commission = $comm;
                    $commission->type = $item['Commission Management'];
                    $commission->brand_id = $brand->id;
                    $commission->save();
    
                    $single_commission = SingleCommission::where('commission_id',$commission->id)->first();
                    $multiple_commission = MultipleCommission::where('commission_id',$commission->id)->first();
                    $dual_commission = DualCommission::where('commission_id',$commission->id)->get();
// dd($multiple_commission);
                    if(!$multiple_commission){
                        isset($single_commission) ? $single_commission->delete() : '';
                        foreach($dual_commission as $dual_commision){
                            // dd($dual_commision);
                                isset($dual_commision) ? $dual_commision->delete() : '';
                            }
                        $multiple_commission = new MultipleCommission();
                        $multiple_commission->new_user = $item['Commision New user'];
                        $multiple_commission->old_user = $item['Commision old user'];
                        $multiple_commission->commission_id = $commission->id;
                        $multiple_commission->save();
                        
                    }else{
                        // dd('ithy');
                        $multiple_commission->new_user = $item['Commision New user'];
                        $multiple_commission->old_user = $item['Commision old user'];
                        $multiple_commission->commission_id = $commission->id;
                        $multiple_commission->save();
                    }
                // }
            }
        }
    }




    public function export()
    {
        $headers = [
            'Cache-Control'        => 'must-revalidate, post-check=0, pre-check=0'
            ,'Content-type'        => 'text/csv'
            ,'Content-Disposition' => 'attachment; filename=Brand_csv_export.csv'
            ,'Expires'             => '0'
            ,'Pragma'              => 'public',
        ];

        $brands    = Brand::all()->toArray();
        // dd($lists);
        $sin = 1;
        $dou = 1;
        if (count($brands) > 0) {
            $new_list = [];
            $all_data = [];
            foreach ($brands as $brand) {
                $all_data['Brand Name'] = $brand['company_name'];
                $all_data['country'] = $brand['country'];
                if ($brand['status'] == 1) {
                    $all_data['Status'] = 'Active';
                } else {
                    $all_data['Status'] = 'Inactive';
                }
                // $all_data['Status'] = $brand['status'];
                $all_data['Commission Management'] = '';
                // $all_data['Commission inf'] = '';
                $all_data['Commision New user'] = '';
                $all_data['Commision old user'] = '';
                // $all_data['Commission Management'] = '';

                $commission = Commission::where('brand_id', $brand['id'])->first();
                if (!empty($commission)) {
                    if ($commission->type == 'fixed single' || $commission->type == 'Percentage Single') {
                        $sin++;
                        $all_data['Commission Management'] = $commission->type;
                        $commission_data = SingleCommission::where('commission_id', $commission->id)->first();
                        $all_data['Commision inf'] = $commission_data->value;
                    } elseif ($commission->type == 'Fixed  Multiple' || $commission->type == 'Percentage Multiple') {
                        $all_data['Commission Management'] = $commission->type;
                        $commission_data = MultipleCommission::where('commission_id', $commission->id)->first();
                        $all_data['Commision New user'] = $commission_data->new_user;
                        $all_data['Commision old user'] = $commission_data->old_user;
                        $all_data['Commision inf'] = '';
                        $dou++;
                    }
                    // else{
                    //     $commission_data = DualCommission::where('commission_id', $commission->id)->get();
                    //     if(count())
                    // }
                   
                    array_push($new_list, $all_data);
                }
            }
            // dd($new_list);
            // dump($sin);
            // // dump($dou);
            // dd('gg');
            // foreach ($lists as $list) {
            //     $coupon_list = [];

            //     $coupon_list['campaign_logo'] = $list['image'];
            //     $coupon_list['campaign_name'] = $list['company_name'];
            //     $coupon_list['country'] = $list['country'];
            //     $coupon_list['status'] = $list['status'];

            //     unset($list['id']);
            //     unset($list['created_at']);
            //     unset($list['updated_at']);
            //     // unset($list['subcategory_id']);
            //     array_push($new_list, $coupon_list);
            // }

            # add headers for each column in the CSV download
            array_unshift($new_list, array_keys($new_list[0]));
            // dd($new_list);

            $callback = function () use ($new_list) {
                $FH = fopen('php://output', 'w');
                foreach ($new_list as $row) {
                    fputcsv($FH, $row);
                }
                fclose($FH);
            };

            return response()->stream($callback, 200, $headers);
        } else {
            return back()->with('error', 'Record not found');
        }
    }

    public function bulk_delete(Request $request)
    {
        // dd($request->all());
        $ids = $request->ids;
        $b_array = explode(',', $ids);
        if (count($b_array) > 0) {
            foreach ($b_array as $id) {
                $coupon = Coupon::where('brand_id', $id)->get();
                $associations = Association::where('brand_id', $id)->get();
                if (count($associations) > 0) {
                    foreach ($associations as $association) {
                        $association->delete();
                    }
                }
                if (count($coupon) > 0) {
                    foreach ($coupon as $in) {
                        $influc = CouponInfluencer::where('coupon_id', $in->id)->get();
                        if (count($influc) > 0) {
                            foreach ($influc as $ini) {
                                $ini->delete();
                            }
                        }
                        $in->delete();
                    }
                }

                $br = Brand::find($id);
                if ($br) {
                    $br->delete();
                }
            }
        }
        
        //DB::table("brands")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Brands Deleted successfully."]);
    }

    public function searchBrands(Request $request)
    {
        if ($request->search != null) {
            $brands = Brand::where('company_name', 'like', '%'. $request->search. '%')
                    ->orWhere('country', 'like', '%'. $request->search. '%')->get();
            $search = $request->search;
            return view('brands.search', compact('brands', 'search'));
        } else {
            return redirect()->route('brands.index')->with('error', 'please put some data to search Brands');
        }
    }


    public function getDataByPages(Request $request)
    {
        // dd($request->all());
        $records = $request->module_val;
        if ($request->module == "brand") {
            $brands = Brand::orderBy('id', 'DESC')->where('company_name', '!=', null)->latest()->take($request->module_val)->get();
            return view('brands.index', compact('brands', 'records'));
        } elseif ($request->module == "coupon") {
            $Coupons = Coupon::orderBy('id', 'DESC')->latest()->take($request->module_val)->get();
            return view('coupons.index', compact('Coupons', 'records'));
        } elseif ($request->module == "inf") {
            $Influencers = User::where('user_type', 2)->orderBy('id', 'DESC')->latest()->take($request->module_val)->get();
            return view('influencer.index', compact('Influencers', 'records'));
        }
    }
}
