jQuery(function () {
    const rolesTable = jQuery('table.roles');
    if (!rolesTable.length) {
        return;
    }
    const roleForm = jQuery('form.role');
    rolesTable.on('click', '.btn-edit', function () {
        const uuid = jQuery(this).closest('tr').attr('data-uuid');
        const name = jQuery(this).closest('tr').find('td.name').text();
        roleForm.find('.name').val(name);
        roleForm.find('.uuid').val(uuid);
    });
});