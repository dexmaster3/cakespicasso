/**
 * Created by dexter on 11/12/14.
 */
function ajaxhandle(data, method, callback) {
    $.ajax({
        url: '/Forms/Form/save',
        type: method,
        data: data,
        success: function (data, status, xhr) {
            callback(data);
        },
        error: function (xhr, status, error) {
            callback(error);
        }
    });
}