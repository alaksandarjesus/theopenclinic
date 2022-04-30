jQuery(function () {

    const appointmentPaymentForm = jQuery("form.appointment-payment-form");

    if (_.isEmpty(appointmentPaymentForm)) {
        return;
    }

    appointmentPaymentForm.validate({
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
                appointment_uuid: form$.find('.appointment-uuid').val(),
                amount: form$.find('.amount').val(),
                comments: form$.find(".comments").val(),
                redirect: form$.find(".redirect").val(),
            }
            jQuery.ajax({
                url: 'appointments/' + data.appointment_uuid + '/payments',
                method: 'POST',
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