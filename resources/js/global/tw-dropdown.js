jQuery(function(){
    jQuery(document).on("click", function(event){
        if(jQuery(event.target).closest('.dropdown').length){
           return;
        }
        jQuery(document).find(".dropdown-menu").addClass('hidden');
    });
});

jQuery(function(){
    jQuery(document).on("click", ".dropdown-trigger", function(){
        jQuery(this).closest('.dropdown').find('.dropdown-menu').toggleClass('hidden');
        jQuery(".dropdown-trigger").not(this).closest('.dropdown').find('.dropdown-menu').addClass('hidden');
    });
});