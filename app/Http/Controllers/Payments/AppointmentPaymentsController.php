<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payments\Payment;
use App\Http\Requests\Payments\PaymentCreateRequest;
use App\Models\Appointments\Appointment;
use Illuminate\Support\Str;

class AppointmentPaymentsController extends Controller
{
    public function get($uuid, Request $request){
        $appointment = Appointment::where('uuid', $uuid)->first();
        if(empty($appointment)){
            return redirect()->to(404);
        }
        return view('payments.appointment.index', compact('appointment'));
    }
    public function store(PaymentCreateRequest $request){
        $validated = (object)$request->validated();
        $appointment = Appointment::where('uuid', $validated->appointment_uuid)->first();
        $payment = new Payment;
        $payment->uuid = Str::uuid();
        $payment->appointment_id = $appointment->id;
        $payment->amount = $validated->amount;
        $payment->comments = $validated->comments;
        $payment->save();
        return response()->json(['redirect' => $validated->redirect]);
    }
}
