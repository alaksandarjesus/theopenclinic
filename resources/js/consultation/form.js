jQuery(function () {
    const appointmentConsultationForm = jQuery("form.appointment-consultation");
    if (!appointmentConsultationForm) {
        return;
    }
    const consultationPrescriptionTable = jQuery("table.consultation-prescription");

    if (_.isEmpty(consultationPrescriptionTable)) {
        return;
    }

    appointmentConsultationForm.validate({
        rules: {
            complaints: {
                required: true
            },
            examination: {
                required: true
            },
            prescription: {
                required: true
            },
            others: {
                required: true
            }
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            event.stopPropagation();
            const form$ = jQuery(form);
            const btn$ = form$.find('.btn-submit');
            let prescription = { drugs: [], comments: consultationPrescriptionTable.find('tfoot tr').find('.comments').val() };
            consultationPrescriptionTable.find('tbody tr').each(function () {
                const temp = {
                    uuid: jQuery(this).find('.drug').val(),
                    days: jQuery(this).find('.days').val(),
                    bb: jQuery(this).find('.bb').val(),
                    ab: jQuery(this).find('.ab').val(),
                    bl: jQuery(this).find('.bl').val(),
                    al: jQuery(this).find('.al').val(),
                    be: jQuery(this).find('.be').val(),
                    ae: jQuery(this).find('.ae').val(),
                    bd: jQuery(this).find('.bd').val(),
                    ad: jQuery(this).find('.ad').val(),
                }
                if (!_.isEmpty(temp.uuid)) {
                    temp.drugName = jQuery(this).find('.drug').find('option:selected').text();
                    prescription.drugs.push(temp);
                }
            });
            if(_.isEmpty(prescription.comments)){
                prescription.comments = 'NA';
            }
            const data = {
                appointment_uuid: form$.find('.appointment-uuid').val(),
                complaints: form$.find(".complaints").val(),
                prescription: prescription,
                examination: form$.find(".examination").val(),
                others: form$.find(".others").val(),
            }
            btn$.prop('disabled', true);
            jQuery.ajax({
                url: 'appointments/' + data.appointment_uuid + '/consultation',
                method: 'POST',
                data: data,
                success: function () {

                },
                error: function () {
                    btn$.prop('disabled', false);
                },
                complete: function () {

                }
            });
        }
    })

});