@extends('layouts.top-nav')

@section('content')

<div class="container my-3">
    <div class="flex justify-between items-center">
        <a class="bg-orange-700 hover:bg-orange-800 white-text py-2 px-4 text-white shadow-sm"
            href="{{url('pharmacy/invoices')}}">Invoices</a>
        <a class="bg-yellow-700 hover:bg-yellow-800 white-text py-2 px-4 text-white shadow-sm"
            href="{{url('pharmacy/invoices/'.$invoice->uuid.'/returns')}}">Returns</a>
    </div>
</div>

<div class="container my-3">
    <div class="grid grid-cols-1 lg:grid-cols-2 grid-gap-4">
        <div>
            <div class=""><strong>Invoice</strong></div>
            <div>{{$invoice->invoice_number}}</div>
        </div>
        <div>
            <div class=""><strong>Customer</strong></div>
            <div>{{$invoice->customer->name}}</div>
        </div>
    </div>
</div>

<div class="container">
    <form action="" class="invoice-return-create" data-invoice-uuid="{{$invoice->uuid}}">
    <div class="overflow-auto">
        <table class="table-fixed w-full">
            <thead>
                <tr>
                    <th class="border border-gray-200 p-3">Drug</th>
                    <th class="border border-gray-200 p-3">Sold</th>
                    <th class="border border-gray-200 p-3" style="width:80px">Qty</th>
                    <th class="border border-gray-200 p-3" style="width:100px">Price</th>
                    <th class="border border-gray-200 p-3" style="width:100px">Tax</th>
                    <th class="border border-gray-200 p-3" style="width:100px">Total</th>
                    <th class="border border-gray-200 p-3">Comments</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $item)
                <tr data-item-uuid="{{$item->uuid}}">
                    <td  class="border border-gray-200 p-3">{{$item->drug?$item->drug->name:''}}</td>
                    <td  class="border border-gray-200 p-3">{{$item->formatted->qty}}</td>
                    <td class="border border-gray-200 p-0">
                        <input type="text" class="form-control w-full  qty update-total">
                    </td>
                    <td class="border border-gray-200 p-0">
                        <input type="text" class="form-control w-full  price text-right update-total"
                            value="{{$item->price?$item->formatted->price:''}}">
                    </td>
                    <td class="border border-gray-200 p-0">
                        <input type="text" class="form-control w-full  tax text-right update-total"
                            value="{{$item->tax?$item->formatted->tax:''}}">
                    </td>
                    <td class="border border-gray-200 p-0">
                        <input type="text" class="form-control w-full  total text-right update-total"
                            value="">
                    </td>

                    <td class="border border-gray-200 p-0">
                        <input type="text" class="form-control w-full comments">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
        <button  class=" btn-submit">Submit</button>
    </form>

</div>

@endsection