<div class="form-group mb-2">
    <div class="flex justify-between items-center">
        <label for="" class="block mb-1 font-medium">Others</label>
        <button type="button" class="speech-to-text" data-target=".others" data-status="off">Start</button>
    </div>
    <textarea name="others" class="block w-full others h-48">{{$consultation->others}}</textarea>
    <div class="speech-to-text--instructions"></div>
</div>