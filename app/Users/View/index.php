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
    <link href="/assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
            <div class="col-xs-12">
                <div class="form-wrap">
                    <h1 id="login-title">Login Form</h1>
                    <? if (!empty($this->data->message)): ?>
                        <div class="alert <?= $this->data->message_type ?>"><?= $this->data->message ?></div>
                    <? endif; ?>
                    <form role="form" action="/users/user/login" method="post" id="login-form" autocomplete="off">
                        <div class="form-group" id="add-after">
                            <label for="username" class="sr-only">Email</label>
                            <input type="text" name="username" id="username" class="form-control"
                                   placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                   placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <span class="character-checkbox" onclick="showPassword()"></span>
                            <span class="label">Show password</span>
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in">
                    </form>
                    <div id="change-form"><a id="change-form-button" onclick="changeForm()">Free Registration Here</a>
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

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>Cakes Picasso &copy; - 2014</p>
            </div>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/login.js"></script>
</body>
</html>