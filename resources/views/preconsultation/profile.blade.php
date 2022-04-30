<h4 class="text-lg font-medium my-2">Profile</h4>
<div class="overflow-auto">
    <table class="table-fixed w-full">
        <tr>
            <th class="text-left p-2">Name</th>
            <td class="text-left p-2">{{$appointment->patient->name}}</td>
        </tr>
        <tr>
            <th class="text-left p-2">Email</th>
            <td class="text-left p-2">{{$appointment->patient->email}}</td>
        </tr>
        <tr>
            <th class="text-left p-2">Mobile</th>
            <td class="text-left p-2">{{$appointment->patient->mobile}}</td>
        </tr>
        <tr>
            <th class="text-left p-2">Gender</th>
            <td class="text-left p-2">{{$appointment->patient->gender?$appointment->patient->gender_text:''}}</td>
        </tr>
        <tr>
            <th class="text-left p-2">Date of Birth</th>
            <td class="text-left p-2">{{$appointment->patient->dob?$appointment->patient->formatted->dob:''}}</td>
        </tr>
        <tr>
            <th class="text-left p-2">Age</th>
            <td class="text-left p-2">{{$appointment->patient->dob?$appointment->patient->formatted->age:''}}</td>
        </tr>
        <tr>
            <th class="text-left p-2">Blood Group</th>
            <td class="text-left p-2">{{$appointment->patient->blood_group}}</td>
        </tr>
    </table>
</div>