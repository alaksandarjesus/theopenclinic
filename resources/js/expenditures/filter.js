jQuery(function(){
    const expendituresFilterForm = jQuery('form.expenditures-filter');
    if(_.isEmpty(expendituresFilterForm)){
        return;
    }

    expendituresFilterForm.find('.from').datepicker({
        dateFormat: 'dd-mm-yy'
    });
    expendituresFilterForm.find('.to').datepicker({
        dateFormat: 'dd-mm-yy'
    });
});