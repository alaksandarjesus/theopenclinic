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
<div class="overflow-auto">
    <table class="table-auto w-full">
        <tr>
            <th class="border border-gray-100 p-3">Drug</th>
            <th class="border border-gray-100 p-3">Batch</th>
            <th class="border border-gray-100 p-3">Expiry Date</th>

        </tr>
        <tr>
            <td class="border border-gray-100 p-3">{{$return->item->drug->name}}</td>
            <td class="border border-gray-100 p-3">{{$return->item->batch}}</td>
            <td class="border border-gray-100 p-3">{{$return->item->expiry_date}}</td>
        </tr>
    </table>
</div>
</div>

<div class="container my-2">
    <form class="container invoice-return-edit" data-invoice-uuid="{{$invoice->uuid}}"
        data-return-uuid="{{$return->uuid}}">
        <div class="overflow-auto">
        <table class="table-auto w-full">
            <tr>
                <th class="border border-gray-100 p-3">Quantity</th>
                <th class="border border-gray-100 p-3">Unit Price</th>
                <th class="border border-gray-100 p-3">Tax</th>
                <th class="border border-gray-100 p-3">Total</th>
            </tr>
            <tr>
                <td class="border border-gray-100 p-0">
                    <input type="text" class="form-control qty update-total w-full text-center"
                        value="{{$return->formatted->qty}}">
                </td>
                <td class="border border-gray-100 p-0">
                    <input type="text" class="form-control price update-total  w-full text-right"
                        value="{{$return->formatted->price}}">
                </td>
                <td class="border border-gray-100 p-0">
                    <input type="text" class="form-control tax update-total  w-full text-center"
                        value="{{$return->formatted->tax}}">
                </td>
                <td class="border border-gray-100 p-0">
                    <input type="text" class="form-control total  w-full text-right"
                        value="{{$return->formatted->total}}" readonly>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-100 p-0" colspan="4">
                    <textarea class="form-control comments  w-full"
                        placeholder="comments">{{$return->comments}}</textarea>

                </td>

            </tr>
        </table>
</div>
        <div>
            <button
                class="btn-submit">Submit</button>

        </div>
    </form>
</div>

@endsection