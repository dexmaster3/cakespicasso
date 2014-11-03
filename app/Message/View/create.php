{{body}}

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Message
                    <small>Send</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-lock"></i> <a href="/admin/dashboard">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-envelope-o"></i> <a href="/message/message/create">Message</a>
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
                        <h3 class="panel-title"><?= $this->data->currentuser['username'] ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3" align="center">
                                <? if(empty($this->data->currentuser['avatar'])): ?>
                                    <img alt="User Pic" src="http://placehold.it/150x150" class="profile-image img-circle">
                                <? else: ?>
                                    <img alt="User Pic" src="/assets/upload/<?= $this->data->currentuser['avatar'] ?>" class="profile-image img-circle">
                                <? endif; ?>
                            </div>
                            <div class=" col-md-9 col-lg-9 ">
                                <form enctype="multipart/form-data" role="form" method="POST" action="/message/message/sendmessage">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Send To</td>
                                        <td>
                                            <select class="form-control" name="sentto">
                                                <? foreach($this->data->users as $user): ?>
                                                <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
                                                <? endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                    <tr>
                                        <td>Subject</td>
                                        <td>
                                            <input class="form-control" type="text" name="subject">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Body</td>
                                        <td>
                                            <textarea class="form-control" name="body"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Attachment</td>
                                        <td>
                                            <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
                                            <input class="form-control" name="attachment" type="file" id="attachment">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <button type="submit" class="pull-right btn btn-primary">Send Message <i class="fa fa-fw fa-envelope"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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