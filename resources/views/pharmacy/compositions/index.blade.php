@extends('layouts.top-nav')

@section('content')


<div class="container">
<h4 class="font-medium text-xl my-5">Compositions</h4>

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-9">
        @include('pharmacy.compositions.table')
        </div>
        <div class="col-span-3">
        @include('pharmacy.compositions.form')
        </div>
    </div>
</div>

@endsection