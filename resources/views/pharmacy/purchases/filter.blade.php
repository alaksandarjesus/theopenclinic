<form action="" class="flex justify-start items-start">
    <div class="form-group mr-2">
        <select name="supplier" class="form-select supplier">
            <option value="">Select Suppliers</option>
            @foreach($suppliers as $supplier)
            <option value="{{$supplier->uuid}}" {{$supplier->uuid === request()->query('supplier')?'selected':''}}>{{$supplier->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mr-2">
        <input type="text" name="q" class="form-control" placeholder="Search...." value="{{request()->query('q')}}">
    </div>
    <button class="bg-orange-700 hover:bg-orange-900 text-white py-2 px-4 mr-2">Search</button>
    <a href="{{url('pharmacy/purchases/create')}}" class="btn-addnew">Add New</a>
</form>