<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User\User;
use App\Models\Appointments\Appointment;
use App\Models\User\UserRoleRelation;
use Illuminate\Support\Str;
use App\Http\Controllers\Appointments\IndexController;
use App\Http\Requests\Appointments\EditRequest;
use Carbon\Carbon;

class EditController extends Controller
{
    public function index($uuid, Request $request)
    {
        $appointment = Appointment::where('uuid', $uuid)->first();
        if(empty($appointment)){
            if($request->expectsJson()){
                $response = [
                    'message' => 'Appointment Invalid',
                    'errors' => ['Invalid Appointment Request'],
                ];
                return $response;
            }
            return redirect()->to('404');
        }

        if(!$appointment->can_edit){
            if($request->expectsJson()){
                $response = [
                    'message' => 'Appointment Expired',
                    'errors' => ['Expired Appointment Request'],
                ];
                return $response;
            }
            return redirect()->to('404?message=appointent-expired');
        }
     
        $doctor_role = Role::where('name', 'Doctor')->first();
        $user_ids = UserRoleRelation::where('role_id', $doctor_role->id)->pluck('id')->toArray();
        $doctors = User::whereIn('id', $user_ids)->get();
        $index_controller = new IndexController();
        $times = $index_controller->get_times();

        return view('appointments.edit', compact('doctors', 'times', 'appointment'));
    }


    public function save(EditRequest $request){

        $validated = (object)$request->validated();

        $appointment =  Appointment::where('uuid', $validated->uuid)->first();
        $doctor = User::where('uuid', $validated->doctor)->first();
        $appointment->doctor_id = $doctor->id;
        $appointment->datetime = date('Y-m-d H:i:s', strtotime($validated->datetime));
        $appointment->created_by = $request->user->id;
        $appointment->save();

        $user = User::where('id', $appointment->patient_id)->first();
        $user->dob = Carbon::parse($validated->dob)->format('Y-m-d');
        $user->blood_group = $validated->blood_group;
        $user->gender = $validated->gender;
        $user->save();

        return response()->json(['redirect' => url('appointments')]);
        

    }
}
