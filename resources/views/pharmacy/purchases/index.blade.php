@extends('layouts.top-nav')

@section('content')


<div class="container mt-3">
    <div class="flex justify-between items-center">
        <h4 class="font-medium text-xl ">Purchases</h4>

        <div class="mr-3">
            @include('pharmacy.purchases.filter')
        </div>
    </div>
</div>

<div class="container mt-3">
@include('pharmacy.purchases.table')


</div>


@endsection