import numeral from 'numeral';

jQuery(function () {
    const pharmacyInvoiceForm = jQuery("form.pharmacy-invoice");
    if (!pharmacyInvoiceForm || !pharmacyInvoiceForm.length) {
        return;
    }
    const pharmacyInvoiceTable = jQuery("table.pharmacy-invoice");
    if (!pharmacyInvoiceTable || !pharmacyInvoiceTable.length) {
        return;
    }
    if (!pharmacyInvoiceForm.find(".uuid").val()) { // new invoice
        appendPharmacyInvoiceTableRow();
    }else{
        setPharmacyInvoiceTableIndex();
    }


    pharmacyInvoiceTable.on('blur', '.add-new-row', function(event){
        const trLength = pharmacyInvoiceTable.find('tbody tr').length;
        const lastIndex = trLength - 1;
        const drugVal = pharmacyInvoiceTable.find('tbody tr:eq('+lastIndex+')').find('.drug').val();
        if(!drugVal){
            return;
        }
        appendPharmacyInvoiceTableRow();
    });

    pharmacyInvoiceTable.on('blur', '.discount', function(event){
        calculatePharmacyInvoiceOverallTotals();
    });

    pharmacyInvoiceTable.on('click', '.btn-delete-row', function(event){
        jQuery(event.target).closest('tr').remove();
        calculatePharmacyInvoiceOverallTotals();

    });

    pharmacyInvoiceTable.on('change', '.drug', function(event){
        const target = jQuery(event.target);
        if(_.isEmpty(target.val())){
            target.closest('tr').find('input.price').val(setInputNumericValue(0));
            target.closest('tr').find('input.tax').val(setInputNumericValue(0));
            target.closest('tr').find('input.qty').val(setInputNumericValue(0));
            return;
        }
        let price = target.find('option:selected').attr('data-price');
        let tax = target.find('option:selected').attr('data-tax');
        target.closest('tr').find('input.price').val(setInputNumericValue(price));
        target.closest('tr').find('input.tax').val(setInputNumericValue(tax));
    });

    pharmacyInvoiceTable.on('blur', '.update-row-total', function(event){
        const target = jQuery(event.target);
        let qty = getInputNumericValue(target.closest('tr').find('input.qty').val());
        let price = getInputNumericValue(target.closest('tr').find('input.price').val());
        let tax = getInputNumericValue(target.closest('tr').find('input.tax').val());
        let rowValue = qty*price;
        let rowTaxValue = rowValue*tax/100;
        let totalValue = rowValue+rowTaxValue;
        let numeralTotal = numeral(totalValue).format('0,0.00');
        target.closest('tr').find('input.total').val(numeralTotal);
        calculatePharmacyInvoiceOverallTotals();
    });

    function calculatePharmacyInvoiceOverallTotals(){
        let subtotal = 0;
        let taxTotal = 0;
        let qty,price,tax,rowValue,rowTaxValue;
        pharmacyInvoiceTable.find('tbody tr').each(function(){
            qty = getInputNumericValue(jQuery(this).find('input.qty').val());
            price = getInputNumericValue(jQuery(this).find('input.price').val());
            tax = getInputNumericValue(jQuery(this).find('input.tax').val());
            rowValue = qty*price;
            rowTaxValue = rowValue*tax/100;
            subtotal = subtotal + rowValue;
            taxTotal = taxTotal + rowTaxValue;
        });
        const discount = getInputNumericValue(pharmacyInvoiceTable.find('.discount').val());
        let finalTotal = subtotal+taxTotal - discount;
        pharmacyInvoiceTable.find('.subtotal').val(setInputNumericValue(subtotal));
        pharmacyInvoiceTable.find('.discount').val(setInputNumericValue(discount));
        pharmacyInvoiceTable.find('.taxtotal').val(setInputNumericValue(taxTotal));
        pharmacyInvoiceTable.find('.finaltotal').val(setInputNumericValue(finalTotal));
    }

    function appendPharmacyInvoiceTableRow() {
        const template = jQuery("#pharmacyInvoiceTableRow").html();
        pharmacyInvoiceTable.find('tbody').append(_.template(template));
        setPharmacyInvoiceTableIndex();

    }

    function setPharmacyInvoiceTableIndex() {
        pharmacyInvoiceTable.find('tbody tr').each(function (index) {
            jQuery(this).find('td:eq(0)').text(index + 1)
        });
        pharmacyInvoiceTable.find('tbody tr:eq(0)').find('.btn-delete-row').remove();
        pharmacyInvoiceTable.find('tbody tr').each(function(index){
            if(!jQuery(this).find('.drug').hasClass('select2-hidden-accessible')){
                jQuery(this).find(".drug").select2()
            }
        
        });
    }
});