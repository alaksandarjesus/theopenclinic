jQuery(function () {
    const appointmentPreconsultationFieldsTable = jQuery('table.appointment-preconsultation-fields');
    if(!appointmentPreconsultationFieldsTable.length){
        return;
    }
    appointmentPreconsultationFieldsTable.on('click', '.btn-delete', function () {
        const uuid = jQuery(this).closest('tr').attr('data-uuid');
        const name = jQuery(this).closest('tr').find('td.name').text();
        const args = {
            title: 'Confirmation Required',
            body: 'Are you sure you want to delete this field <strong>' + name + '</strong>',
            data: {uuid: uuid}
        }
        window.twConfirmModal(args, onAppointmentPreconsultationFieldConfirmDelete);
    });
    function onAppointmentPreconsultationFieldConfirmDelete(modal,data) {
        if(!data.confirm){
            modal.disableClickable(false);
            modal.close();
            return;
        }
        jQuery.ajax({
            url: `/preconsultation-fields/${data.uuid}`,
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