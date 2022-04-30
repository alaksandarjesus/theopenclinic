jQuery(function () {
    const messageForm = jQuery('form.message');
    if (!messageForm.length) {
        return;
    }
    messageForm.validate({
        rules: {
            description: {
                required: true,
                minlength: 3,
                maxlength: 200
            }
        },
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const data = {
                uuid: jQuery(form).find('.uuid').val(),
                description: jQuery(form).find('.description').val(),
            }
            const btn = jQuery(form).find('.btn-submit');
            btn.prop('disabled', true);
            jQuery.ajax({
                url: 'messages',
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