jQuery(function(){
    const orderDate = jQuery(".order_date");
    const purchaseOrderForm = jQuery("form.purchase-order");
    if(!orderDate || !orderDate.length){
        return;
    }
    if(!purchaseOrderForm || !purchaseOrderForm.length){
        return;
    }
    const purchaseOrderTable = jQuery("table.purchase-order");
    if(!purchaseOrderTable || !purchaseOrderTable.length){
        return;
    }
    orderDate.datepicker({
        dateFormat: 'dd-mm-yy',
        defaultDate: new Date()
    }).datepicker('setDate', new Date());

    purchaseOrderForm.find('.btn-submit').on('click', function(){
        const data = preparePurchaseOrderFormData();
        const dataIsValid = validatePurchaseOrderFormData(data);
        if(!dataIsValid){
            return;
        }
        data.submitted = !!JSON.parse(jQuery(this).attr('data-submitted'));

        if(data.submitted){
            const args = {
                title: 'Confirmation Required',
                body: 'Are you sure you want to submit this purchase order <strong>#' +data.order_number+ '</strong>',
                data: {}
            }
            window.twConfirmModal(args,  function (modal,ret) {
                modal.disableClickable(false);
                modal.close();
                if(!ret.confirm){
                    return;
                }
                makePurchaseApi(data);
            })
        }
        else{
            makePurchaseApi(data);
        }
        
    });

    function makePurchaseApi(data){
        jQuery.ajax({
            url: 'pharmacy/purchases',
            method:'POST',
            data: data,
            success: function(res){
            },
            error: function(err){

            },
            complete: function(){

            }
        });
    }

    function validatePurchaseOrderFormData(data){
        if(!data.order_number){
            const args = {
                'title' : 'Error processing',
                'body' : 'Order Number is required'
            }
            window.twAlertModal(args);
            return false;
        }
        if(_.isEmpty(_.get(data, 'supplier.uuid', null))){
            const args = {
                'title' : 'Error processing',
                'body' : 'Supplier is required'
            }
            window.twAlertModal(args);
            return false;
        }
        const drugUuids = _.map(data.items, (item) => _.get(item, 'drug.uuid', '')).filter(v => v);
      
        if(_.isEmpty(drugUuids)){
            const args = {
                'title' : 'Error processing',
                'body' : 'Atleast one drug is required'
            }
            window.twAlertModal(args);
            return false;
        }
        const uniqDrugUuids = _.uniq(drugUuids);

        if(drugUuids.length !== uniqDrugUuids.length){
            const args = {
                'title' : 'Error processing',
                'body' : 'Drug duplicate order cannot be processed.'
            }
            window.twAlertModal(args);
            return false;
        }
        return true;
    }

    function preparePurchaseOrderFormData(){
        const data = {
            uuid: purchaseOrderForm.find('.uuid').val(),
            order_number: purchaseOrderForm.find('.order_number').val(),
            order_date: purchaseOrderForm.find('.order_date').val(),
            supplier: {uuid: purchaseOrderForm.find('.supplier').val()},
            items: [],
            subtotal: getInputNumericValue(purchaseOrderForm.find('.subtotal').val()),
            tax: getInputNumericValue(purchaseOrderForm.find('.taxtotal').val()),
            discount: getInputNumericValue(purchaseOrderForm.find('.discount').val()),
            total: getInputNumericValue(purchaseOrderForm.find('.finaltotal').val()),
            comments: purchaseOrderForm.find('.comments').val(),
        }
        purchaseOrderTable.find('tbody tr').each(function(){
            let drugUuid = jQuery(this).find('select.drug').val();
            if(!_.isEmpty(drugUuid)){
                const item = {
                    uuid: jQuery(this).closest('tr').attr('data-item-uuid'),
                    drug : {uuid: drugUuid},
                    qty : getInputNumericValue(jQuery(this).find('input.qty').val()),
                    cost : getInputNumericValue(jQuery(this).find('input.cost').val()),
                    tax : getInputNumericValue(jQuery(this).find('input.tax').val()),
                    total : getInputNumericValue(jQuery(this).find('input.total').val()),
                }
               
                data.items.push(_.cloneDeep(item));
            }
            
        });
        return data;
    }

});