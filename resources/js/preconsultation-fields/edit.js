
jQuery(function(){
    const appointmentPreconsultationFieldsTable = jQuery('table.appointment-preconsultation-fields');
    if(!appointmentPreconsultationFieldsTable.length){
        return;
    }
    const appointmentPreconsultationForm = jQuery('form.appointment-preconsultation-field');
    if (!appointmentPreconsultationForm.length) {
        return;
    }
    appointmentPreconsultationFieldsTable.on('click', '.btn-edit', function(){
       const uuid = jQuery(this).closest('tr').attr('data-uuid');
       const name = jQuery(this).closest('tr').find('td.name').text();
       const type = jQuery(this).closest('tr').find('td.type').text();
       const order = jQuery(this).closest('tr').find('td.order').text();
       const values = jQuery(this).closest('tr').find('td.values').text();
       appointmentPreconsultationForm.find('.name').val(name);
       appointmentPreconsultationForm.find('.uuid').val(uuid);
       appointmentPreconsultationForm.find('.type').val(type);
       appointmentPreconsultationForm.find('.order').val(order);
       appointmentPreconsultationForm.find('.values').val(values);
    });

});