<div class="overflow-auto">
<table class="table-auto w-full pharmacy-categories">
    <thead>
        <tr>
        <th class="border border-gray-200 p-3">S.No</th>

            <th class="border border-gray-200 p-3">Name</th>
            <th class="border border-gray-200 p-3"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr data-uuid="{{$category->uuid}}">
                <td class="border border-gray-200 p-3 text-center">{{$loop->iteration}}</td>
                <td class="border border-gray-200 p-3 name">{{$category->name}}</td>
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