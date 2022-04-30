<?php

namespace App\Http\Controllers\Pharmacy\Purchases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacy\Purchase\Order;
use App\Models\Pharmacy\Purchase\Item;
use App\Http\Requests\Pharmacy\PurchaseInventory\CreateRequest;
use App\Http\Requests\Pharmacy\PurchaseInventory\UpdateRequest;
use App\Models\Pharmacy\Purchase\Inventory;
use Illuminate\Support\Str;
use App\Http\Controllers\Pharmacy\DrugsController;



class PurchasesInventoryController extends Controller
{
    public function get($purchase_order_uuid, Request $request){

        $order = Order::where('uuid', $purchase_order_uuid)->first();
        

        if(empty($order)){
        
            return redirect()->to(404);
        
        }

        return view('pharmacy.purchases-inventory.get', compact('order'));
    }

    public function create($purchase_order_uuid, Request $request){

        $order = Order::where('uuid', $purchase_order_uuid)->first();
        
        if(empty($order)){
        
            return redirect()->to(404);
        
        }

        return view('pharmacy.purchases-inventory.create', compact('order'));
    }

    public function edit($purchase_order_uuid, $inventory_uuid, Request $request){
        $order = Order::where('uuid', $purchase_order_uuid)->first();
        
        if(empty($order)){ 
            return redirect()->to(404);
        }
        $item_ids = Item::where('order_id', $order->id)->pluck('id')->toArray();
        $inventory = Inventory::whereIn('purchase_order_item_id', $item_ids)->where('uuid', $inventory_uuid)->first();

        if(empty($inventory)){ 
            return redirect()->to(404);
        }

        return view('pharmacy.purchases-inventory.edit', compact('order', 'inventory'));

    }

   

    public function update($purchase_order_uuid, $inventory_uuid, UpdateRequest $request){
        $order = Order::where('uuid', $purchase_order_uuid)->first();
        
        if(empty($order)){ 
            $err = [
                'message' => 'Order Not Found',
                'errors' => ['Invalid Order Details']
            ];
            return response()->json($err, 422);
        }
        $item_ids = Item::where('order_id', $order->id)->pluck('id')->toArray();

        $inventory = Inventory::whereIn('purchase_order_item_id', $item_ids)->where('uuid', $inventory_uuid)->first();

        if(empty($inventory)){ 
            $err = [
                'message' => 'Inventory Not Found',
                'errors' => ['Invalid Inventory Details']
            ];
            return response()->json($err, 422);
        }

        $validated = (object)$request->validated();

        if($validated->order['uuid'] !== $purchase_order_uuid){
            $err = [
                'message' => 'Mismatch Order Details',
                'errors' => ['Invalid Order Details']
            ];
            return response()->json($err, 422);
        }

        if($validated->inventory['uuid'] !== $inventory_uuid){
            $err = [
                'message' => 'Mismatch Inventory Details',
                'errors' => ['Invalid Inventory Details']
            ];
            return response()->json($err, 422);
        }

        $inventory->qty = $validated->inventory['qty'];
        $inventory->batch = !empty($validated->inventory['batch'])?$validated->inventory['batch']:NULL;
        $inventory->expiry_date = !empty($validated->inventory['expiry_date'])?$validated->inventory['expiry_date']:NULL;
        $inventory->comments = !empty($validated->inventory['comments'])?$validated->inventory['comments']:NULL;
        $inventory->updated_by = $request->user->id;
        $inventory->save();
        
        $drugs_controller =  new DrugsController;
        $drugs_controller->update_stock($inventory->item->drug_id);
        return response()->json(['redirect' => url('pharmacy/purchases/'.$order->uuid.'/inventory')]);

    }

    public function save(CreateRequest $request){

        $validated = (object)$request->validated();

        $order = Order::where('uuid',$validated->order['uuid'])->first();

        foreach($validated->items as $item){
            $item = (object)$item;
            $row = Item::where('uuid', $item->uuid)->first();
            $inventory = new Inventory;
            $inventory->uuid = Str::uuid();
            $inventory->purchase_order_item_id = $row->id;
            $inventory->qty = $item->qty;
            $inventory->batch = !empty($item->batch)?$item->batch:NULL;
            $inventory->expiry_date = !empty($item->expiry_date)?$item->expiry_date:NULL;
            $inventory->comments = !empty($item->comments)?$item->comments:NULL;
            $inventory->created_by = $request->user->id;
            $inventory->save();
        }
        
        $drugs_controller =  new DrugsController;
        $drugs_controller->update_stock($inventory->item->drug_id);
        return response()->json(['redirect' => url('pharmacy/purchases/'.$order->uuid.'/inventory')]);
    }

    public function delete($purchase_order_uuid, $inventory_uuid, Request $request){

        if(!$request->user->is_super_administrator){
            $err = [
                'message' => 'Unauthorized',
                'errors' => ['You are not authorized to perform this action']
            ];
            return response()->json($err, 422);
        }

        $order = Order::where('uuid', $purchase_order_uuid)->first();
        
        if(empty($order)){ 
            $err = [
                'message' => 'Order Not Found',
                'errors' => ['Invalid Order Details']
            ];
            return response()->json($err, 422);
        }
        $item_ids = Item::where('order_id', $order->id)->pluck('id')->toArray();

        $inventory = Inventory::whereIn('purchase_order_item_id', $item_ids)->where('uuid', $inventory_uuid)->first();

        if(empty($inventory)){ 
            $err = [
                'message' => 'Inventory Not Found',
                'errors' => ['Invalid Inventory Details']
            ];
            return response()->json($err, 422);
        }

        $inventory->deleted_by = $request->user->id;
        $inventory->save();
        $inventory->delete();
        $drugs_controller =  new DrugsController;
        $drugs_controller->update_stock($inventory->item->drug_id);
        return response()->json(['redirect' =>  url('pharmacy/purchases/'.$order->uuid.'/inventory')]);

    }
}
