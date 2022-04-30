@extends('layouts.top-nav')

@section('content')
<div class="container my-3">
    <div class="flex justify-end items-center">
        <div>
            @include('pharmacy.drugs.history-filter')
        </div>
    </div>
</div>

<div class="container w-full ">
    <div class="grid grid-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
        @if(request()->has('user') && request()->user->is_super_administrator ||
        request()->user->is_administrator)

        <div class="  h-40 p-3 bg-white shadow-md rounded-md bg-orange-200">
            <div class="inline-flex items-center justify-center absolute w-12 h-12 bg-white rounded-full">
                @include('components.icons',
                ['icon'=>
                'appointment', 'className' => 'fill-gray-700'])</div>
            <h4 class="text-base font-medium justify-center flex  text-slate-700">Appointments</h4>
            <div class="flex justify-center items-center my-3">
                <h4 class="text-5xl font-medium text-slate-800">{{$args->appointments}}</h4>
            </div>
        </div>
        <div class="h-40 p-3 shadow-md rounded-md bg-green-200">
            <div class="inline-flex items-center absolute justify-center  w-12 h-12 bg-white rounded-full">
                @include('components.icons',
                ['icon'=>
                'consultation', 'className' => 'fill-gray-700'])</div>
            <h4 class="text-base font-medium justify-center flex  text-slate-700">Consultations</h4>
            <div class="flex justify-center items-center my-3">
                <h4 class="text-5xl font-medium text-slate-800">{{$args->consultations}}</h4>

            </div>

        </div>
        <div class="h-40 p-3 shadow-md rounded-md bg-pink-200">
            <div class="inline-flex items-center justify-center absolute w-12 h-12 bg-white rounded-full">
                @include('components.icons',
                ['icon'=>
                'payments', 'className' => 'fill-gray-700'])</div>
            <h4 class="text-base font-medium  flex justify-center text-slate-700">Payments</h4>
            <div class="flex justify-center items-center my-3">
                <h4 class="text-5xl font-medium text-slate-800">{{$args->payments}}</h4>
            </div>
        </div>
        <div class="h-40 p-3 shadow-md rounded-md bg-yellow-200">
            <div class="inline-flex absolute items-center  justify-center  w-12 h-12 bg-white rounded-full">
                @include('components.icons',
                ['icon'=>
                'purchase', 'className' => 'fill-gray-700'])</div>
            <h4 class="text-base font-medium flex justify-center items-center text-slate-700">Purchases</h4>
            <div class="flex justify-center items-center my-3">
                <h4 class="text-5xl font-medium text-slate-800">{{$args->purchases}}</h4>
            </div>
        </div>
        <div class="h-40 p-3 shadow-md rounded-md bg-purple-200">
            <div class="inline-flex items-center justify-center absolute  w-12 h-12 bg-white rounded-full">
                @include('components.icons',
                ['icon'=>
                'purchase-return', 'className' => 'fill-gray-700'])</div>
            <h4 class="text-base font-medium justify-center flex text-slate-700">Purchase Returns</h4>
            <div class="flex justify-center items-center my-3">
                <h4 class="text-5xl font-medium text-slate-800">{{$args->purchase_returns}}</h4>
            </div>
        </div>
        <div class="h-40 p-3 shadow-md rounded-md bg-sky-200">
            <div class="inline-flex items-center justify-center absolute w-12 h-12 bg-white rounded-full">
                @include('components.icons',
                ['icon'=>
                'invoice', 'className' => 'fill-gray-700'])</div>
            <h4 class="text-base font-medium justify-center flex  text-slate-700">Invoices</h4>
            <div class="flex justify-center items-center my-3">
                <h4 class="text-5xl font-medium text-slate-800">{{$args->invoices}}</h4>
            </div>
        </div>
        <div class="h-40 p-3 shadow-md rounded-md bg-emerald-200">
            <div class="inline-flex items-center absolute justify-center  w-12 h-12 bg-white rounded-full">
                @include('components.icons',
                ['icon'=>
                'invoice-return', 'className' => 'fill-gray-700'])</div>
            <h4 class="text-base font-medium justify-center flex  text-slate-700">Invoice Returns</h4>
            <div class="flex justify-center items-center my-3">
                <h4 class="text-5xl font-medium text-slate-800">{{$args->invoice_returns}}</h4>
            </div>
        </div>
        <div class="h-40 p-3 shadow-md rounded-md bg-blue-200">
            <div class="inline-flex items-center justify-center absolute w-12 h-12 bg-white rounded-full">
                @include('components.icons',
                ['icon'=>
                'expenditure', 'className' => 'fill-gray-700'])</div>
            <h4 class="text-base font-medium  justify-center flex text-slate-700">Expenditure</h4>
            <div class="flex justify-center items-center my-3">
                <h4 class="text-5xl font-medium text-slate-800">{{$args->expenditures}}</h4>
            </div>
        </div>
        
        @endif
        @if(request()->has('user') && request()->user->is_pharmacist)
        <div class="h-40 p-3 shadow-md rounded-md bg-sky-200">
            <div class="inline-flex items-center justify-center absolute w-12 h-12 bg-white rounded-full">
                @include('components.icons',
                ['icon'=>
                'invoice', 'className' => 'fill-gray-700'])</div>
            <h4 class="text-base font-medium justify-center flex  text-slate-700">Invoices</h4>
            <div class="flex justify-center items-center my-3">
                <h4 class="text-5xl font-medium text-slate-800">{{$args->invoices}}</h4>

            </div>
        </div>
        <div class="h-40 p-3 shadow-md rounded-md bg-emerald-200">
            <div class="inline-flex items-center absolute justify-center  w-12 h-12 bg-white rounded-full">
                @include('components.icons',
                ['icon'=>
                'payments', 'className' => 'fill-gray-700'])</div>
            <h4 class="text-base font-medium justify-center flex  text-slate-700">Invoice Returns</h4>
            <div class="flex justify-center items-center my-3">
                <h4 class="text-5xl font-medium text-slate-800">{{$args->invoice_returns}}</h4>

            </div>
        </div>
        @endif
        @if(request()->has('user') && request()->user->is_frontdesk)
        <div class="h-40 p-3 bg-white shadow-md rounded-md bg-orange-200">
            <div class="inline-flex items-center justify-center absolute w-12 h-12 bg-white rounded-full">
                @include('components.icons',
                ['icon'=>
                'appointment', 'className' => 'fill-gray-700'])</div>
            <h4 class="text-base font-medium justify-center flex  text-slate-700">Appointments</h4>
            <div class="flex justify-center items-center my-3">
                <h4 class="text-5xl font-medium text-slate-800">{{$args->appointments}}</h4>

            </div>

        </div>
        @endif
        @if(request()->has('user') && request()->user->is_doctor)
        <div class="h-40 p-3 bg-white shadow-md rounded-md bg-orange-200">
            <div class="inline-flex items-center justify-center absolute w-12 h-12 bg-white rounded-full">
                @include('components.icons',
                ['icon'=>
                'appointment', 'className' => 'fill-gray-700'])</div>
            <h4 class="text-base font-medium justify-center flex  text-slate-700">Appointments</h4>
            <div class="flex justify-center items-center my-3">
                <h4 class="text-5xl font-medium text-slate-800">{{$args->appointments}}</h4>

            </div>

        </div>

        <div class="h-40 p-3 shadow-md rounded-md bg-green-200">
            <div class="inline-flex items-center absolute justify-center  w-12 h-12 bg-white rounded-full">
                @include('components.icons',
                ['icon'=>
                'payments', 'className' => 'fill-gray-700'])</div>
            <h4 class="text-base font-medium justify-center flex  text-slate-700">Consultations</h4>
            <div class="flex justify-center items-center my-3">
                <h4 class="text-5xl font-medium text-slate-800">{{$args->consultations}}</h4>

            </div>

        </div>
        @endif
    </div>
</div>

@endsection