    jQuery(function(){
        const purchaseInventoryListTable = jQuery(".purchase-inventory-list-table");
        if(_.isEmpty(purchaseInventoryListTable)){
            return;
        }
        purchaseInventoryListTable.on('click', '.btn-delete', function () {
            const uuid = jQuery(this).closest('tr').attr('data-uuid');
            const name = jQuery(this).closest('tr').find('td.name').text();
            const args = {
                title: 'Confirmation Required',
                body: 'Are you sure you want to delete this inventory for <strong>' + name + '</strong>',
                data: {
                    orderUuid: jQuery(this).closest('table').attr('data-order-uuid'),
                    inventoryUuid: jQuery(this).closest('tr').attr('data-inventory-uuid')
                }
            }
            window.twConfirmModal(args, onPurchaseInventoryListTableRowDelete);
        });
        function onPurchaseInventoryListTableRowDelete(modal,data) {
            if(!data.confirm){
                modal.disableClickable(false);
                modal.close();
                return;
            }
            jQuery.ajax({
                url: `/pharmacy/purchases/${data.orderUuid}/inventory/${data.inventoryUuid}`,
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