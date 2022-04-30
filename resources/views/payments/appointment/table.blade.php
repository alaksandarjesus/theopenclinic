<div class="overflow-auto hidden md:block">
    <table class="table-auto w-full ">
        <tr>
            <th class="p-3 text-center">Doctor</th>
            <th class="p-3 text-center">Patient</th>
            <th class="p-3 text-center">Date</th>
            <th class="p-3 text-center">Time</th>
        </tr>
        <tr>
            <td class="p-3 text-center">{{$appointment->doctor->name}}</td>
            <td class="p-3 text-center">{{$appointment->patient->name}}</td>
            <td class="p-3 text-center">{{$appointment->formatted->date}}</td>
            <td class="p-3 text-center">{{$appointment->formatted->time}}</td>
        </tr>
    </table>
</div>

<div class="overflow-auto block md:hidden">
    <table class="table-auto w-full ">

        <tr>
            <td>
                <div class="p-3 text-left"><strong>Doctor: </strong> {{$appointment->doctor->name}}</div>
                <div class="p-3 text-left"><strong>Patient: </strong> {{$appointment->patient->name}}</div>
                <div class="p-3 text-left"><strong>Date: </strong> {{$appointment->formatted->date}}</div>
                <div class="p-3 text-left"><strong>Time: </strong> {{$appointment->formatted->time}}</div>

            </td>

        </tr>
    </table>
</div>