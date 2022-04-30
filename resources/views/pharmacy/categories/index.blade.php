@extends('layouts.top-nav')

@section('content')


<div class="container">
<h4 class="font-medium text-xl my-5">Categories</h4>

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-9">
        @include('pharmacy.categories.table')
        </div>
        <div class="col-span-3">
        @include('pharmacy.categories.form')
        </div>
    </div>
</div>

@endsection