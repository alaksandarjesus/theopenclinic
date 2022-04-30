<form class="flex justify-center items-center settings-clinic-info">
    <div class="w-full lg:w-1/2">
        <h4 class="text-slate-900 text-xl font-medium my-3">Clinical Info</h4>
        <div class="grid grid-cols-1  gap-3">
            <div class="form-group mb-3">
                <label for="" class="block mb-1 font-medium">Clinic Name</label>
                <input type="text" name="clinicName" class="block w-full clinic_name" autocomplete="current-name"
                    autofocus value="{{!empty($settings['clinic_name'])?$settings['clinic_name']:''}}">
            </div>
            <div class="form-group mb-3">
                <label for="" class="block mb-1 font-medium">Clinic Tax Information</label>
                <input type="text" name="clinicTaxInformation" class="clinic_tax_information  w-full"
                    autocomplete="current-unit"
                    value="{{!empty($settings['clinic_tax_information'])?$settings['clinic_tax_information']:''}}">
            </div>
            <div class="form-group mb-3">
                <label for="" class="block mb-1 font-medium">Clinic Email</label>
                <input type="text" name="clinicEmail" class="block w-full clinic_email" autocomplete="current-cost"
                    value="{{!empty($settings['clinic_email'])?$settings['clinic_email']:''}}">
            </div>
            <div class="form-group mb-3">
                <label for="" class="block mb-1 font-medium">Clinic Phone</label>
                <input type="text" name="clinicPhone" class="block w-full clinic_phone" autocomplete="current-tax"
                    value="{{!empty($settings['clinic_phone'])?$settings['clinic_phone']:''}}">
            </div>
            <div class="form-group mb-3">
                <label for="" class="block mb-1 font-medium">Clinic Address</label>
                <textarea name="clinicAddress"
                    class="clinic_address w-full h-24">{{!empty($settings['clinic_address'])?$settings['clinic_address']:''}}</textarea>
            </div>
        </div>
        <div class="flex justify-end items-center">
            <button
                class=" btn-submit">Submit</button>
        </div>
    </div>
</form>