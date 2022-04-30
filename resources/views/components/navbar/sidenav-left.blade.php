<nav class="sidenav fixed top-0 left-0 z-[1000] h-screen w-screen hidden shadow-lg">
    <div class="items-wrapper w-4/5 bg-white h-screen overflow-auto">
        <div class="flex justify-start items-start">
            <a href="{{url('dashboard')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Dashboard
            </a>
        </div>
        @if(request()->has('user') && request()->user->can_view_menu_item(['Super Administrator',
        'Administrator']))
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('appointments/create')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Create Appointment</a>
        </div>
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('appointments')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Appointments</a>
        </div>
        @if(request()->has('user') && request()->user->can_view_menu_item(['Super Administrator']))
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('roles')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Roles</a>

        </div>
        @endif
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('users')}}" class="hover:bg-gray-100 w-full px-5 py-2">Users</a>
        </div>
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('expenditures')}}" class="hover:bg-gray-100 w-full px-5 py-2">Expenditures</a>
        </div>
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('payments')}}" class="hover:bg-gray-100 w-full px-5 py-2">Payments</a>
        </div>
        @if(request()->has('user') && request()->user->can_view_menu_item(['Super Administrator']))
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('settings')}}" class="hover:bg-gray-100 w-full px-5 py-2">Settings</a>
        </div>
        @endif
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('preconsultation-fields')}}" class="hover:bg-gray-100 w-full px-5 py-2">Pre Consultation
                Fields</a>
        </div>
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('user-custom-fields')}}" class="hover:bg-gray-100 w-full px-5 py-2">User Custom Fields</a>
        </div>
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('pharmacy/categories')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Categories</a>
        </div>
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('pharmacy/compositions')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Compositions</a>
        </div>
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('pharmacy/drugs')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Drugs</a>
        </div>
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('pharmacy/suppliers')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Suppliers</a>
        </div>
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('pharmacy/purchases')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Purchases</a>
        </div>
        <div class="flex justify-start items-start flex-col">
            <a href="{{url('pharmacy/invoices')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Invoices</a>
        </div>
    </div>
    @endif
    @if(request()->has('user') && request()->user->can_view_menu_item(['Pharmacist']))
    <div class="flex justify-start items-start flex-col">
        <a href="{{url('pharmacy/drugs')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Drugs</a>
    </div>
    <div class="flex justify-start items-start flex-col">
        <a href="{{url('pharmacy/invoices')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Invoices</a>
    </div>
    @endif

    @if(request()->has('user') && request()->user->can_view_menu_item(['Front Desk']))
    <div class="flex justify-start items-start flex-col">
        <a href="{{url('appointments/create')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Create Appointment</a>
    </div>
    <div class="flex justify-start items-start flex-col">
        <a href="{{url('appointments')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Appointments</a>
    </div>
    @endif

    @if(request()->has('user') && request()->user->can_view_menu_item(['Doctor']))
    <div class="flex justify-start items-start flex-col">
        <a href="{{url('appointments')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Appointments</a>
    </div>
    @endif

</nav>