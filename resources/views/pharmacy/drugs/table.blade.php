<div class="overflow-auto">
    <table class="table-auto w-full pharmacy-drugs">
        <thead>
            <tr>
                <th class="border border-gray-200 p-3">S.No</th>

                <th class="border border-gray-200 p-3">Name</th>
                <th class="border border-gray-200 p-3">Cost</th>
                <th class="border border-gray-200 p-3">Price</th>
                <th class="border border-gray-200 p-3">Tax</th>
                <th class="border border-gray-200 p-3">Ordered</th>
                <th class="border border-gray-200 p-3">Received</th>
                <th class="border border-gray-200 p-3">Transit</th>
                <th class="border border-gray-200 p-3">Stocks</th>
                <th class="border border-gray-200 p-3">Purchase Return</th>
                <th class="border border-gray-200 p-3">Invoice</th>
                <th class="border border-gray-200 p-3">Invoice Return</th>
                <th class="border border-gray-200 p-3"></th>
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
                <td class="border border-gray-200 p-3 text-center">{{$drug->cost}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->price}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->tax}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->ordered}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->received}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->transit}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->in_stock}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->purchase_returned}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->invoiced}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$drug->invoice_returned}}</td>
                <td class="border border-gray-200 p-3">
                    <div class="flex justify-between items-center">
                        <a href="{{url('pharmacy/drugs/'.$drug->uuid.'/history')}}" class="mr-2 btn-manage-history"
                            data-tippy-content="Manage History">@include('components.icons', ['icon'=> 'manage-history',
                            'className'=>'fill-yellow-800'])</a>
                        <button class="mr-2 btn-refresh" data-tippy-content="Sync">@include('components.icons',
                            ['icon'=> 'sync'])</button>
                        <a href="{{url('pharmacy/drugs/'.$drug->uuid.'/edit')}}" class="mr-2 btn-edit"
                            data-tippy-content="Edit">@include('components.icons', ['icon'=> 'edit'])</a>
                        @if(request()->has('user') && request()->user->is_super_administrator)
                        <button class="btn-delete" data-tippy-content="Delete">@include('components.icons', ['icon'=>
                            'delete'])</button>
                        @endif
                    </div>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>