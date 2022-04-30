jQuery(function(){
    const appointmentCreateForm = jQuery('form.create-appointment');
    if(!appointmentCreateForm || !appointmentCreateForm.length){
        return;
    }

    const timeSelect = appointmentCreateForm.find('.time');
    setTimeout(()=>{
        timeSelect.prop('disabled', true);
    });
    appointmentCreateForm.find('.doctor').on('change', function(){
        getAvailableTimeslots();
    });

    appointmentCreateForm.find('.dater').datepicker({
        dateFormat: 'dd-mm-yy',
        defaultDate: new Date(),
        onSelect: function (date, event) {
            getAvailableTimeslots();
        }
    }).datepicker('setDate', new Date());

    appointmentCreateForm.find('.dob').datepicker({
        dateFormat: 'dd-mm-yy',
    });
    

    function getAvailableTimeslots() {
        const data = {
            doctor: appointmentCreateForm.find('.doctor').val(),
            date: appointmentCreateForm.find('.dater').val(),
        }
        if(!data.doctor || !data.date){
            timeSelect.prop('disabled', true);
            return;
        }
        timeSelect.prop('disabled', true);
        jQuery.ajax({
            url: 'appointments/doctor-availability',
            method: 'POST',
            data: data,
            success: function(res){
                updateTimeslots(res);
            },
            error: function(err){

            },
            complete: function(){
                
            }
        })

    }

    function updateTimeslots(res){
        const booked = _.get(res, 'booked');
        timeSelect.prop('disabled', false);
        timeSelect.find('option').removeClass('text-danger').prop('disabled', false);
        timeSelect.val('');
        if(!_.isEmpty(booked)){
            timeSelect.find('option').each(function(){
                const value = jQuery(this).attr('value');
                if(booked.indexOf(value) !== -1){
                    jQuery(this).addClass('text-danger').prop('disabled', true);
                }
            });
        }
    }

    appointmentCreateForm.validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 30
            }, email: {
                required: true,
                minlength: 3,
                maxlength: 30
            },
            mobile: {
                required: true,
                minlength: 10,
                maxlength: 10
            },
            doctor:{
                required: true
            },
            dater: {
                required: true
            },
            time:{
                required: true
            },
            gender:{
                required: true
            },
            bloodgroup:{
                required: true
            },
            dob:{
                required: true
            }
        },
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const form$ = jQuery(form);
            const datetime = form$.find('.dater').val()+' '+form$.find('.time').val()+':00';
            const uuid = form$.find('.uuid').val();
            const data = {
                uuid: uuid?uuid:null,
                name: uuid?null:form$.find('.name').val(),
                email: uuid?null:form$.find('.email').val(),
                mobile: uuid?null:form$.find('.mobile').val(),
                doctor: form$.find('.doctor').val(),
                datetime: datetime,
                dob: form$.find('.dob').val(),
                gender: form$.find('.gender').val(),
                blood_group: form$.find('.blood-group').val(),

            }
            btnSubmit = form$.find('.btn-submit');
            btnSubmit.prop('disabled', true);
            jQuery.ajax({
                url: 'appointments',
                method:'POST',
                data: data,
                success: function(res){
                    
                },
                error: function(err){
                    btnSubmit.prop('disabled', false);

                },
                complete: function(){
                    btnSubmit.prop('disabled', false);
                }
            })
        }
    });
});