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
                    <li class="active">
                        <i class="fa fa-file-text-o"></i> <a href="/users/profile">Profile</a>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div
                class="col-xs-12 col-sm-12 col-md-6 col-lg-6 toppad">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $this->data->user['username'] ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3" align="center">
                                <? if(empty($this->data->user['avatar'])): ?>
                                <img alt="User Pic" src="http://placehold.it/150x150" class="profile-image img-circle">
                                <? else: ?>
                                <img alt="User Pic" src="/assets/upload/<?= $this->data->user['avatar'] ?>" class="profile-image img-circle">
                                <? endif; ?>
                            </div>
                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Date of Birth</td>
                                        <td><?= date('M j, Y', strtotime($this->data->user['birthday'])) ?></td>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <form id="comment-form" action="/users/profile/postcomment" method="post" style="margin: 10px 0;">
                <h2>Write <?= ucfirst($this->data->user['username']) ?> a note:
                    <button class="btn btn-primary pull-right" type="submit">Post
                    <img src="/assets/img/ajax-loader.gif" style="display: none;"> </button>
                </h2>
                    <textarea class="form-control" name="body" placeholder="What are you thinking?"></textarea>
                    <input type="hidden" class="hidden hide" name="profile_id" value="<?= $this->data->user['id'] ?>">
                    </form>
                <? foreach($this->data->notes as $note): ?>
                <div class="well">
                    <div class="note-body"><?= $note['body'] ?></div>
                    <div class="note-date"><?= $note['date_modified'] ?></div>
                </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

{{/body}}

{{scripts}}
<script>
    var commentform = $("#comment-form");

    commentform.on('submit', function(ev){
        ev.preventDefault();
        var info = {
            url: commentform.attr('action'),
            method: commentform.attr('method'),
            data: commentform.serializeArray()
        };
        ajaxhandle(info, function(data){
            $.notify(data.message, data.type);
            if (data.success) {
                setTimeout(function(){
                    window.location.reload();
                }, 1500);
            }
        })
    })
</script>
{{/scripts}}