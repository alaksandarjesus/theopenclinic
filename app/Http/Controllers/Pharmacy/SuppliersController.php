<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacy\Supplier;
use App\Http\Requests\Pharmacy\SupplierRequest;
use Illuminate\Support\Str;

class SuppliersController extends Controller
{
    public function index(Request $request){

        $q = $request->query('q', NULL);

        $suppliers = Supplier::when(($q), function($query) use ($q){
            
            return $query->where('name', 'LIKE' ,'%'.$q.'%')
            ->orWhere('email', 'LIKE' ,'%'.$q.'%')
            ->orWhere('phone', 'LIKE' ,'%'.$q.'%');

        })->orderBy('name', 'ASC')->get();

        return view('pharmacy.suppliers.index', compact('suppliers'));
    }

    public function create(){

        $supplier = new Supplier();

        return view('pharmacy.suppliers.form', compact('supplier'));
    }

    public function edit($uuid){

        $supplier = Supplier::where('uuid', $uuid)->first();

        if(empty($supplier)){

            return redirect()->to('404');

        }
        return view('pharmacy.suppliers.form', compact('supplier'));

    }

    public function store(SupplierRequest $request){
        $validated = (object) $request->validated();
        if(empty($validated->uuid)){
            $supplier = new Supplier;
            $supplier->uuid = Str::uuid();
        $supplier->created_by = $request->user->id;

        }else{
            $supplier = Supplier::where('uuid', $validated->uuid)->first();
        }
        
        $supplier->name = $validated->name;
        $supplier->address = $validated->address;
        $supplier->email = $validated->email;
        $supplier->phone = $validated->phone;
        $supplier->tax_information = $validated->tax_information;
        $supplier->description = $validated->description;
        $supplier->updated_by = $request->user->id;
        $supplier->save();

        return response()->json(['redirect' => url('/pharmacy/suppliers')]);
    }

    public function delete($uuid, Request $request){
        $supplier = Supplier::where('uuid', $uuid)->first();
        if(empty($supplier)){
            $err = [
                'message' => 'Missing supplier',
                'errors' => ['Unidentified Rolename']
            ];
            return response()->json($err, 422);
        }

        $err = [
            'message' => 'Missing supplier',
            'errors' => ['to check if any purchases is connected. If yes, purchases to be removed']
        ];
        return response()->json($err, 422);

        // todo: to check if any drug is connected. If yes, drug to be removed
        $supplier->deleted_by = $request->user->id;
        $supplier->save();
        $supplier->delete();
        return response()->json(['redirect' => url('/pharmacy/suppliers')]);
    }
}
