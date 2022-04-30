@extends('layouts.print')

@section('body')
<div class="container">
    <h4 class="text-center font-semibold text-xl ">Appointment</h4>
</div>
<div class="container">
    <div class="overflow-auto">
        <table class="table-fixed w-full">
            <tr>
                <td colspan="2">
                    <div class="float-right">
                        <div class="mb-2"><strong>Ref</strong>: {{$appointment->uuid}}</div>
                    </div>
                    <div class="float-left">
                        <div class="mb-2"><strong>Date</strong>: {{$appointment->consultation->updated_at}}</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mb-1"><strong>Name: </strong>{{$appointment->doctor->name}}</div>
                    <div class="mb-1"><strong>Email: </strong>{{$appointment->doctor->email}}</div>
                    <div class="mb-1"><strong>Phone: </strong>{{$appointment->doctor->phone}}</div>
                </td>
                <td>
                    <div class="mb-1"><strong>Name: </strong>{{$appointment->patient->name}}</div>
                    <div class="mb-1"><strong>Email: </strong>{{$appointment->patient->email}}</div>
                    <div class="mb-1"><strong>Phone: </strong>{{$appointment->patient->phone}}</div>
                </td>
            </tr>
        </table>
    </div>
    <div class="overflow-auto">
        <table class="summary w-full">
            <tr>
                <th class="p-2 text-left">Complaints</th>

            </tr>
            <tr>
                <td class="summary-complaints p-2 text-left">
                    {{$appointment->consultation->complaints}}
                </td>
            </tr>
            <tr>
                <th class="p-2 text-left">Examination</th>

            </tr>
            <tr>
                <td class="summary-examination p-2 text-left">
                    {{$appointment->consultation->examination}}

                </td>
            </tr>
            <tr>
                <th class="p-2 text-left">Prescription</th>

            </tr>
            <tr>
                <td class="summary-prescription p-2 text-left">
                    @if(!empty($appointment->consultation->prescription->drugs))
                    @include('appointments.print-prescription-table')
                    @endif
                </td>
            </tr>
            <tr>
                <th class="p-2 text-left">Others</th>

            </tr>
            <tr>
                <td class="summary-others p-2 text-left">
                    {{$appointment->consultation->others}}

                </td>
            </tr>
        </table>
    </div>

</div>


@endsection