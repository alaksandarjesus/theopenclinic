@extends('layouts.top-nav')

@section('content')

<div class="container my-5">
<div class="flex justify-center items-center">
    <div class="w-full md:w-3/4 lg:w-1/2 2xl:w-1/4">
    <h4 class="text-lg font-semibold">Edit Appointment</h4>
    </div>
</div>
</div>
<div class="container">
    <div class="flex justify-center items-center">

        <form action="" class="edit-appointment  w-full md:w-3/4 lg:w-1/2 2xl:w-1/4">
            <input type="hidden" value="{{$appointment->uuid}}" name="uuid" class="uuid">

            <div class="form-group mb-3">
                <label for="" class="form-label font-medium mb-1">Name</label>
                <div>{{$appointment->patient->name}}</div>
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label font-medium mb-1">Email</label>
                <div>{{$appointment->patient->email}}</div>
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label font-medium mb-1">Mobile</label>
                <div>{{$appointment->patient->mobile}}</div>
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label font-medium mb-1">Doctor</label>
                <select name="doctor" class="doctor form-select w-full">
                    <option value="">Select Doctor</option>
                    @foreach($doctors as $doctor)
                    <option value="{{$doctor->uuid}}" {{$doctor->uuid === $appointment->doctor->uuid? 'selected':''}}>
                        {{$doctor->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-12 gap-2 mb-2">
                <div class="form-group col-span-7">
                <label for="" class="form-label font-medium mb-1">Date</label>

                    <input type="text" class="dater form-control w-full" name="dater"
                        value="{{$appointment->formatted->date}}"
                        data-original-date="{{$appointment->formatted->date}}">
                </div>
                <div class="form-group col-span-5">
                 
                    <label for="" class="form-label font-medium mb-1">Time</label>

                    <select name="time" class="time form-select w-full"
                        data-original-time="{{$appointment->formatted->time}}">
                        <option value="">Select Time</option>
                        @foreach($times as $time)
                        <option value="{{$time}}" {{$appointment->formatted->time == $time?'selected':''}}>{{$time}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>




            <div class="clear-both"></div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 md:gap-3">
                <div class="form-group mb-3">
                    <label for="" class="block mb-1 font-medium">Gender</label>
                    <select name="gender" class="form-select w-full gender">
                        <option value="">Gender</option>
                        <option value="m" {{$appointment->patient->gender === 'm'?'selected':''}}>Male</option>
                        <option value="f" {{$appointment->patient->gender === 'f'?'selected':''}}>Female</option>
                        <option value="o" {{$appointment->patient->gender === 'o'?'selected':''}}>Other</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="block mb-1 font-medium">Date of Birth</label>
                    <input type="text" name="dob" class="block w-full dob" autocomplete="current-dob"
                        value="{{$appointment->patient->formatted->dob}}">
                    <div class="text-sm font-medium text-gray-700 age">{{$appointment->patient->formatted->age}} Years</div>

                </div>
                <div class="form-group mb-3">
                    <label for="" class="block mb-1 font-medium">Blood Group</label>
                    <select name="bloodgroup" class="form-select w-full blood-group">
                        <option value="">Blood Group</option>
                        <option value="O+" {{$appointment->patient->blood_group === 'O+'?'selected':''}}>O+</option>
                        <option value="O-" {{$appointment->patient->blood_group === 'O-'?'selected':''}}>O-</option>
                        <option value="A+" {{$appointment->patient->blood_group === 'A+'?'selected':''}}>A+</option>
                    </select>
                </div>
            </div>
            <button class="btn-update">Update</button>

        </form>
    </div>
</div>

@endsection