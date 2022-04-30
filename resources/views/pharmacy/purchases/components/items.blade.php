@foreach($order->items as $item)
<tr data-item-uuid="{{$item->uuid}}">
    <td class="border border-gray-200 p-0 text-center">{{$loop->iteration}}</td>
    <td class="border border-gray-200 p-0 text-center">
        @if($loop->index)
        <button type="button" class="btn btn-outline-danger btn-delete-row btn-sm"><span
                class="material-icons-outlined">delete</span></button>
                @endif
    </td>
    <td class="border border-gray-200 p-0">
        <select name="" id="" class="form-select drug w-full">
            <option value="">Select Drug</option>
            @foreach($drugs as $drug)
            <option value="{{$drug->uuid}}" data-cost="{{$drug->cost}}" data-tax="{{$drug->tax}}"
            @if($item->drug && ($item->drug->uuid === $drug->uuid))
            selected
            @endif
            >{{$drug->name}}
                ({{$drug->unit}})</option>
            @endforeach
        </select>
    </td>
    <td class="border border-gray-200 p-0">
        <input type="text" class="form-control qty update-row-total w-32 text-right format-numeral-value" value="{{$item->qty?$item->formatted->qty:'0.00'}}">
    </td>
    <td class="border border-gray-200 p-0">
        <input type="text" class="form-control cost update-row-total w-32 text-right format-numeral-value" value="{{$item->cost?$item->formatted->cost:'0.00'}}">
    </td>
    <td class="border border-gray-200 p-0">
        <input type="text" class="form-control tax update-row-total w-32 text-right add-new-row format-numeral-value"
            value="{{$item->tax?$item->formatted->tax:'0.00'}}">
    </td>
    <td class="border border-gray-200 p-0">
        <input type="text" class="form-control total w-32 text-right bg-white format-numeral-value" value="{{$item->total?$item->formatted->total:'0.00'}}" readonly>
    </td>
    
</tr>

@endforeach