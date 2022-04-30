<form action="" class="appointment-payment-form">
    <input type="hidden" value="{{$appointment->uuid}}" class="appointment-uuid">
    <input type="hidden" value="{{url('appointments')}}" class="redirect">
    <div class="form-group mb-3">
        <label for="" class="block mb-1 font-medium">Amount</label>
        <input type="text" name="amount" value="" class="block w-full amount" autocomplete="current-amount" autofocus>
    </div>

    <div class="form-group mb-3">
        <label for="" class="block mb-1 font-medium">Comments</label>
        <textarea name="comments" class="block w-full comments"></textarea>
    </div>
    <div>
        <button
            class=" btn-submit">Submit</button>
    </div>
</form>
<div class="clear-both"></div>
