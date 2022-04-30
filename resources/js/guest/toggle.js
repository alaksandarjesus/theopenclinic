jQuery(function(){
    jQuery(".toggle-trigger").on('click', function(){
        jQuery(this).closest(".toggle-parent").find(".toggle-section").slideToggle();
    })
});