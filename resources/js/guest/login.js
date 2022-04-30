jQuery(function(){
    const loginForm = jQuery("form.login");
    if(!loginForm.length){
        return;
    }

    loginForm.validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true,
                minlength:3,
                maxlength:12
            }
        },
        messages:{

        },
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const data = {
                username : jQuery(form).find('.username').val(),
                password : jQuery(form).find('.password').val(),
            }
            const btnSubmit = jQuery(form).find('.btn-submit');
            btnSubmit.prop('disabled', true);
            jQuery.ajax({
                url: 'guest/login',
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
    })
});