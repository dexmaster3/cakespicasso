{{body}}

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Layouts
                    <small>All layouts</small>
                </h1>

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-lock"></i> <a href="/admin/dashboard">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-edit"></i> <a href="/layouts/layout">Layouts</a>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row" style="margin-bottom: 1em;">
            <div class="col-lg-12">
                <a href="/layouts/layout/create" class="btn btn-success">Add Page +</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>Layout Name</th>
                        <th>Layout HTML</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <?php foreach ($this->data->layouts as $layout): ?>
                        <tr id="layout-item-<?= $layout['id'] ?>">
                            <td>
                                <a href="/display/display/layout?id=<?= $layout['id'] ?>"
                                   class="btn btn-default"><?= $layout['layout_name'] ?></a>
                            </td>
                            <td>
                                <?= $layout['layout_content'] ?>
                            </td>
                            <td>
                                <?= $layout['layout_author'] ?>
                            </td>
                            <td>
                                <a href="/layouts/layout/edit?id=<?= $layout['id'] ?>"
                                   class="btn btn-warning">Edit</a>
                            </td>
                            <td>
                                <a onclick="deleteLayout(<?= $layout['id'] ?>)"
                                   class="btn btn-danger">Delete</a>
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

{{scripts}}
<script>
    function deleteLayout(layout_id) {
        var info = {
            url: "/Layouts/Layout/delete?id=" + layout_id,
            method: "DELETE"
        };

        ajaxhandle(info, function(data){
            $.notify(data.message, data.type);
            if (data.success) {
                $("tr#layout-item-" + layout_id).fadeOut(600, function(){
                    this.remove();
                })
            }
        });
    }
</script>
{{/scripts}}