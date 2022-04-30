@extends('layouts.top-nav')

@section('content')
<div class="container">
    <form class="flex justify-center items-center pharmacy-drug">
        <input type="hidden" class="uuid" value="{{$drug->uuid}}">
        <div class="w-full lg:w-1/2">
            <h4 class="text-slate-900 text-xl font-medium my-3">{{$drug->uuid?'Edit':'Create'}} Drug</h4>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                <div>
                    <div class="form-group mb-3">
                        <label for="" class="block mb-1 font-medium">Name</label>
                        <input type="text" name="name" class="block w-full name" autocomplete="current-name" autofocus
                            value="{{$drug->name}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="block mb-1 font-medium">Unit</label>
                        <input type="text" name="unit" class="block w-full unit" autocomplete="current-unit"
                            value="{{$drug->unit}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="block mb-1 font-medium">Compositions</label>
                        <select name="compositions" class="form-select w-full compositions" multiple>
                            @foreach($compositions as $composition)
                                <option value="{{$composition->uuid}}"
                                @foreach($drug->compositions as $drug_composition)
                                {{$drug_composition->uuid === $composition->uuid?'selected':''}}
                                @endforeach
                                >{{$composition->name}}</option>
                            @endforeach
                        </select>
                        <div class="text-sm font-normal text-gray-400">Ctrl+Click to select multiple compositions</div>
                    </div>
                </div>
                <div>
                <div class="form-group mb-3">
                        <label for="" class="block mb-1 font-medium">Category</label>
                        <select name="category" class="form-select w-full category">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->uuid}}"
                                {{$drug->category && $drug->category->uuid === $category->uuid?'selected':''}}
                                >{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="block mb-1 font-medium">Cost</label>
                        <input type="text" name="cost" class="block w-full cost" autocomplete="current-cost"
                            value="{{$drug->cost}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="block mb-1 font-medium">Tax (%)</label>
                        <input type="text" name="tax" class="block w-full tax" autocomplete="current-tax"
                            value="{{$drug->tax}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="block mb-1 font-medium">Price</label>
                        <input type="text" name="price" class="block w-full price" autocomplete="current-price"
                            value="{{$drug->price}}">
                    </div>
                </div>

            </div>
            <div class="form-group mb-3">
                <label for="" class="block mb-1 font-medium">Description</label>
                <textarea name="description" class="description w-full h-24">{{$drug->description}}</textarea>
            </div>
            <div class="flex justify-end items-center">
                <button
                    class="btn-submit">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection