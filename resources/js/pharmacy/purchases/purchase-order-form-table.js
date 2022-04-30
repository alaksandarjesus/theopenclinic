import numeral from 'numeral';

jQuery(function(){
    const purchaseOrderForm = jQuery("form.purchase-order");
    if(!purchaseOrderForm || !purchaseOrderForm.length){
        return;
    }

    const purchaseOrderTable = jQuery("table.purchase-order");
    if(!purchaseOrderTable || !purchaseOrderTable.length){
        return;
    }
    if(!purchaseOrderForm.find(".uuid").val()){ // new purchase order
        appendPurchaseOrderTableRow();
    }
   
    purchaseOrderTable.on('blur', '.add-new-row', function(event){
        const trLength = purchaseOrderTable.find('tbody tr').length;
        const lastIndex = trLength - 1;
        const drugVal = purchaseOrderTable.find('tbody tr:eq('+lastIndex+')').find('.drug').val();
        if(!drugVal){
            return;
        }
        appendPurchaseOrderTableRow();
    });
    purchaseOrderTable.on('blur', '.discount', function(event){
        calculatePurchaseOrderOverallTotals();
    });
    purchaseOrderTable.on('click', '.btn-delete-row', function(event){
      
        jQuery(event.target).closest('tr').remove();
        calculatePurchaseOrderOverallTotals();

    });
   
    purchaseOrderTable.on('change', '.drug', function(event){
        const target = jQuery(event.target);
        if(_.isEmpty(target.val())){
            target.closest('tr').find('input.cost').val(setInputNumericValue(0));
            target.closest('tr').find('input.tax').val(setInputNumericValue(0));
            target.closest('tr').find('input.qty').val(setInputNumericValue(0));
            return;
        }
        let cost = target.find('option:selected').attr('data-cost');
        let tax = target.find('option:selected').attr('data-tax');
        target.closest('tr').find('input.cost').val(setInputNumericValue(cost));
        target.closest('tr').find('input.tax').val(setInputNumericValue(tax));
    });

    purchaseOrderTable.on('blur', '.update-row-total', function(event){
        const target = jQuery(event.target);
        let qty = getInputNumericValue(target.closest('tr').find('input.qty').val());
        let cost = getInputNumericValue(target.closest('tr').find('input.cost').val());
        let tax = getInputNumericValue(target.closest('tr').find('input.tax').val());
        let rowValue = qty*cost;
        let rowTaxValue = rowValue*tax/100;
        let totalValue = rowValue+rowTaxValue;
        let numeralTotal = numeral(totalValue).format('0,0.00');
        target.closest('tr').find('input.total').val(numeralTotal);
        calculatePurchaseOrderOverallTotals();
    });
    
    function calculatePurchaseOrderOverallTotals(){
        let subtotal = 0;
        let taxTotal = 0;
        let qty,cost,tax,rowValue,rowTaxValue;
        purchaseOrderTable.find('tbody tr').each(function(){
            qty = getInputNumericValue(jQuery(this).find('input.qty').val());
            cost = getInputNumericValue(jQuery(this).find('input.cost').val());
            tax = getInputNumericValue(jQuery(this).find('input.tax').val());
            rowValue = qty*cost;
            rowTaxValue = rowValue*tax/100;
            subtotal = subtotal + rowValue;
            taxTotal = taxTotal + rowTaxValue;
        });
        const discount = getInputNumericValue(purchaseOrderTable.find('.discount').val());
        let finalTotal = subtotal+taxTotal - discount;
        purchaseOrderTable.find('.subtotal').val(setInputNumericValue(subtotal));
        purchaseOrderTable.find('.discount').val(setInputNumericValue(discount));
        purchaseOrderTable.find('.taxtotal').val(setInputNumericValue(taxTotal));
        purchaseOrderTable.find('.finaltotal').val(setInputNumericValue(finalTotal));
    }
   
    

    function appendPurchaseOrderTableRow(){
        
            const template = jQuery("#pharmacyPurchaseOrderTableRow").html();
            purchaseOrderTable.find('tbody').append(_.template(template));
                setPurchaseOrderTableIndex();
    }

    function setPurchaseOrderTableIndex(){
        purchaseOrderTable.find('tbody tr').each(function(index){
            jQuery(this).find('td:eq(0)').text(index+1)
        });
       
        purchaseOrderTable.find('tbody tr:eq(0)').find('.btn-delete-row').remove();
    }
});