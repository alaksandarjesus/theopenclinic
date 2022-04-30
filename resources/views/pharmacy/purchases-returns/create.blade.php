@extends('layouts.top-nav')

@section('content')

<div class="container my-3">
    <div class="flex justify-between items-center">
        <a class="bg-orange-700 hover:bg-orange-800 white-text py-2 px-4 text-white shadow-sm"
            href="{{url('pharmacy/purchases')}}">Purchases</a>
        <a class="bg-yellow-700 hover:bg-yellow-800 white-text py-2 px-4 text-white shadow-sm"
            href="{{url('pharmacy/purchases/'.$order->uuid.'/returns')}}">Returns</a>
    </div>
</div>

<div class="container my-3">
    <div class="grid grid-cols-1 lg:grid-cols-2 grid-gap-4">
        <div>
            <div class=""><strong>Purchase Order</strong></div>
            <div>{{$order->order_number}}</div>
        </div>
        <div>
            <div class=""><strong>Supplier</strong></div>
            <div>{{$order->supplier->name}}</div>
        </div>
    </div>
</div>

<div class="container">
    <form action="" class="purchase-return-create" data-order-uuid="{{$order->uuid}}">
        <div class="overflow-auto">
            <table class="table-fixed w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-200 p-3">Drug</th>
                        <th class="border border-gray-200 p-3" style="width:120px">Received</th>
                        <th class="border border-gray-200 p-3" style="width:120px">Batch</th>
                        <th class="border border-gray-200 p-3" style="width:120px">Expiry</th>

                        <th class="border border-gray-200 p-3" style="width:120px">Qty</th>
                        <th class="border border-gray-200 p-3" style="width:120px">Price</th>
                        <th class="border border-gray-200 p-3" style="width:120px">Tax</th>
                        <th class="border border-gray-200 p-3" style="width:120px">Total</th>

                        <th class="border border-gray-200 p-3" style="width:250px">Comments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    @foreach($item->inventory as $inventory)
                    <tr data-item-uuid="{{$item->uuid}}" data-inventory-uuid="{{$inventory->uuid}}">
                        <td class="border border-gray-200 p-3">{{$item->drug?$item->drug->name:''}}</td>
                        <td class="border border-gray-200 p-3 text-center">{{$inventory->formatted->qty}}</td>
                        <td class="border border-gray-200 p-3">{{$inventory->batch}}</td>
                        <td class="border border-gray-200 p-3">{{$inventory->formatted->expiry_date}}</td>
                        <td class="border border-gray-200 p-0 ">
                            <input type="text" class="form-control  w-full qty update-total text-center">
                        </td>
                        <td class="border border-gray-200 p-0 ">
                            <input type="text" class="form-control  w-full cost text-right update-total"
                                value="{{$item->cost?$item->formatted->cost:''}}">
                        </td>
                        <td class="border border-gray-200 p-0 ">
                            <input type="text" class="form-control  w-full tax text-right update-total"
                                value="{{$item->tax?$item->formatted->tax:''}}">
                        </td>
                        <td class="border border-gray-200 p-0 ">
                            <input type="text" class="form-control  w-full total text-right update-total" value="0.00">
                        </td>

                        <td class="border border-gray-200 p-0 ">
                            <input type="text" class="form-control comments w-full">
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-3">
            <button class="btn-submit">Submit</button>

        </div>
    </form>
</div>

@endsection