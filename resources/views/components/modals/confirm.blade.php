<div class="modal fixed confirm top-0 left-0 bg-gray-300/40 w-full  h-full flex justify-center items-center hidden z-[1030]">
    <div class="bg-white w-full md:w-3/4 lg:w-1/2 mx-5  h-48 rounded-lg shadow-lg p-5 relative">
        <div class="flex justify-between items-center">
        <div class="modal-title text-black font-medium text-lg">Confirm</div>
        <button class="btn-close btn-clickable disabled:opacity-75 disabled:cursor-not-allowed" data-value="0">
        @include('components.icons', ['icon'=>'close'])

        </button>
        </div>
        <div class="modal-body text-slate-900 text-base my-5">Are you sure you want to perform this action?</div>
        <div class="absolute bottom-5 right-5">
          <button class="hover:bg-gray-200 mr-5 py-2 px-4 btn-cancel btn-clickable  disabled:opacity-75 disabled:cursor-not-allowed" data-value="0">Cancel</button>
          <button class="bg-emerald-800 text-white py-2 px-4 btn-clickable btn-confirm disabled:opacity-75 disabled:cursor-not-allowed" data-value="1">Confirm</button>
        </div>
      </div>
</div>