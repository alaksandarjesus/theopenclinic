@extends('layouts.top-nav')

@section('content')


<div class="container my-5">
    <div class="flex justify-center items-center  ">

        <div class="w-full md:w-3/4 lg:w-1/2 2xl:w-1/4">
            <h4 class="text-lg font-semibold">Create Appointment</h4>
        </div>
    </div>
</div>
<div class="container ">
    <div class="flex justify-center items-center  ">

        <form action="" class="create-appointment w-full md:w-3/4 lg:w-1/2 2xl:w-1/4">
            <div class="mb-2">
                <button type="button" class="btn-create-appointment-search-users float-right">Search
                    Users</button>
            </div>
            <div class="clear-both"></div>
            <input type="hidden" name="uuid" class="uuid">
            <div class="clearfix"></div>
            <div class="form-group mb-2">
                <label for="" class="form-label font-medium mb-1">Name</label>
                <input type="text" name="name" class="name form-control w-full" autofocus>
            </div>

            <div class="form-group mb-2">
                <label for="" class="form-label font-medium mb-1">Email</label>
                <input type="text" name="email" class="email form-control w-full">
            </div>
            <div class="form-group mb-2">
                <label for="" class="form-label font-medium mb-1">Mobile</label>
                <input type="text" name="mobile" class="mobile form-control w-full">
            </div>
            <div class="form-group mb-2">
                <label for="" class="form-label font-medium mb-1">Doctor</label>
                <select name="doctor" class="doctor form-select w-full">
                    <option value="">Select Doctor</option>
                    @foreach($doctors as $doctor)
                    <option value="{{$doctor->uuid}}">{{$doctor->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-2 mb-2">
                <div class="form-group md:col-span-7">
                    <label for="" class="form-label font-medium mb-1">Date</label>
                    <input type="text" class="dater form-control w-full" name="dater">
                </div>
                <div class="form-group md:col-span-5">
                    <label for="" class="form-label font-medium mb-1">Time</label>
                    <select name="time" class="time form-select w-full">
                        <option value="">Select Time</option>
                        @foreach($times as $time)
                        <option value="{{$time}}">{{$time}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 md:gap-3">
                <div class="form-group mb-3">
                    <label for="" class="block mb-1 font-medium">Gender</label>
                    <select name="gender" class="form-select w-full gender">
                        <option value="">Gender</option>
                        <option value="m">Male</option>
                        <option value="f">Female</option>
                        <option value="o">Other</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="block mb-1 font-medium">Date of Birth</label>
                    <input type="text" name="dob" class="block w-full dob" autocomplete="current-dob" value="">
                    <div class="text-sm font-medium text-gray-700 age"></div>

                </div>
                <div class="form-group mb-3">
                    <label for="" class="block mb-1 font-medium">Blood Group</label>
                    <select name="bloodgroup" class="form-select w-full blood-group">
                        <option value="">Blood Group</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="A+">A+</option>
                    </select>
                </div>
            </div>
            <button class="btn-create">Create</button>
        </form>
    </div>
</div>
@endsection

@section('page-templates')

@include('components.modals.search-users')

@endsection