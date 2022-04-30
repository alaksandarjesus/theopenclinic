jQuery(function(){
    const invoiceReturnsListTable = jQuery('table.invoice-returns-list-table');
    if(!invoiceReturnsListTable || !invoiceReturnsListTable.length){
        return;
    }
    invoiceReturnsListTable.on('click', '.btn-delete', function(){
        const args = {
            title: 'Confirmation Required',
            body: 'Are you sure you want to delete this invoice return?',
            onConfirm: onInvoiceReturnsListTableRowDelete,
            data: {
                invoiceUuid: jQuery(this).closest('table').attr('data-invoice-uuid'),
                returnUuid: jQuery(this).closest('tr').attr('data-return-uuid')
            }
        }
        window.bsConfirmModal(args);
    });

    function onInvoiceReturnsListTableRowDelete(modal, modalEle,data) {
       
        jQuery(modalEle).find('.btn-confirm').prop('disabled', true);
        jQuery.ajax({
            url: `/pharmacy/invoices/${data.invoiceUuid}/returns/${data.returnUuid}`,
            
            method: 'DELETE',
            success: function (res) {

            },
            error: function (err) {

            },
            complete: function () {
                jQuery(modalEle).find('.btn-confirm').prop('disabled', false);
                modal.hide();
            }
        })

       }
});