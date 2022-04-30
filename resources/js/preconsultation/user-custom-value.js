jQuery(function(){
    const appointmentUserCustomValueForm = jQuery("form.appointment-user-custom-value-form");
    if(_.isEmpty(appointmentUserCustomValueForm)){
        return;
    }
    appointmentUserCustomValueForm.on('submit', function(event){
        event.preventDefault();
        event.stopPropagation();
        const args = {
            title: 'Confirmation Required',
            body: 'Are you sure you want to update this custom fields?',
            data: {  }
        }
        window.twConfirmModal(args, onConfirmappointmentUserCustomValueForm);
    });

    function onConfirmappointmentUserCustomValueForm(modal, data){
        if (!data.confirm) {
            modal.disableClickable(false);
            modal.close();
            return;
        }
        const fieldValues = appointmentUserCustomValues();
       if(_.isEmpty(fieldValues)){
        modal.disableClickable(false);
        modal.close();
        const args = {
            title: 'Alert',
            body: 'User Custom Form Values Cannot be empty',
        }
        twAlertModal(args);
        return;
       }
       saveAppointmentUserCustomValueForm(fieldValues);
    }

    function saveAppointmentUserCustomValueForm(fieldValues){
        const user_uuid = appointmentUserCustomValueForm.find('.user-uuid').val();
        jQuery.ajax({
            url: `users/${user_uuid}/user-custom-values`,
            method: 'POST',
            data: {
                fields: fieldValues,
                user_uuid:user_uuid
            },
            success: function (res) {
                
            },
            error: function (err) {

            },
            complete: function () {

            }
        })
    }

    function appointmentUserCustomValues(){
        const fieldValues = [];
        appointmentUserCustomValueForm.find('.field').each(function(){
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