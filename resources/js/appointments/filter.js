jQuery(function(){
    const appointmentFiltersForm = jQuery("form.appointments-filter");
    if(_.isEmpty(appointmentFiltersForm)){
        return;
    }
    appointmentFiltersForm.find('.date').datepicker({
        dateFormat: 'dd-mm-yy'
    });
});