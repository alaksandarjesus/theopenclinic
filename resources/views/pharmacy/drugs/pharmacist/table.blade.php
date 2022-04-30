<div class="overflow-auto">
<table class="table-auto w-full pharmacy-drugs">
    <thead>
        <tr>
        <th class="border border-gray-200 p-3">S.No</th>

            <th class="border border-gray-200 p-3">Name</th>
            <th class="border border-gray-200 p-3">Price</th>
            <th class="border border-gray-200 p-3">Tax</th>
            <th class="border border-gray-200 p-3">Orders</th>
            <th class="border border-gray-200 p-3">Recieved</th>
            <th class="border border-gray-200 p-3">Transit</th>
            <th class="border border-gray-200 p-3">Stocks</th>
            <th class="border border-gray-200 p-3">Purchases Returns</th>
            <th class="border border-gray-200 p-3">Inventory</th>
            <th class="border border-gray-200 p-3">Inventory Returns</th>
        </tr>
    </thead>
    <tbody>
        @foreach($drugs as $drug)
            <tr data-uuid="{{$drug->uuid}}">
                <td class="border border-gray-200 p-3 text-center">{{$loop->iteration}}</td>
                <td class="border border-gray-200 p-3 name">
                    <div>{{$drug->name}}</div>
                    <div class="text-sm text-gray-700">{{$drug->category->name}}</div>
                </td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->price}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->tax}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->ordered}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->received}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->transit}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->in_stock}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->purchase_returned}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->invoiced}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->invoice_returned}}</td>
            </tr>
           
        @endforeach
    </tbody>
</table>
</div>

