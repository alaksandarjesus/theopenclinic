jQuery(function(){
    const messagesTable = jQuery('table.messages');
    if (!messagesTable.length) {
        return;
    }
    messagesTable.on('click', 'tbody tr', function(){
        const href = jQuery(this).closest('tr').attr('data-href');
        window.location.href = href;
    });
})