/**
 * Created by dexter on 11/12/14.
 */
function ajaxhandle(info, callback) {
    $.ajax({
        url: info.url,
        type: info.method,
        data: info.data,
        success: function (data, status, xhr) {
            callback(data);
        },
        error: function (xhr, status, error) {
            var data = {message: error};
            callback(data);
        }
    });
}