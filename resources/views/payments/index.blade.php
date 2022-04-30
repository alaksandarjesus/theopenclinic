@extends('layouts.top-nav')

@section('content')


<div class="container my-5">
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center">

        <h4 class="font-medium text-xl my-5">Payments</h4>

        @include('payments.filter')
    </div>
</div>

<div class="container">
    @include('payments.table')

</div>

@endsection