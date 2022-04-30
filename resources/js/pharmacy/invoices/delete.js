jQuery(function(){
    const invoiceOrdersTable = jQuery("table.invoice-orders");
    if(_.isEmpty(invoiceOrdersTable)){
        return;
    }
    invoiceOrdersTable.on('click', '.btn-delete', function(event){
        const uuid = jQuery(this).closest('tr').attr('data-uuid');
        const args = {
            title: 'Confirmation Required',
            body: 'Are you sure you want to delete this invoice',
            data: {uuid: uuid}
        }
        window.twConfirmModal(args, onInvoiceOrderConfirmDelete)
    });

    function onInvoiceOrderConfirmDelete(modal,data) {
        if(!data.confirm){
            modal.disableClickable(false);
            modal.close();
            return;
        }
        jQuery.ajax({
            url: `/pharmacy/invoices/${data.uuid}`,
            method: 'DELETE',
            success: function (res) {
                modal.disableClickable(false);
                modal.close();
            },
            error: function (err) {

            },
            complete: function () {
                
            }
        })
    }
});