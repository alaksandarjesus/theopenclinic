import numeral from 'numeral';

jQuery(function(){
    let args;
    const purchaseReturnEditForm = jQuery("form.purchase-return-edit");
    if(_.isEmpty(purchaseReturnEditForm)){
        return;
    }
    purchaseReturnEditForm.find(".update-total").on('keyup', function(){
        let qty = getInputNumericValue(purchaseReturnEditForm.find('input.qty').val());
        let cost = getInputNumericValue(purchaseReturnEditForm.find('input.cost').val());
        let tax = getInputNumericValue(purchaseReturnEditForm.find('input.tax').val());
        let rowValue = qty*cost;
        let rowTaxValue = rowValue*tax/100;
        let totalValue = rowValue+rowTaxValue;
        let numeralTotal = numeral(totalValue).format('0,0.00');
        purchaseReturnEditForm.find('input.total').val(numeralTotal);
    });
    purchaseReturnEditForm.validate({
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const data = {
                order: {
                    uuid: jQuery(form).attr('data-order-uuid')
                },
                return: {
                    uuid: jQuery(form).attr('data-return-uuid'),
                    qty: jQuery(form).find('.qty').val(),
                    tax: jQuery(form).find('.tax').val(),
                    cost: jQuery(form).find('.cost').val(),
                    total: jQuery(form).find('.total').val(),
                    comments: jQuery(form).find('.comments').val(),
                },
            }
            if (_.isEmpty(data.return.qty) || isNaN(data.return.qty)) {
                args = {
                    title: 'Alert',
                    body: 'Invalid quantity',
                }
                twAlertModal(args);
                return [];
            }
            jQuery(form).find('.btn-submit').prop('disabled', true);
            jQuery.ajax({
                url: 'pharmacy/purchases/' + data.order.uuid + '/returns/' + data.return.uuid,
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
    })
});