jQuery(function () {
    const userCustomFieldForm = jQuery('form.user-custom-field');
    if (!userCustomFieldForm.length) {
        return;
    }
    userCustomFieldForm.validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 30
            },
            type: {
                required: true,
            },
            values: {
                required: false,
            },
            order: {
                required: false,
                digits: true
            }
        },
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const data = {
                uuid: jQuery(form).find('.uuid').val(),
                name: jQuery(form).find('.name').val(),
                type: jQuery(form).find('.type').val(),
                values: jQuery(form).find('.values').val(),
                order: jQuery(form).find('.order').val(),
            }
            const btn = jQuery(form).find('.btn-submit');
            btn.prop('disabled', true);
            jQuery.ajax({
                url: _.isEmpty(data.uuid)?'user-custom-fields':'user-custom-fields/'+data.uuid,
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