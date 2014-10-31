{{body}}

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Users
                    <small>All users</small>
                </h1>

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-lock"></i> <a href="/admin/dashboard">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-edit"></i> <a href="/layouts/layout">Users</a>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row" style="margin-bottom: 1em;">
            <div class="col-lg-12">
                <a href="/users/profile/edit" class="btn btn-success">Add User +</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table style="vertical-align: middle;" class="table table-bordered table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Birthday</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Phone</th>
                    </tr>
                    </thead>
                    <?php foreach ($this->data->users as $user): ?>
                        <tr>
                            <td>
                                <? if(empty($user['avatar'])): ?>
                            <img style="width: 50px;" src="http://placehold.it/50x50"/>
                            <? else: ?>
                                <img style="width: 50px;" src="/assets/img/upload/<?= $user['avatar'] ?>"/>
                            <? endif ?>
                            </td>
                            <td>
                                <a href="/users/profile/show?id=<?= $user['id'] ?>"><?= $user['username'] ?></a>
                            </td>
                            <td>
                                <?= $user['email'] ?>
                            </td>
                            <td>
                                <?= date('M d, Y', strtotime($user['birthday'])) ?>
                            </td>
                            <td>
                                <?= $user['gender'] ?>
                            </td>
                            <td>
                                <?= $user['address'] ?>
                            </td>
                            <td>
                                <?= $user['phone'] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

{{/body}}