<div class="overflow-auto">
<table class="table-auto w-full pharmacy-compositions">
    <thead>
        <tr>
            <th class="border border-gray-200 p-3">S.No</th>
            <th class="border border-gray-200 p-3">Name</th>
            <th class="border border-gray-200 p-3">Email</th>
            <th class="border border-gray-200 p-3">Phone</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($suppliers as $supplier)
            <tr data-uuid="{{$supplier->uuid}}">
                <td class="border border-gray-200 p-3 text-center">{{$loop->iteration}}</td>
                <td class="border border-gray-200 p-3 name">{{$supplier->name}}</td>
                <td class="border border-gray-200 p-3">{{$supplier->email}}</td>
                <td class="border border-gray-200 p-3">{{$supplier->phone}}</td>
                <td class="border border-gray-200 p-3">
                    <div class="flex justify-center items-center">
                        <a href="{{url('pharmacy/suppliers/'.$supplier->uuid.'/edit')}}" class="mr-2 btn-edit"data-tippy-content="Edit">@include('components.icons', ['icon'=> 'edit'])</a>
                        @if(request()->has('user') && request()->user->is_super_administrator)
                        <button class="btn-delete" data-tippy-content="Delete">@include('components.icons', ['icon'=> 'delete'])</button>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>