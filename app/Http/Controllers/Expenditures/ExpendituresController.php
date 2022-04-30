<?php

namespace App\Http\Controllers\Expenditures;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expenditures\Expenditure;
use App\Http\Requests\Expenditures\ExpenditureRequest;
use Carbon\Carbon;
use Illuminate\Support\Str;


class ExpendituresController extends Controller
{
    public function index(Request $request){

        $from = $request->query('from', NULL);
        $to = $request->query('to', NULL);

        $expenditures = Expenditure::when($from, function($query) use ($from){
            $from_parsed = Carbon::parse($from)->format('Y-m-d');
            return $query->where('date', '>=', $from_parsed);
        })->when($to, function($query) use ($to){
            $to_parsed = Carbon::parse($to)->format('Y-m-d');
            return $query->where('date', '<=', $to_parsed);
        })->orderBy('date', 'DESC')->get();

        return view('expenditures.index', compact('expenditures'));
    }


    public function store(ExpenditureRequest $request){
        $validated = (object) $request->validated();
        if(empty($validated->uuid)){
            $expenditure = new Expenditure;
            $expenditure->uuid = Str::uuid();
            $expenditure->created_by = $request->user->id;
        }else{
            $expenditure = Expenditure::where('uuid', $validated->uuid)->first();
        }
        $expenditure->amount = $validated->amount;
        $expenditure->date = Carbon::parse($validated->date)->format('Y-m-d');
        $expenditure->description = $validated->description;
        $expenditure->save();

        return response()->json(['redirect' => url('/expenditures')]);
    }

    public function delete($uuid, Request $request){
        $expenditure = Expenditure::where('uuid', $uuid)->first();
        if(empty($expenditure)){
            $err = [
                'message' => 'Missing expenditure',
                'errors' => ['Unidentified expenditure']
            ];
            return response()->json($err, 422);
        }

        // todo: to check if any drug is connected. If yes, drug to be removed
        $expenditure->deleted_by = $request->user->id;
        $expenditure->save();
        $expenditure->delete();
        return response()->json(['redirect' => url('/expenditures')]);
    }
}
