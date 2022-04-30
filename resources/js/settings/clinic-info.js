jQuery(function(){
    const settingsClinicInfoForm = jQuery("form.settings-clinic-info");
    if(!settingsClinicInfoForm || !settingsClinicInfoForm.length){
        return;
    }
    settingsClinicInfoForm.validate({
        rules: {

        },
        messages:{

        },
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const data = {
                clinic_name : jQuery(form).find('.clinic_name').val(),
                clinic_address : jQuery(form).find('.clinic_address').val(),
                clinic_tax_information : jQuery(form).find('.clinic_tax_information').val(),
                clinic_email : jQuery(form).find('.clinic_email').val(),
                clinic_phone : jQuery(form).find('.clinic_phone').val(),
            }
            jQuery.ajax({
                url: 'settings/clinic-info',
                method: 'POST',
                data:data,
                success: function(res){
                    const args = {
                        title: 'Success',
                        body: 'Clinic Information Updated Successfully',
                    }
                    twAlertModal(args);
                    return;
                },
                error: function(){

                },
                complete: function(){

                }
            })
        }
    })
});