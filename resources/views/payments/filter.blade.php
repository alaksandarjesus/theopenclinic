<div class="w-auto lg:w-1/2">
    <form action=""
        class="payments-filter w-full flex flex-col justify-start items-start md:flex-row md:justify-between md:items-center">
        <input type="text" class="w-full md:w-36 my-2 md:my-0 from" name="from" placeholder="dd-mm-yyyy"
            value="{{request()->query('from', '')}}" autcomplete="off">
        <input type="text" class="w-full md:w-36 my-2 md:my-0 to" name="to" placeholder="dd-mm-yyyy"
            value="{{request()->query('to', '')}}" autcomplete="off">
        <button class="btn-filter w-full md:w-36 my-2  md:my-0">Filter</button>

    </form>
</div>