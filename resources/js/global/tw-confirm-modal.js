jQuery(function () {
  const confirmModal = jQuery(".confirm.modal");
  if (!confirmModal.length) {
    return;
  }
  confirmModal.open = function(){
    jQuery('body').addClass('overflow-hidden');
    jQuery('body').find('.super-container').addClass('blur-sm');
    confirmModal.find('.btn-clickable').prop('disabled', false);
    confirmModal.removeClass('hidden');
  }
  confirmModal.close = function(){
    jQuery('body').removeClass('overflow-hidden');
    jQuery('body').find('.super-container').removeClass('blur-sm');
    confirmModal.addClass('hidden');
  }
  confirmModal.disableClickable = function(disable){
    confirmModal.find(".btn-clickable").prop('disabled', disable);
  }
  window.twConfirmModal = function (args, callback) {
    confirmModal.find('.modal-title').html(_.get(args, 'title', 'Confirm'));
    confirmModal.find('.modal-body').html(_.get(args, 'body', 'Are you sure you want to perform this action?'));
    confirmModal.find('.btn-cancel').text(_.get(args, 'btns.cancel', 'Cancel'));
    confirmModal.find('.btn-confirm').text(_.get(args, 'btns.confirm', 'Confirm'));
    confirmModal.open();
    confirmModal.off().on('click', '.btn-clickable', function(){
      const value = parseInt(jQuery(this).attr('data-value'))?true:false;
      _.set(args, 'data.confirm', value);
      callback(confirmModal, _.get(args, 'data'));
    });
  }
});