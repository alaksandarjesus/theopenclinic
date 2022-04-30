const numberToText = require('number-to-text');

jQuery(function(){

    const numberToTextEle = jQuery(document).find('.number-to-text');
    if(!numberToTextEle || !numberToTextEle.length){
        return;
    }
    numberToTextEle.each(function(){
        let value = jQuery(this).attr('data-value');
        if(value){
            jQuery(this).text(numberToText.convertToText(value) )
        }
    });

});