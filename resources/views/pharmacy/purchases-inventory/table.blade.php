<div class="overflow-auto">
<table class="table-auto w-full purchase-inventory-list-table" data-order-uuid="{{$order->uuid}}">
    <thead>
        <tr>
            <th class="border border-gray-200 p-3">Drug</th>
            <th class="border border-gray-200 p-3">Qty</th>
            <th class="border border-gray-200 p-3">Batch</th>
            <th class="border border-gray-200 p-3">Expiry</th>
            <th class="border border-gray-200 p-3">Comments</th>
            <th  class="border border-gray-200 p-3"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        @foreach($item->inventory as $inventory)
        <tr data-inventory-uuid="{{$inventory->uuid}}">
            <td  class="border border-gray-200 p-3 name">{{$item->drug->name}}</td>
            <td  class="border border-gray-200 p-3">{{$inventory->qty}}</td>
            <td  class="border border-gray-200 p-3">{{$inventory->batch}}</td>
            <td  class="border border-gray-200 p-3">{{$inventory->expiry_date?$inventory->formatted->expiry_date:NULL}}</td>
            <td class="border border-gray-200 p-3">{{$inventory->comments}}</td>

            <td  class="border border-gray-200 p-3">
                <div class="flex justify-center items-center">
                    <a href="{{url('pharmacy/purchases/'.$order->uuid.'/inventory/'.$inventory->uuid.'/edit')}}"
                        class="mr-2 btn-edit" data-tippy-content="Edit">@include('components.icons', ['icon'=> 'edit'])</a>
                        @if(request()->has('user') && request()->user->is_super_administrator)
                        <button class="btn-delete" data-tippy-content="Delete">@include('components.icons', ['icon'=> 'delete'])</button>
                        @endif

                </div>
            </td>
        </tr>
        @endforeach
        @endforeach
    </tbody>
</table>
</div>