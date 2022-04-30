jQuery(function(){
    const toggleNavButton = jQuery(".btn-toggle-nav");
    if(_.isEmpty(toggleNavButton)){
        return;
    }

    toggleNavButton.on('click', function(){
        jQuery('body').addClass('overflow-hidden');
        jQuery(document).find('nav.sidenav').removeClass('hidden');
    });
    jQuery(document).find('nav.sidenav').on('click', function(){
        jQuery(this).addClass('hidden');
        jQuery('body').removeClass('overflow-hidden');

    });

});