@if(request()->has('user') && request()->user->can_view_menu_item(['Super Administrator', 'Administrator']))
<div class="relative dropdown">
    <button class="dropdown-trigger mx-2 py-4 px-3 hover:bg-teal-700 text-white ">Pharmacy
    </button>
    <div class="absolute dropdown-menu bg-white shadow-md py-3 top-14 right-5 w-48 hidden">
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
</div>
@endif

@if(request()->has('user') && request()->user->can_view_menu_item(['Pharmacist']))
<div class="">
    <a href="{{url('pharmacy/drugs')}}" class="mx-2 py-4 px-3 hover:bg-teal-700 text-white">Drugs
    </a>
    <a href="{{url('pharmacy/invoices')}}" class="mx-2 py-4 px-3 hover:bg-teal-700 text-white">Invoices
    </a>
</div>
@endif
