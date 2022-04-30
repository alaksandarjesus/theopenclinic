<form action="" class="flex justify-start items-start">
    <div class="form-group mr-2">
        <select name="composition" class="form-select composition">
            <option value="">Select Composition</option>
            @foreach($compositions as $composition)
            <option value="{{$composition->uuid}}" {{$composition->uuid === request()->query('composition')?'selected':''}}>{{$composition->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mr-2">
        <select name="category" class="form-select category">
            <option value="">Select Category</option>
            @foreach($categories as $category)
            <option value="{{$category->uuid}}" {{$category->uuid === request()->query('category')?'selected':''}}>{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mr-2">
        <input type="text" name="q" class="form-control" placeholder="Search...." value="{{request()->query('q')}}">
    </div>
    <button class="bg-orange-700 hover:bg-orange-900 text-white py-2 px-4 mr-2">Search</button>
    <a href="{{url('pharmacy/drugs/create')}}" class="btn-addnew">Add New</a>
</form>