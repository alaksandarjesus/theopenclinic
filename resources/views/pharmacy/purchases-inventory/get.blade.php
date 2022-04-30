@extends('layouts.top-nav')

@section('content')

<div class="container my-3">
    <div class="flex justify-between items-center">
        <a class="bg-orange-700 hover:bg-orange-800 white-text py-2 px-4 text-white shadow-sm" href="{{url('pharmacy/purchases')}}">Purchases</a>
        <a class="bg-green-700 hover:bg-green-800 white-text py-2 px-4 text-white shadow-sm" href="{{url('pharmacy/purchases/'.$order->uuid.'/inventory/create')}}">Create</a>
    </div>

</div>
<div class="container">
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
    @include('pharmacy.purchases-inventory.table')
</div>

@endsection