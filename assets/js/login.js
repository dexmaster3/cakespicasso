var loginHandler = (function () {
    var pub = {};
    var loginShowing = true;

    function showPassword() {
        var key_attr = $('.password').attr('type');

        if (key_attr != 'text') {
            $('.checkbox').addClass('show');
            $('.password').attr('type', 'text');
        } else {
            $('.checkbox').removeClass('show');
            $('.password').attr('type', 'password');
        }
    }

    function changeForm() {
        if (loginShowing) {
            $("#login-wrap").fadeOut(1000, function(){
                $("#register-wrap").fadeIn(1000, function(){
                    loginShowing = false;
                });
            });

        } else {
            $("#register-wrap").fadeOut(1000, function(){
                $("#login-wrap").fadeIn(1000, function(){
                    loginShowing = true;
                });
            });
        }
    }

    function sendLogin() {
        var inputs = $("#login-form input");
        var data = inputs.serializeArray();
        data.push({name: "ajax", value: "true"});
        $.ajax({
            url: "/users/user/login",
            method: "POST",
            data: data,
            success: function (data, status, xhr) {
                if (data.success) {
                    $.notify(data.message, data.type);
                    setTimeout(function () {
                        window.location.href = data.redirect;
                    }, 1200)
                } else {
                    $.notify(data.message, data.type);
                    inputs.val('');
                    inputs.first().focus();
                }
            },
            error: function (xhr, status, error) {
                $.notify(error, 'error');
                inputs.val('');
                inputs.first().focus();
            }
        });
    }

    function sendRegister() {
        var inputs = $("#register-form input");
        var data = inputs.serializeArray();
        data.push({name: "ajax", value: "true"});
        $.ajax({
            url: "/users/user/register",
            method: "POST",
            data: data,
            success: function (data, status, xhr) {
                if (data.success) {
                    $.notify(data.message, data.type);
                    setTimeout(function () {
                        window.location.href = data.redirect;
                    }, 2000)
                } else {
                    $.notify(data.message, data.type);
                    inputs.val('');
                    inputs.first().focus();
                }
            },
            error: function (xhr, status, error) {
                $.notify(error, 'error');
                inputs.val('');
                inputs.first().focus();
            }
        });
    }

    //Login bindings
    $("#register-form").submit(function(ev){
        ev.preventDefault();
        sendRegister();
    });
    $("#login-form").submit(function(ev){
        ev.preventDefault();
        sendLogin();
    });

    $("#login-form input").first().focus();

    pub.changeForm = changeForm;
    pub.showPassword = showPassword;

    return pub;
}());

var LoginHandler = loginHandler;