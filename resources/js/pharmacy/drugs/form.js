jQuery(function () {
    const pharmacyDrugForm = jQuery('form.pharmacy-drug');
    if (!pharmacyDrugForm.length) {
        return;
    }
    pharmacyDrugForm.validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 40
            },
            unit: {
                required: true,
                minlength: 1,
                maxlength: 20
            },
            price: {
                required: true,
                currency: true
            },
            cost: {
                required: true,
                currency: true
            },
            tax: {
                required: true,
                currency: true
            },
            description: {
                required: false,
                minlength: 3,
                maxlength: 200
            },
            compositions: {
                required: false
            },
            category: {
                required: true
            }
        },
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const data = {
                uuid: jQuery(form).find('.uuid').val(),
                name: jQuery(form).find('.name').val(),
                unit: jQuery(form).find('.unit').val(),
                price: jQuery(form).find('.price').val(),
                cost: jQuery(form).find('.cost').val(),
                tax: jQuery(form).find('.tax').val(),
                description: jQuery(form).find('.description').val(),
                compositions: jQuery(form).find('.compositions').val(),
                category: jQuery(form).find('.category').val(),
            }
            const btn = jQuery(form).find('.btn-submit');
            btn.prop('disabled', true);
            jQuery.ajax({
                url: 'pharmacy/drugs',
                method: 'POST',
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