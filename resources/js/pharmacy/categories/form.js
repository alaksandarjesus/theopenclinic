jQuery(function () {
    const pharmacyDrugCategoryForm = jQuery('form.pharmacy-drug-category');
    if (!pharmacyDrugCategoryForm.length) {
        return;
    }
    pharmacyDrugCategoryForm.validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 20
            }
        },
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const data = {
                uuid: jQuery(form).find('.uuid').val(),
                name: jQuery(form).find('.name').val(),
            }
            const btn = jQuery(form).find('.btn-submit');
            btn.prop('disabled', true);
            jQuery.ajax({
                url: _.isEmpty(data.uuid)?'pharmacy/categories':'pharmacy/categories/'+data.uuid,
                method: _.isEmpty(data.uuid)?'POST':'PUT',
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