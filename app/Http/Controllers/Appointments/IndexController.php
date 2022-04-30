<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointments\DoctorAvailabilityRequest;
use App\Models\Appointments\Appointment;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User\UserRoleRelation;


class IndexController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date', date('d-m-Y'));
        $doctor = $request->query('doctor', NULL);
        $patient = $request->query('patient', NULL);

        $appointments = Appointment::when($date, function($query)use($date){
            $start = Carbon::parse($date)->copy()->startOfDay();
            $end = Carbon::parse($date)->copy()->endOfDay();
            return $query->whereBetween('datetime', [$start, $end]);
        })->when($request->user->is_doctor, function($query) use ($request){
            return $query->where('doctor_id', $request->user->id);
        })->when($doctor, function($query) use ($doctor){
            $doctorObj = Role::where('name', 'doctor')->first();
            if(empty($doctor)){
                return $query->where('id', '<', 1);
            }
            $doctor_ids = UserRoleRelation::where('role_id', $doctorObj->id)->pluck('user_id')->toArray();
            if(empty($doctor_ids)){
                return $query->where('id', '<', 1);
            }
            $user_ids = User::whereIn('id', $doctor_ids)->where('name', 'LIKE', '%'.$doctor.'%')->pluck('id')->toArray();
            return $query->whereIn('doctor_id', $user_ids);
        })->when($patient, function($query) use ($patient){
            $patientObj = Role::where('name', 'patient')->first();
            if(empty($patient)){
                return $query->where('id', '<', 1);
            }
            $patient_ids = UserRoleRelation::where('role_id', $patientObj->id)->pluck('user_id')->toArray();
            if(empty($patient_ids)){
                return $query->where('id', '<', 1);
            }
            $user_ids = User::whereIn('id', $patient_ids)->where('name', 'LIKE', '%'.$patient.'%')->pluck('id')->toArray();
            return $query->whereIn('patient_id', $user_ids);
        })->orderBy('datetime', 'DESC')->paginate(env('PAGINATION_ITEMS_COUNT'));

        $today = Carbon::now()->format('d-m-Y');
        $previous_date = Carbon::parse($date)->copy()->subDays(1)->format('d-m-Y');
        $next_date = Carbon::parse($date)->copy()->addDays(1)->format('d-m-Y');

        return view('appointments.index', compact('appointments', 'date', 'today', 'previous_date', 'next_date'));
    }

    public function doctor_availability(DoctorAvailabilityRequest $request)
    {

        $validated = (object) $request->validated();

        $doctor = User::where('uuid', $validated->doctor)->first();

        $start = Carbon::parse($validated->date)->startOfDay();
        $end = Carbon::parse($validated->date)->endOfDay();

        $appointment_datetimes = Appointment::where('doctor_id', $doctor->id)
            ->whereBetween('datetime', [$start, $end])->pluck('datetime')->toArray();

        $booked = [];

        foreach ($appointment_datetimes as $datetime) {

            $booked[] = Carbon::parse($datetime)->format('H:i');
        }

        return response()->json(['booked' => $booked, 'start' => $start, 'end' => $end]);

    }

    public function delete($uuid, Request $request){
        $appointment = Appointment::where('uuid', $uuid)->first();
        if(empty($appointment)){
            $response = [
                'message' => 'Appointment Invalid',
                'errors' => ['Unable to identify the appointment'],
            ];
            return $response;
        }
        $appointment->deleted_by = $request->user->id;
        $appointment->save();
        $appointment->delete();
        return response()->json(['success' => true, 'redirect' => url('appointments')]);
    }

    public function get_times()
    {
        $times = [];
        $minutes = ['00', '15', '30', 45];
        for ($i = 0; $i < 24; $i++) {
            $hour = (string) $i;
            foreach ($minutes as $minute) {
                $times[] = str_pad($hour, 2, "0", STR_PAD_LEFT) . ':' . $minute;
            }
        }
        return $times;
    }

}
