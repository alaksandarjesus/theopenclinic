@extends('layouts.top-nav')

@section('content')


<div class="container my-5">
    <h4 class="text-lg font-semibold">Pre Consultation Form</h4>
</div>

<div class="container">
    <div class="grid grid-cols-1 lg:grid-cols-12 lg:gap-12">
        <div class="profile-wrapper lg:col-span-6">
            @include('preconsultation.profile')
            @include('preconsultation.user-custom-values')
        </div>
        <div class="form-wrapper lg:col-span-6">
            @include('preconsultation.form')
        </div>
    </div>
</div>

@endsection