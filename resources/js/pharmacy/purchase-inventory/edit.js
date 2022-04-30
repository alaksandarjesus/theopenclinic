const moment = require("moment");

jQuery(function () {
    const purchaseInventoryEditForm = jQuery("form.purchase-inventory-edit");

    if (_.isEmpty(purchaseInventoryEditForm)) {
        return;
    }
    purchaseInventoryEditForm.find('.expiry_date').datepicker({
        dateFormat: 'dd-mm-yy'
    })
    purchaseInventoryEditForm.validate({
        submitHandler: function (form, event) {
            event.preventDefault();
            event.stopPropagation();
            const data = {
                order: {
                    uuid: jQuery(form).attr('data-order-uuid')
                },
                inventory: {
                    uuid: jQuery(form).attr('data-inventory-uuid'),
                    qty: jQuery(form).find('.qty').val(),
                    batch: jQuery(form).find('.batch').val(),
                    expiry_date: jQuery(form).find('.expiry_date').val(),
                    comments: jQuery(form).find('.comments').val(),
                },
            }
            if (_.isEmpty(data.inventory.qty) || isNaN(data.inventory.qty)) {
                args = {
                    title: 'Alert',
                    body: 'Invalid quantity',
                }
                twAlertModal(args);
                return [];
            }
            if (data.inventory.expiry_date) {
                const momented = moment(data.inventory.expiry_date, 'DD-MM-YYYY');
                if (!momented.isValid()) {
                    args = {
                        title: 'Alert',
                        body: 'Invalid Expiry Date',
                    }
                    twAlertModal(args);
                    return [];
                }
                data.inventory.expiry_date = momented.format('YYYY-MM-DD');
            }
            jQuery(form).find('.btn-submit').prop('disabled', true);
            jQuery.ajax({
                url: 'pharmacy/purchases/' + data.order.uuid + '/inventory/' + data.inventory.uuid,
                method: 'PUT',
                data: data,
                success: function () {
                },
                error: function () {
                    jQuery(form).find('.btn-submit').prop('disabled', false);
                },
                complete: function () {

                }

            });
        }
    });
});