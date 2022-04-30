
<script type="text/html" id="consultation-prescription-table-tr-html">
<tr>
<td class="p-2 border border-gray-200 text-center">
        <button class="btn-delete text-center" type="button"
        data-tippy-content="Delete">@include('components.icons', ['icon'=>'delete'])
    </button>
    </td>
    <td class="p-0 border border-gray-200">
        <select name="drug" class="drug w-full">
            <option value="">Select Drugs</option>
            @foreach($drugs as $drug)
            <option value="{{$drug->uuid}}" data-compositions='@json($drug->compositions)'>{{$drug->name}}</option>
            @endforeach
        </select>
    </td>
    <td class="p-0 border border-gray-200">
        <input type="text" name="days" class="days w-full text-center" value="0">
    </td>
    <td class="p-0 border border-gray-200">
        <input type="text" name="bb" class="bb w-full text-center" value="0">
    </td>
    <td class="p-0 border border-gray-200">
        <input type="text" name="ab" class="ab w-full text-center" value="0">
    </td>
    <td class="p-0 border border-gray-200">
        <input type="text" name="bl" class="bl w-full text-center" value="0">
    </td>
    <td class="p-0 border border-gray-200">
        <input type="text" name="al" class="al w-full text-center" value="0">
    </td>
    <td class="p-0 border border-gray-200">
        <input type="text" name="be" class="be w-full text-center" value="0">
    </td>
    <td class="p-0 border border-gray-200">
        <input type="text" name="ae" class="ae w-full text-center" value="0">
    </td>
    <td class="p-0 border border-gray-200">
        <input type="text" name="bd" class="bd w-full text-center" value="0">
    </td>
    <td class="p-0 border border-gray-200">
        <input type="text" name="ad" class="ad w-full text-center create-next-row" value="0">
    </td>

</tr>
</script>