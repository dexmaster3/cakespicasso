<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Cakes Picasso Admin (aka Young-Fro)</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b
                    class="caret"></b></a>
            <ul class="dropdown-menu message-dropdown">
                <? if(empty($this->data->messages)): ?>
                <li class="message-footer">
                    <a href="#">You have No messages</a>
                </li>
                <? else: ?>
                <? foreach($this->data->messages as $message): ?>
                <li class="message-preview">
                    <a href="/message/message/view?id=<?= $message['message_id'] ?>">
                        <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>

                            <div class="media-body">
                                <h5 class="media-heading">
                                    <strong><?= ucfirst($message['username']) ?></strong>
                                </h5>

                                <p class="small text-muted"><i class="fa fa-clock-o"></i> <?= date("M j, g:ia", strtotime($message['date_modified'])) ?></p>
                                <h5 class="media-heading">
                                    <strong><i class="fa fa-fw fa-flag-o"></i> <?= $message['subject'] ?></strong>
                                </h5>
                                <p><?= $message['body'] ?></p>
                            </div>
                        </div>
                    </a>
                </li>
                <? endforeach; ?>
                <li class="message-footer">
                    <a href="/message/message/all">Read All New Messages</a>
                </li>
                <? endif; ?>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu alert-dropdown">
                <li>
                    <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">View All</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= ucfirst($_SESSION['user']['username']) ?> <b
                    class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="/users/profile"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="/message/message"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                </li>
                <li>
                    <a href="/users/profile/edit"><i class="fa fa-fw fa-gear"></i> Edit Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a style="cursor: pointer;" onclick="LogoutHandler.doLogout();"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li <?php if (stripos($_SERVER['REQUEST_URI'], "/admin/dashboard") !== false): echo 'class="active"'; endif; ?> >
                <a href="/admin/dashboard"><i class="fa fa-fw fa-tachometer"></i> Dashboard</a>
            </li>
            <li <?php if (stripos($_SERVER['REQUEST_URI'], "/browser") !== false): echo 'class="active"'; endif; ?> >
                <a href="/browser"><i class="fa fa-fw fa-list-ul"></i> Browser</a>
            </li>
            <li <?php if (stripos($_SERVER['REQUEST_URI'], "/pages/page") !== false): echo 'class="active"'; endif; ?> >
                <a href="/pages/page"><i class="fa fa-fw fa-file-text-o"></i> Content</a>
            </li>
            <li <?php if (stripos($_SERVER['REQUEST_URI'], "/forms/form") !== false): echo 'class="active"'; endif; ?> >
                <a href="/forms/form"><i class="fa fa-fw fa-pencil"></i> Forms</a>
            </li>
            <li <?php if (stripos($_SERVER['REQUEST_URI'], "/display/formdata") !== false): echo 'class="active"'; endif; ?> >
                <a href="/display/formdata"><i class="fa fa-fw fa-book"></i> Form Data</a>
            </li>
            <li <?php if (stripos($_SERVER['REQUEST_URI'], "/layouts/layout") !== false): echo 'class="active"'; endif; ?> >
                <a href="/layouts/layout"><i class="fa fa-fw fa-edit"></i> Layouts</a>
            </li>
            <li <?php if (stripos($_SERVER['REQUEST_URI'], "/renderings/rendering") !== false): echo 'class="active"'; endif; ?> >
                <a href="/renderings/rendering"><i class="fa fa-fw fa-photo"></i> Renderings</a>
            </li>
            <li <?php if (stripos($_SERVER['REQUEST_URI'], "/messages/message") !== false): echo 'class="active"'; endif; ?> >
                <a href="/messages/message"><i class="fa fa-fw fa-envelope"></i> Messages</a>
            </li>
            <li <?php if (stripos($_SERVER['REQUEST_URI'], "/users/profile/showall") !== false): echo 'class="active"'; endif; ?> >
                <a href="/users/profile/showall"><i class="fa fa-fw fa-user"></i> Users</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i>
                    Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="#">Cakes</a>
                    </li>
                    <li>
                        <a href="#">Picasso</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>