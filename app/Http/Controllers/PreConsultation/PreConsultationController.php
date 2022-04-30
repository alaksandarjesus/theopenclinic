<?php

namespace App\Http\Controllers\PreConsultation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointments\Appointment;
use App\Models\Appointments\PreconsultationField;
use App\Models\User\UserCustomField;
use App\Models\Appointments\Preconsultation;
use App\Http\Requests\Appointments\PreconsultationRequest;



class PreConsultationController extends Controller
{
    public function index($uuid, Request $request){

        $appointment = Appointment::where('uuid', $uuid)->first();
        if(empty($appointment)){
            return redirect()->to(404);
        }
        if(!$appointment->can_consult){
            if($request->expectsJson()){
                $response = [
                    'message' => 'Appointment Expired',
                    'errors' => ['Expired Appointment Request'],
                ];
                return $response;
            }
            return redirect()->to('404?message=appointent-expired');
        }
        $preconsultation_fields = PreconsultationField::orderBy('order', 'ASC')->get();
        $user_custom_fields = UserCustomField::orderBy('order', 'ASC')->get();
        return view('preconsultation.index', compact('appointment', 'preconsultation_fields', 'user_custom_fields'));
    }

    public function store(PreconsultationRequest $request){
        $validated = (object)$request->validated();
        $appointment = Appointment::where('uuid', $validated->appointment)->first();

        Preconsultation::where('appointment_id', $appointment->id)->update(['deleted_by' => $request->user->id]);
        Preconsultation::where('appointment_id', $appointment->id)->delete();

        foreach($validated->fields as $field){
            $field = (object)$field;

            $fieldObj = PreconsultationField::where('uuid', $field->uuid)->first();
            $row = new Preconsultation();
            $row->appointment_id = $appointment->id;
            $row->preconsultation_field_id = $fieldObj->id;
            $row->value = $field->value;
            $row->created_by = $request->user->id;
            $row->save();
        }

        return response()->json(['redirect' => url('appointments')]);
    }
}
