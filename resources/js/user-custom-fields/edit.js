
jQuery(function(){
    const userCustomFieldsTable = jQuery('table.user-custom-fields');
    if(!userCustomFieldsTable.length){
        return;
    }
    const userCustomFieldForm = jQuery('form.user-custom-field');
    if (!userCustomFieldForm.length) {
        return;
    }
    userCustomFieldsTable.on('click', '.btn-edit', function(){
       const uuid = jQuery(this).closest('tr').attr('data-uuid');
       const name = jQuery(this).closest('tr').find('td.name').text();
       const type = jQuery(this).closest('tr').find('td.type').text();
       const order = jQuery(this).closest('tr').find('td.order').text();
       const values = jQuery(this).closest('tr').find('td.values').text();
       userCustomFieldForm.find('.name').val(name);
       userCustomFieldForm.find('.uuid').val(uuid);
       userCustomFieldForm.find('.type').val(type);
       userCustomFieldForm.find('.order').val(order);
       userCustomFieldForm.find('.values').val(values);
    });

});