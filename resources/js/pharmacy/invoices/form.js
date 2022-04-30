jQuery(function(){
    const pharmacyInvoiceForm = jQuery("form.pharmacy-invoice");
    if(!pharmacyInvoiceForm || !pharmacyInvoiceForm.length){
        return;
    }

    const pharmacyInvoiceTable = jQuery("table.pharmacy-invoice");
    if (!pharmacyInvoiceTable || !pharmacyInvoiceTable.length) {
        return;
    }
    const invoiceDate =  pharmacyInvoiceForm.find('.invoice_date');
    invoiceDate.datepicker({
        dateFormat: 'dd-mm-yy',
        defaultDate: new Date()
    }).datepicker('setDate', new Date());

    jQuery(".customer").select2();

    pharmacyInvoiceForm.find('.btn-submit').on('click', function(){
        const data = preparePharmacyInvoiceFormData();
        const dataIsValid = validatePharmacyInvoiceFormData(data);
        if(!dataIsValid){
            return;
        }
        data.submitted = !!JSON.parse(jQuery(this).attr('data-submitted'));
      
        jQuery.ajax({
            url: 'pharmacy/invoices',
            method:'POST',
            data: data,
            success: function(res){
                
            },
            error: function(err){

            },
            complete: function(){

            }
        });
    });
    function validatePharmacyInvoiceFormData(data){
        if(!data.invoice_number){
            const args = {
                'title' : 'Error processing',
                'body' : 'Order Number is required'
            }
            window.twAlertModal(args);
            return false;
        }
        if(_.isEmpty(_.get(data, 'customer.uuid', null))){
            const args = {
                'title' : 'Error processing',
                'body' : 'Customer is required'
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
                'body' : 'Drug duplicate cannot be processed.'
            }
            window.twAlertModal(args);
            return false;
        }
        return true;
    }

    function preparePharmacyInvoiceFormData(){
        const data = {
            uuid: pharmacyInvoiceForm.find('.uuid').val(),
            invoice_number: pharmacyInvoiceForm.find('.invoice_number').val(),
            invoice_date: pharmacyInvoiceForm.find('.invoice_date').val(),
            customer: {uuid: pharmacyInvoiceForm.find('.customer').val()},
            items: [],
            subtotal: getInputNumericValue(pharmacyInvoiceForm.find('.subtotal').val()),
            tax: getInputNumericValue(pharmacyInvoiceForm.find('.taxtotal').val()),
            discount: getInputNumericValue(pharmacyInvoiceForm.find('.discount').val()),
            total: getInputNumericValue(pharmacyInvoiceForm.find('.finaltotal').val()),
            comments: pharmacyInvoiceForm.find('.comments').val(),
        }
        pharmacyInvoiceTable.find('tbody tr').each(function(){
            let drugUuid = jQuery(this).find('select.drug').val();
            if(!_.isEmpty(drugUuid)){
                const item = {
                    uuid: jQuery(this).closest('tr').attr('data-item-uuid'),
                    drug : {uuid: drugUuid},
                    qty : getInputNumericValue(jQuery(this).find('input.qty').val()),
                    price : getInputNumericValue(jQuery(this).find('input.price').val()),
                    tax : getInputNumericValue(jQuery(this).find('input.tax').val()),
                    total : getInputNumericValue(jQuery(this).find('input.total').val()),
                }
               
                data.items.push(_.cloneDeep(item));
            }
            
        });
        return data;
    }
});