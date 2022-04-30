import numeral from 'numeral';

jQuery(function(){
  window.getInputNumericValue =   function (value){
        if(!value){
            return 0;
        }
        let numeralValue = numeral(value);
        if(_.isNaN(numeralValue.value())){
            return 0;
        }
        return numeralValue.value();
    }
});