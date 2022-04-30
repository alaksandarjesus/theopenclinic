<div class="overflow-auto">
<table class="table-auto w-full pharmacy-invoice">
    <thead>
        <tr>
            <th class="border border-gray-200 p-3 w-8">S.No</th>
            <th class="border border-gray-200 p-3 w-8"></th>
            <th class="border border-gray-200 p-3">Drug</th>
            <th class="border border-gray-200 p-0 w-32">Qty</th>
            <th class="border border-gray-200 p-0 w-32">Price</th>
            <th class="border border-gray-200 p-0 w-32">Tax (%)</th>
            <th class="border border-gray-200 p-0 w-32">Total</th>

        </tr>
    </thead>
    <tbody>
        @if(!empty($invoice->uuid))
        @include('pharmacy.invoices.components.items')
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th colspan="6" class="border border-gray-200 p-0  pr-2 text-right font-medium">Subtotal</th>
            <td class="border border-gray-200 p-0">
                <input type="text" class="form-control w-32 subtotal text-right bg-white format-numeral-value"
                    value="{{$invoice->subtotal?$invoice->formatted->subtotal:'0.00'}}" readonly>

            </td>
        </tr>
        <tr>
            <th colspan="6" class="border border-gray-200 p-0  pr-2 text-right font-medium">Tax</th>
            <td class="border border-gray-200 p-0">
                <input type="text" class="form-control w-32 taxtotal text-right bg-white format-numeral-value"
                    value="{{$invoice->tax?$invoice->formatted->tax:'0.00'}}" readonly>

            </td>
        </tr>
        <tr>
            <th colspan="6" class="border border-gray-200 p-0  pr-2 text-right font-medium">Discount</th>

            <td class="border border-gray-200 p-0">
                <input type="text" class="form-control w-32 discount text-right bg-white format-numeral-value"
                    value="{{$invoice->discount?$invoice->formatted->discount:'0.00'}}">
            </td>
        </tr>
        <tr>
            <th colspan="6" class="border border-gray-200 p-0  pr-2 text-right font-medium">Total</th>
            <td class="border border-gray-200 p-0">
                <input type="text" class="form-control w-32 finaltotal text-right bg-white format-numeral-value"
                    value="{{$invoice->total?$invoice->formatted->total:'0.00'}}" readonly>
            </td>
        </tr>
        <tr>
            <td colspan="7" class="td-comments">
                <textarea class="form-control comments w-full h-32" placeholder="Any comments"></textarea>
            </td>
        </tr>
    </tfoot>
</table>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="flex justify-end items-center">
            <button class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 mr-2 btn-submit" data-submitted="0" type="button">Save</button>
            <button class="bg-green-700 hover:bg-green-800 text-white py-2 px-4 btn-submit" data-submitted="1" type="button">Submit</button>
        </div>
    </div>
</div>

<script type="text/html" id="pharmacyInvoiceTableRow">
<tr>
    <td class="border border-gray-200 p-0 text-center"></td>
    <td class="border border-gray-200 p-0 text-center">
    @if(request()->has('user') && request()->user->is_super_administrator)
        <button type="button" class="btn btn-outline-danger btn-delete-row btn-sm" data-tippy-content="Delete">
            @include('components.icons', ['icon'=> 'delete'])
        </button>
        @endif
    </td>
    <td class="border border-gray-200 p-0 text-center">
        <select class="form-select drug w-full">
            <option value="">Select Drug</option>
            @foreach($drugs as $drug)
            <option value="{{$drug->uuid}}" data-price="{{$drug->price}}" data-tax="{{$drug->tax}}">{{$drug->name}}
                ({{$drug->unit}})</option>
            @endforeach
        </select>
    </td>
    <td class="border border-gray-200 p-0">
        <input type="text" class="form-control w-32 qty update-row-total text-right format-numeral-value" value="0">
    </td>
    <td class="border border-gray-200 p-0">
        <input type="text" class="form-control w-32 price update-row-total text-right format-numeral-value" value="0">
    </td>
    <td class="border border-gray-200 p-0">
        <input type="text" class="form-control w-32 tax update-row-total text-right add-new-row format-numeral-value"
            value="0">
    </td>
    <td class="border border-gray-200 p-0">
        <input type="text" class="form-control w-32 total text-right bg-white format-numeral-value" value="0" readonly>
    </td>

</tr>
</script>