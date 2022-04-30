@extends('layouts.top-nav')

@section('content')


<div class="container my-5">
    <h4 class="text-lg font-semibold">Payment Form</h4>
</div>

<div class="container">
    <div>
        @include('payments.appointment.table')
    </div>
    <div>
        <div class="grid grid-cols-1 lg:grid-cols-12 lg:gap-12">
            <div class="lg:col-span-6">
            @include('payments.appointment.history')

            </div>
            <div class="lg:col-span-6">
            @include('payments.appointment.form')
          

            </div>
        </div>
       
    </div>
</div>

@endsection