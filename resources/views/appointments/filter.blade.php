    <div class="w-auto lg:w-3/4">
        <form action=""
            class="appointments-filter  flex flex-col justify-start items-start md:flex-row md:justify-between md:items-center">
            <input type="text" name="date" class="date w-full md:w-36 my-2 md:my-0" placeholder="dd-mm-yyyy"
                value="{{$date}}" />
            @if(request()->has('user') && request()->user->can_view_menu_item(['Front Desk',
            'Administrator', 'Super Administrator']))
            <input type="text" name="doctor" class=" w-full md:w-36 my-2 md:my-0" placeholder="doctor"
                value="{{request()->query('doctor')}}" />
            @endif
            <input type="text" name="patient" class=" w-full md:w-36 my-2 md:my-0" placeholder="patient"
                value="{{request()->query('patient')}}" />
            <button class="py-2 px-4 bg-green-900 text-white  w-full md:w-36 my-2 md:my-0">Search</button>
            @if(request()->has('user') && request()->user->can_view_menu_item(['Front Desk',
            'Administrator', 'Super Administrator']))
            <a href="{{url('appointments/create')}}" class="btn-addnew  w-full md:w-36 my-2 md:my-0">Add New</a>
            @endif
        </form>
    </div>