@extends('layouts.top-nav')

@section('content')


<div class="container mt-3">
    <div class="flex justify-between items-center">
        <h4 class="font-medium text-xl ">Suppliers</h4>

        <div class="mr-3">
            @include('pharmacy.suppliers.filter')
        </div>
    </div>
</div>

<div class="container mt-3">
    @include('pharmacy.suppliers.table')

</div>


@endsection