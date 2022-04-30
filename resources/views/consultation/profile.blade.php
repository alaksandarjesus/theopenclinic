<h4 class="text-lg font-medium my-2">Profile</h4>
<div class="overflow-auto">
    <table class="table-fixed w-full">
        <tr>
            <th class="text-left p-2" style="width: 200px;">Name</th>
            <td class="text-left p-2">{{$appointment->patient->name}}</td>
        </tr>
        <tr>
            <th class="text-left p-2" style="width: 200px;">Email</th>
            <td class="text-left p-2">{{$appointment->patient->email}}</td>
        </tr>
        <tr>
            <th class="text-left p-2" style="width: 200px;">Mobile</th>
            <td class="text-left p-2">{{$appointment->patient->mobile}}</td>
        </tr>
        <tr>
            <th class="text-left p-2" style="width: 200px;">Gender</th>
            <td class="text-left p-2">{{$appointment->patient->gender?$appointment->patient->gender_text:''}}</td>
        </tr>
        <tr>
            <th class="text-left p-2" style="width: 200px;">Date of Birth</th>
            <td class="text-left p-2">{{$appointment->patient->dob?$appointment->patient->formatted->dob:''}}</td>
        </tr>
        <tr>
            <th class="text-left p-2" style="width: 200px;">Age</th>
            <td class="text-left p-2">{{$appointment->patient->dob?$appointment->patient->formatted->age:''}}</td>
        </tr>
        <tr>
            <th class="text-left p-2" style="width: 200px;">Blood Group</th>
            <td class="text-left p-2">{{$appointment->patient->blood_group}}</td>
        </tr>
    </table>

</div>