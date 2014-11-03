{{body}}

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Message
                    <small>View</small>
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
                        <h3 class="panel-title">From: <?= $this->data->message['username'] ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3" align="center">
                                <? if(empty($this->data->message['avatar'])): ?>
                                    <img alt="User Pic" src="http://placehold.it/150x150" class="profile-image img-circle">
                                <? else: ?>
                                    <img alt="User Pic" src="/assets/upload/<?= $this->data->message['avatar'] ?>" class="profile-image img-circle">
                                <? endif; ?>
                            </div>
                            <div class=" col-md-9 col-lg-9 ">
                                    <table class="table table-user-information">
                                        <tbody>
                                        <tr>
                                        <tr>
                                            <td>Subject</td>
                                            <td>
                                                <p><?= $this->data->message['subject'] ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Body</td>
                                            <td>
                                                <p><?= $this->data->message['body'] ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Attachment</td>
                                            <td>
                                                <? if(empty($this->data->message['attachment'])): ?>
                                                <p style="opacity: 0.5;">No attachment</p>
                                                <? else: ?>
                                                <a href="/assets/upload/<?= $this->data->message['attachment'] ?>"><?= $this->data->message['attachment'] ?></a>
                                                <? endif; ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button"
                           class="btn btn-sm btn-primary" href="/message/message/create"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button"
                               href="/message/message/delete?id=<?= $this->data->message['message_id'] ?>"
                               class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
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