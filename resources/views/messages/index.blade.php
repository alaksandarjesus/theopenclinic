@extends('layouts.top-nav')

@section('content')

<div class="container my-5">
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center">
        <h4 class="text-lg font-semibold">Messages</h4>
        @include('messages.filter')
    </div>
    <div class="w-full my-5">
        @include('messages.table')
        </div>
    
</div>


@endsection