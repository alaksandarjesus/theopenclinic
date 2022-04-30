<div class="form-group mb-2">
    <div class="flex justify-between items-center">
        <label for="" class="block mb-1 font-medium">Examination</label>
        <button type="button" class="speech-to-text" data-target=".examination" data-status="off">Start</button>
    </div>
    <textarea name="examination" class="block w-full examination h-48">{{$consultation->examination}}</textarea>
    <div class="speech-to-text--instructions"></div>
</div>
