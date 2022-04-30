<?php

namespace App\Http\Controllers\Pharmacy\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy\Invoice\Invoice;
use App\Models\Pharmacy\Invoice\Item;
use App\Models\Pharmacy\Invoice\Returnn;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceReturn\CreateRequest;
use App\Http\Requests\InvoiceReturn\UpdateRequest;
use App\Http\Controllers\Pharmacy\DrugsController;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class InvoicesReturnController extends Controller
{
    public function index($invoice_uuid, Request $request)
    {

        $invoice = Invoice::where('uuid', $invoice_uuid)->first();

        if (empty($invoice)) {
            return redirect()->to(404);
        }

        $item_ids = Item::where('invoice_id', $invoice->id)->pluck('id')->toArray();

        if (empty($item_ids)) {
            return redirect()->to(404);
        }

        $returns = Returnn::whereIn('invoice_item_id', $item_ids)->get();

        return view('pharmacy.invoice-returns.index', compact('invoice', 'returns'));
    }

    public function create($invoice_uuid, Request $request)
    {

        $invoice = Invoice::where('uuid', $invoice_uuid)->first();

        if (empty($invoice)) {

            return redirect()->to(404);

        }

        return view('pharmacy.invoice-returns.create', compact('invoice'));
    }

    public function save(CreateRequest $request)
    {

        $validated = (object) $request->validated();
        $invoice = Invoice::where('uuid', $validated->invoice['uuid'])->first();

        if (empty($invoice)) {
            $err = [
                'message' => 'Invoice Not Found',
                'errors' => ['Invalid Invoice Details'],
            ];
            return response()->json($err, 422);
        }

        foreach ($validated->items as $item) {
            $itemModel = Item::where('uuid', $item['item']['uuid'])->first();
            $return = new Returnn;
            $return->uuid = Str::uuid();
            $return->invoice_id = $invoice->id;
            $return->invoice_item_id = $itemModel->id;
            $return->price = $item['price'];
            $return->tax = $item['tax'];
            $return->qty = $item['qty'];
            $return->total = $item['total'];
            $return->comments = Arr::get($item, 'comments', null);
            $return->created_by = $request->user->id;
            $return->save();

            $drugs_controller = new DrugsController;
            $drugs_controller->update_stock($itemModel->drug_id);
        }

        return response()->json(['redirect' => url('pharmacy/invoices/' . $invoice->uuid . '/returns')]);

    }

    public function edit($invoice_uuid, $return_uuid, Request $request)
    {
        $invoice = Invoice::where('uuid', $invoice_uuid)->first();

        if (empty($invoice)) {

            return redirect()->to(404);
        }
        $item_ids = Item::where('invoice_id', $invoice->id)->pluck('id')->toArray();

        $return = Returnn::where('uuid', $return_uuid)->whereIn('invoice_item_id', $item_ids)->first();

        if (empty($return)) {

            return redirect()->to(404);
        }

        return view('pharmacy.invoice-returns.edit', compact('invoice', 'return'));

    }

    public function update($uuid, UpdateRequest $request)
    {

        $validated = (object) $request->validated();

        $invoice = Invoice::where('uuid', $validated->invoice['uuid'])->first();

        if (empty($invoice)) {
            $err = [
                'message' => 'Invoice Not Found',
                'errors' => ['Invalid Invoice Details'],
            ];
            return response()->json($err, 422);
        }

        $return = Returnn::where('uuid', $validated->return['uuid'])->first();

        if ($return->item->invoice->id !== $invoice->id) {

            $err = [
                'message' => 'Return and Invoice Mismatch',
                'errors' => ['Invalid Invoice Details'],
            ];
            return response()->json($err, 422);
        }

        $return->price = $validated->return['price'];
        $return->tax = $validated->return['tax'];
        $return->qty = $validated->return['qty'];
        $return->total = $validated->return['total'];
        $return->comments = Arr::get($validated->return, 'comments', null);
        $return->updated_by = $request->user->id;
        $return->save();

        $drugs_controller = new DrugsController;
        $drugs_controller->update_stock($return->item->drug_id);

        return response()->json(['redirect' => url('pharmacy/invoices/' . $invoice->uuid . '/returns')]);

    }

    public function delete($invoice_uuid, $return_uuid, Request $request){
        $invoice = Invoice::where('uuid', $invoice_uuid)->first();
        if(empty($invoice)){
            $err = [
                'message' => 'Missing Invoice Order',
                'errors' => ['Unidentified Order']
            ];
            return response()->json($err, 422);
        }
        $return = Returnn::where('uuid', $return_uuid)->first();

        if ($return->item->invoice->id !== $invoice->id) {

            $err = [
                'message' => 'Return and Invoice Mismatch',
                'errors' => ['Invalid Invoice Details'],
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
