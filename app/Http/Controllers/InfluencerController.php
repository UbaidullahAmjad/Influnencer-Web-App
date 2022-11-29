<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Influencer;
use App\Models\Payment;

use App\Models\User;
use App\Models\Association;
use Illuminate\Support\Facades\Hash;
use Excel;
use App\Imports\InfluencerImport;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

use File;
use Validator;

class InfluencerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Influencers = [];
        if ($request->ajax()) {
            $Inf = User::where('user_type',2)->get();
            foreach($Inf as $in){
                $in['inf_image'] = file_exists(public_path('images/influencer/'.$in->image)) && !empty($in->image) ? asset('images/influencer/'.$in->image) : asset('images/influencer/thumbnail.png');
                array_push($Influencers,$in);
            }
            $k = 1;
            return Datatables::of($Influencers)
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
                         <a href="influencer/'.$row["id"].'/edit"> <button
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
                                 inputLabel: "Type influencer/delete to delete item",
                                 inputPlaceholder: "Type influencer/delete to delete item",
                                 showCancelButton: true,
                                 inputValidator: (value) => {
                                     return new Promise((resolve) => {
                                         if (value != "influencer/delete") {
                                             resolve("Type influencer/delete to delete item")
                                         } else {
                                             resolve()
                                         }
                                     })
                                 },
                             })
                             if (email) {
                                 $.ajax({
                                     url: "influencer/'.$row["id"].'",
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

        return view('influencer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('influencer.create');
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
            'f_name' => 'required|max:30',
            'location' => 'required|max:50',
            'inf_type' => 'required',
            'status' => 'required',
            // 'l_name' => 'required|max:30',
            'email' => 'required|email|unique:users|max:30',
            'pub_id' => 'required|unique:users|max:30',
            'inf_handle_name' => 'required|unique:users|max:20',
            // 'login_id' => 'required|unique:influencers|max:20',
            'password' => 'required|max:20',
            'image' =>'mimes:jpeg,jpg,png|required',
        ],
        [
            // 'image.required' => 'The : Image type must be jpeg,jpg,png.',
            'inf_handle_name.required' => 'Influencer Handle Name is Required',
            'f_name.required' => 'First Name is Required',
            'pub_id.required' => "The Publisher has already been taken..."

        ]
    );



    $Influencer= new User();

        $image = $request->file('image');
        // unlink(public_path('images/Product/') . $data->image);
        if($request->image){
            $imageName = time() . rand(1, 10000) . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('images/influencer/'), $imageName);
        $Influencer->image=$imageName;

        }


        $hashed = Hash::make($request->password);

        $Influencer->password = $hashed;
        $Influencer->inf_handle_name = $request->inf_handle_name;
        $Influencer->name = $request->f_name;
        $Influencer->f_name = $request->f_name;
        $Influencer->l_name = $request->l_name;
        $Influencer->email = $request->email;
        $Influencer->phone = $request->phone;
        $Influencer->login_id = $request->login_id;
        $Influencer->pub_id = $request->pub_id;
        $Influencer->location = $request->location;
        $Influencer->status = $request->status;
        $Influencer->inf_type = $request->inf_type;
        $Influencer->user_type = 2;
        $Influencer->save();
          $id = $Influencer->id;
        //   dd($id);
        return redirect()->route('influencer.create')->with('success','Influencer Added Successfully');
        // return view('influencer.create',compact('Influencer'));
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

        $influencer = User::find($id);
        if(!empty($influencer)){
            return view('influencer.edit',compact('influencer'));
        }
        else{
            return back()->with('error','No record found');
        }
        // dd($influencers);

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
            'f_name' => 'required|max:30',
            // 'location' => 'required|max:50',
            'status' => 'required',
            // 'l_name' => 'required|max:30',
            'email' => 'required|email|max:30',
            'inf_type' => 'required',
            'inf_handle_name' => 'required|max:20',
            // 'login_id' => 'required|max:20',
            // 'password' => 'required|max:20',
        ],
        [
            // 'image.required' => 'The : Image type must be jpeg,jpg,png.',
            'inf_handle_name.required' => 'Influencer Handle Name is Required',
            'f_name.required' => 'First Name is Required'

        ]
    );

        $inf = User::where('pub_id',$request->pub_id)->first();
        if(!empty($inf) && $inf->id != $id){
            return back()->With('error', 'Publisher ID has already been taken');
        }
        $image = $request->file('image');
        $influencer = User::find($id);
        if ($image) {
            // dd($request->all());
            $image = $request->file('image');
            // unlink(public_path('images/Product/') . $data->image);
            $imageName = time() . rand(1, 10000) . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('images/influencer/'), $imageName);
            $influencer->image=$imageName;
        }
        // dd($last_img);
        if($request->password){
            $influencer->password = Hash::make($request->password);
        }

        

        $influencer->f_name = $request->f_name;
        $influencer->l_name = $request->l_name;
        $influencer->inf_handle_name = $request->inf_handle_name;
        $influencer->email = $request->email;
        $influencer->phone = $request->phone;
        $influencer->login_id = $request->login_id;
        $influencer->location = $request->location;
        $influencer->status = $request->status;
        $influencer->pub_id = $request->pub_id;
        $influencer->inf_type = $request->inf_type;
        $influencer->update();
        // return view('influencer.edit',compact('influencer'));
        return redirect()->back()->With('success','Influencer updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = User::find($id);
        if (!empty($image)) {
            // dd($image->image);
            $old_image = $image->image;
            $url = public_path('/assets/images/influencer_images/'.$old_image); // Take a look at this Url, you might wanna change it

            if (file_exists($url) && $image->image) {
                // dd($url);

                unlink(public_path('/assets/images/influencer_images/') . $image->image);
            }

            $associations = Association::where('influencer_id', $id)->get();
            if (!empty($associations)) {
                if (count($associations) > 0) {
                    foreach ($associations as $association) {
                        $association->delete();
                    }
                }
            }
            $delete = User::find($id)->delete();
            return response()->json(['data'=>"true",'id'=>$id]);
        }else{
            return response()->json("false");
        }
    }

    public function csvForm()
    {
        return view('influencer.csv_influencer');
    }

    public function csvUpload(Request $request)
    {
        // dd("hello");
        // $csv = $request->all();
        // dd($csv);
        // Excel::import(new BrandImport,$csv);
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
        // dd($row);
        if($row){
            $item_fields = $this->setUpItemFields($row);

            // $attribute_options = $this->setUpProductAttributeOptions($item_fields);

        }else{
            return back()->withErrors('Invalid CSV File.');
        }

        $i = 0;
        while(($row = (fgetcsv($file))) !== false){
            DB::beginTransaction();
            try{
                $item = $this->fillItemFields($item_fields,$row);
                if(!array_key_exists('Pub ID', $item)){
                    return back()->with('error','InCorrect Data.');
                }
                // dd($item);
                $brand = [];
                $u = User::where('pub_id', $item['Pub ID'])->orWhere('inf_handle_name',$item['Handl Name'])->where('user_type',2)->first();
                // dd($u);
                if(empty($u)){
                    $brand = $this->createInfluencer($item);
                    // dd($brand);
                    if ($brand) {
                        // dd("hello");
                        if (array_key_exists('influencer_image', $item) && !empty($item['influencer_image']) && file_exists(public_path() . '/assets/images/gallery_images/' . $item['influencer_image'])) {
                                File::copy(public_path().'/assets/images/gallery_images/'.$item['influencer_image'], public_path().'/images/influencer/'.$item['influencer_image']);
                                $brand->image = $item['influencer_image'];
                                $brand->save();
                            }
                       
                    }
                }

                DB::commit();


            }catch(Exception $e){
                DB::rollback();
                // return
                dd($e);
            }

            $i++;
        }
        // dd('stop');
        fclose($file);

        return back()->with('success','Influencer(s) Imported Successfully.');
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

    public function createInfluencer($item):User
    {
        
            //dump('check ander gya');
           
                $stat = 0;
                if ($item['Status'] == 'Active') {
                    $stat = 1;
                }
                
                $influencer = new User();
                $influencer->f_name = isset($item['Name']) ? $item['Name'] : $item['Handl Name'];
                $influencer->name = isset($item['Name']) ? $item['Name'] : $item['Handl Name'];
                // $brand->l_name = $item['last_name'];
                $influencer->email = $item['Handl Name']."@gmail.com";
                $influencer->phone = $item['Mobile Number'];
                //$brand->login_id = $item['login_id'];
                $influencer->password = 111;
                $influencer->pub_id = $item['Pub ID'];
                $influencer->location = $item['Location'];
                $influencer->status = $stat;
                $influencer->inf_handle_name = $item['Handl Name'];
                $influencer->user_type = 2;
    
                $influencer->save();
    
                $influencer->password = Hash::make($influencer->id."192");
                $influencer->save();
            
            return $influencer;
            
        
    }

    public function export()
    {
        $headers = [
            'Cache-Control'        => 'must-revalidate, post-check=0, pre-check=0'
            ,'Content-type'        => 'text/csv'
            ,'Content-Disposition' => 'attachment; filename=Influencer_csv_export.csv'
            ,'Expires'             => '0'
            ,'Pragma'              => 'public',
        ];

        $lists    = User::where('user_type',2)->get()->toArray();
        // dd($lists);
        if (count($lists) > 0) {
            $new_list = [];
            foreach ($lists as $list) {
                $influencer_list = [];

                $influencer_list['influencer_image'] = $list['image'];
                $influencer_list['Name'] = $list['f_name'];
                $influencer_list['last_name'] = $list['l_name'];
                $influencer_list['email'] = $list['email'];
                $influencer_list['Mobile Number'] = $list['phone'];
                $influencer_list['login_id'] = $list['login_id'];
                $influencer_list['Pub ID'] = $list['pub_id'];
                $influencer_list['Location'] = $list['location'];
                if($list['status'] == 1){
                    $influencer_list['Status'] = 'Active';
                }else{
                    $influencer_list['Status'] = "Inactive";
                }
                $influencer_list['Handl Name'] = $list['inf_handle_name'];
                $influencer_list['password'] = "";

                // unset($list['password']);
                unset($list['created_at']);
                unset($list['updated_at']);
                // unset($list['subcategory_id']);
                array_push($new_list, $influencer_list);
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
        DB::table("users")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Brands Deleted successfully."]);
    }

    public function searchInfluencer (Request $request){

        if($request->search != null){
            // $Influencers = User::where('f_name', 'like', '%'. $request->search. '%')
            //     ->orWhere('l_name', 'like', '%'. $request->search. '%')->where('user_type',2)->get();
            $Influencers = User::where('location', 'like', '%'. $request->search. '%')->where('user_type',2)->get();
            $search = $request->search;
            return view('influencer.search', compact('Influencers','search'));

        }else{
                
            return redirect()->route('influencer.index')->with('error','please put some data to search Influencer');
        }
    }


    public function influencerDetails(){
        $payments = Payment::all();

        return view('influencer.show_payments', compact('payments'));
    }

    public function getInfluencers(Request $request)
    {
        $data = [];
        if($request->status != -2){
            $data = User::where('status',$request->status)->where('user_type',2)->get();
            
            // dd($data);
        }else{
            $data = User::where('user_type',2)->get();
        }

        return response()->json(['data'=>$data]);
    }




}
