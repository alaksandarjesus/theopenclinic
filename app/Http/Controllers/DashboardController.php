<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pharmacy\Purchase\Order;
use App\Models\Pharmacy\Purchase\Returnn as PurchaseReturn;
use App\Models\Pharmacy\Invoice\Invoice;
use App\Models\Pharmacy\Invoice\Returnn as InvoiceReturn;
use App\Models\Payments\Payment;
use App\Models\Expenditures\Expenditure;
use App\Models\Appointments\Appointment;
use App\Models\Consultation\Consultation;


class DashboardController extends Controller
{
    public function index(Request $request){
        $from = $request->query('from', Carbon::now()->subMonth(1)->format('d-m-Y'));
        $to = $request->query('to', Carbon::now()->format('d-m-Y'));

        $start = Carbon::parse($from)->startOfDay()->format('Y-m-d H:i:s');
        $end = Carbon::parse($to)->endOfDay()->format('Y-m-d H:i:s');


        $appointment_ids = Appointment::when($request->user->is_doctor, function($query) use ($request){
            return $query->where('doctor_id', $request->user->id);
        })->whereBetween('datetime', [$start, $end])->pluck('id')->toArray();

        $appointments = count($appointment_ids);
        
        $consultations = 0;

        if(!empty($appointments)){
            $consultations = Consultation::whereIn('appointment_id', $appointment_ids)
            ->whereBetween('created_at', [$start, $end])->count();
        }


        $args = (object)[
            'payments' =>  Payment::whereBetween('created_at', [$start, $end])->sum('amount'),
            'expenditures' => Expenditure::whereBetween('date', [$start, $end])->sum('amount'),
            'appointments' => $appointments,
            'consultations' => $consultations,
            'purchases' => Order::whereBetween('order_date', [$start, $end])->where("submitted", 1)->sum('total'),
            'purchase_returns' => PurchaseReturn::whereBetween('created_at', [$start, $end])->sum('total'),
            'invoices' => Invoice::whereBetween('invoice_date', [$start, $end])->where("submitted", 1)->sum('total'),
            'invoice_returns' => InvoiceReturn::whereBetween('created_at', [$start, $end])->sum('total'),
        ];

        return view('dashboard.index', compact('args','from', 'to'));
    }
}
