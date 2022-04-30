@extends('layouts.top-nav')

@section('content')


<div class="container ">
    <h4 class="font-medium text-xl my-5">Roles</h4>
    <div class="grid grid-cols-1 lg:grid-cols-12 lg:gap-12">
        <div class="lg:col-span-6">
            @include('roles.table')
        </div>
        <div class="lg:col-span-6">
            @include('roles.form')
        </div>
    </div>
</div>

@endsection