{{body}}
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Media
                    <small>Your Files</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-lock"></i> <a href="/admin/dashboard">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file-image-o"></i> <a href="/media/media">Media</a>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row" style="margin-bottom: 1em;">
            <div class="col-lg-12">
                <a href="/media/media/create" class="btn btn-success">Add Item +</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Original Name</th>
                        <th>File Name</th>
                        <th>Resource Path</th>
                        <th>Date Modified</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <? foreach ($this->data->media as $file): ?>
                        <tr id="media-item-<?= $file['id'] ?>">
                            <td>
                                <?= $file['id'] ?>
                            </td>
                            <td>
                                <?= $file['original_name'] ?>
                            </td>
                            <td>
                                <?= $file['file_name'] ?>
                            </td>
                            <td>
                                <a target="_blank" href="<?= $file['full_path'] ?>"><?= $file['full_path'] ?></a>
                            </td>
                            <td>
                                <?= Display_DisplayHelper::friendlyElapsedTime($file['date_modified']) ?>
                            </td>
                            <td>
                                <a onclick="deleteMedia(<?= $file['id'] ?>)" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <? endforeach; ?>
                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
{{/body}}


{{scripts}}
<script>
    function deleteMedia(media_id) {
        var info = {
            url: "/Media/Media/delete?id=" + media_id,
            method: "DELETE",
            data: null
        };
        ajaxhandle(info, function(data){
            $.notify(data.message, data.type);
            if(data.success) {
                $("tr#media-item-" + media_id).fadeOut(600, function(){
                    this.remove();
                });
            }
        });
    }
</script>
{{/scripts}}