jQuery(function(){
    const appointmentPreconsultationForm = jQuery("form.appointment-preconsultation");
    if(_.isEmpty(appointmentPreconsultationForm)){
        return;
    }
    appointmentPreconsultationForm.on('submit', function(event){
        event.preventDefault();
        event.stopPropagation();
        const args = {
            title: 'Confirmation Required',
            body: 'Are you sure you want to update this preconsultation form?',
            data: {  }
        }
        window.twConfirmModal(args, onConfirmAppointmentPreconsultationForm);
    });

    function onConfirmAppointmentPreconsultationForm(modal, data){
        if (!data.confirm) {
            modal.disableClickable(false);
            modal.close();
            return;
        }
        const fieldValues = appointmentPreconsultationFormValues();
       if(_.isEmpty(fieldValues)){
        modal.disableClickable(false);
        modal.close();
        const args = {
            title: 'Alert',
            body: 'Preconsultation Form Values Cannot be empty',
        }
        twAlertModal(args);
        return;
       }
       saveAppointmentPreconsultationForm(fieldValues);
    }

    function saveAppointmentPreconsultationForm(fieldValues){
        const appointment = appointmentPreconsultationForm.find('.appointment-uuid').val();
        jQuery.ajax({
            url: `appointments/${appointment}/pre-consultation`,
            method: 'POST',
            data: {
                fields: fieldValues,
                appointment:appointment
            },
            success: function (res) {
                
            },
            error: function (err) {

            },
            complete: function () {

            }
        })
    }

    function appointmentPreconsultationFormValues(){
        const fieldValues = [];
        appointmentPreconsultationForm.find('.field').each(function(){
            let temp = {};
            const value =jQuery(this).val();

            if(jQuery(this).attr('type') !== 'checkbox' && jQuery(this).attr('type') !== 'radio'){
                if(value){
                    temp =  {
                        uuid: jQuery(this).attr('data-uuid'),
                        value: value
                    }
                }
              
            }else{
                if(jQuery(this).is(':checked')){
                    if(value){
                        temp =  {
                            uuid: jQuery(this).attr('data-uuid'),
                            value: value
                        }
                    }
                }
            }
            if(!_.isEmpty(temp)){
                fieldValues.push(temp)
            }
        });
        return fieldValues;
    }
});