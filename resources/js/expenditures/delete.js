jQuery(function () {
    const expendituresTable = jQuery('table.expenditures');
    if (!expendituresTable.length) {
        return;
    }
    expendituresTable.on('click', '.btn-delete', function () {
        const uuid = jQuery(this).closest('tr').attr('data-uuid');
        const date = jQuery(this).closest('tr').find('td.date').text();
        const amount = jQuery(this).closest('tr').find('td.amount').text();
        const args = {
            title: 'Confirmation Required',
            body: 'Are you sure you want to delete this expendition on <strong>' + date + '</strong> with amount <strong>' + amount + '</strong>',
            data: {uuid: uuid}
        }
        window.twConfirmModal(args, onExpenditureConfirmDelete);
    });
    function onExpenditureConfirmDelete(modal,data) {
        if(!data.confirm){
            modal.disableClickable(false);
            modal.close();
            return;
        }
        jQuery.ajax({
            url: `/expenditures/${data.uuid}`,
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