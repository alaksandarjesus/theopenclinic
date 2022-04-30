@extends('layouts.print')

@section('body')
<div class="container">
    <h4 class="text-center font-semibold text-xl ">Purchase Order</h4>
</div>
<div class="container">
    <div class="overflow-auto">
        <table class="table-auto w-full">
            <tr>
                <td colspan="2">
                    <div class="float-right">
                        <div class="mb-2"><strong>Purchase Order Number</strong>: {{$order->order_number}}</div>
                        <div class="mb-2"><strong>Date</strong>: {{$order->formatted->order_date}}</div>
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
                    <div class="mb-1"><strong>{{$order->supplier->name}}</strong></div>
                    <div class="mb-1"><strong>Address: </strong>{{$order->supplier->address}}</div>
                    <div class="mb-1"><strong>Tax Info: </strong> {{$order->supplier->tax_information}}</div>
                    <div class="mb-1"><strong>Email: </strong>{{$order->supplier->email}}</div>
                    <div class="mb-1"><strong>Phone: </strong>{{$order->supplier->phone}}</div>
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
                    <th style="width:100px" class="border border-gray-1 p-4">Unit</th>
                    <th style="width:100px" class="border border-gray-1 p-4">Qty</th>
                    <th style="width:100px" class="border border-gray-1 p-4">Price</th>
                    <th style="width:100px" class="border border-gray-1 p-4">Tax (%)</th>
                    <th style="width:100px" class="border border-gray-1 p-4">Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($order->items as $item)
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
                        {{$order->subtotal?$order->formatted->subtotal:'0.00'}}
                    </td>
                </tr>
                <tr>
                    <th class="text-right border border-gray-1 p-4" colspan="6">Tax</th>
                    <td class="text-right border border-gray-1 p-4">{{$order->tax?$order->formatted->tax:'0.00'}}</td>
                </tr>
                <tr>
                    <th class="text-right border border-gray-1 p-4" colspan="6">Discount</th>
                    <td class="text-right border border-gray-1 p-4">
                        {{$order->discount?$order->formatted->discount:'0.00'}}
                    </td>
                </tr>
                <tr>
                    <th class="text-right border border-gray-1 p-4" colspan="6">Total</th>
                    <td class="text-right border border-gray-1 p-4">{{$order->total?$order->formatted->total:'0.00'}}
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <strong>In Words: </strong><span class="number-to-text" data-value="{{$order->total}}"></span>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


@endsection