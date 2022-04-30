jQuery(document).ajaxSend(function (event, jqXHR, settings) {

    if (_.get(settings, 'donotIntercept', false)) {
        return;
    }
window.toogleLoader(true);
    const baseurl = _.get(window, 'variables.baseurl');
    const trimmed = _.trim(baseurl, '/');
    const url = _.trim(settings.url, '/');
    _.set(settings, 'url', trimmed + '/' + url);
    jqXHR.setRequestHeader('X-CSRF-TOKEN', jQuery('meta[name="csrf-token"]').attr('content'));
    return settings;
});

jQuery(document).ajaxSuccess(function (event, request, settings) {
    if (_.get(settings, 'donotIntercept', false)) {
        return;
    }
window.toogleLoader(false);

    const responseJson = _.get(request, 'responseJSON', {});
    const redirect = _.get(responseJson, 'redirect', null);
    if (redirect) {
        window.location.href = redirect;
        return;
    }
    const reload = _.get(responseJson, 'reload', false);
    if (reload) {
        window.location.reload();
    }
});

jQuery(document).ajaxError(function (event, request, settings) {
    if (_.get(settings, 'donotIntercept', false)) {
        return;
    }
window.toogleLoader(false);

    const responseJson = _.get(request, 'responseJSON', {});
    if(_.isEqual(_.toInteger(request.status), 422)){
        const message = _.get(responseJson, 'message', '');
        const responseJSONErrors = _.get(responseJson, 'errors', '')
        let errors = 'Invalid Entries...';
        if(!_.isEmpty(responseJSONErrors)){
            const errorValues = _.values(responseJSONErrors);
            if(!_.isEmpty(errorValues)){
                const flattened = _.flattenDeep(errorValues);
                errors = '<ul class="list-unstyled"><li>'+flattened.join('</li><li>')+'</li></ul>';
            }
        }
        const args = {
            title: message,
            body: errors,
        }
        twAlertModal(args);
        return;
    }
    if(_.isEqual(_.toInteger(request.status), 403)){
        const message = _.get(responseJson, 'message', 'Unauthorized Action');
        const responseJSONErrors = _.get(responseJson, 'errors', '')
        const args = {
            title: 'Alert',
            body: message,
        }
        twAlertModal(args);
        return;
    }
    const args = {
        title: 'Alert',
        body: 'Unknown error. Contact Administrator',
    }
    twAlertModal(args);
});