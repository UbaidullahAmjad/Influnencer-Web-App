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
            'Status',
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
