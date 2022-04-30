<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy\Drug;
use App\Models\Pharmacy\Invoice\Item as InvoiceItem;
use App\Models\Pharmacy\Invoice\Returnn as InvoiceReturn;
use App\Models\Pharmacy\Purchase\Inventory as PurchaseInventory;
use App\Models\Pharmacy\Purchase\Item as PurchaseItem;
use App\Models\Pharmacy\Purchase\Returnn as PurchaseReturn;
use App\Models\Pharmacy\Purchase\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DrugHistoryController extends Controller
{
    public function index($uuid, Request $request)
    {

        $from = $request->query('from', Carbon::now()->subMonth(1)->format('d-m-Y'));
        $to = $request->query('to', Carbon::now()->format('d-m-Y'));

        $start = Carbon::parse($from)->startOfDay()->format('Y-m-d H:i:s');
        $end = Carbon::parse($to)->endOfDay()->format('Y-m-d H:i:s');

        $drug = Drug::where('uuid', $uuid)->first();
        if (empty($drug)) {
            return redirect()->to('404');
        }
        $rows = [];
        $order_ids = Order::where('submitted', 1)->where('order_date', '>=', $start)->where('order_date', '<=', $end)->pluck('id')->toArray();
      
        $purchase_items = PurchaseItem::where('drug_id', $drug->id)->whereIn('order_id', $order_ids)->where('submitted', 1)->get();
        foreach ($purchase_items as $item) {
            $rows[] = (object)[
                'item' => $item,
                'timestamp' => Carbon::parse($item->order->order_date)->timestamp,
                'datetime' => Carbon::parse($item->order->order_date)->format('d-m-Y H:i:s'),
                'ref' => 'Purchase Item',
            ];
            $purchase_inventory = PurchaseInventory::where('purchase_order_item_id', $item->id)->where('created_at', '>=', $start)->where('created_at', '<=', $end)->get();
            foreach ($purchase_inventory as $inventory) {
                $rows[] = (object)[
                    'item' => $inventory,
                    'timestamp' => Carbon::parse($inventory->created_at)->timestamp,
                    'datetime' => Carbon::parse($inventory->created_at)->format('d-m-Y H:i:s'),

                    'ref' => 'Purchase Inventory',
                ];
                $purchase_return = PurchaseReturn::where('purchase_order_inventory_id', $inventory->id)->where('created_at', '>=', $start)->where('created_at', '<=', $end)->get();
                foreach ($purchase_return as $return) {
                    $rows[] = (object)[
                        'item' => $return,
                        'timestamp' => Carbon::parse($return->created_at)->timestamp,
                        'datetime' => Carbon::parse($return->created_at)->format('d-m-Y H:i:s'),

                        'ref' => 'Purchase Return',
                    ];
                }
            }

        }

        $invoice_items = InvoiceItem::where('drug_id', $drug->id)->where('submitted', 1)->where('created_at', '>=', $start)->where('created_at', '<=', $end)->get();
        foreach ($invoice_items as $item) {
            $rows[] = (object)[
                'item' => $item,
                'timestamp' => Carbon::parse($item->created_at)->timestamp,
                'datetime' => Carbon::parse($item->created_at)->format('d-m-Y H:i:s'),
                'ref' => 'Invoice Item',
            ];

            $invoice_returns = InvoiceReturn::where('invoice_item_id', $item->id)->where('created_at', '>=', $start)->where('created_at', '<=', $end)->get();

            foreach ($invoice_returns as $return) {
                $rows[] = (object)[
                    'item' => $return,
                    'timestamp' => Carbon::parse($return->created_at)->timestamp,
                    'datetime' => Carbon::parse($return->created_at)->format('d-m-Y H:i:s'),
                    'ref' => 'Invoice Return',
                ];

            }

        }
        usort($rows, function ($a, $b) {
            return $b->timestamp - $a->timestamp;
        });
       
        return view('pharmacy.drugs.history', compact('drug','rows', 'from', 'to'));
    }
}
