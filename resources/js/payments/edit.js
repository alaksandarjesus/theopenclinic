jQuery(function(){

    const paymentEditForm = jQuery("form.payment-edit");

    if(_.isEmpty(paymentEditForm)){
        return;
    }

    paymentEditForm.validate({
        rules: {
            amount: {
                required: true,
                currency: true
            }
        },
        comments: {
            required: true
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            event.stopPropagation();
            form$ = jQuery(form);
            btn$ = form$.find('.btn-submit');
            btn$.prop('disabled', true);
            const data = {
                payment_uuid: form$.find('.payment-uuid').val(),
                amount: form$.find('.amount').val(),
                comments: form$.find(".comments").val(),
                redirect: form$.find(".redirect").val(),
            }
            jQuery.ajax({
                url: 'payments/' + data.payment_uuid,
                method: 'PUT',
                data: data,
                success: function () {

                },
                error: function () {
                    btn$.prop('disabled', false);
                },
                complete: function () {

                }
            })
        }
    });

});