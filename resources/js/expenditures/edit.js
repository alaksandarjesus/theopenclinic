
jQuery(function(){
    const expendituresTable = jQuery('table.expenditures');
    if(!expendituresTable.length){
        return;
    }
    const expendituresForm = jQuery('form.expenditures');
    if (!expendituresForm.length) {
        return;
    }
    expendituresTable.on('click', '.btn-edit', function(){
       const uuid = jQuery(this).closest('tr').attr('data-uuid');
       const description = jQuery(this).closest('tr').find('td.description').text();
       const amount = jQuery(this).closest('tr').find('td.amount').text();
       const date = jQuery(this).closest('tr').find('td.expdate').text();
       expendituresForm.find('.description').val(description);
       expendituresForm.find('.amount').val(amount);
       expendituresForm.find('.expdate').val(date);
       expendituresForm.find('.uuid').val(uuid);
    });

});