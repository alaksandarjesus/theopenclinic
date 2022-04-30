jQuery(function(){
    const previousConsultationTable = jQuery("table.previous-consultation");
    if(_.isEmpty(previousConsultationTable)){
        return;
    }
    previousConsultationTable.on('click', '.toggle-tbody', function(){
        jQuery(this).closest('table').find('tbody.table-body').slideToggle();
    })
});