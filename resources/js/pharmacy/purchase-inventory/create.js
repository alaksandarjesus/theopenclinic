const moment = require("moment");

jQuery(function(){
    const purchaseInventoryCreateForm = jQuery("form.purchase-inventory-create");

    if(_.isEmpty(purchaseInventoryCreateForm)){
        return;
    }
    purchaseInventoryCreateForm.find('.expiry_date').datepicker({
        dateFormat:'dd-mm-yy'
    });
    purchaseInventoryCreateForm.validate({
        submitHandler: function(form, event){
            event.preventDefault();
            event.stopPropagation();
            const data = {
                order: {
                    uuid: jQuery(form).attr('data-order-uuid'),
                    
                },
                items:getPurchaseInventoryTableItems()
            }

            if(_.isEmpty(data.items)){
                return;
            }
            jQuery(form).find('.btn-submit').prop('disabled', true);
            jQuery.ajax({
                url: 'pharmacy/purchases/'+data.order.uuid+'/inventory',
                method: 'POST',
                data: data,
                success: function(){
                },
                error: function(){
                    jQuery(form).find('.btn-submit').prop('disabled', false);
                },
                complete: function(){
                    
                }

            })
        }
    })

    function getPurchaseInventoryTableItems(){
        let date,qty,temp;
        let items = [];
        let hasValidDates = true;
        purchaseInventoryCreateForm.find('table tbody tr').each(function(){
            qty = jQuery(this).find(".qty").val();
            if(qty && !isNaN(qty)){
                date = jQuery(this).find('.expiry_date').val();
                expiry_date = date?moment(date, 'DD-MM-YYYY'):'';
                if(expiry_date && !expiry_date.isValid()){
                    hasValidDates = false;
                }
            }          
        });
        if(!hasValidDates){
            args =  {
                title: 'Alert',
                body: 'Invalid date specified',
            }
            twAlertModal(args);
            return [];
        }

        purchaseInventoryCreateForm.find('table tbody tr').each(function(){
            qty = jQuery(this).find(".qty").val();
            if(qty && !isNaN(qty)){
                date = jQuery(this).find('.expiry_date').val();
                expiry_date = date?moment(date, 'DD-MM-YYYY'):'';
                    temp = {
                        uuid: jQuery(this).attr('data-item-uuid'),
                        qty: qty,
                        batch: jQuery(this).find('.batch').val(),
                        expiry_date: expiry_date?expiry_date.format('YYYY-MM-DD'):'',
                        comments: jQuery(this).find('.comments').val()
                    }
                    items.push(_.clone(temp));
            }
        });
        if(_.isEmpty(items)){
            args =  {
                title: 'Alert',
                body: 'Invalid quantity specified',
            }
            twAlertModal(args);
            return [];
        }
        return items;
    }
});