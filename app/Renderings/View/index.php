{{body}}

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Renderings
                    <small>View Renderings</small>
                </h1>

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-lock"></i> <a href="/admin/dashboard">Admin</a>
                    </li>
                    <li class="active">
                        <i class="active fa fa-photo"></i> <a href="/renderings/rendering">Renderings</a>
                    </li>
                </ol>
                <a href="/renderings/rendering/create" class="btn btn-success">Create New</a>
                <hr/>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
                <? foreach ($this->data->renderings as $rendering): ?>
            <div class="col-lg-6" id="rendering-column-<?= $rendering['id'] ?>">
                    <div class="rendering-iframe-holder">
                        <iframe class="rendering-iframe"
                                src="/display/display/rendering?id=<?= $rendering['id'] ?>"></iframe>
                        <div class="rendering-iframe-id"><?= $rendering['id'] ?></div>
                        <div class="rendering-delete"><a class="btn btn-danger" onclick="deleteRendering(<?= $rendering['id'] ?>)">Delete</a></div>
                    </div>
            </div>
                <? endforeach; ?>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

{{/body}}

{{scripts}}
<script>
    function deleteRendering(rendering_id) {
        var info = {
            url: "/Renderings/Rendering/delete?id=" + rendering_id,
            method: "DELETE"
        };

        ajaxhandle(info, function(data){
            $.notify(data.message, data.type);
            if (data.success) {
                $("div#rendering-column-" + rendering_id).fadeOut(600, function(){
                    this.remove();
                })
            }
        })
    }
</script>

{{/scripts}}