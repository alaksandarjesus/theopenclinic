<div class="w-auto lg:w-3/4">
    <div class="flex justify-end items-center flex flex-col justify-start items-start md:flex-row md:justify-between md:items-center">
        <form action=""
            class="messages-filter ">
            <input type="text" class="w-full md:w-36 my-2 md:my-0" name="q" placeholder="search"
                value="{{request()->query('q')}}">
            <input type="text" class="w-full md:w-36 my-2 md:my-0 from" name="from" placeholder="dd-mm-yyyy"
                value="{{$from}}">
            <input type="text" class="w-full md:w-36 my-2 md:my-0 to" name="to" placeholder="dd-mm-yyyy"
                value="{{$to}}">
                <button class="btn-filter w-full md:w-36 my-2  md:my-0">Filter</button>
            <!-- <button class="btn-filter w-full md:w-36 my-2 md:my-0">Filter</button> -->
        </form>

        <a href="{{url('messages/create')}}" class=" w-full md:w-36 my-2 md:my-0 btn-addnew">Add New</a>
    </div>
</div>