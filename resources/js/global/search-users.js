jQuery(function(){
    window.searchUsersModal = searchUsersModal = jQuery(".modal.search-users");
    if(!window.searchUsersModal){
        return;
    }

    window.searchUsersModal.open = function () {
        jQuery('body').addClass('overflow-hidden');
        jQuery('body').find('.super-container').addClass('blur-sm');
        window.searchUsersModal.find(".users-list-table").empty();
        window.searchUsersModal.find(".no-users-found").hide();
        window.searchUsersModal.find(".query").val('');
        setTimeout(()=>{
            window.searchUsersModal.find(".query")[0].focus();
        })
        window.searchUsersModal.removeClass('hidden');
    }
    window.searchUsersModal.hide = function () {
        jQuery('body').removeClass('overflow-hidden');
        jQuery('body').find('.super-container').removeClass('blur-sm');
        window.searchUsersModal.find(".users-list-table").empty();
        window.searchUsersModal.find(".no-users-found").hide();
        window.searchUsersModal.find(".query").val('');
        window.searchUsersModal.addClass('hidden');
    }
    const searchUsersForm = jQuery("form.search-users");
    if(!searchUsersForm || !searchUsersForm.length){
        return;
    }
    const usersListTable = searchUsersForm.closest('.modal.search-users').find(".users-list-table");
    const noUsersFound = searchUsersForm.closest('.modal.search-users').find(".no-users-found");
    searchUsersForm.find('.query').on('keyup', function(){
        usersListTable.empty();
        noUsersFound.hide();
    });

    window.searchUsersModal.find('.btn-close').on('click', function(){
        window.searchUsersModal.hide();
    });
    
    searchUsersForm.validate({
        rules: {
            query: {
                required: true,
                minlength: 3,
                maxlength: 20
            }
        },
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const form$ = jQuery(form);
            const data = {
                q: form$.find(".query").val()
            }
            form$.find('.btn-submit').prop('disabled', true);
           
            usersListTable.empty();
            noUsersFound.hide();
            jQuery.ajax({
                url: 'users/search',
                data: data,
                method: 'POST',
                success: function(res){
                    const searchUsersModalUsersListTemplate = jQuery("#searchUsersModalUsersListTemplate").html();
                    const users = _.get(res, 'users', []);
                    if(_.isEmpty(users)){
                        noUsersFound.show();
                        return;
                    }
                    console.log(users)
                    const compiled = _.template(searchUsersModalUsersListTemplate)({users:users});
                    usersListTable.html(compiled);

                },
                error: function(err){

                },
                complete: function(){
                    form$.find('.btn-submit').prop('disabled', false);
                }
            })
        }
    })
});