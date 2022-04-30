@extends('layouts.top-nav')

@section('content')


<div class="container mt-3">
    <div class="flex justify-between items-center">
        <h4 class="font-medium text-xl ">Invoices</h4>
        <div class="mr-3">
            @include('pharmacy.invoices.filter')
        </div>
    </div>
</div>

<div class="container mt-3">
    @include('pharmacy.invoices.table')
</div>

@endsection