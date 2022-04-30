import numeral from 'numeral';

jQuery(function(){
    let args;
    const invoiceeReturnEditForm = jQuery("form.invoice-return-edit");
    if(_.isEmpty(invoiceeReturnEditForm)){
        return;
    }
    invoiceeReturnEditForm.find(".update-total").on('keyup', function(){
        let qty = getInputNumericValue(invoiceeReturnEditForm.find('input.qty').val());
        let price = getInputNumericValue(invoiceeReturnEditForm.find('input.price').val());
        let tax = getInputNumericValue(invoiceeReturnEditForm.find('input.tax').val());
        let rowValue = qty*price;
        let rowTaxValue = rowValue*tax/100;
        let totalValue = rowValue+rowTaxValue;
        let numeralTotal = numeral(totalValue).format('0,0.00');
        invoiceeReturnEditForm.find('input.total').val(numeralTotal);
    });
    invoiceeReturnEditForm.validate({
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const data = {
                invoice: {
                    uuid: jQuery(form).attr('data-invoice-uuid')
                },
                return: {
                    uuid: jQuery(form).attr('data-return-uuid'),
                    qty: jQuery(form).find('.qty').val(),
                    tax: jQuery(form).find('.tax').val(),
                    price: jQuery(form).find('.price').val(),
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
                url: 'pharmacy/invoices/' + data.invoice.uuid + '/returns/' + data.return.uuid,
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