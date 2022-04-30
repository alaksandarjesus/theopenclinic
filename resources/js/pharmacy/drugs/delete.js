jQuery(function () {
    const pharmacyDrugsTable = jQuery('table.pharmacy-drugs');
    if (!pharmacyDrugsTable.length) {
        return;
    }
    pharmacyDrugsTable.on('click', '.btn-delete', function () {
        const uuid = jQuery(this).closest('tr').attr('data-uuid');
        const name = jQuery(this).closest('tr').find('td.name').text();
        const args = {
            title: 'Confirmation Required',
            body: 'Are you sure you want to delete this drug <strong>' + name + '</strong>',
            data: {uuid: uuid}
        }
        window.twConfirmModal(args, onPharmacyDrugConfirmDelete);
    });
    function onPharmacyDrugConfirmDelete(modal,data) {
        if(!data.confirm){
            modal.disableClickable(false);
            modal.close();
            return;
        }
        jQuery.ajax({
            url: 'pharmacy/drugs/' + data.uuid,
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