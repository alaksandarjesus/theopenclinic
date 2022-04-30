<div
    class="modal fixed alert top-0 left-0 bg-gray-300/40 w-full h-full flex justify-center items-center hidden z-[1040]">
    <div class="bg-white w-full md:w-1/2  h-48 rounded-lg shadow-lg p-5 relative">
        <div class="flex justify-between items-center">
            <div class="modal-title text-black font-medium text-lg">Alert</div>
            <button class="btn-close btn-clickable disabled:opacity-75 disabled:cursor-not-allowed" data-value="0">
                @include('components.icons', ['icon'=>'close'])
            </button>
        </div>
        <div class="modal-body text-slate-900 text-base my-5">Something went wrong... Contact Administrator?</div>
        <div class="absolute bottom-5 right-5">
            <button
                class="bg-emerald-800 text-white py-2 px-4 btn-clickable btn-agree disabled:opacity-75 disabled:cursor-not-allowed"
                data-value="1">Ok</button>
        </div>
    </div>
</div>