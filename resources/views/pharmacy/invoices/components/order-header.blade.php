<div class="grid grid-cols-3 gap-3 mb-3">
    <div class="form-group">
        <label for="" class="block mb-1 font-medium">Invoice Number</label>
        <input type="text" name="invoiceNumber" value="{{$invoice->invoice_number}}" class="block w-full invoice_number"
            autocomplete="current-invoiceNumber" autofocus>
    </div>
    <div class="form-group">
        <label for="" class="block mb-1 font-medium">Invoice Date</label>
        <input type="text" name="invoiceDate" value="{{$invoice->invoice_date?$invoice->formatted->invoice_date:''}}"
            class="block w-full invoice_date" autocomplete="current-invoiceDate" autofocus>
    </div>
    <div class="form-group">
        <div class="form-group">
            <label for="" class="block mb-1 font-medium">Customer</label>
            <select name="customer" class="customer w-full">
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                <option value="{{$customer->uuid}}" 
                @if($invoice->customer && ($invoice->customer->uuid === $customer->uuid))
                selected
                @endif
                    >{{$customer->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
