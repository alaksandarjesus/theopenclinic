import numeral from 'numeral';

jQuery(function(){
    let args;
    const invoiceReturnCreateForm = jQuery("form.invoice-return-create");
    if(_.isEmpty(invoiceReturnCreateForm)){
        return;
    }
    invoiceReturnCreateForm.find(".update-total").on('blur', function(){
        const tr = jQuery(this).closest('tr');
        let qty = getInputNumericValue(tr.find('input.qty').val());
        if(!qty || isNaN(qty)){
            return;
        }

        let price = getInputNumericValue(tr.find('input.price').val());
        let tax = getInputNumericValue(tr.find('input.tax').val());
        let rowValue = qty*price;
        let rowTaxValue = rowValue*tax/100;
        let totalValue = rowValue+rowTaxValue;
        let numeralTotal = numeral(totalValue).format('0,0.00');
        tr.find('input.total').val(numeralTotal);
        tr.find('input.qty').val(numeral(qty).format('0,0.00'));
    });

    function getInvoiceReturnItems(){
        const data = [];
        invoiceReturnCreateForm.find('tbody tr').each(function(){
            let itemUuid = jQuery(this).attr('data-item-uuid');
            let qty = getInputNumericValue(jQuery(this).find('input.qty').val());
            if(!_.isEmpty(itemUuid) && qty && !isNaN(qty)){
                const item = {
                    item : {uuid: itemUuid},
                    qty : getInputNumericValue(jQuery(this).find('input.qty').val()),
                    price : getInputNumericValue(jQuery(this).find('input.price').val()),
                    tax : getInputNumericValue(jQuery(this).find('input.tax').val()),
                    total : getInputNumericValue(jQuery(this).find('input.total').val()),
                    comments : jQuery(this).find('input.comments').val(),
                }
               
                data.push(_.cloneDeep(item));
            }
            
        });
        return data;
    }
    invoiceReturnCreateForm.validate({
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const data = {
                invoice: {
                    uuid: jQuery(form).attr('data-invoice-uuid')
                },
                items: getInvoiceReturnItems(),
            }
            if(_.isEmpty(data.items)){
                args =  {
                    title: 'Alert',
                    body: 'Invalid items specified',
                }
                twAlertModal(args);
                return;
            }
            jQuery(form).find('.btn-submit').prop('disabled', true);
            jQuery.ajax({
                url: 'pharmacy/invoices/' + data.invoice.uuid + '/returns',
                method: 'POST',
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