jQuery(function () {
    const pharmacyDrugCompositionsTable = jQuery('table.pharmacy-compositions');

    if (!pharmacyDrugCompositionsTable.length) {
        return;
    }
    pharmacyDrugCompositionsTable.on('click', '.btn-delete', function () {
        const uuid = jQuery(this).closest('tr').attr('data-uuid');
        const name = jQuery(this).closest('tr').find('td.name').text();
        const args = {
            title: 'Confirmation Required',
            body: 'Are you sure you want to delete this composition <strong>' + name + '</strong>',
            data: {uuid: uuid}
        }
        window.twConfirmModal(args, onPharmacyDrugCompositionConfirmDelete);
    });
    function onPharmacyDrugCompositionConfirmDelete(modal,data) {
        if(!data.confirm){
            modal.disableClickable(false);
            modal.close();
            return;
        }
        jQuery.ajax({
            url: `/pharmacy/compositions/${data.uuid}`,
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