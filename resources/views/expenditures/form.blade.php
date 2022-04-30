<form action="" class="expenditures w-full" novalidate>
    <h4 class="text-slate-900 text-xl font-medium mb-2">Create / Edit Expenditure</h4>
    <input type="hidden" name="uuid" class="uuid">
    <div class="form-group mb-3">
        <label for="" class="block mb-1 font-medium">Date</label>
        <input type="text" name="expdate" value="" class="block w-full expdate">
    </div>
    <div class="form-group mb-3">
        <label for="" class="block mb-1 font-medium">Amount</label>
        <input type="text" name="amount" value="" class="block w-full amount">
    </div>
    <div class="form-group mb-3">
        <label for="" class="block mb-1 font-medium">Description</label>
        <textarea name="description" class="description w-full block"></textarea>
    </div>
    <div>
        <button
            class=" btn-submit">Submit</button>
    </div>
</form>