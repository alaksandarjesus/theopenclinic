<h4 class="text-lg font-medium my-2">Previous Consultation Fields</h4>
@foreach($previous_consultations as $consultation)

<div class="overflow-auto">
<table class="w-full previous-consultation">
    <thead>
        <tr class="bg-gray-200 cursor-pointer toggle-tbody">
            <th class="text-left p-3">Doctor</th>
            <td class="text-left p-3">{{$consultation->appointment->doctor->name}}</td>
            <th class="text-left p-3">Date</th>
            <td class="text-left p-3"> {{$consultation->appointment->formatted->date}}
                {{$consultation->appointment->formatted->time}}</td>

        </tr>
    </thead>
    <tbody class="table-body" style="display:none">
        <tr>
            <th class="text-left p-3" colspan="4">Complaints</th>
        </tr>
        <tr>
            <td class="text-left p-3" colspan="4">{{$consultation->complaints}}</td>
        </tr>
        <tr>
            <th class="text-left p-3" colspan="4">Examination</th>
        </tr>
        <tr>
            <td class="text-left p-3" colspan="4">{{$consultation->examination}}</td>
        </tr>
        <tr>
            <th class="text-left p-3" colspan="4">Prescription</th>
        </tr>
        <tr>
            <td class="text-left p-3" colspan="4">
                @if(!empty($consultation->prescription) && !empty($consultation->prescription->drugs))
                @include('consultation.previous-consultations-table')
                @endif
            </td>
        </tr>
        <tr>
            <th class="text-left p-3" colspan="4">Others</th>
        </tr>
        <tr>
            <td class="text-left p-3" colspan="4">{{$consultation->others}}</td>
        </tr>
    </tbody>
</table>
</div>
@endforeach