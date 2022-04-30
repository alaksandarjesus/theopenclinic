jQuery(function () {

    const consultationPrescriptionTable = jQuery("table.consultation-prescription");

    if (_.isEmpty(consultationPrescriptionTable)) {
        return;
    }

        onInit();



    function onInit() {
        const tpl = _.template(jQuery('#consultation-prescription-table-tr-html').html());
        consultationPrescriptionTable.find('tbody').append(tpl());
         setConsultationPrescriptionTableIndex();
        consultationPrescriptionTable.on('focus', '.create-next-row', function () {
            setNextRow();
        });

        consultationPrescriptionTable.on('click', '.btn-delete', function () {
            jQuery(this).closest('tr').remove();
        });
    }

    function matchCustom(params, data) {

        if (_.trim(params.term) === '') {
            return data;
        }

        if (typeof data.text === 'undefined') {
            return null;
        }

        let matches = false;

        if (_.toLower(data.text).indexOf(_.toLower(params.term)) > -1) {

            matches = true;

        }
        const compositions = jQuery(data.element).attr('data-compositions');

        if (!_.isEmpty(compositions)) {
            const compositionsParsed = JSON.parse(compositions);
            const compositionFiltered = compositionsParsed.filter(item => {
                return _.toLower(item.name).indexOf(_.toLower(params.term)) !== -1
            });
            matches = matches || !!compositionFiltered.length;
        }

        if (matches) {
            var modifiedData = jQuery.extend({}, data, true);
            return modifiedData;
        }

        return null;
    }


    function setConsultationPrescriptionTableIndex() {
        consultationPrescriptionTable.find('tbody tr').each(function (index) {

            if (!jQuery(this).find('select.drug').hasClass('select2-hidden-accessible')) {
                
                jQuery(this).find('select.drug').select2({
                    matcher: matchCustom
                }).on('select2:open', function (e) {
                    document.querySelector('.select2-container--open .select2-search__field').focus();
                });
            }

        });
        consultationPrescriptionTable.find('tbody tr:first').find("button.btn-delete").remove();
    }

    function setNextRow() {


        const drugVal = consultationPrescriptionTable.find('tbody tr:last').find('.drug').val();
        if (!drugVal) {
            return;
        }
        const tpl = _.template(jQuery('#consultation-prescription-table-tr-html').html());
        consultationPrescriptionTable.find('tbody').append(tpl());
        setConsultationPrescriptionTableIndex();

    }


});