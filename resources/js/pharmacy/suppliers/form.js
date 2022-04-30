jQuery(function () {
    const pharmacySupplierForm = jQuery('form.pharmacy-supplier');
    if (!pharmacySupplierForm.length) {
        return;
    }
    pharmacySupplierForm.validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 200
            },
            address: {
                required: false,
                minlength: 3,
                maxlength: 200
            },
            email: {
                required: false,
                minlength: 3,
                maxlength: 30
            },
            phone: {
                required: false,
                minlength: 3,
                maxlength: 20
            },
            tax_information: {
                required: false,
                minlength: 3,
                maxlength: 200
            },
            description: {
                required: false,
                minlength: 3,
                maxlength: 200
            }
        },
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const data = {
                uuid: jQuery(form).find('.uuid').val(),
                name: jQuery(form).find('.name').val(),
                address: jQuery(form).find('.address').val(),
                email: jQuery(form).find('.email').val(),
                phone: jQuery(form).find('.phone').val(),
                tax_information: jQuery(form).find('.tax_information').val(),
                description: jQuery(form).find('.description').val(),
            }
            const btn = jQuery(form).find('.btn-submit');
            btn.prop('disabled', true);
            jQuery.ajax({
                url: 'pharmacy/suppliers/',
                method:'POST',
                data:data,
                success: function(){
                },
                error: function(err){
                    btn.prop('disabled', false);
                },
                complete: function(){

                }      
            })
        }
    })
});