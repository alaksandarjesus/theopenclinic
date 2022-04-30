jQuery(function(){
    const pharmacyDrugsTable = jQuery('table.pharmacy-drugs');
    if(!pharmacyDrugsTable.length){
        return;
    }
    pharmacyDrugsTable.on('click', '.btn-refresh', function(){
       const uuid = jQuery(this).closest('tr').attr('data-uuid');
       const btn = jQuery(this);
       btn.prop('disabled', true);
       jQuery.ajax({
           url: 'pharmacy/drugs/'+uuid+'/refresh',
           success: function(res){
               window.location.reload();
           },
           error: function(err){
9
           },
           complete: function(){
            btn.prop('disabled', false);
           }
       })
    });
});
