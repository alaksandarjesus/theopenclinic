
jQuery(function(){
    const pharmacyCategoriesTable = jQuery('table.pharmacy-categories');
    if(!pharmacyCategoriesTable.length){
        return;
    }
    const pharmacyDrugCategoryForm = jQuery('form.pharmacy-drug-category');
    if (!pharmacyDrugCategoryForm.length) {
        return;
    }
    pharmacyCategoriesTable.on('click', '.btn-edit', function(){
       const uuid = jQuery(this).closest('tr').attr('data-uuid');
       const name = jQuery(this).closest('tr').find('td.name').text();
       pharmacyDrugCategoryForm.find('.name').val(name);
       pharmacyDrugCategoryForm.find('.uuid').val(uuid);
    });

});