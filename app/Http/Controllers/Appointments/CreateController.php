<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Appointments\CreateRequest;
use App\Models\Appointments\Appointment;
use App\Models\Role;
use App\Models\User\User;
use App\Models\User\UserRoleRelation;
use Illuminate\Support\Str;
use App\Http\Controllers\Appointments\IndexController;
use Carbon\Carbon;


class CreateController extends Controller
{
    public function index(Request $request)
    {
        $doctor_role = Role::where('name', 'Doctor')->first();
        $user_ids = UserRoleRelation::where('role_id', $doctor_role->id)->pluck('user_id')->toArray();
         $doctors = User::whereIn('id', $user_ids)->get();
        $index_controller = new IndexController();
        $times = $index_controller->get_times();
       return view('appointments.create', compact('doctors', 'times'));
    }

    public function save(CreateRequest $request)
    {
        $validated = (object) $request->validated();

        if (empty($validated->uuid)) {
            $is_valid_user = $this->is_valid_user($validated);
            if (!empty($is_valid_user)) {
                return response()->json($is_valid_user, 422);
            }
            $user = User::where('mobile', $validated->mobile)->where('email', $validated->email)->first();
            if (empty($user)) {
                $user = $this->create_user($validated, $request);
            }
        }else{
            $user = User::where('uuid', $validated->uuid)->first();
        }

        $doctor = User::where('uuid', $validated->doctor)->first();
        $appointment = new Appointment;
        $appointment->patient_id = $user->id;
        $appointment->doctor_id = $doctor->id;
        $appointment->uuid = Str::uuid();
        $appointment->datetime = date('Y-m-d H:i:s', strtotime($validated->datetime));
        $appointment->created_by = $request->user->id;
        $appointment->save();

        $user->dob = Carbon::parse($validated->dob)->format('Y-m-d');
        $user->blood_group = $validated->blood_group;
        $user->gender = $validated->gender;
        $user->save();
        
        return response()->json(['redirect' => url('appointments')]);
    }

    private function is_valid_user($validated)
    {
        $user = User::where('email', $validated->email)->first();
        if (!empty($user)) {
            if ($user->mobile !== $validated->mobile) {
                $response = [
                    'message' => 'User Invalid',
                    'errors' => ['User registered email conflicts with registered mobile'],
                ];
                return $response;
            }
        }

        $user = User::where('mobile', $validated->mobile)->first();
        if (!empty($user)) {
            if ($user->email !== $validated->email) {
                $response = [
                    'message' => 'User Invalid',
                    'errors' => ['User registered mobile conflicts with registered email'],
                ];

                return $response;
            }
        }
        return [];
    }

    private function create_user($validated, $request)
    {
        $user = new User;
        $user->uuid = Str::uuid();
        $user->username = Str::slug($validated->name, '_') . '_' . strtolower(Str::random(3));
        $user->name = $validated->name;
        $user->email = $validated->email;
        $user->mobile = $validated->mobile;
        $user->password = Str::random(12);
        $user->created_by = $request->user->id;
        $user->save();
        $patient_role = Role::where('name', 'patient')->first();
        $row = new UserRoleRelation;
        $row->user_id = $user->id;
        $row->role_id = $patient_role->id;
        $row->created_by = $request->user->id;
        $row->save();
        return $user;
    }
  
}
