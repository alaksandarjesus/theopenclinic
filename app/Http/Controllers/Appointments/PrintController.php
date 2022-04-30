<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointments\Appointment;

class PrintController extends Controller
{
    public function index($uuid){
        $appointment = Appointment::where('uuid', $uuid)->first();

        if(empty($appointment)){
            return redirect()->to('404');
        }

        return view('appointments.print', compact('appointment'));

    }
}
