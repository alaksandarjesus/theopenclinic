@extends('layouts.top-nav')

@section('content')


<div class="container my-5">
    <h4 class="text-lg font-semibold">Edit Payment</h4>
</div>

<div class="container">
<form action="" class="payment-edit">
    <input type="hidden" value="{{$payment->uuid}}" class="payment-uuid">
    <input type="hidden" value="{{url('payments')}}" class="redirect">
    <div class="form-group mb-3">
        <label for="" class="block mb-1 font-medium">Amount</label>
        <input type="text" name="amount" value="{{$payment->amount}}" class="block w-full amount" autocomplete="current-amount" autofocus>
    </div>

    <div class="form-group mb-3">
        <label for="" class="block mb-1 font-medium">Comments</label>
        <textarea name="comments" class="block w-full comments">{{$payment->comments}}</textarea>
    </div>
    <div>
        <button
            class=" btn-submit">Submit</button>
    </div>
</form>

</div>

@endsection

