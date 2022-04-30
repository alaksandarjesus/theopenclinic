@extends('layouts.print')

@section('body')
<div class="container">
    <h4 class="text-center font-semibold text-xl ">Invoice</h4>
</div>
<div class="container">
    <div class="overflow-auto">
        <table class="table-auto w-full">
            <tr>
                <td colspan="2">
                    <div class="float-right">
                        <div class="mb-2"><strong>Invoice Number</strong>: {{$invoice->invoice_number}}</div>
                        <div class="mb-2"><strong>Date</strong>: {{$invoice->formatted->invoice_date}}</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mb-1"><strong>{{$settings['clinic_name']}}</strong></div>
                    <div class="mb-1"><strong>Address: </strong>{{$settings['clinic_address']}}</div>
                    <div class="mb-1"><strong>Tax Info: </strong> {{$settings['clinic_tax_information']}}</div>
                    <div class="mb-1"><strong>Email: </strong>{{$settings['clinic_email']}}</div>
                    <div class="mb-1"><strong>Phone: </strong>{{$settings['clinic_phone']}}</div>
                </td>
                <td>
                    <div class="mb-1"><strong>{{$invoice->customer->name}}</strong></div>
                    <div class="mb-1"><strong>Address: </strong>{{$invoice->customer->address}}</div>
                    <div class="mb-1"><strong>Tax Info: </strong> {{$invoice->customer->tax_information}}</div>
                    <div class="mb-1"><strong>Email: </strong>{{$invoice->customer->email}}</div>
                    <div class="mb-1"><strong>Phone: </strong>{{$invoice->customer->mobile}}</div>
                </td>
            </tr>
        </table>
    </div>
    <div class="overflow-auto">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th style="width:40px" class="border border-gray-1 p-4">S.NO</th>
                    <th class="border border-gray-1 p-4">Item</th>
                    <th class="border border-gray-1 p-4" style="width:100px">Unit</th>
                    <th class="border border-gray-1 p-4" style="width:100px">Qty</th>
                    <th class="border border-gray-1 p-4" style="width:100px">Price</th>
                    <th class="border border-gray-1 p-4" style="width:100px">Tax (%)</th>
                    <th class="border border-gray-1 p-4" style="width:100px">Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($invoice->items as $item)
                <tr>

                    <td class="border border-gray-1 p-4">{{$loop->iteration}}</td>
                    <td class="border border-gray-1 p-4">{{$item->drug?$item->drug->name:''}}</td>
                    <td class="border border-gray-1 p-4">{{$item->drug?$item->drug->unit:''}}</td>
                    <td class="border border-gray-1 p-4 text-center">{{$item->qty?$item->formatted->qty:'0.00'}}</td>
                    <td class="border border-gray-1 p-4 text-right">{{$item->cost?$item->formatted->cost:'0.00'}}</td>
                    <td class="border border-gray-1 p-4 text-right">{{$item->tax?$item->formatted->tax:'0.00'}}</td>
                    <td class="border border-gray-1 p-4 text-right">{{$item->total?$item->formatted->total:'0.00'}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right border border-gray-1 p-4" colspan="6">SubTotal</th>
                    <td class="text-right border border-gray-1 p-4">
                        {{$invoice->subtotal?$invoice->formatted->subtotal:'0.00'}}</td>
                </tr>
                <tr>
                    <th class="text-right border border-gray-1 p-4" colspan="6">Tax</th>
                    <td class="text-right border border-gray-1 p-4">{{$invoice->tax?$invoice->formatted->tax:'0.00'}}
                    </td>
                </tr>
                <tr>
                    <th class="text-right border border-gray-1 p-4" colspan="6">Discount</th>
                    <td class="text-right border border-gray-1 p-4">
                        {{$invoice->discount?$invoice->formatted->discount:'0.00'}}</td>
                </tr>
                <tr>
                    <th class="text-right border border-gray-1 p-4" colspan="6">Total</th>
                    <td class="text-right border border-gray-1 p-4">
                        {{$invoice->total?$invoice->formatted->total:'0.00'}}</td>
                </tr>
                <tr>
                    <td colspan="7">
                        <strong>In Words: </strong><span class="number-to-text" data-value="{{$invoice->total}}"></span>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


@endsection