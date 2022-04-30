@extends('layouts.top-nav')

@section('content')


<div class="container mt-3">
    <form action="" class="appointment-consultation">
        <input type="hidden" class="appointment-uuid" value="{{$appointment->uuid}}">
 
            <div class="grid grid-cols-1 lg:grid-cols-12 lg:gap-4 tabs">
                <div class="lg:col-span-3">@include('consultation.tabs.tab-header')</div>
                <div class="lg:col-span-9"> 
                @include('consultation.tabs.tab-body')
                @include('consultation.tabs.tab-nav')
                </div>
            </div>
            
           
    </form>
</div>

@endsection