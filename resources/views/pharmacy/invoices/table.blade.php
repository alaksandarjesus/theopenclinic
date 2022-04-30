<div class="overflow-auto">
<table class="table-auto w-full invoice-orders">
    <thead>
        <tr>
            <th class="border border-gray-200 p-3">S.No</th>
            <th class="border border-gray-200 p-3">Customer</th>
            <th class="border border-gray-200 p-3">Items Count</th>
            <th class="border border-gray-200 p-3">Sub Total</th>
            <th class="border border-gray-200 p-3">Tax</th>
            <th class="border border-gray-200 p-3">Discount</th>
            <th class="border border-gray-200 p-3">Total</th>
            <th class="border border-gray-200 p-3"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $invoice)

        <tr data-uuid="{{$invoice->uuid}}">
            <td class="border border-gray-200 p-3 text-center">{{$loop->iteration}}</td>
            <td  class="border border-gray-200 p-3">{{$invoice->customer->name}}</td>
            <td class="border border-gray-200 p-3 text-center">{{$invoice->items_count}}</td>
            <td class="border border-gray-200 p-3 text-right">{{$invoice->formatted->subtotal}}</td>
            <td class="border border-gray-200 p-3 text-right">{{$invoice->formatted->tax}}</td>
            <td class="border border-gray-200 p-3 text-right">{{$invoice->formatted->discount}}</td>
            <td class="border border-gray-200 p-3 text-right">{{$invoice->formatted->total}}</td>
            <td class="border border-gray-200 p-3">

            @if(!$invoice->submitted)
                <div class="flex justify-center items-center">
                    <a href="{{url('pharmacy/invoices/'.$invoice->uuid.'/edit')}}" class="mr-2 btn-edit" data-tippy-content="Edit">
                        @include('components.icons', ['icon'=> 'edit'])
                    </a>
                    <button class="btn-delete" data-tippy-content="Delete">
                        @include('components.icons', ['icon'=> 'delete'])
                    </button>
                </div>

                @endif

                @if($invoice->submitted)
                <div class="flex justify-between items-center">

                    <a href="{{url('pharmacy/invoices/'.$invoice->uuid.'/returns')}}" class="btn-return" data-tippy-content="Return">
                        @include('components.icons', ['icon'=> 'return'])
                    </a>
                   
                    <a href="{{url('pharmacy/invoices/'.$invoice->uuid.'/print')}}" class="btn-edit" data-tippy-content="Print">
                        @include('components.icons', ['icon'=> 'print'])
                    </a>
                    @if(request()->has('user') && request()->user->is_super_administrator)
                    <button class="btn-delete" data-tippy-content="Delete">
                        @include('components.icons', ['icon'=> 'delete'])
                    </button>
                    @endif
                </div>

                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>