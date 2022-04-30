<nav class="primary w-full bg-teal-900 shadow-lg ">
    <div class="container mx-auto ">
        <div class="flex justify-between items-center">
            <button class="md:hidden mx-2 py-4 px-3 hover:bg-teal-700 text-white btn-toggle-nav">
                @include('components.icons', ['icon'=>
                'menu', 'className' => 'fill-white'])
            </button>
            <div class="brand py-4 px-3 sm:px-0">
                <a href="javacript:void(0)" class="text-white text-xl font-medium">AMS Clinic</a>
            </div>
            <div class="hidden md:flex  justify-start items-center flex-row ">

                @include('components.navbar.menu-items.dashboard')

                @if(request()->has('user') && request()->user->can_view_menu_item(['Super Administrator', 'Front Desk',
                'Administrator', 'Doctor']))
                @include('components.navbar.menu-items.appointments')
                @endif

                @if(request()->has('user') && request()->user->can_view_menu_item(['Super Administrator',
                'Administrator']))
                @include('components.navbar.menu-items.super-admin')
                @endif

                @if(request()->has('user') && request()->user->can_view_menu_item(['Super Administrator',
                'Administrator', 'Pharmacist']))

                @include('components.navbar.menu-items.pharmacy')
                @endif


                @include('components.navbar.menu-items.messages')

                @include('components.navbar.menu-items.user')

            </div>
            <div class="flex md:hidden  justify-start items-center flex-row toggle-parent">
            
                @include('components.navbar.menu-items.user')
            </div>

        </div>
    </div>
</nav>

@include('components.navbar.sidenav-left')