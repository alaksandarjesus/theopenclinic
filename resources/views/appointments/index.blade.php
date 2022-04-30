@extends('layouts.top-nav')

@section('content')

<div class="container my-5">
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center">
        <h4 class="text-lg font-semibold">Appointments</h4>
        @include('appointments.filter')
    </div>
</div>


<div class="container ">
    <div class="flex justify-between items-center my-2">
        <div>
            <a href="{{url('/appointments?date='.$previous_date)}}" class="arrow-back"
                data-tippy-content="{{$previous_date}}">@include('components.icons',
                ['icon'=>
                'arrow-back', 'className' => 'fill-gray-700'])</a>

        </div>
        <div>
            @if($today !== $date)
            <a href="{{url('/appointments')}}" class="pin-drop"
                data-tippy-content="{{$today}}">@include('components.icons',
                ['icon'=>
                'today', 'className' => 'fill-gray-700'])</a>
            @endif
        </div>
        <div>
            <a href="{{url('/appointments?date='.$next_date)}}" class="arrow-forward "
                data-tippy-content="{{$next_date}}">@include('components.icons',
                ['icon'=>
                'arrow-forward', 'className' => 'fill-gray-700'])</a>
        </div>
    </div>

    @include('appointments.table')
</div>


@endsection