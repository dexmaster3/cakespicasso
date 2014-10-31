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
            <div class="col-lg-12">
                <form enctype="multipart/form-data" action="/users/profile/save" method="post">
                    <div class="form-group">
                        <label for="username">User Name</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $this->data->user['username'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $this->data->user['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="avatar">Upload Avatar</label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
                        <input type="file" class="form-control" id="avatar" name="avatar">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                            <option <? if($this->data->user['gender'] === "Male"): echo 'selected="selected"'; endif; ?>>Male</option>
                            <option <? if($this->data->user['gender'] === "Female"): echo 'selected="selected"'; endif; ?>>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="text" class="form-control" id="birthday" name="birthday" value="<?= date('m/d/Y', strtotime($this->data->user['birthday'])) ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= $this->data->user['address'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= $this->data->user['phone'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="old_password">Old Password</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" value="">
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" value="">
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirm">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_password_confirm" name="new_password_confirm"
                               value="">
                    </div>
                    <div class="form-group hidden" style="display: none;">
                        <input type="number" class="form-control" id="user_id" name="id" value="<?= $this->data->user['id'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="about">About Me</label>
                        <textarea rows="10" class="form-control" id="about" name="about"><?= $this->data->user['about'] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Page</button>
                </form>
            </div>
        </div>
        <div class="modal fade" id="renderings-modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
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
<script src="/assets/js/bootstrap-datepicker.js"></script>
<script>
    $(".form-control#birthday").datepicker({});
</script>
{{/scripts}}