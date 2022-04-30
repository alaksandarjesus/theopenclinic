<div class="overflow-auto">
<table class="table-auto w-full user-custom-fields">
    <thead>
        <tr>
            <th class="border border-gray-200 p-3">S.No</th>
            <th class="border border-gray-200 p-3">Name</th>
            <th class="border border-gray-200 p-3">Order</th>
            <th class="border border-gray-200 p-3">Type</th>
            <th class="border border-gray-200 p-3">Values</th>
            <th class="border border-gray-200 p-3"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($fields as $field)
            <tr data-uuid="{{$field->uuid}}">
                <td class="border border-gray-200 p-3 text-center">{{$loop->iteration}}</td>
                <td class="border border-gray-200 p-3 name">{{$field->name}}</td>
                <td class="border border-gray-200 p-3 order">{{$field->order}}</td>
                <td class="border border-gray-200 p-3 type">{{$field->type}}</td>
                <td class="border border-gray-200 p-3 values">{{$field->values}}</td>
                <td class="border border-gray-200 p-3">
                    <div class="flex justify-center items-center">
                        <button class="mr-2 btn-edit" data-tippy-content="Edit">@include('components.icons', ['icon'=> 'edit'])</button>
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