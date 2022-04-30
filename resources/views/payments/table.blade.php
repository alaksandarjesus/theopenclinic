<div class="overflow-auto">
<table class="w-full table-auto payments">
    <thead>
        <tr>
            <th class="border border-gray-1 p-3">S.No</th>
            <th class="border border-gray-1 p-3">Doctor</th>
            <th class="border border-gray-1 p-3">Patient</th>
            <th class="border border-gray-1 p-3">Amount</th>
            <th class="border border-gray-1 p-3">Comments</th>
            <th class="border border-gray-1 p-3">Created At</th>
            <th class="border border-gray-1 p-3"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)

        <tr data-uuid="{{$payment->uuid}}">
            <td class="border border-gray-1 p-3 text-center">{{$loop->iteration}}</td>
            <td class="border border-gray-1 p-3">{{$payment->appointment->doctor->name}}</td>
            <td class="border border-gray-1 p-3 name">{{$payment->appointment->patient->name}}</td>
            <td class="border border-gray-1 p-3">{{$payment->amount}}</td>
            <td class="border border-gray-1 p-3">{{$payment->comments}}</td>
            <td class="border border-gray-1 p-3">{{$payment->formatted->date}} {{$payment->formatted->time}}</td>
            <td class="border border-gray-200 p-3">
                <div class="flex justify-center items-center">
                    <a href="{{url('payments/'.$payment->uuid.'/edit')}}" data-tippy-content="Edit"
                        class="mr-2 btn-edit">@include('components.icons', ['icon'=> 'edit'])</a>
                        @if(request()->has('user') && request()->user->is_super_administrator)
                    <button class="btn-delete" data-tippy-content="Delete">@include('components.icons', ['icon'=> 'delete'])</button>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>