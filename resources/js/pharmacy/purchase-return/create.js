import numeral from 'numeral';

jQuery(function(){
    let args;
    const purchaseReturnCreateForm = jQuery("form.purchase-return-create");
    if(_.isEmpty(purchaseReturnCreateForm)){
        return;
    }
    purchaseReturnCreateForm.find(".update-total").on('blur', function(){
        const tr = jQuery(this).closest('tr');
        let qty = getInputNumericValue(tr.find('input.qty').val());
        if(!qty || isNaN(qty)){
            return;
        }

        let cost = getInputNumericValue(tr.find('input.cost').val());
        let tax = getInputNumericValue(tr.find('input.tax').val());
        let rowValue = qty*cost;
        let rowTaxValue = rowValue*tax/100;
        let totalValue = rowValue+rowTaxValue;
        let numeralTotal = numeral(totalValue).format('0,0.00');
        tr.find('input.total').val(numeralTotal);
        tr.find('input.qty').val(numeral(qty).format('0,0.00'));
    });

    function getPurchaseReturnInventoryItems(){
        const data = [];
        purchaseReturnCreateForm.find('tbody tr').each(function(){
            let itemUuid = jQuery(this).attr('data-item-uuid');
            let inventoryUuid = jQuery(this).attr('data-inventory-uuid');
            let qty = getInputNumericValue(jQuery(this).find('input.qty').val());
            if(!_.isEmpty(itemUuid) && qty && !isNaN(qty)){
                const item = {
                    item : {uuid: itemUuid},
                    inventory: {uuid: inventoryUuid},
                    qty : getInputNumericValue(jQuery(this).find('input.qty').val()),
                    cost : getInputNumericValue(jQuery(this).find('input.cost').val()),
                    tax : getInputNumericValue(jQuery(this).find('input.tax').val()),
                    total : getInputNumericValue(jQuery(this).find('input.total').val()),
                    comments : jQuery(this).find('input.comments').val(),
                }
               
                data.push(_.cloneDeep(item));
            }
            
        });
        return data;
    }
    purchaseReturnCreateForm.validate({
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const data = {
                order: {
                    uuid: jQuery(form).attr('data-order-uuid')
                },
                items: getPurchaseReturnInventoryItems(),
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
                url: 'pharmacy/purchases/' + data.order.uuid + '/returns',
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