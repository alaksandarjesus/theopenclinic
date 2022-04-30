jQuery(function () {
    const tabButtons = jQuery(".tab-btn");
    if (_.isEmpty(tabButtons)) {
        return;
    }
    setTabNavButtonsNavigation(-1, 1);
    jQuery(document).on("click", '.tab-btn', function () {
        jQuery(this).closest('.tabs').find('.tab-content').addClass('hidden');
        const target = jQuery(this).attr('data-target');
        jQuery(this).closest('.tabs').find('.tab-body').find(target).removeClass('hidden');
        jQuery(this).closest('.tabs').find('.tab-btn').removeClass('text-red-900 bg-red-100').addClass('text-slate-900');
        jQuery(this).addClass('text-red-900 bg-red-100').removeClass('text-slate-900');

    });

    jQuery(document).on("change", ".tab-header-select", function () {
        const selectedTab = jQuery(this).val();
        jQuery(this).closest('.tabs').find('.tab-content').addClass('hidden');
        jQuery(this).closest('.tabs').find('.tab-body').find('.' + selectedTab).removeClass('hidden');
        const index = jQuery(this).find("option:selected").index();
        setTabNavButtonsNavigation(index-1, index+1)

    });

    jQuery(document).on('click', '.btn-tab-nav', function(){
        const toTabId = _.toInteger(jQuery(this).attr('data-tab-id'));
        const tabHeaderSelect = jQuery(this).closest('.tabs').find('.tab-header-select');
        const tabRef = tabHeaderSelect.find('option:eq('+toTabId+')').attr('value');
        tabHeaderSelect.val(tabRef);
        jQuery(this).closest('.tabs').find('.tab-content').addClass('hidden');
        jQuery(this).closest('.tabs').find('.tab-body').find('.' + tabRef).removeClass('hidden');
        setTabNavButtonsNavigation(toTabId-1, toTabId+1)
    });

    function setTabNavButtonsNavigation(prev, next) {
        const tabNavButtons = tabButtons.closest('.tabs').find('.tab-nav-buttons');
        if(_.isEmpty(tabNavButtons)){
            return;
        }
        const tabsButtonsLength = tabButtons.closest('.tabs').find('.tab-btn').length;
        const prevTab = tabButtons.closest('.tabs').find('.tab-btn:eq('+prev+')');
        const nextTab = tabButtons.closest('.tabs').find('.tab-btn:eq('+next+')');
        const prevTabBtn = tabNavButtons.find('.btn-prev');
        const nextTabBtn = tabNavButtons.find('.btn-next');
        prevTabBtn.hide();
        nextTabBtn.hide();
        if(prev > -1){
            prevTabBtn.text(prevTab.text())
            prevTabBtn.attr('data-tab-id', prev);
            prevTabBtn.show();
        }
        if(next < (tabsButtonsLength)){
            nextTabBtn.text(nextTab.text())
            nextTabBtn.attr('data-tab-id', next);
            nextTabBtn.show();
        }
       
    }

});