<h4 class="text-lg font-medium my-2">Summary</h4>

<div class="overflow-auto">
    <table class="w-full">
        <tr>
            <th class="p-2 text-left">Patient Name</th>
            <td class="p-2 text-left">{{$appointment->patient->name}}</td>
        </tr>
        <tr>
            <th class="p-2 text-left">Patient Age</th>
            <td class="p-2 text-left">{{$appointment->patient->formatted->age}}</td>
        </tr>
    </table>
    <table class="w-full">
        <tr>
            <th class="p-2 text-left">Patient Email</th>
            <td class="p-2 text-left">{{$appointment->patient->email}}</td>
        </tr>
        <tr>
            <th class="p-2 text-left">Patient Mobile</th>
            <td class="p-2 text-left">{{$appointment->patient->mobile}}</td>
        </tr>
    </table>
</div>
<hr class="border border-2 height-4 bg-slate-400">
<div class="overflow-auto">
    <table class="summary w-full">
        <tr>
            <th class="p-2 text-left">Complaints</th>

        </tr>
        <tr>
            <td class="summary-complaints p-2 text-left"></td>
        </tr>
        <tr>
            <th class="p-2 text-left">Examination</th>

        </tr>
        <tr>
            <td class="summary-examination p-2 text-left"></td>
        </tr>
        <tr>
            <th class="p-2 text-left">Prescription</th>

        </tr>
        <tr>
            <td class="summary-prescription p-2 text-left"></td>
        </tr>
        <tr>
            <th class="p-2 text-left">Others</th>

        </tr>
        <tr>
            <td class="summary-others p-2 text-left"></td>
        </tr>
    </table>
</div>
<div class="flex justify-center items-center">
    <button class="bg-emerald-800 hover:bg-emerald-900 text-white px-4 py-2 shadow-lg btn-submit">Submit</button>
</div>


@include('consultation.summary.prescription-table')