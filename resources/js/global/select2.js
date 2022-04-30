jQuery(function(){
    jQuery(document).on("select2:open", () => {
        document.querySelector(".select2-container--open .select2-search__field").focus()
      });
});