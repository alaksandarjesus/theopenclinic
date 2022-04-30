jQuery(function () {
    const pharmacySuppliersTable = jQuery('table.pharmacy-suppliers');
    if (!pharmacySuppliersTable.length) {
        return;
    }
    pharmacySuppliersTable.on('click', '.btn-delete', function () {
        const uuid = jQuery(this).closest('tr').attr('data-uuid');
        const btn = jQuery(this);
        btn.prop('disabled', true);
        jQuery.ajax({
            url: 'pharmacy/suppliers/' + uuid,
            success: function (res) {
                updatePharmacyCategoryAlertMessage(res);
            },
            error: function (err) {
                
            },
            complete: function () {
                btn.prop('disabled', false);
            }
        })
    });

    function updatePharmacyCategoryAlertMessage(supplier) {
        const args = {
            title: 'Confirmation Required',
            body: 'Are you sure you want to delete this supplier <strong>' + _.get(supplier, 'name') + '</strong>',
            onConfirm: onPharmacyCategoryConfirmDelete,
            data: supplier
        }
        window.bsConfirmModal(args);
    }



    function onPharmacyCategoryConfirmDelete(modal, modalEle,data) {
        jQuery(modalEle).find('.btn-confirm').prop('disabled', true);
        jQuery.ajax({
            url: `/pharmacy/suppliers/${data.uuid}`,
            
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