@extends('layouts.top-nav')

@section('content')


<div class="container">
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center">
        <h4 class="font-medium text-xl my-5">Expenditures</h4>
            @include('expenditures.filter')
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 lg:gap-12">
        <div class="col-span-6">
            @include('expenditures.table')
        </div>
        <div class="col-span-6">
            @include('expenditures.form')
        </div>
    </div>
</div>

@endsection