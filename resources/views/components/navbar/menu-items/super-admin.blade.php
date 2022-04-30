<div class="relative dropdown ">
    <button class="dropdown-trigger mx-2 py-4 px-3 hover:bg-teal-700 text-white ">Super Admin
    </button>
    <div class="absolute dropdown-menu bg-white shadow-md py-3 top-14 right-5 w-48 hidden">
        <div class="flex justify-start items-start flex-col">
        @if(request()->has('user') && request()->user->can_view_menu_item(['Super Administrator']))
            <a href="{{url('roles')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Roles</a>
            <a href="{{url('settings')}}" class="hover:bg-gray-100 w-full px-5 py-2">Settings</a>
            @endif
            <a href="{{url('users')}}" class="hover:bg-gray-100 w-full px-5 py-2">Users</a>
            <a href="{{url('expenditures')}}" class="hover:bg-gray-100 w-full px-5 py-2">Expenditures</a>
            <a href="{{url('payments')}}" class="hover:bg-gray-100 w-full px-5 py-2">Payments</a>
            <a href="{{url('preconsultation-fields')}}" class="hover:bg-gray-100 w-full px-5 py-2">Pre Consultation Fields</a>
            <a href="{{url('user-custom-fields')}}" class="hover:bg-gray-100 w-full px-5 py-2">User Custom Fields</a>
        </div>
    </div>
</div>