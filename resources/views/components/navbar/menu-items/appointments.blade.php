@if(request()->has('user') && request()->user->can_view_menu_item(['Super Administrator', 'Administrator']))
<div class="relative dropdown ">
    <button class="dropdown-trigger mx-2 py-4 px-3 hover:bg-teal-700 text-white ">Appointments
    </button>
    <div class="absolute dropdown-menu bg-white shadow-md py-3 top-14 right-5 w-48 hidden">
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('appointments/create')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Create</a>
            <a href="{{url('appointments')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Appointments</a>
        </div>
    </div>
</div>
@endif
@if(request()->has('user') && request()->user->can_view_menu_item(['Doctor']))
<div class="">
<a href="{{url('appointments')}}" class="dropdown-trigger mx-2 py-4 px-3 hover:bg-teal-700 text-white">Appointments</a>
</div>
@endif
@if(request()->has('user') && request()->user->can_view_menu_item(['Front Desk']))
<div class="">
<a href="{{url('appointments/create')}}" class="dropdown-trigger mx-2 py-4 px-3 hover:bg-teal-700 text-white">Create</a>
<a href="{{url('appointments')}}" class="dropdown-trigger mx-2 py-4 px-3 hover:bg-teal-700 text-white">Appointments</a>
</div>
@endif