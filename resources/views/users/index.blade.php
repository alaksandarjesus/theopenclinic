@extends('layouts.top-nav')

@section('content')

<div class="container mt-3">
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center">
        <h4 class="font-medium text-xl ">Users</h4>
        @include('users.filter')
    </div>
</div>

<div class="container mt-3 ">

    @include('users.table')
</div>

@endsection