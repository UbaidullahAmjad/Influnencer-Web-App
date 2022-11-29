<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\AllPayment;

use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
    $data = Payment::where('pub_id',auth()->user()->pub_id)->first();
      return view('payment.index',compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'max:50',
            'wallet' => 'max:20',
            'bank_name' =>'max:30',
            'account_holder_name' =>'max:30',
            'account_no' =>'max:20',
            'iban' =>'max:20'

        ]);
        $data = Payment::where('pub_id',auth()->user()->pub_id)->first();
        if ($data) {
           
            if ($request->paypal) {
                // dd($data);
                $data->pub_id = auth()->user()->pub_id;
                $data->paypal_email = !empty($request->email) ? $request->email : $data->paypal_email ;
                $data->save();
                return redirect()->back()->with('success', 'Paypal Email Saved');
            }
        
            if ($request->wallet) {
                $data->pub_id = auth()->user()->pub_id;
                $data->wallet_id = !empty($request->wallet) ? $request->wallet : $data->wallet_id ;
                $data->save();
                return redirect()->back()->with('success', 'Wallet ID Saved');
            }
            if ($request->bank) {
                $data->pub_id = auth()->user()->pub_id;
                $data->bank_name = !empty($request->bank_name) ? $request->bank_name : $data->bank_name ;
                $data->bank_account_no = !empty($request->account_no) ? $request->account_no : $data->bank_account_no ;
                $data->account_holder = !empty($request->account_holder_name) ? $request->account_holder_name : $data->account_holder ;
                $data->iban = !empty($request->iban) ? $request->iban : $data->iban ;
                $data->save();
                return redirect()->back()->with('success', 'Bank Details Save Successfully');
            }
        }else{
            $data = new Payment();
            if ($request->paypal) {
                $data->pub_id = auth()->user()->pub_id;
                $data->paypal_email = $request->email;
                $data->save();
                return redirect()->back()->with('success', 'Paypal Email Saved');
            }
        
            if ($request->wallet) {
                $data->pub_id = auth()->user()->pub_id;
                $data->wallet_id = $request->wallet;
                $data->save();
                return redirect()->back()->with('success', 'Wallet ID Saved');
            }
            if ($request->bank) {
                $data->pub_id = auth()->user()->pub_id;
                $data->bank_name = $request->bank_name;
                $data->bank_account_no = $request->account_no;
                $data->account_holder = $request->account_holder_name;
                $data->iban = $request->iban;
                $data->save();
                return redirect()->back()->with('success', 'Bank Details Save Successfully');
            }
        }
        
    }


    public function uploadPayment()
    {
        return view('payment.csv_payment');
    }

    public function uploadPaymentStore(Request $request)
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

            // $attribute_options = $this->setUpProductAttributeOptions($item_fields);

        }else{
            return back()->withErrors('Invalid CSV File.');
        }

        $fills = [
            'ID',
            'Publisher',
            'Link',
            'Direct WhatsApp',
            'Group WhatsApp',
            'Country',
            'Bank City',
            'Bank Name',
            'Beneficiary',
            'Account Number',
            'IBAN Number',
            'Notes',
            'Amount',
            'Pending Amount',
            'Total',
            'Quality',
            'Payment Currency',
            'Transfer',
            'POP Invoice',
            'MM',
            
        ];
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

        $i = 0;
        while(($row = (fgetcsv($file))) !== false){
            DB::beginTransaction();
            try{
                $item = $this->fillItemFields($item_fields,$row);
                if(!array_key_exists('ID',$item)){
                    return back()->with('error','InCorrect Data.');
                }
                // dd($item);
                $payment = [];
               
                // dd($u);
                if(empty($u)){
                    $payment = $this->createPayment($item);
                    // dd($brand);
                    // if ($brand) {
                    //     // dd('yahan');
                    //     if (file_exists(public_path() . '/assets/images/gallery_images/' . $item['influencer_image'])) {
                    //         File::copy(public_path('/assets/images/gallery_images/'.$item['influencer_image']), public_path().'/images/influencer/'.$item['influencer_image']);
                    //         $brand->image = $item['influencer_image'];
                    //         $brand->save();
                    //     }
                    // }



                }

                DB::commit();


            }catch(Exception $e){
                DB::rollback();
                // return
                // dd($e);
            }

            $i++;
        }
        // dd('stop');
        fclose($file);

        return back()->with('success','Payment(s) Imported Successfully.');
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

    public function createPayment($item)
    {
        $pay = AllPayment::where('pub_id',$item['ID'])->where('publisher',$item['Publisher'])->where('link',$item['Link'])->where('direct_whatsapp',$item['Direct WhatsApp'])->where('group_whatsapp',$item['Group WhatsApp'])->where('country',$item['Country'])->where('bank_city',$item['Bank City'])->where('bank_name',$item['Bank Name'])->where('beneficiary',$item['Beneficiary'])->where('account_number',$item['Account Number'])->where('iban_number',$item['IBAN Number'])->where('notes',$item['Notes'])->where('amount',$item['Amount'])->where('pending_amount',$item['Pending Amount'])->where('quality',$item['Quality'])->where('payment_currency',$item['Payment Currency'])->where('transfer',$item['Transfer'])->where('pop_invoice',$item['POP Invoice'])->where('total',$item['Total'])->where('mm',$item['MM'])->first();
        // dd(!$pay);
        if(! $pay)
        {
            $payment = new AllPayment();
            //dd($item['first_name']);
            //$brand->fill($item)->save();
            $payment->pub_id = $item['ID'];
            $payment->publisher = $item['Publisher'];
            $payment->link = $item['Link'];
            $payment->direct_whatsapp = $item['Direct WhatsApp'];
            $payment->group_whatsapp = $item['Group WhatsApp'];
            $payment->country = $item['Country'];
            $payment->bank_city = $item['Bank City'];
            $payment->bank_name = $item['Bank Name'];
            $payment->beneficiary = $item['Beneficiary'];
            $payment->account_number = $item['Account Number'];
            $payment->iban_number = $item['IBAN Number'];
            $payment->notes = $item['Notes'];
            $payment->amount = $item['Amount'];
            $payment->pending_amount = $item['Pending Amount'];
            $payment->quality = $item['Quality'];
            $payment->payment_currency = $item['Payment Currency'];
            $payment->transfer = $item['Transfer'];
            $payment->pop_invoice = $item['POP Invoice'];
            $payment->total = $item['Total'];
            $payment->mm = $item['MM'];

            $payment->save();
        }
    }

    public function payment_detail()
    {
       $payments = AllPayment::all();
       return view('payment.payment_detail',compact('payments'));
    }
    public function payment_view($id)
    {
        $payments = AllPayment::find($id);
        return view('payment.view_payment_details',compact('payments'));
    }

    public function changePaymentStatus(Request $request){
        // dd($request->all());
        $payment = AllPayment::find($request->id);
        if($payment){
            $payment->transfer = $request->val;
            $payment->save();

            return response()->json('1');
        }else{
            return response()->json('0');
        }
        
    }

    public function export()
    {
        $headers = [
            'Cache-Control'        => 'must-revalidate, post-check=0, pre-check=0'
            ,'Content-type'        => 'text/csv'
            ,'Content-Disposition' => 'attachment; filename=Payment_csv_export.csv'
            ,'Expires'             => '0'
            ,'Pragma'              => 'public',
        ];

        $lists    = AllPayment::all()->toArray();
        //dd($lists);
         if (count($lists) > 0) {
             $new_list = [];
             foreach ($lists as $list) {
                 $coupon_influencer_list = [];
                 $coupon_influencer_list['ID'] = $list['pub_id'];
                 
                     $coupon_influencer_list['Publisher'] = $list['publisher'];
                     $coupon_influencer_list['Link'] = $list['link'];
                     $coupon_influencer_list['Direct WhatsApp'] =$list['direct_whatsapp'];
                     $coupon_influencer_list['Group WhatsApp'] =$list['group_whatsapp'];
                     $coupon_influencer_list['Country'] =$list['country'];
                     $coupon_influencer_list['Bank City'] =$list['bank_city'];
                     $coupon_influencer_list['Bank Name'] =$list['bank_name'];
                     $coupon_influencer_list['Beneficiary'] =$list['beneficiary'];
                     $coupon_influencer_list['Account Number'] =$list['account_number'];
                     $coupon_influencer_list['IBAN Number'] =$list['iban_number'];
                     $coupon_influencer_list['Notes'] =$list['notes'];
                     $coupon_influencer_list['Amount'] =$list['amount'];
                     $coupon_influencer_list['Pending Amount'] =$list['pending_amount'];
                     $coupon_influencer_list['Total'] =$list['total'];
                     $coupon_influencer_list['Quality'] =$list['quality'];
                     $coupon_influencer_list['Payment Currency'] =$list['payment_currency'];
                     $coupon_influencer_list['Transfer'] =$list['transfer'];
                     $coupon_influencer_list['POP Invoice'] =$list['pop_invoice'];
                     $coupon_influencer_list['MM'] =$list['mm'];


                    
                     unset($list['id']);
                     unset($list['created_at']);
                     unset($list['updated_at']);
                     array_push($new_list, $coupon_influencer_list);
                
                 // unset($list['id']);

            // unset($list['subcategory_id']);
             }
             //dd($new_list);
             # add headers for each column in the CSV download
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
         }
         else{
             return back()->with('error','Reocord not found');
         }
    }

    public function getInfluencerPayments(){
        $payments = AllPayment::where('pub_id', auth()->user()->pub_id)->get();

        return view('payment.influencer_payments', compact('payments'));
    }
    
    public function searchPayments(Request $request){
        $request->validate([
            'search' => 'required',
        ]);
        $payments = AllPayment::where('pub_id', $request->search)
                    ->orWhere('bank_name','like', '%'. $request->search. '%')
                    ->orWhere('iban_number','like', '%'. $request->search. '%')->get();
        $search = $request->search;
        // return view('payment.payment_detail', compact('payments', 'search'))
        return redirect()->route('searched_payment',$request->search);
    }
    public function searchedPayment($search)
    {
        // dd($search);
        $payments = AllPayment::where('pub_id', $search)
                    ->orWhere('bank_name','like', '%'. $search. '%')
                    ->orWhere('iban_number','like', '%'. $search. '%')->get();
        return view('payment.payment_detail', compact('payments', 'search'));


    }



}
