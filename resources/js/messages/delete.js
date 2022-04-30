jQuery(function () {
    const form$ =jQuery("form.message");
    if (!form$.length) {
        return;
    }
    
    form$.on('click', '.btn-delete', function () {
        const uuid = form$.find(".uuid").val();
        const args = {
            title: 'Confirmation Required',
            body: `Are you sure you want to delete this message thread`,
            data: {uuid: uuid}
        }
        window.twConfirmModal(args, onMessagesConfirmDelete);
    });
    function onMessagesConfirmDelete(modal,data) {
        if(!data.confirm){
            modal.disableClickable(false);
            modal.close();
            return;
        }
        jQuery.ajax({
            url: `/messages/${data.uuid}`,
            method: 'DELETE',
            success: function (res) {
                modal.disableClickable(false);
                modal.close();
            },
            error: function (err) {

            },
            complete: function () {
              
            }
        })
    }
});