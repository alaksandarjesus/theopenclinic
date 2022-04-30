<div class="overflow-auto">
<table class="table-auto users w-full">
    <thead>
        <tr>
            <th class="border border-gray-200 p-3">S.No</th>
            <th class="border border-gray-200 p-3">Role</th>
            <th class="border border-gray-200 p-3">Username</th>
            <th class="border border-gray-200 p-3">Name</th>
            <th class="border border-gray-200 p-3">Email</th>
            <th class="border border-gray-200 p-3">Mobile</th>
            <th class="border border-gray-200 p-3"></th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
            <tr class="{{$user->blocked?'bg-red-100':''}}" data-uuid="{{$user->uuid}}" data-edit-url="{{url('/users/'.$user->uuid.'/edit')}}">
                <td class="border border-gray-200 p-3 text-center">{{$loop->iteration}}</td>
                <td class="border border-gray-200 p-3">
                <div>
                    @foreach($user->role_names as $role)
                    {{$role}}{{!$loop->last?', ':''}}
                    @endforeach
                    </div>
                </td>
                <td class="border border-gray-200 p-3">{{$user->username}}</td>
                <td class="border border-gray-200 p-3 name">
                    <div>{{$user->name}}</div>
                </td>
                <td class="border border-gray-200 p-3">{{$user->email}}</td>
                <td class="border border-gray-200 p-3">{{$user->mobile}}</td>
                <td class="border border-gray-200 p-3">
                    <div class="flex justify-center items-center">
                        <a class="mr-2 btn-edit" data-tippy-content="Edit" href="{{url('users/'.$user->uuid.'/edit')}}">@include('components.icons', ['icon'=> 'edit'])</a>
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

<div class="clear-both"></div>
<div class="flex justify-end items-center my-3">
{{ $users->links('vendor.pagination.tailwind') }}
</div>