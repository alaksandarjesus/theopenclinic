<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacy\Drug;
use App\Models\Pharmacy\Composition;
use App\Http\Requests\Pharmacy\DrugRequest;
use Illuminate\Support\Str;
use App\Models\Pharmacy\Purchase\Item;
use App\Models\Pharmacy\Purchase\Inventory;
use App\Models\Pharmacy\Purchase\Returnn as PurchaseReturn;
use App\Models\Pharmacy\Invoice\Item as InvoiceItem;
use App\Models\Pharmacy\Invoice\Returnn as InvoiceReturn;
use App\Models\Pharmacy\DrugCompositionRelationship;
use App\Models\Pharmacy\Category;



class DrugsController extends Controller
{
    public function index(Request $request){

        $composition = $request->query('composition', NULL);
        $category = $request->query('category', NULL);

        $q = $request->query('q', NULL);

        $drugs = Drug::when($composition, function($query)use($composition){

            $composition_model = Composition::where('uuid', $composition)->first();

            if(empty($composition_model)){

                return $query->where('id', '<', 1);
            }
            $drug_ids = DrugCompositionRelationship::where('composition_id', $composition_model->id)->pluck('drug_id')->toArray();

            return $query->WhereIn('id', $drug_ids);

        })->when($category, function($query)use($category){

            $category_model = Category::where('uuid', $category)->first();

            if(empty($category_model)){

                return $query->where('id', '<', 1);
            }

            return $query->Where('category_id', $category_model->id);

        })->when($q, function($query) use ($q){

            return $query->where('name', 'LIKE', '%'.$q.'%');

        })->orderBy('name', 'ASC')->get();
        
        $compositions = Composition::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();

        if($request->user->is_pharmacist){
        return view('pharmacy.drugs.pharmacist.index', compact('drugs', 'compositions', 'categories'));

        }

        return view('pharmacy.drugs.index', compact('drugs', 'compositions', 'categories'));
    }

    public function create(){
        $compositions = Composition::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        
        $drug = new Drug();
        return view('pharmacy.drugs.form', compact('drug', 'compositions', 'categories'));
    }

    public function edit($uuid){
        $compositions = Composition::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();

        $drug = Drug::where('uuid', $uuid)->first();
        if(empty($drug)){
            return redirect()->to('404');
        }
        return view('pharmacy.drugs.form', compact('drug', 'compositions', 'categories'));
    }


    public function get($uuid){

        $drug = Drug::where('uuid', $uuid)->first();

        return response()->json($drug);
    }

    public function store(DrugRequest $request){
        $validated = (object) $request->validated();
        if(empty($validated->uuid)){
            $drug = new Drug;
            $drug->uuid = Str::uuid();
            $drug->created_by = $request->user->id;
        }else{
            $drug = Drug::where('uuid', $validated->uuid)->first();
        }
       
        $drug->name = $validated->name;
        $drug->unit = $validated->unit;
        $drug->price = $validated->price;
        $drug->cost = $validated->cost;
        $drug->tax = $validated->tax;
        $drug->description = $validated->description;
        $drug->updated_by = $request->user->id;

        $categoryObj = Category::where('uuid', $validated->category)->first();

        $drug->category_id=$categoryObj->id;

        $drug->save();
        if(empty($validated->compositions)){
            $validated->compositions = [];
        }
        $this->update_compositions($request, $drug, $validated->compositions);

        return response()->json(['redirect' => url('/pharmacy/drugs')]);
    }

    public function update_compositions($request, $drug, $composition_uuids = NULL){


        DrugCompositionRelationship::where('drug_id', $drug->id)->update(['deleted_by' => $request->user->id]);

        DrugCompositionRelationship::where('drug_id', $drug->id)->delete();

        if(empty($composition_uuids)){
            return;
        }
        $compositions = Composition::whereIn('uuid', $composition_uuids)->pluck('id')->toArray();

        foreach($compositions as $composition_id){
            $row =  new DrugCompositionRelationship;
            $row->drug_id = $drug->id;
            $row->composition_id = $composition_id;
            $row->created_by = $request->user->id;
            $row->save();
        }
    }

    public function delete($uuid, Request $request){
        $drug = Drug::where('uuid', $uuid)->first();
        if(empty($drug)){
            $err = [
                'message' => 'Missing drug',
                'errors' => ['Unidentified Drug']
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

        $err = [
            'message' => 'Missing drug',
            'errors' => ['to check if any purchase/invoice is connected. If yes, drug to be removed']
        ];
        return response()->json($err, 422);

        // todo: to check if any drug is connected. If yes, drug to be removed
        $drug->deleted_by = $request->user->id;
        $drug->save();
        $drug->delete();
        return response()->json(['redirect' => url('/pharmacy/drugs')]);
    }



    public function update_stock($drug_id){

        $drug = Drug::find($drug_id);

        if(empty($drug)){

            return;
        }

        $drug->received = 0;

        $drug->purchase_returned = 0;

        $purchase_order_item_ids = Item::where('drug_id', $drug->id)->where('submitted', 1)->pluck('id')->toArray();
       
        if(!empty($purchase_order_item_ids)){

            $purchase_inventory_ids = Inventory::whereIn('purchase_order_item_id', $purchase_order_item_ids)->pluck('id')->toArray();

            if(!empty($purchase_inventory_ids)){

                $drug->received  = Inventory::whereIn('id', $purchase_inventory_ids)->sum('qty');
            }

            $purchase_return_ids = PurchaseReturn::whereIn('purchase_order_inventory_id', $purchase_inventory_ids)->pluck('id')->toArray();
          
            if(!empty($purchase_return_ids)){

                $drug->purchase_returned  = PurchaseReturn::whereIn('id', $purchase_return_ids)->sum('qty');

            }
        }

        $purchase_order_item_model = Item::where('drug_id', $drug->id)->where('submitted', 1);

        $drug->ordered = $purchase_order_item_model->sum('qty');

        $drug->transit = $drug->ordered - $drug->received;

        $drug->invoiced = InvoiceItem::where('drug_id', $drug->id)->where('submitted', 1)->sum('qty');

        $invoiced_ids = InvoiceItem::where('drug_id', $drug->id)->where('submitted', 1)->pluck('id')->toArray();

        $drug->invoice_returned = 0;

        if(!empty($invoiced_ids)){


            $drug->invoice_returned = InvoiceReturn::whereIn('invoice_item_id', $invoiced_ids)->sum('qty');
        }

        $drug->in_stock = $drug->received - $drug->purchase_returned - $drug->invoiced + $drug->invoice_returned;

        $drug->save();

        return;
    }

    public function refresh($uuid, Request $requst){
        $drug = Drug::where('uuid', $uuid)->first();
        if(empty($drug)){
            return;
        }
        
        $this->update_stock($drug->id);
        return response()->json(['success' => true]);
    }
}
