import numeral from 'numeral';

jQuery(function(){
    jQuery(document).on('change', '.format-numeral-value', function(){
        const target = jQuery(event.target);
        if(!target.val()){
            target.val(numeral(0).format('0,0.00'));
        }
        target.val(numeral(target.val()).format('0,0.00'));
    });
});