@extends('layouts.top-nav')

@section('content')


<div class="container mt-3">
    <div class="flex justify-between items-center">
        <h4 class="font-medium text-xl ">Drugs</h4>

        <div class="mr-3">
            @include('pharmacy.drugs.filter')
        </div>
    </div>
</div>

<div class="container mt-3">
@include('pharmacy.drugs.pharmacist.table')

</div>


@endsection