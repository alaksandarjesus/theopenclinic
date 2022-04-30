jQuery(function () {
    const alertModal = jQuery(".alert.modal");
    if (!alertModal.length) {
        return;
    }
    alertModal.open = function () {
        if (alertModal.is(":visible")) {
            return;
        }
        jQuery('body').addClass('overflow-hidden');
        jQuery('body').find('.super-container').addClass('blur-sm');
        alertModal.find('.btn-clickable').prop('disabled', false);
        alertModal.removeClass('hidden');
    }
    alertModal.close = function () {
        jQuery('body').removeClass('overflow-hidden');
        jQuery('body').find('.super-container').removeClass('blur-sm');
        alertModal.addClass('hidden');
    }
    window.twAlertModal = function (args) {
        alertModal.find('.modal-title').html(_.get(args, 'title', 'Oops!!'));
        alertModal.find('.modal-body').html(_.get(args, 'body', 'Something went wrong... Contact Administrator.'));
        alertModal.find('.btn-agree').text(_.get(args, 'btn.agree', 'Ok'));
        alertModal.open();
        alertModal.on('click', '.btn-clickable', function () {
            alertModal.close();
        });
    }
});