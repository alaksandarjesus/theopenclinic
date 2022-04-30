<div class="overflow-auto">
<table class="table-auto w-full invoice-returns-list-table" data-invoice-uuid="{{$invoice->uuid}}">
    <thead>
        <tr>
            <th class="border border-gray-200 p-3">Drug</th>
            <th class="border border-gray-200 p-3">Qty</th>
            <th class="border border-gray-200 p-3">Price</th>
            <th class="border border-gray-200 p-3">Tax</th>
            <th class="border border-gray-200 p-3">Total</th>
            <th class="border border-gray-200 p-3">Comments</th>
            <th class="border border-gray-200 p-3"></th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($returns as $return)
        <tr data-return-uuid="{{$return->uuid}}">
            <td class="border border-gray-200 p-3 name">{{$return->item->drug->name}}</td>
            <td class="border border-gray-200 p-3 text-center">{{$return->formatted->qty}}</td>
            <td class="border border-gray-200 p-3 text-right">{{$return->formatted->price}}</td>
            <td class="border border-gray-200 p-3 text-center">{{$return->formatted->tax}}</td>
            <td class="border border-gray-200 p-3 text-right">{{$return->formatted->total}}</td>
            <td class="border border-gray-200 p-3">{{$return->comments}}</td>
            <td class="border border-gray-200 p-3">
                <div class="flex justify-center items-center">
                    <a href="{{url('pharmacy/invoices/'.$invoice->uuid.'/returns/'.$return->uuid.'/edit')}}"
                        class="mr-2 btn-edit" data-tippy-content="Edit">@include('components.icons', ['icon'=> 'edit'])</a>
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