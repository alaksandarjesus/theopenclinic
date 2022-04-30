jQuery(function(){
    const pharmacyCompositionsTable = jQuery('table.pharmacy-compositions');

    if(!pharmacyCompositionsTable.length){
        return;
    }
    const pharmacyCompositionForm = jQuery('form.pharmacy-composition');

    if (!pharmacyCompositionForm.length) {
        return;
    }
    pharmacyCompositionsTable.on('click', '.btn-edit', function(){
       const uuid = jQuery(this).closest('tr').attr('data-uuid');
       const name = jQuery(this).closest('tr').find('td.name').text();
       pharmacyCompositionForm.find('.name').val(name);
       pharmacyCompositionForm.find('.uuid').val(uuid);
    });

});