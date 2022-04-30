jQuery(function(){
    jQuery.validator.setDefaults({
        errorElement: 'div',
        errorClass: 'text-sm font-normal text-red-600',
        highlight: function (element, errorClass) {
            jQuery(element).addClass('border-red-600 border-2');
        },
        unhighlight: function (element, errorClass) {
            jQuery(element).removeClass('border-red-600 border-2');
        },
        errorPlacement: function (error, element) {
            jQuery(element).closest('.form-group').append(error);
        }
    });

    jQuery.validator.addMethod("currency", function(value, element) {
        return this.optional(element) || /^\d{0,6}(\.\d{0,2})?$/i.test(value);
    }, "Only numbers & you must include two decimal places");


});