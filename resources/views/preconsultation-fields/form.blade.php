<form action="" class="appointment-preconsultation-field w-full">
    <h4 class="text-slate-900 text-xl font-medium mb-2">Create / Edit Preconsultation Field</h4>
    <input type="hidden" name="uuid" class="uuid">
    <div class="form-group mb-3">
        <label for="" class="block mb-1 font-medium">Name</label>
        <input type="text" name="name" value="" class="block w-full name">
    </div>
    <div class="form-group mb-3">
        <label for="" class="block mb-1 font-medium">Order</label>
        <input type="text" name="order" value="" class="block w-full order">
    </div>
    <div class="form-group mb-3">
        <label for="" class="block mb-1 font-medium">Type</label>
        <select name="type" class="block w-full type">
            <option value="">Select Type</option>
            <option value="text">Text</option>
            <option value="select">Select</option>
            <option value="checkbox">Checkbox</option>
            <option value="radio">Radio</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="" class="block mb-1 font-medium">Values</label>
        <textarea name="values"  class="block w-full values"></textarea>
        <div class="text-sm font-gray-700">Seperated by commas</div>
    </div>
    <div>
        <button
            class=" btn-submit">Submit</button>
    </div>
</form>