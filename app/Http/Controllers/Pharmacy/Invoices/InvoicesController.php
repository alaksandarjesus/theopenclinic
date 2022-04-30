<?php

namespace App\Http\Controllers\Pharmacy\Invoices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacy\Invoice\Invoice;
use App\Models\Pharmacy\Invoice\Item;
use App\Models\User\User;
use App\Models\User\UserRoleRelation;
use App\Models\Role;
use App\Models\Pharmacy\Drug;
use App\Http\Requests\Pharmacy\InvoiceRequest;
use Illuminate\Support\Str;
use App\Http\Controllers\Pharmacy\DrugsController;
use App\Models\Setting;



class InvoicesController extends Controller
{
    public function index(){

        $invoices = Invoice::orderBy('created_at', 'DESC')->get();

        return view('pharmacy.invoices.index', compact('invoices'));
    }

    public function create(){
        $invoice = new Invoice();
        $patient_role = Role::where('name', 'patient')->first();
        $patient_ids = UserRoleRelation::where('role_id', $patient_role->id)->pluck('id')->toArray();
        $customers = User::whereIn('id', $patient_ids)->orderBy('name', 'ASC')->get();
        $drugs = Drug::orderBy('name', 'ASC')->get();
        return view('pharmacy.invoices.form', compact('invoice','customers', 'drugs'));
    }

    public function save(InvoiceRequest $request){

        $validated = (object)$request->validated();

        
        if(!empty($validated->uuid)){
            $invoice = Invoice::where('uuid', $validated->uuid)->first();
            $invoice->updated_by = $request->user->id;
        }else{
            $invoice = new Invoice;
            $invoice->uuid = Str::uuid();
            $invoice->created_by = $request->user->id;
        }

        $invoice->invoice_number = $validated->invoice_number;
        $invoice->invoice_date = !empty($validated->invoice_date)?date('Y-m-d H:i:s', strtotime($validated->invoice_date)):date('Y-m-d H:i:s');
        $customer = NULL;
        if(!empty($validated->customer) && !empty($validated->customer['uuid'])){
            $customer = User::where('uuid', $validated->customer['uuid'])->first();
        }
        $invoice->customer_id = !empty($customer)?$customer->id:NULL;
        $invoice->submitted = !empty($validated->submitted) && json_decode($validated->submitted)?1:0;
        $invoice->subtotal =  $validated->subtotal;
        $invoice->tax = $validated->tax;
        $invoice->discount = $validated->discount;
        $invoice->total = $validated->total;
        $invoice->comments = $validated->comments;
        $invoice->items_count = !empty($validated->items)?count($validated->items):0;
        $invoice->save();
        if(!empty($validated->items)){
            foreach($validated->items as $item){
                $drug = NULL;
                if(!empty($item['drug']) && !empty($item['drug']['uuid'])){
                    $drug = Drug::where('uuid', $item['drug']['uuid'])->first();
                }
                if(empty($drug)){
                    continue;
                }
                if(empty($item['uuid'])){
                    $row = new Item;
                    $row->uuid = Str::uuid();
                    
                }else{
                    $row = Item::where('uuid', $item['uuid'])->first();
                }
               

                $row->invoice_id =  $invoice->id;
                $row->drug_id = !empty($drug)?$drug->id:0;
                $row->tax = $item['tax'];
                $row->price = $item['price'];
                $row->qty = $item['qty'];
                $row->total = $item['total'];
                $row->submitted = $invoice->submitted;
                $row->save();
                if($invoice->submitted){
                    $row->save();
                    $drugController = new DrugsController();
                    $drugController->update_stock($row->drug_id);
                }
                
            }
        }
        return response()->json(['redirect' => url('pharmacy/invoices')]);

    }
    public function edit($uuid){
        $invoice = Invoice::where('uuid', $uuid)->first();
        if(empty($invoice)){
            if (!$request->expectsJson()) {
                return redirect()->to('404');
            }
            $response = [
                'message' => 'Invoice Failed',
                'errors' => ['Invoice UUID does not match']
            ];

            return response()->json($response, 422);
        }
        if($invoice->submitted){
            if (!$request->expectsJson()) {
                return redirect()->to('404');
            }
            $response = [
                'message' => 'Invoice Submitted',
                'errors' => ['Invoice cannot be edited']
            ];

            return response()->json($response, 422);
        }
        $patient_role = Role::where('name', 'patient')->first();
        $patient_ids = UserRoleRelation::where('role_id', $patient_role->id)->pluck('id')->toArray();
        $customers = User::whereIn('id', $patient_ids)->orderBy('name', 'ASC')->get();
        $drugs = Drug::orderBy('name', 'ASC')->get();
        return view('pharmacy.invoices.form', compact('invoice','customers', 'drugs'));
    }

    public function print($uuid, Request $request){
        $invoice = Invoice::where('uuid', $uuid)->first();
        if(empty($invoice)){
            if (!$request->expectsJson()) {
                return redirect()->to('404');
            }
            $response = [
                'message' => 'Invoice Failed',
                'errors' => ['Invoice UUID does not match']
            ];

            return response()->json($response, 422);
        }
        if(!$invoice->submitted){
            if (!$request->expectsJson()) {
                return redirect()->to('404');
            }
            $response = [
                'message' => 'Invoice Submitted',
                'errors' => ['Invoice cannot be edited']
            ];

            return response()->json($response, 422);
        }
        $patient_role = Role::where('name', 'patient')->first();
        $patient_ids = UserRoleRelation::where('role_id', $patient_role->id)->pluck('id')->toArray();
        $customers = User::whereIn('id', $patient_ids)->orderBy('name', 'ASC')->get();
        $drugs = Drug::orderBy('name', 'ASC')->get();
        $settings = Setting::get()->pluck('meta_value', 'meta_key');
      
        return view('pharmacy.invoices.print', compact('invoice', 'settings','customers', 'drugs'));
    }

    public function delete($uuid, Request $request){
        $invoice = Invoice::where('uuid', $uuid)->first();
        if(empty($invoice)){
            $err = [
                'message' => 'Missing Invoice Order',
                'errors' => ['Unidentified Order']
            ];
            return response()->json($err, 422);
        }
        if(!$request->user->is_super_administrator){
            $err = [
                'message' => 'Unauthorized',
                'errors' => ['You are not authorized to perform this action']
            ];
            return response()->json($err, 422);
        }

        foreach($invoice->items as $item){
            $item->deleted_by = $request->user->id;
            $item->save();
            $item->delete();
            $drugController = new DrugsController();
            $drugController->update_stock($item->drug_id);
        }
        $invoice->deleted_by = $request->user->id;
        $invoice->save();
        $invoice->delete();
        
        return response()->json(['redirect' => url('/pharmacy/invoices')]);
    }
}
