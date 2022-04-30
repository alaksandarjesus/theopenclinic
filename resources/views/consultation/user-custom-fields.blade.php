<h4 class="text-lg font-medium my-2">Custom Fields</h4>
<div class="overflow-auto">
<table class="table-fixed w-full">
    <tbody>
    @foreach($user_custom_fields as $field)
    <tr>
        <th class="text-left p-2" style="width: 200px;">{{$field->name}}</th>
        <td class="text-left p-2">{{$appointment->patient->user_custom_value($field->uuid)}}</td>
    </tr>
    @endforeach
    </tbody>


</table>
</div>