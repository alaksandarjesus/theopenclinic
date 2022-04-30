jQuery(function(){
    const messagesTable = jQuery('table.messages');
    if(!messagesTable.length){
        return;
    }
    const messagesForm = jQuery('form.messages');
    if (!messagesForm.length) {
        return;
    }
    messagesTable.on('click', '.btn-edit', function(){
       const uuid = jQuery(this).closest('tr').attr('data-uuid');
       const description = jQuery(this).closest('tr').find('td.description').text();
       messagesForm.find('.description').val(description);
       messagesForm.find('.uuid').val(uuid);
    });

});