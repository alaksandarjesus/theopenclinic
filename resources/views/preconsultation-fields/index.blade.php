@extends('layouts.top-nav')

@section('content')


<div class="container">
    <h4 class="font-medium text-xl my-5">Preconsultation Fields</h4>

    <div class="grid grid-cols-1 lg:grid-cols-12 lg:gap-12">
        <div class="col-span-6">
            @include('preconsultation-fields.table')
        </div>
        <div class="col-span-6">
            @include('preconsultation-fields.form')
        </div>
    </div>
</div>

@endsection