<?php

namespace App\Http\Controllers\Consultation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointments\Appointment;
use App\Models\User\UserCustomField;
use App\Models\Appointments\PreconsultationField;
use App\Models\Consultation\Consultation;
use App\Http\Requests\Consultation\ConsultationRequest;
use Illuminate\Support\Str;
use App\Models\Pharmacy\Drug;
use App\Models\Prescription\Prescription;
use App\Models\Prescription\PrescriptionDrug;

class ConsultationController extends Controller
{
    public function get($uuid, Request $request){

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
        $consultation = Consultation::where('appointment_id', $appointment->id)->first();
        if(empty($consultation)){
            $consultation = new Consultation();
        }
        $previous_appointments = Appointment::where('patient_id', $appointment->patient_id)->orderBy('datetime', 'DESC')->pluck('id')->toArray();
        $previous_consultations = [];
        if($previous_appointments){
            $previous_consultations = Consultation::whereIn('appointment_id', $previous_appointments)->orderBy('created_at', 'DESC')->get();
        }
        $drugs = Drug::orderBy('name', 'asc')->get();
        return view('consultation.index', compact('appointment', 'consultation', 'previous_consultations','preconsultation_fields', 'user_custom_fields', 'drugs'));

    }

    public function store(ConsultationRequest $request){
        $validated = (object)$request->validated();
        $appointment = Appointment::where('uuid', $validated->appointment_uuid)->first();
        Consultation::where('appointment_id', $appointment->id)->update(['deleted_by' => $request->user->id]);
        Consultation::where('appointment_id', $appointment->id)->delete();
        $row = new Consultation;
        $row->uuid = Str::uuid();
        $row->appointment_id = $appointment->id;
        $row->complaints = $validated->complaints;
        $row->examination = $validated->examination;
        $row->others = $validated->others;
        $row->created_by = $request->user->id;
        $row->save();
        $this->add_prescription($row, $validated, $request);

        return response()->json(['redirect' => url('appointments')]);
    }

    private function add_prescription($row, $validated, $request){
        Prescription::where('consultation_id', $row->id)->update(['deleted_by' => $request->user->id]);
        Prescription::where('consultation_id', $row->id)->delete();
        $prescription = new Prescription;
        $prescription->uuid = Str::uuid();
        $prescription->consultation_id = $row->id;
        $prescription->comments = $validated->prescription['comments'];
        $prescription->created_by = $request->user->id;
        $prescription->save();
        PrescriptionDrug::where('prescription_id', $prescription->id)->update(['deleted_by' => $request->user->id]);
        PrescriptionDrug::where('prescription_id', $prescription->id)->delete();
        if(empty($validated->prescription['drugs'])){
            return;
        }
        $drugs = $validated->prescription['drugs'];
        foreach($drugs as $drug){
            $drug = (object)$drug;
            $prescription_drug = new PrescriptionDrug;
            $drug_obj = Drug::where('uuid', $drug->uuid)->first();
            $prescription_drug->prescription_id = $prescription->id;
            $prescription_drug->drug_id = $drug_obj->id;
            $prescription_drug->days = $drug->days;
            $prescription_drug->bb = $drug->bb;
            $prescription_drug->ab = $drug->ab;
            $prescription_drug->bl = $drug->bl;
            $prescription_drug->al = $drug->al;
            $prescription_drug->be = $drug->be;
            $prescription_drug->ae = $drug->ae;
            $prescription_drug->bd = $drug->bd;
            $prescription_drug->ad = $drug->ad;
            $prescription_drug->created_by = $request->user->id;
            $prescription_drug->save();
        }
        return;
    }

}
