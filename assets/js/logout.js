/**
 * Created by dexter on 11/11/14.
 */

var logoutHandler = (function(){
    var pub = {};

    function doLogout() {
        $.ajax({
            url: "/users/user/logout",
            method: "GET",
            success: function(data, status, xhr){
                $.notify(data.message, 'success');
                setTimeout(function(){
                    window.location.href = "/";
                }, 1000);
            },
            error: function(xhr, status, error) {
                $.notify(error, 'error');
            }
        });
    }

    pub.doLogout = doLogout;

    return pub;
}());

var LogoutHandler = logoutHandler;