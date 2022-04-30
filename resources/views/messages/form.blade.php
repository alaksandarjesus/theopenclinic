@extends('layouts.top-nav')

@section('content')

<div class="container my-5">
    <div class="flex justify-center items-center">
        <div class="w-1/3">
            <div class="flex justify-between items-center">
                <h4 class="text-lg font-semibold">{{empty($message->uuid)?'Create':'Reply'}} Message</h4>
            </div>
        </div>
    </div>
</div>

@if($message->uuid)
@include('messages.history');
@endif


<div class="container my-5">
    <div class="flex justify-center items-center">
        <div class="w-1/3">

            <form action="" class="message">
                <input type="hidden" name="uuid" class="uuid" value="{{$message->uuid}}">
                <textarea name="description" class="description w-full rounded h-48"></textarea>
                @if(request()->has('user') && request()->user->is_super_administrator)
                <div class="flex justify-between items-center">
                    <div>

                        <button type="button" class="text-red-800 btn-delete" data-tippy-content="Delete">Delete</button>

                    </div>
                    <div>
                        <button class="btn-submit">Submit</button>
                    </div>
                </div>

                @else
                <div>
                    <button class="btn-submit">Submit</button>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>

@endsection