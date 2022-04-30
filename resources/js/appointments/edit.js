jQuery(function () {
    const appointmentEditForm = jQuery('form.edit-appointment');
    if (!appointmentEditForm || !appointmentEditForm.length) {
        return;
    }
    const timeSelect = appointmentEditForm.find('.time');
    setTimeout(() => {
        getAvailableTimeslots(false);
    });
    appointmentEditForm.find('.doctor').on('change', function () {
        getAvailableTimeslots(true);
    });

    appointmentEditForm.find('.dater').datepicker({
        dateFormat: 'dd-mm-yy',
        onSelect: function (date, event) {
            getAvailableTimeslots(true);
        }
    });
    appointmentEditForm.find('.dob').datepicker({
        dateFormat: 'dd-mm-yy',
    });


    function getAvailableTimeslots(resetValue) {
        const data = {
            doctor: appointmentEditForm.find('.doctor').val(),
            date: appointmentEditForm.find('.dater').val(),
        }
        if (!data.doctor || !data.date) {
            timeSelect.prop('disabled', true);
            return;
        }
        timeSelect.prop('disabled', true);
        jQuery.ajax({
            url: 'appointments/doctor-availability',
            method: 'POST',
            data: data,
            success: function (res) {
                updateTimeslots(res, resetValue);
            },
            error: function (err) {

            },
            complete: function () {

            }
        })

    }

    function updateTimeslots(res, resetValue) {
        const booked = _.get(res, 'booked');
        timeSelect.prop('disabled', false);
        if (resetValue) {
            timeSelect.val('');
        }
        timeSelect.find('option').removeClass('text-danger').prop('disabled', false);
        if (_.isEmpty(booked)) {
            return;
        }
        const originalTime = timeSelect.attr('data-original-time');
            timeSelect.find('option').each(function () {
                const value = jQuery(this).attr('value');
                if ((booked.indexOf(value) !== -1) && !_.isEqual(originalTime, value)) {
                    jQuery(this).addClass('text-danger').prop('disabled', true);
                }
            });
    }

    appointmentEditForm.validate({
        rules: {
            doctor: {
                required: true
            },
            dater: {
                required: true
            },
            time: {
                required: true
            },
            gender: {
                required: true
            },
            bloodgroup: {
                required: true
            },
            dob: {
                required: true
            }
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            event.stopPropagation();
            const form$ = jQuery(form);
            const datetime = form$.find('.dater').val() + ' ' + form$.find('.time').val() + ':00';
            const uuid = form$.find('.uuid').val();
            const data = {
                uuid: uuid ? uuid : null,
                doctor: form$.find('.doctor').val(),
                datetime: datetime,
                dob: form$.find('.dob').val(),
                gender: form$.find('.gender').val(),
                blood_group: form$.find('.blood-group').val(),
            }
            const btnSubmit = jQuery(form).find('.btn-submit');
            btnSubmit.prop('disabled', true);
            jQuery.ajax({
                url: 'appointments',
                method: 'PUT',
                data: data,
                success: function (res) {

                },
                error: function (err) {
                    btnSubmit.prop('disabled', false);

                },
                complete: function () {
                }
            })
        }
    });
});