jQuery(function(){
    const purchaseReturnsListTable = jQuery('table.purchase-returns-list-table');
    if(!purchaseReturnsListTable || !purchaseReturnsListTable.length){
        return;
    }
    purchaseReturnsListTable.on('click', '.btn-delete', function(){
        const args = {
            title: 'Confirmation Required',
            body: 'Are you sure you want to delete this return?',
            onConfirm: onPurchaseReturnsListTableRowDelete,
            data: {
                orderUuid: jQuery(this).closest('table').attr('data-order-uuid'),
                returnUuid: jQuery(this).closest('tr').attr('data-return-uuid')
            }
        }
        window.bsConfirmModal(args);
    });

    function onPurchaseReturnsListTableRowDelete(modal, modalEle,data) {
       
        jQuery(modalEle).find('.btn-confirm').prop('disabled', true);
        jQuery.ajax({
            url: `/pharmacy/purchases/${data.orderUuid}/returns/${data.returnUuid}`,
            
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