jQuery(function(){
    const purchaseOrdersTable = jQuery("table.purchase-orders");
    if(_.isEmpty(purchaseOrdersTable)){
        return;
    }
    purchaseOrdersTable.on('click', '.btn-delete', function () {
        const uuid = jQuery(this).closest('tr').attr('data-uuid');
        const orderNumber = jQuery(this).closest('tr').find('td.order-number').text();
        const args = {
            title: 'Confirmation Required',
            body: 'Are you sure you want to delete this purchase order <strong>' + orderNumber + '</strong>',
            data: {uuid: uuid}
        }
        window.twConfirmModal(args, onPurchaseOrderConfirmDelete);
    });
    function onPurchaseOrderConfirmDelete(modal,data) {
        if(!data.confirm){
            modal.disableClickable(false);
            modal.close();
            return;
        }
        jQuery.ajax({
            url: `/pharmacy/purchases/${data.uuid}`,
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