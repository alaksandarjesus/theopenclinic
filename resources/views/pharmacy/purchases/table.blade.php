<div class="overflow-auto">
    <table class="table-auto w-full purchase-orders">
        <thead>
            <tr>
                <th class="border border-gray-200 p-3">S.No</th>
                <th class="border border-gray-200 p-3">Order Number</th>
                <th class="border border-gray-200 p-3">Supplier</th>
                <th class="border border-gray-200 p-3">Items Count</th>
                <th class="border border-gray-200 p-3">Sub Total</th>
                <th class="border border-gray-200 p-3">Tax</th>
                <th class="border border-gray-200 p-3">Discount</th>
                <th class="border border-gray-200 p-3">Total</th>
                <th class="border border-gray-200 p-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
            <tr data-uuid="{{$purchase->uuid}}">
                <td class="border border-gray-200 p-3 text-center">{{$loop->iteration}}</td>

                <td class="border border-gray-200 p-3 order-number">{{$purchase->order_number}}</td>
                <td class="border border-gray-200 p-3">{{$purchase->supplier->name}}</td>
                <td class="border border-gray-200 p-3">{{$purchase->items_count}}</td>
                <td class="border border-gray-200 p-3">{{$purchase->formatted->subtotal}}</td>
                <td class="border border-gray-200 p-3">{{$purchase->formatted->tax}}</td>
                <td class="border border-gray-200 p-3">{{$purchase->formatted->discount}}</td>
                <td class="border border-gray-200 p-3">{{$purchase->formatted->total}}</td>
                <td class="border border-gray-200 p-3">

                    @if(!$purchase->submitted)
                    <div class="flex justify-center items-center">
                        <a href="{{url('pharmacy/purchases/'.$purchase->uuid.'/edit')}}" class="mr-2 btn-edit"
                            data-tippy-content="Edit">
                            @include('components.icons', ['icon'=> 'edit'])
                        </a>
                        @if(request()->has('user') && request()->user->is_super_administrator)
                        <button class="btn-delete" data-tippy-content="Delete">
                            @include('components.icons', ['icon'=> 'delete'])
                        </button>
                        @endif
                    </div>

                    @endif

                    @if($purchase->submitted)
                    <div class="flex justify-between items-center">

                        <a href="{{url('pharmacy/purchases/'.$purchase->uuid.'/returns')}}" class="btn-return"
                            data-tippy-content="Return">
                            @include('components.icons', ['icon'=> 'return'])
                        </a>
                        <a href="{{url('pharmacy/purchases/'.$purchase->uuid.'/inventory')}}" class="btn-inventory"
                            data-tippy-content="Inventry">
                            @include('components.icons', ['icon'=> 'inventory'])

                        </a>
                        <a href="{{url('pharmacy/purchases/'.$purchase->uuid.'/print')}}" class="btn-edit"
                            data-tippy-content="Print">
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