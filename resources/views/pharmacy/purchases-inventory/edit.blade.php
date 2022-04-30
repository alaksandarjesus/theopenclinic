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
    <form class="purchase-inventory-edit" data-order-uuid="{{$order->uuid}}" data-inventory-uuid="{{$inventory->uuid}}">
        <div class="row">
            <div class="col-sm-12">
                <div class="overflow-auto">
                    <table class="table table-bordered">
                        <tr>
                            <th class="p-3">Drug</th>
                            <td>{{$inventory->item->drug->name}}</td>
                        </tr>
                        <tr>
                            <th class="p-3">Quantity</th>
                            <td class="p-0">
                                <input type="text" class="form-control qty" value="{{$inventory->qty}}">
                            </td>
                        </tr>
                        <tr>
                            <th class="p-3">Batch</th>
                            <td class="p-0">
                                <input type="text" class="form-control batch" value="{{$inventory->batch}}">
                            </td>
                        </tr>
                        <tr>
                            <th class="p-3">Expiry</th>
                            <td class="p-0">
                                <input type="text" class="form-control expiry_date"
                                    value="{{$inventory->expiry_date?$inventory->formatted->expiry_date:NULL}}">
                            </td>
                        </tr>
                        <tr>
                            <th class="p-3">Comments</th>
                            <td class="p-0">
                                <input type="text" class="form-control comments" value="{{$inventory->comments}}">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="my-3">
                <button class="btn-submit">Submit</button>

            </div>
        </div>
    </form>
</div>

@endsection