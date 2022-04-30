jQuery(function(){
    const userForm = jQuery("form.user");
    if(_.isEmpty(userForm)){
        return;
    }
    userForm.find(".username").on('keyup', function(){
        const value = jQuery(this).val();
        if(_.isEmpty(value)){
            return;
        }
        jQuery(this).val(_.toLower(value));
    });
    userForm.find(".dob").datepicker({
        dateFormat: 'dd-mm-yy'
    })
    userForm.validate({
        rules: {
            gender: {
                required: true
            },
            name:{
                required: true,
                minlength: 3,
                maxlength: 30,
                pattern: '^[A-Za-z\\s]*$'

            },
            email: {
                required: true,
                email:true,
                minlength: 3,
                maxlength: 30
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10,
            },
            username: {
                required: true,
                minlength: 5,
                maxlength: 30,
                pattern: '^[a-z0-9\_]*$'
            },
            password: {
                required: false,
                minlength: 8,
                maxlength: 12,
                pattern:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$!%*?&])[A-Za-z\d@#$!%*?&]{8,12}$/
            },
            role: {
                required: true
            }
        },
        messages: {
            name: {
                pattern: "Only alphabets, and spaces allowed"
            },
            username:{
                pattern: "Lowercase letters, underscore and numbers only allowed"
            },
            password: {
                pattern: "At least one uppercase letter, one lowercase letter, one number and one special character"
            }
        },
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const form$ = jQuery(form);
            const data = {
                uuid: form$.find('.uuid').val(),
                gender: form$.find('.gender').val(),
                name: form$.find('.name').val(),
                email: form$.find('.email').val(),
                mobile: form$.find('.mobile').val(),
                username: form$.find('.username').val(),
                password: form$.find('.password').val(),
                role: form$.find('.role').val(),
                dob: form$.find('.dob').val(),
                blood_group: form$.find('.blood-group').val(),
                active: form$.find(".active").is(":checked")?true:false
            }
            const btnSubmit = jQuery(form).find('.btn-submit');
            btnSubmit.prop('disabled', true);
            jQuery.ajax({
                url: 'users',
                method:'POST',
                data: data,
                success: function(res){
                },
                error: function(err){
                    btnSubmit.prop('disabled', false);

                },
                complete: function(){

                }
            })
        }
    });
});