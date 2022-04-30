@extends('layouts.top-nav')

@section('content')
<div class="container">
    <form action="" class="flex justify-center items-center  pharmacy-supplier">
        <input type="hidden" class="uuid" value="{{$supplier->uuid}}">

        <div class="w-full lg:w-1/2">
            <h4 class="text-slate-900 text-xl font-medium my-3">{{$supplier->uuid?'Edit':'Create'}} Supplier</h4>
            <input type="hidden" name="uuid" class="uuid">
            <div class="form-group mb-3">
                <label for="" class="block mb-1 font-medium">Name</label>
                <input type="text" name="name" value="{{$supplier->name}}" class="block w-full name">
            </div>
            <div class="form-group mb-3">
                <label for="" class="block mb-1 font-medium">Email</label>
                <input type="text" name="email" value="{{$supplier->email}}" class="block w-full email">
            </div>
            <div class="form-group mb-3">
                <label for="" class="block mb-1 font-medium">Phone</label>
                <input type="text" name="phone" value="{{$supplier->phone}}" class="block w-full phone">
            </div>
            <div class="form-group mb-3">
                <label for="" class="block mb-1 font-medium">Tax Information</label>
                <input type="text" name="tax_information" value="{{$supplier->tax_information}}"
                    class="block w-full tax_information">
            </div>
            <div class="form-group mb-3">
                <label for="" class="block mb-1 font-medium">Address</label>
                <textarea name="address" class="address w-full h-24">{{$supplier->address}}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="" class="block mb-1 font-medium">Description</label>
                <textarea name="description" class="description w-full h-24">{{$supplier->description}}</textarea>
            </div>
            <div>
                <button
                    class="btn-submit">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection