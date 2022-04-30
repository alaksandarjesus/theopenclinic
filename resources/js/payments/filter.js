jQuery(function(){
    const paymentsFilterForm = jQuery('form.payments-filter');
    if(_.isEmpty(paymentsFilterForm)){
        return;
    }

    paymentsFilterForm.find('.from').datepicker({
        dateFormat: 'dd-mm-yy'
    });
    paymentsFilterForm.find('.to').datepicker({
        dateFormat: 'dd-mm-yy'
    });
});