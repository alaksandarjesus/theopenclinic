<div class="container my-5">
    <h4 class="text-lg font-semibold">History</h4>
</div>
<div class="overflow-auto">
    <table class="table-layout w-full">
        <thead>
            <tr>
                <th class="border border-gray-1 p-3">S.No</th>
                <th class="border border-gray-1 p-3">Amount</th>
                <th class="border border-gray-1 p-3">Comments</th>
            </tr>
        </thead>
        @foreach($appointment->payments as $payment)
        <tbody>
            <tr>
                <td class="border border-gray-1 p-3">{{$loop->iteration}}</td>
                <td class="border border-gray-1 p-3">{{$payment->amount}}</td>
                <td class="border border-gray-1 p-3">{{$payment->comments}}</td>
            </tr>
        </tbody>

        @endforeach

    </table>
</div>