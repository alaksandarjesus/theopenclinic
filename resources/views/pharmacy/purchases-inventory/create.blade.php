@extends('layouts.top-nav')

@section('content')

<div class="container my-3">
    <div class="flex justify-between items-center">
        <a class="bg-orange-700 hover:bg-orange-800 white-text py-2 px-4 text-white shadow-sm"
            href="{{url('pharmacy/purchases')}}">Purchases</a>
        <a class="bg-yellow-700 hover:bg-yellow-800 white-text py-2 px-4 text-white shadow-sm"
            href="{{url('pharmacy/purchases/'.$order->uuid.'/inventory')}}">Inventory</a>
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
    <form action="" class="purchase-inventory-create" data-order-uuid="{{$order->uuid}}">
        <div class="overflow-auto">
            <table class="table-fixed w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-200 p-3" style="width: 60px">S.No</th>
                        <th class="border border-gray-200 p-3">Drug</th>
                        <th class="border border-gray-200 p-3" style="width:120px">Qty</th>
                        <th class="border border-gray-200 p-3" style="width:120px">Batch</th>
                        <th class="border border-gray-200 p-3" style="width:120px">Expiry</th>
                        <th class="border border-gray-200 p-3" style="width:250px">Comments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr data-item-uuid="{{$item->uuid}}">
                        <td class="border border-gray-200 p-3 text-center">{{$loop->iteration}}</td>
                        <td class="border border-gray-200 p-3">{{$item->drug?$item->drug->name:''}}</td>
                        <td class="border border-gray-200 p-0 ">
                            <input type="text" class="form-control qty  w-full">
                        </td>
                        <td class="border border-gray-200 p-0 ">
                            <input type="text" class="form-control batch  w-full">
                        </td>
                        <td class="border border-gray-200 p-0">
                            <input type="text" class="form-control expiry_date  w-full">
                        </td>
                        <td class="border border-gray-200 p-0">
                            <input type="text" class="form-control comments w-full">
                        </td>
                    </tr>
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