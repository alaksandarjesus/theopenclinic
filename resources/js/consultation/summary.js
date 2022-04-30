jQuery(function(){
    const appointmentConsultationForm = jQuery("form.appointment-consultation");
    if(_.isEmpty(appointmentConsultationForm)){
        return;
    }
    const appointmentConsultationTabBtnSummary = appointmentConsultationForm.find('.tab-btn-summary');
    if(_.isEmpty(appointmentConsultationTabBtnSummary)){
        return;
    }

    const appointmentConsultationTableSummary = appointmentConsultationForm.find("table.summary");
    if(_.isEmpty(appointmentConsultationTableSummary)){
        return;
    }
    const consultationPrescriptionTable = jQuery("table.consultation-prescription");

    if(_.isEmpty(consultationPrescriptionTable)){
        return;
    }
    appointmentConsultationTabBtnSummary.on('click', function(){
        const form$ = appointmentConsultationForm;
        const fields = ['complaints', 'examination', 'others'];
        fields.forEach(field => {
            if(!form$.find("."+field).val()){
                form$.find("."+field).val('NA');
            }
        });
        let prescription = {drugs:[], comments:consultationPrescriptionTable.find('tfoot tr').find('.comments').val()};
        consultationPrescriptionTable.find('tbody tr').each(function(){
            const temp = {
                drug: jQuery(this).find('.drug').val(),
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
            if(!_.isEmpty(temp.drug)){
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
            examination: form$.find(".examination").val(),
            prescription:prescription,
            others: form$.find(".others").val(),
        }

        const tpl = _.template(jQuery("#consultation-summary-prescription-table").html());
        appointmentConsultationTableSummary.find(".summary-prescription").html(tpl({prescription:data.prescription}));

        appointmentConsultationTableSummary.find('.summary-complaints').text(data.complaints);
        appointmentConsultationTableSummary.find('.summary-examination').text(data.examination);
        appointmentConsultationTableSummary.find('.summary-others').text(data.others);
    });

});