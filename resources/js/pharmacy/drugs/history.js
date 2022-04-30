jQuery(function(){
    const pharmacyDrugHistoryFilterForm = jQuery("form.pharmacy-drug-history-filter");
    if(_.isEmpty(pharmacyDrugHistoryFilterForm)){
        return;
    }
    pharmacyDrugHistoryFilterForm.find(".from").datepicker({
        dateFormat:'dd-mm-yy'
    });
    pharmacyDrugHistoryFilterForm.find(".to").datepicker({
        dateFormat:'dd-mm-yy'
    });
});