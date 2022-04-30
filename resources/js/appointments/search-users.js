jQuery(function () {
    const btnCreateAppointmentSearchUsers = jQuery(".btn-create-appointment-search-users");
    if (!btnCreateAppointmentSearchUsers || !btnCreateAppointmentSearchUsers.length) {
        return;
    }

    

    btnCreateAppointmentSearchUsers.on('click', function () {
        window.searchUsersModal.open();
    });

    window.searchUsersModal.on('click', function(event){
        const target$ = jQuery(event.target);
        if(!target$.closest('tr').hasClass('user-row')){
            return;
        }
        const row$ = target$.closest('tr');
        const user = {
            uuid: row$.attr('data-uuid'),
            username: row$.attr('data-username'),
            email: row$.find('.email').text(),
            mobile: row$.find('.mobile').text(),
            name: row$.find('.name').text(),
            gender: row$.find('.gender').text(),
            blood_group: row$.find('.blood-group').text(),
            dob: row$.find('.dob').text(),
            age: row$.find('.age').text(),
        }
        const form$ = btnCreateAppointmentSearchUsers.closest('form.create-appointment');
        form$.find(".uuid").val(user.uuid);
        form$.find(".email").val(user.email);
        form$.find(".mobile").val(user.mobile);
        form$.find(".name").val(user.name);
        form$.find(".gender").val(user.gender);
        form$.find(".blood-group").val(user.blood_group);
        form$.find(".dob").val(user.dob);
        form$.find(".age").text(user.age? user.age+ ' Years':'');
        window.searchUsersModal.hide();
    });
});