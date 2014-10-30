{{body}}

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Profile
                    <small>Edit</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-lock"></i> <a href="/admin/dashboard">Admin</a>
                    </li>
                    <li>
                        <i class="fa fa-file-text-o"></i> <a href="/users/profile">Profile</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Edit
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div
                class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 toppad">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $this->data->user['username'] ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3" align="center"><img alt="User Pic"
                                                                               src="/assets/img/upload/<?= $this->data->user['avatar'] ?>"
                                                                               class="profile-image img-circle"></div>
                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Date of Birth</td>
                                        <td><?= $this->data->user['birthday'] ?></td>
                                    </tr>

                                    <tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td><?= $this->data->user['gender'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Home Address</td>
                                        <td><?= $this->data->user['address'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?= $this->data->user['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td><?= $this->data->user['phone'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>About Me</td>
                                        <td><?= $this->data->user['about'] ?></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <a href="#" class="btn btn-primary">My Sales Performance</a>
                                <a href="#" class="btn btn-primary">Team Sales Performance</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button"
                           class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button"
                               class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button"
                               class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <img class="profile-image" src=""/>

                <h2 class="profile-name"></h2>
            </div>
            <div class="col-lg-6">
                <h2>About Me</h2>

                <p></p>
            </div>
        </div>
        <div class="modal fade" id="renderings-modal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body" id="renderings-modal-body">
                        <nav>
                            <ul class="pagination">
                            </ul>
                        </nav>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary save">Select Rendering</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

{{/body}}

{{scripts}}

{{/scripts}}