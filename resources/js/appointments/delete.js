jQuery(function () {
    const appointmentsListTable = jQuery("table.appointments-list");
    if (!appointmentsListTable || !appointmentsListTable.length) {
        return;
    }
    appointmentsListTable.on('click', '.btn-delete', function () {
        const uuid = jQuery(this).closest('tr').attr('data-uuid');
        const name = jQuery(this).closest('tr').find('td.name').text();
        const args = {
            title: 'Confirmation Required',
            body: 'Are you sure you want to delete this appointment for <strong>' + name + '</strong>',
            data: { uuid: uuid }
        }
        window.twConfirmModal(args, confirmAppointmentDelete);
    });
    function confirmAppointmentDelete(modal, data) {
        if (!data.confirm) {
            modal.disableClickable(false);
            modal.close();
            return;
        }
        jQuery.ajax({
            url: `/appointments/${data.uuid}`,
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