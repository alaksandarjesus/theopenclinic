<h4 class="text-lg font-medium my-2">Custom Fields</h4>
<form action="" class="appointment-user-custom-value-form">
    <input type="hidden" class="user-uuid" value="{{$appointment->patient->uuid}}">
    @foreach($user_custom_fields as $field)

    @if($field->type === 'text')
    <div class="form-group mb-3">
        <label for="" class="block mb-1 font-medium">{{$field->name}}</label>
        <input type="text" value="{{$appointment->patient->user_custom_value($field->uuid)}}" class="block w-full {{$field->name}} field" data-uuid="{{$field->uuid}}" placeholder="Enter {{$field->name}}">
    </div>
    @endif

    @if($field->type === 'select')
    <div class="form-group mb-3">
        <label for="" class="block mb-1 font-medium">{{$field->name}}</label>
        <select class="{{$field->name}} w-full field" data-uuid="{{$field->uuid}}">
            <option value="">Select {{$field->name}}</option>
            @foreach($field->values_as_array as $value)
            <option value="{{$value}}" 
            {{$appointment->patient->user_custom_value($field->uuid) === $value?'selected':''}}
            >{{$value}}</option>
            @endforeach
        </select>
    </div>
    @endif

    @if($field->type === 'checkbox')
    <div class="form-group mb-3">
        <div>
            <label for="" class="block mb-1 font-medium">{{$field->name}}</label>
        </div>
        @foreach($field->values_as_array as $value)
        <label for="" class="inline-block mr-3 font-medium">
            <input type="checkbox" name="{{$field->name}}[]" value="{{$value}}" class="field" data-uuid="{{$field->uuid}}"
            {{$appointment->patient->user_custom_value($field->uuid, $value) === $value?'checked':''}}
            
            >
            <span class="ml-1">{{$value}}</span>
        </label>
        @endforeach

    </div>
    @endif

    @if($field->type === 'radio')
    <div class="form-group mb-3">
        <div>
            <label for="" class="mb-1 font-medium">{{$field->name}}</label>
        </div>
        @foreach($field->values_as_array as $value)
        <label for="" class="inline-block mr-3 font-medium">
            <input type="radio" name="{{$field->name}}" value="{{$value}}" class="field" data-uuid="{{$field->uuid}}"
            {{$appointment->patient->user_custom_value($field->uuid) === $value?'checked':''}}
            
            >
            <span class="ml-1">{{$value}}</span>
        </label>
        @endforeach

    </div>
    @endif

    @endforeach
    <div class="flex justify-end items-center">
    <button
            class="btn-submit">Submit</button>

    </div>
</form>