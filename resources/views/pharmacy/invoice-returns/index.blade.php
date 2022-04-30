@extends('layouts.top-nav')

@section('content')

<div class="container my-3">
    <div class="flex justify-between items-center">
        <a class="bg-orange-700 hover:bg-orange-800 white-text py-2 px-4 text-white shadow-sm" 
        href="{{url('pharmacy/invoices')}}">Invoices</a>
        <a class="bg-green-700 hover:bg-green-800 white-text py-2 px-4 text-white shadow-sm" 
        href="{{url('pharmacy/invoices/'.$invoice->uuid.'/returns/create')}}">Create</a>
    </div>
</div>
<div class="container">
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
    @include('pharmacy.invoice-returns.table')
</div>
@endsection