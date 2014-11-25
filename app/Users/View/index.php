<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Welcome to Cakes Picasso AKA YoungFro">
    <meta name="author" content="DEX!">

    <title>Cakes Picasso</title>

    <!-- Bootstrap Core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Login CSS -->
    <link href="/assets/css/login.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <? if(!empty($this->data->message['message'])): ?>
                <div class="alert alert-danger"><?= $this->data->message['message'] ?></div>
                <? endif; ?>
                <div class="form-wrap form-holder" id="login-wrap">
                    <span><img src="/assets/img/cake.jpg" alt="CakesPicasso" /><h1 id="login-title">Login Form</h1></span>
                    <form role="form" id="login-form" action="/users/user/login" method="POST">
                        <div class="form-group" id="add-after">
                            <label for="username" class="sr-only">Email</label>
                            <input type="text" name="username" id="username" class="form-control"
                                   placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" class="form-control password"
                                   placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <span class="character-checkbox" onclick="LoginHandler.showPassword()"></span>
                            <span class="label">Show password</span>
                        </div>
                        <button type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block">Log In
                            <img id="login-spinner" style="display: none; width:20px;" src="/assets/img/ajax-loader.gif"></button>
                    </form>
                    <div id="change-form"><a id="change-form-button" onclick="LoginHandler.changeForm()">Free Registration Here</a>
                    </div>
                    <hr>
                    <a href="/browser" style="font-size: 20px;color: #428bca;text-align: center;">
                        <p>Not a Member?</p>
                        <p>Check out our public pages!</p>
                    </a>
                    <p style="text-align: center;">Cakes Picasso &copy; - 2014</p>
                </div>
                <div class="form-wrap form-holder" id="register-wrap" style="display: none;">
                    <span><img src="/assets/img/cake.jpg" alt="CakesPicasso" /><h1 id="login-title">Registration Form</h1></span>
                    <form role="form" id="register-form" action="/users/user/register" method="POST">
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                   placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                   placeholder="Email@domain.tld">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" class="form-control password"
                                   placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <span class="character-checkbox" onclick="LoginHandler.showPassword()"></span>
                            <span class="label">Show password</span>
                        </div>
                        <button type="submit" id="btn-register" class="btn btn-custom btn-lg btn-block">Register
                            <img id="register-spinner" style="display: none; width: 20px;" src="/assets/img/ajax-loader.gif"></button>
                    </form>
                    <div id="change-form"><a id="change-form-button" onclick="LoginHandler.changeForm()">Back to Login</a>
                    </div>
                    <hr>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<script src="/assets/js/jquery-1.11.0.js"></script>
<script src="/assets/js/notify.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/login.js"></script>
</body>
</html>