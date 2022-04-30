@extends('layouts.top-nav')

@section('content')
<div class="container my-5">
<h4 class="font-medium text-xl my-4">{{$order->uuid?'Edit':'Create'}} Order</h4>

    <form action="" class="purchase-order">
        <div>
            <input type="hidden" name="uuid" class="uuid" value="{{$order->uuid}}">
        </div>
        @include('pharmacy.purchases.components.order-header')
        @include('pharmacy.purchases.components.order-body')
    </form>
</div>



@endsection