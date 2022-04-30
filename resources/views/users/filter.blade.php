<div class="w-auto lg:w-1/2">
    <form action=""
        class=" w-full flex flex-col justify-start items-start md:flex-row md:justify-between md:items-center">
            <select name="role" class=" role w-full md:w-36 my-2 md:my-0">
                <option value="">All Roles</option>
                @foreach($roles as $role)
                <option value="{{$role->uuid}}" {{$role->uuid === request()->query('role')?'selected':''}}>
                    {{$role->name}}</option>
                @endforeach
            </select>
        
            <input type="text" name="q" class="w-full md:w-36 my-2 md:my-0" placeholder="Search...."
                value="{{request()->query('q')}}">
        <button class="bg-orange-700 hover:bg-orange-900 w-full md:w-auto text-white py-2 px-4  my-2 md:my-0">Search</button>
        <a href="{{url('users/create')}}"
            class="btn-addnew w-full  md:w-auto my-2 md:my-0">Add New</a>
    </form>
    </div>