<div class="relative dropdown ">
    <button class="dropdown-trigger mx-2 py-4 px-3 hover:bg-teal-700 text-white"> 
   @include('components.icons', ['icon'=>
                            'person-outline', 'className' => 'fill-white'])
    </button>
    <div class="absolute dropdown-menu bg-white shadow-md py-3 top-14 right-5 w-48 hidden">
        <div class="flex justify-start items-start flex-col">
            <a href="javascript:void(0)" class="hover:bg-gray-100 w-full px-5 py-2">{{request()->has('user')?request()->user->name:''}}</a>
            <a href="{{url('profile')}}" class="hover:bg-gray-100 w-full px-5 py-2">Profile</a>
            <a href="{{url('messages')}}" class="hover:bg-gray-100 w-full px-5 py-2 block lg:hidden">Messages
    </a>
            <a href="{{url('logout')}}" class="hover:bg-gray-100 w-full px-5 py-2 ">Logout</a>
        </div>
    </div>
</div>