<div class="grid grid-cols-3 gap-3 mb-3">
    <div class="form-group">
        <label for="" class="block mb-1 font-medium">Purchase Order Number</label>
        <input type="text" name="orderNumber" value="{{$order->order_number}}" class="block w-full order_number"
            autocomplete="current-orderNumber" autofocus>
    </div>
    <div class="form-group">
        <label for="" class="block mb-1 font-medium">Purchase Order Date</label>
        <input type="text" name="orderDate" value="{{$order->order_date?$order->formatted->order_date:''}}"
            class="block w-full order_date" autocomplete="current-orderDate" autofocus>
    </div>
    <div class="form-group">
        <div class="form-group">
            <label for="" class="block mb-1 font-medium">Supplier</label>
            <select name="supplier" class="form-select supplier w-full">
                <option value="">Select Supplier</option>
                @foreach($suppliers as $supplier)
                <option value="{{$supplier->uuid}}" @if($order->supplier && ($order->supplier->uuid ===
                    $supplier->uuid))
                    selected
                    @endif
                    >{{$supplier->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
