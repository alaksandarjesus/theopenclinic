@extends('layouts.no-nav')

@section('layout-content')

<div class="container">
    <div class="flex justify-center items-center  ">
        <img class="object-cover h-48 w-half" src="{{asset('images/logo.png')}}">
    </div>
</div>

<div class="container">
    <div class="flex justify-center items-center">
        @include('guest.login.form')
    </div>
</div>

<!-- Remove only {{--  Below Line   -->
{{-- 
    
    @include('guest.login.credentials') 
    
--}}
<!-- Remove only --}}  Above Line -->


@endsection