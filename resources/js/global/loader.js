
jQuery(function(){

    window.toogleLoader = function(visible){
        if(visible){
            jQuery('body').addClass('overflow-hidden');
            // jQuery('body').find('.super-container').addClass('blur-sm');
            jQuery(".loader").addClass('flex');
            jQuery(".loader").removeClass('hidden');
        }else{
            jQuery('body').removeClass('overflow-hidden');
            // jQuery('body').find('.super-container').removeClass('blur-sm');
            jQuery(".loader").removeClass('flex');
            jQuery(".loader").addClass('hidden');
        }
        
    }

  



});