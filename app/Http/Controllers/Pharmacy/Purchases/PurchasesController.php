<?php

namespace App\Http\Controllers\Pharmacy\Purchases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacy\Purchase\Order;
use App\Models\Pharmacy\Purchase\Item;
use App\Models\Pharmacy\Supplier;
use App\Models\Setting;
use App\Models\Pharmacy\Drug;
use App\Http\Requests\Pharmacy\PurchaseOrderRequest;
use Illuminate\Support\Str;
use App\Http\Controllers\Pharmacy\DrugsController;
use App\Models\Pharmacy\Purchase\Inventory;



class PurchasesController extends Controller
{
    public function index(Request $request){

        $supplier = $request->query('supplier', NULL);
        $q = $request->query('q', NULL);

        $purchases = Order::when($supplier, function($query) use ($supplier){
            $supplierObj = Supplier::where('uuid', $uuid)->first();
            if(empty($supplierObj)){
                return $query->where('id', '<' ,-1);
            }
            return $query->where('supplier_id', $supplierObj->id);
        })->when($q, function($query) use ($q){
            return $query->where('order_number', 'LIKE', '%'.$q.'%');
        })->orderBy('created_at', 'DESC')->get();

        $suppliers = Supplier::orderBy('name', 'ASC')->get();

        return view('pharmacy.purchases.index', compact('purchases', 'suppliers'));
    }

    public function get($uuid, Request $request){

        $order = Order::where('uuid', $uuid)->first();

        if(empty($order)){
            if (!$request->expectsJson()) {
                return redirect()->to('404');
            }
            $response = [
                'message' => 'Order Failed',
                'errors' => ['Order UUID does not match']
            ];

            return response()->json($response, 422);
        }
        $order->supplier;
        foreach($order->items as $item){
            $item->drug;
        };
        $order->formatted;
        return response()->json($order);
    }

    public function create(){
        $order = new Order();
        $suppliers = Supplier::orderBy('name', 'ASC')->get();
        $drugs = Drug::orderBy('name', 'ASC')->get();
        return view('pharmacy.purchases.form', compact('order','suppliers', 'drugs'));
    }

    public function edit($uuid){
        $order = Order::where('uuid', $uuid)->first();
        if(empty($order)){
            if (!$request->expectsJson()) {
                return redirect()->to('404');
            }
            $response = [
                'message' => 'Order Failed',
                'errors' => ['Order UUID does not match']
            ];

            return response()->json($response, 422);
        }
        if($order->submitted){
            if (!$request->expectsJson()) {
                return redirect()->to('404');
            }
            $response = [
                'message' => 'Order Submitted',
                'errors' => ['Order cannot be edited']
            ];

            return response()->json($response, 422);
        }
        $suppliers = Supplier::orderBy('name', 'ASC')->get();
        $drugs = Drug::orderBy('name', 'ASC')->get();
        return view('pharmacy.purchases.form', compact('order','suppliers', 'drugs'));
    }

    public function print($uuid, Request $request){
        $order = Order::where('uuid', $uuid)->first();
        if(empty($order)){
            if (!$request->expectsJson()) {
                return redirect()->to('404');
            }
            $response = [
                'message' => 'Order Failed',
                'errors' => ['Order UUID does not match']
            ];

            return response()->json($response, 422);
        }
        if(!$order->submitted){
            if (!$request->expectsJson()) {
                return redirect()->to('404');
            }
            $response = [
                'message' => 'Order Not Submitted',
                'errors' => ['Order cannot be printed']
            ];

            return response()->json($response, 422);
        }
        $suppliers = Supplier::orderBy('name', 'ASC')->get();
        $drugs = Drug::orderBy('name', 'ASC')->get();
        $settings = Setting::get()->pluck('meta_value', 'meta_key');
        return view('pharmacy.purchases.print', compact('order', 'settings','suppliers', 'drugs'));
    }

    public function save(PurchaseOrderRequest $request){

        $validated = (object)$request->validated();

        
        if(!empty($validated->uuid)){
            $order = Order::where('uuid', $validated->uuid)->first();
            $order->updated_by = $request->user->id;
        }else{
            $order = new Order;
            $order->uuid = Str::uuid();
            $order->created_by = $request->user->id;
        }

        $order->order_number = $validated->order_number;
        $order->order_date = !empty($validated->order_date)?date('Y-m-d H:i:s', strtotime($validated->order_date)):date('Y-m-d H:i:s');
        $supplier = NULL;
        if(!empty($validated->supplier) && !empty($validated->supplier['uuid'])){
            $supplier = Supplier::where('uuid', $validated->supplier['uuid'])->first();
        }
        $order->supplier_id = !empty($supplier)?$supplier->id:NULL;
        $order->submitted = !empty($validated->submitted) && json_decode($validated->submitted)?1:0;
        $order->subtotal =  $validated->subtotal;
        $order->tax = $validated->tax;
        $order->discount = $validated->discount;
        $order->total = $validated->total;
        $order->comments = $validated->comments;
        $order->items_count = !empty($validated->items)?count($validated->items):0;
        $order->save();
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
               

                $row->order_id =  $order->id;
                $row->drug_id = !empty($drug)?$drug->id:0;
                $row->tax = $item['tax'];
                $row->cost = $item['cost'];
                $row->qty = $item['qty'];
                $row->total = $item['total'];
                $row->submitted = $order->submitted;
                $row->save();
                if($order->submitted){
                    $row->save();
                    $drugController = new DrugsController();
                    $drugController->update_stock($row->drug_id);
                }
                
            }
        }
        return response()->json(['redirect' => url('pharmacy/purchases')]);

    }

    public function typeahead(Request $request){

        $order_query = $request->query('query', NULL);

        $rows = Order::when($order_query, function($query) use($order_query){
            return $query->where('order_number', 'like', '%'.$order_query.'%');
        })->where('submitted', 1)->orderBy('created_at', 'DESC')->take(10)->select(['order_number', 'uuid'])->get();
        
        $result = [];
        foreach($rows as $row){
            $result[] = [
                'id' => $row->uuid,
                'value' => $row->order_number
            ];
        }
        return response()->json($result);
    }

    public function delete($uuid, Request $request){
        $order = Order::where('uuid', $uuid)->first();
        if(empty($order)){
            $err = [
                'message' => 'Missing Purchase Order',
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

        foreach($order->items as $item){
            $item->deleted_by = $request->user->id;
            $item->save();
            $item->delete();
            $inventory = Inventory::where('purchase_order_item_id', $item->id)
                            ->get();
            foreach($inventory as $row){
                $row->deleted_by = $request->user->id;
                $row->save();
                $row->delete();
            }
            $drugController = new DrugsController();
            $drugController->update_stock($item->drug_id);
        }
        $order->deleted_by = $request->user->id;
        $order->save();
        $order->delete();
        
        return response()->json(['redirect' => url('/pharmacy/purchases')]);
    }
}
