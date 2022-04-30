<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacy\Composition;
use App\Http\Requests\Pharmacy\CompositionRequest;
use Illuminate\Support\Str;

class CompositionsController extends Controller
{
    public function index(){

        $compositions = Composition::orderBy('name', 'ASC')->get();

        return view('pharmacy.compositions.index', compact('compositions'));
    }

    public function get($uuid){

        $composition = Composition::where('uuid', $uuid)->first();

        return response()->json($composition);
    }

    public function store(CompositionRequest $request){
        $validated = (object) $request->validated();
        $composition = new Composition;
        $composition->uuid = Str::uuid();
        $composition->name = $validated->name;
        $composition->created_by = $request->user->id;
        $composition->save();

        return response()->json(['redirect' => url('/pharmacy/compositions')]);
    }

    public function update(CompositionRequest $request){
        $validated = (object) $request->validated();
        $composition = Composition::where('uuid', $validated->uuid)->first();
        $composition->name = $validated->name;
        $composition->updated_by = $request->user->id;
        $composition->save();

        return response()->json(['redirect' => url('/pharmacy/compositions')]);
    }

    public function delete($uuid, Request $request){
        $composition = Composition::where('uuid', $uuid)->first();
        if(empty($composition)){
            $err = [
                'message' => 'Missing composition',
                'errors' => ['Unidentified Rolename']
            ];
            return response()->json($err, 422);
        }

        $err = [
            'message' => 'Missing composition',
            'errors' => ['to check if any drug is connected. If yes, drug to be removed']
        ];
        return response()->json($err, 422);

        // todo: to check if any drug is connected. If yes, drug to be removed
        $composition->deleted_by = $request->user->id;
        $composition->save();
        $composition->delete();
        return response()->json(['redirect' => url('/pharmacy/compositions')]);
    }
}
