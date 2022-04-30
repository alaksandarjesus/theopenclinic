@extends('layouts.top-nav')

@section('content')


<div class="container my-3 ">
    <div class="flex justify-center items-center">
        <div class="w-full md:w-1/3 2xl:w-1/4">
            <h4 class="text-slate-900 text-xl font-medium my-3">Profile</h4>
            <div class="overflow-auto">
                <table class="table-auto w-full">
                    <tr>
                        <th class="text-left p-2 border border-gray-200">Name:</th>
                        <td class="text-left p-2 border border-gray-200">{{$user->name}}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 border border-gray-200">Username:</th>
                        <td class="text-left p-2 border border-gray-200">{{$user->username}}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 border border-gray-200">Email:</th>
                        <td class="text-left p-2 border border-gray-200">{{$user->email}}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 border border-gray-200">Mobile:</th>
                        <td class="text-left p-2 border border-gray-200">{{$user->mobile}}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 border dorder-gray-200">Gender:</th>
                        <td class="text-left p-2 border border-gray-200">{{$user->gender}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection