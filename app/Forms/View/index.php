{{body}}

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Forms
                    <small>All</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-lock"></i> <a href="/admin/dashboard">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-pencil"></i> <a href="/forms/form">Forms</a>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <a style="margin-bottom: 10px;" href="/forms/form/create" class="btn btn-success">Create +</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Form Name</th>
                        <th>Form HTML</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <? foreach ($this->data->forms as $form): ?>
                        <tr id="form-item-<?= $form['id'] ?>">
                            <td><?= $form['id'] ?></td>
                            <td>
                                <?= $form['form_name'] ?>
                            </td>
                            <td>
                                <?= $form['form_html'] ?>
                            </td>
                            <td>
                                <a onclick="deleteForm(<?= $form['id'] ?>);" class="btn btn-danger">Delete</a>
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
    function deleteForm(form_id) {
        var info = {
            url: "/Forms/Form/delete?id=" + form_id,
            method: "DELETE",
            data: null
        };
        ajaxhandle(info, function(data){
            $.notify(data.message, data.type);
            if(data.success) {
                $("tr#form-item-" + form_id).fadeOut(600, function(){
                    this.remove();
                });
            }
        });
    }
</script>
{{/scripts}}