<div class="form-group mb-2">
    <div class="flex justify-between items-center">
        <label for="" class="block mb-1 font-medium">Complaints</label>
        <button type="button" class="speech-to-text" data-target=".complaints" data-status="off">Start</button>
    </div>
    <textarea name="complaints" class="block w-full complaints h-48">{{$consultation->complaints}}</textarea>
    <div class="speech-to-text--instructions"></div>
</div>