<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payments\Payment;
use App\Http\Requests\Payments\PaymentEditRequest;
use App\Models\Appointments\Appointment;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PaymentsController extends Controller
{
    public function index(Request $request){
        
        $from = $request->query('from', NULL);
        $to = $request->query('to', NULL);

        $payments = Payment::when($from, function($query) use ($from){
            $from_parsed = Carbon::parse($from)->format('Y-m-d');
            return $query->where('created_at', '>=', $from_parsed);
        })->when($to, function($query) use ($to){
            $to_parsed = Carbon::parse($to)->format('Y-m-d');
            return $query->where('created_at', '<=', $to_parsed);
        })->orderBy('created_at', 'DESC')->get();

        return view('payments.index', compact('payments'));
    }

    public function edit($uuid){

        $payment = Payment::where('uuid', $uuid)->first();

        if(empty($payment)){

            return redirect()->to(404);
        }

        return view('payments.form', compact('payment'));

    }


    public function update(PaymentEditRequest $request){

        $validated =  (object)$request->validated();

        $payment = Payment::where('uuid', $validated->payment_uuid)->first();

        $payment->amount = $validated->amount;

        $payment->comments = $validated->comments;

        $payment->save();

        return response()->json(['redirect' => $validated->redirect]);


    }

    public function delete($uuid, Request $request){
        $payment = Payment::where('uuid', $uuid)->first();
        if(empty($payment)){
            $err = [
                'message' => 'Missing payment',
                'errors' => ['Unidentified payment']
            ];
            return response()->json($err, 422);
        }

        // todo: to check if any payment is connected. If yes, payment to be removed
        $payment->deleted_by = $request->user->id;
        $payment->save();
        $payment->delete();
        return response()->json(['redirect' => url('payments')]);
    }

  
}
