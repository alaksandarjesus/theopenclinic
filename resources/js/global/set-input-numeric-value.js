import numeral from 'numeral';

jQuery(function(){
  window.setInputNumericValue =   function (value){
        if(!value){
            return numeral(0).format('0,0.00');
        }
        return numeral(value).format('0,0.00');
    }
});