jQuery(function () {
    const expendituresForm = jQuery('form.expenditures');
    if (!expendituresForm.length) {
        return;
    }
    expendituresForm.find('.expdate').datepicker({
        dateFormat: 'dd-mm-yy'
    })
    expendituresForm.validate({
        rules: {
            expdate: {
                required: true,
            },
            amount: {
                required: true,
                digits: true
            },
            description: {
                required: true,
            }
        },
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const data = {
                uuid: jQuery(form).find('.uuid').val(),
                date: jQuery(form).find('.expdate').val(),
                amount: jQuery(form).find('.amount').val(),
                description: jQuery(form).find('.description').val(),
            }
            const btn = jQuery(form).find('.btn-submit');
            btn.prop('disabled', true);
            jQuery.ajax({
                url: 'expenditures',
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