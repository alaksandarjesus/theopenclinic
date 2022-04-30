<?php

namespace App\Http\Controllers\Pharmacy\Purchases;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Pharmacy\DrugsController;
use App\Http\Requests\Pharmacy\PurchaseReturn\CreateRequest;
use App\Http\Requests\Pharmacy\PurchaseReturn\UpdateRequest;
use App\Models\Pharmacy\Purchase\Inventory;
use App\Models\Pharmacy\Purchase\Item;
use App\Models\Pharmacy\Purchase\Order;
use App\Models\Pharmacy\Purchase\Returnn;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PurchasesReturnController extends Controller
{
    public function index($purchase_order_uuid, Request $request)
    {

        $order = Order::where('uuid', $purchase_order_uuid)->first();

        if (empty($order)) {
            return redirect()->to(404);
        }

        $item_ids = Item::where('order_id', $order->id)->pluck('id')->toArray();

        if (empty($item_ids)) {
            return redirect()->to(404);
        }

        $inventory_ids = Inventory::whereIn('purchase_order_item_id', $item_ids)->pluck('id')->toArray();
        if (empty($inventory)) {
            $returns = Returnn::whereIn('purchase_order_inventory_id', $inventory_ids)->get();
        }

        return view('pharmacy.purchases-returns.index', compact('order', 'returns'));
    }

    public function create($purchase_order_uuid, Request $request)
    {

        $order = Order::where('uuid', $purchase_order_uuid)->first();

        if (empty($order)) {

            return redirect()->to(404);

        }

        return view('pharmacy.purchases-returns.create', compact('order'));
    }

    public function edit($purchase_order_uuid, $return_uuid, Request $request)
    {
        $order = Order::where('uuid', $purchase_order_uuid)->first();

        if (empty($order)) {

            return redirect()->to(404);
        }
        $item_ids = Item::where('order_id', $order->id)->pluck('id')->toArray();

        $inventory_ids = Inventory::whereIn('purchase_order_item_id', $item_ids)->pluck('id')->toArray();

        if (empty($inventory_ids)) {

            return redirect()->to(404);
        }

        $return = Returnn::where('uuid', $return_uuid)->whereIn('purchase_order_inventory_id', $inventory_ids)->first();

        if (empty($return)) {

            return redirect()->to(404);
        }

        return view('pharmacy.purchases-returns.edit', compact('order', 'return'));

    }

    public function save(CreateRequest $request)
    {

        $validated = (object) $request->validated();
        $order = Order::where('uuid', $validated->order['uuid'])->first();

        if (empty($order)) {
            $err = [
                'message' => 'Order Not Found',
                'errors' => ['Invalid Order Details'],
            ];
            return response()->json($err, 422);
        }
        foreach ($validated->items as $item) {
            $itemModel = Item::where('uuid', $item['item']['uuid'])->first();
            $inventoryModel = Inventory::where('uuid', $item['inventory']['uuid'])->where('purchase_order_item_id', $itemModel->id)->first();
            if (empty($inventoryModel)) {
                continue;
            }
            $return = new Returnn;
            $return->uuid = Str::uuid();
            $return->purchase_order_inventory_id = $inventoryModel->id;
            $return->cost = $item['cost'];
            $return->tax = $item['tax'];
            $return->qty = $item['qty'];
            $return->total = $item['total'];
            $return->comments = Arr::get($item, 'comments', null);
            $return->created_by = $request->user->id;
            $return->save();

            $drugs_controller = new DrugsController;
            $drugs_controller->update_stock($itemModel->drug_id);
        }

        return response()->json(['redirect' => url('pharmacy/purchases/' . $order->uuid . '/returns')]);

    }

    public function update($uuid, UpdateRequest $request)
    {

        $validated = (object) $request->validated();

        $order = Order::where('uuid', $validated->order['uuid'])->first();

        if (empty($order)) {
            $err = [
                'message' => 'Order Not Found',
                'errors' => ['Invalid Order Details'],
            ];
            return response()->json($err, 422);
        }

        $return = Returnn::where('uuid', $validated->return['uuid'])->first();

        if (empty($return->inventory) || empty($return->inventory->item) || empty($return->inventory->item->order)) {

            $err = [
                'message' => 'Return Order Not Found',
                'errors' => ['Invalid Order Details'],
            ];
            return response()->json($err, 422);
        }

        if ($return->inventory->item->order->id !== $order->id) {

            $err = [
                'message' => 'Return and Order Mismatch',
                'errors' => ['Invalid Order Details'],
            ];
            return response()->json($err, 422);
        }

        $return->cost = $validated->return['cost'];
        $return->tax = $validated->return['tax'];
        $return->qty = $validated->return['qty'];
        $return->total = $validated->return['total'];
        $return->comments = Arr::get($validated->return, 'comments', null);
        $return->updated_by = $request->user->id;
        $return->save();

        $drugs_controller = new DrugsController;
        $drugs_controller->update_stock($return->inventory->item->drug_id);

        return response()->json(['redirect' => url('pharmacy/purchases/' . $order->uuid . '/returns')]);

    }

    public function delete($order_uuid, $return_uuid, Request $request)
    {

        if (!$request->user->is_super_administrator) {
            $err = [
                'message' => 'Unauthorized',
                'errors' => ['You are not authorized to perform this action'],
            ];
            return response()->json($err, 422);
        }

        $order = Order::where('uuid', $order_uuid)->first();
        if (empty($order)) {
            $err = [
                'message' => 'Missing Purchase Order',
                'errors' => ['Unidentified Order'],
            ];
            return response()->json($err, 422);
        }

        $return = Returnn::where('uuid', $return_uuid)->first();

        if (empty($return->inventory) || empty($return->inventory->item) || empty($return->inventory->item->order)) {

            $err = [
                'message' => 'Return Order Not Found',
                'errors' => ['Invalid Order Details'],
            ];
            return response()->json($err, 422);
        }

        if ($return->inventory->item->order->id !== $order->id) {

            $err = [
                'message' => 'Return and Order Mismatch',
                'errors' => ['Invalid Order Details'],
            ];
            return response()->json($err, 422);
        }

        $return->deleted_by = $request->user->id;
        $return->save();
        $return->delete();

        $drugController = new DrugsController();
        $drugController->update_stock($return->inventory->item->drug_id);

        return response()->json(['redirect' => url('/pharmacy/purchases')]);
    }
}
