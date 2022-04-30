<div class="container px-3">
    <div class="flex justify-center items-center toggle-parent">
        <div class="w-full sm:w-1/2 lg:w-1/3 2xl:w-1/4 ">
            <div class="flex justify-between items-center">
                <div class="text-slate-900 text-xl flex justify-center font-medium my-3  cursor-pointer">Demo
                    Credentials</div>
                <button class="toggle-trigger">
                    @include('components.icons',
                    ['icon'=>
                    'dropdown', 'className' => 'fill-gray-700'])
                </button>
            </div>
            <div class="toggle-section hidden">
                <div class="border border-gray-300   shadow-sm p-3 ">
                    <h2 class="font-bold">Super Admin</h2>
                    <div>Username: superadmin</div>
                    <div>Password: Password@123</div>
                </div>
                <div class="border border-gray-300   shadow-sm p-3">
                    <h2 class="font-bold">Administrator</h2>
                    <div>Username: administrator</div>
                    <div>Password: Password@123</div>
                </div>
                <div class="border border-gray-300   shadow-sm p-3">
                    <h2 class="font-bold">Front Desk</h2>
                    <div>Username: frontdesk</div>
                    <div>Password: Password@123</div>
                </div>
                <div class="border border-gray-300   shadow-sm p-3">
                    <h2 class="font-bold">Pharmacist</h2>
                    <div>Username: pharmacist</div>
                    <div>Password: Password@123</div>
                </div>
                <div class="border border-gray-300   shadow-sm p-3">
                    <h2 class="font-bold">Doctor</h2>
                    <div>Username: doctor</div>
                    <div>Password: Password@123</div>
                </div>
            </div>

        </div>
    </div>
</div>
