jQuery(function(){
    jQuery(document).on('click', '.submenu-toggle', function(){
        jQuery(this).closest('.submenu').toggleClass('open');
    });
});