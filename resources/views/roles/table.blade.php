<div class="overflow-auto">
<table class="table-auto roles w-full">
    <thead>
        <tr>
            <th class="border border-gray-200 p-3">S.No</th>
            <th class="border border-gray-200 p-3">Name</th>
            <th class="border border-gray-200 p-3">Users Count</th>
            <th class="border border-gray-200 p-3"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
            <tr data-uuid="{{$role->uuid}}">
                <td class="border border-gray-200 p-3 text-center">{{$loop->iteration}}</td>
                <td class="border border-gray-200 p-3 name">{{$role->name}}</td>
                <td class="border border-gray-200 p-3 text-center">{{$role->users_count}}</td>
                <td class="border border-gray-200 p-3">
                    <div class="flex justify-center items-center">
                        <button class="mr-2 btn-edit" data-tippy-content="Edit" data-tippy-content="Edit">@include('components.icons', ['icon'=> 'edit'])</button>
                        @if(request()->has('user') && request()->user->is_super_administrator)
                        <button class="btn-delete" data-tippy-content="Delete" data-tippy-content="Delete">@include('components.icons', ['icon'=> 'delete'])</button>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>