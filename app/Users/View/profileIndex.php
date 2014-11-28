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
                                <? if (empty($this->data->user['avatar'])): ?>
                                    <img alt="User Pic" src="http://placehold.it/150x150"
                                         class="profile-image img-circle">
                                <? else: ?>
                                    <img alt="User Pic" src="/assets/upload/<?= $this->data->user['avatar'] ?>"
                                         class="profile-image img-circle">
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
                <form id="note-form" action="/users/profile/postnote" method="post" style="margin: 10px 0;">
                    <h2>Write <?= ucfirst($this->data->user['username']) ?> a note:
                        <button class="btn btn-primary pull-right" type="submit">Post
                            <img src="/assets/img/ajax-loader.gif" style="display: none;"></button>
                    </h2>
                    <textarea class="form-control" name="body" placeholder="What are you thinking?"></textarea>
                    <input type="hidden" class="hidden hide" name="profile_id" value="<?= $this->data->user['id'] ?>">
                </form>
                <div class="notes-section">
                    <? foreach ($this->data->user_notes as $note): ?>
                        <div class="note">
                            <div class="note-body">
                                <?= $note['body']; ?>
                            </div>
                            <div class="note-user">
                                <? foreach ($this->data->all_users as $user): ?>
                                    <? if ($user['id'] == $note['author_id']): ?>
                                        <?= $user['username'] ?>
                                        <img src="/assets/upload/<?= $user['avatar'] ?>" style="width: 30px;"/>
                                    <? endif; ?>
                                <? endforeach; ?>
                            </div>
                            <div class="note-timestamp">
                                <?= Display_DisplayHelper::friendlyElapsedTime($note['date_modified']); ?>
                            </div>
                            <? if (!empty($note['sub_notes'])): ?>
                                <? foreach ($note['sub_notes'] as $subnote): ?>
                                    <div class="note-comment">
                                        <div class="note-body">
                                            <?= $subnote['body']; ?>
                                        </div>
                                        <div class="note-user">
                                            <? foreach ($this->data->all_users as $user): ?>
                                                <? if ($user['id'] == $subnote['author_id']): ?>
                                                    <?= $user['username'] ?>
                                                    <img src="/assets/upload/<?= $user['avatar'] ?>" style="width: 30px;"/>
                                                <? endif; ?>
                                            <? endforeach; ?>
                                        </div>
                                        <div class="note-timestamp">
                                            <?= Display_DisplayHelper::friendlyElapsedTime($subnote['date_modified']); ?>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                            <? endif; ?>
                            <form class="comment-form" action="/users/profile/postnote" method="post">
                            <input name="body" class="form-control note-comment-input" type="text" placeholder="Comment on note" />
                                <input class="hide hidden" type="hidden" name="parent_note" value="<?= $note['id'] ?>" />
                                <input type="hidden" class="hidden hide" name="profile_id" value="<?= $this->data->user['id'] ?>">
                            </form>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

{{/body}}

{{scripts}}
<script>
    var noteform = $("#note-form");
    var commentforms = $(".comment-form");

    noteform.on('submit', function (ev) {
        ev.preventDefault();
        var info = {
            url: noteform.attr('action'),
            method: noteform.attr('method'),
            data: noteform.serializeArray()
        };
        ajaxhandle(info, function (data) {
            $.notify(data.message, data.type);
            if (data.success) {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
        });
    });

    commentforms.on('submit', function(ev){
        ev.preventDefault();
        var appendto = $(this);
        var info = {
            url: appendto.attr('action'),
            method: appendto.attr('method'),
            data: appendto.serializeArray()
        };
        ajaxhandle(info, function(data){
            $.notify(data.message, data.type);
            $(".note-comment-input").val("");
            if (data.success) {
                var sentbody;
                $.each(info.data, function(index, value){
                    if(value['name'] === "body") {
                        sentbody = value['value'];
                    }
                });
                var eletoadd = '<div class="note-comment"><div class="note-body">' + sentbody +
                    '</div><div class="note-user"> <?= $_SESSION['user']['username'] ?> <img src="/assets/upload/' +
                    '<?= $_SESSION['user']['avatar'] ?>' + '" style="width: 30px;"/>' +
                    '</div><div class="note-timestamp">Now</div></div>';
                $(appendto).before(eletoadd);
            }
        });
    });
</script>
{{/scripts}}