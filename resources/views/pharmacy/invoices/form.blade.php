@extends('layouts.top-nav')

@section('content')
<div class="container my-5">
    <h4 class="font-medium text-xl my-4">{{$invoice->uuid?'Edit':'Create'}} Invoice</h4>
    <form action="" class="pharmacy-invoice">
        <div>
            <input type="hidden" name="uuid" class="uuid" value="{{$invoice->uuid}}">
        </div>
        @include('pharmacy.invoices.components.order-header')
        @include('pharmacy.invoices.components.order-body')
    </form>
</div>
@endsection