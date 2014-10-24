function showPassword() {
    var key_attr = $('#password').attr('type');

    if (key_attr != 'text') {
        $('.checkbox').addClass('show');
        $('#password').attr('type', 'text');
    } else {
        $('.checkbox').removeClass('show');
        $('#password').attr('type', 'password');
    }
}

function changeForm() {
    $("#alert-banner").remove();
    if (!$("#added-email").length) {
        $(".form-wrap").fadeOut(function() {
            $("#add-after").after('<div class="form-group" id="added-email">' +
            '<label for="email" class="sr-only">Email</label>' +
            '<input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com"></div>');
            $("#login-title").text("Registration Form");
            $("#login-form").attr('action', '/users/user/register');
            $("#change-form-button").text("Back to Login");
        }).fadeIn();
    } else {
        $(".form-wrap").fadeOut(function() {
            $("#added-email").remove();
            $("#login-title").text("Login Form");
            $("#login-form").attr('action', '/users/user/login');
            $("#change-form-button").text("Free Registration Here");
        }).fadeIn();
    }
}