{{body}}

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Form Data
                    <small>All</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-lock"></i> <a href="/admin/dashboard">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-pencil"></i> <a href="/forms/formdata">Form Data</a>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6">
                <? foreach ($this->data->formdatas as $form): ?>
                    <table class="table table-bordered">
                        <thead>
                        <? if (array_key_exists('form_id', $form)): ?>
                            <? foreach ($this->data->forms as $formie): ?>
                                <? if($form['form_id'] == $formie['id']): ?>
                                    <tr>
                                        <th>Form Name</th>
                                        <th><?= $formie['form_name'] ?></th>
                                    </tr>
                                <? endif; ?>
                            <? endforeach; ?>
                        <? endif; ?>
                        </thead>
                        <tbody>
                        <? foreach ($form as $key => $val): ?>
                            <tr>
                                <td><?= $key ?></td>
                                <td><?= $val ?></td>
                            </tr>
                        <? endforeach; ?>
                        </tbody>
                    </table>
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
    function deleteForm(form_id) {
        $.ajax({
            url: "/Forms/Form/delete?id=" + form_id,
            type: "DELETE",
            success: function (data, status, xhr) {
                if (data.success) {
                    $.notify("Form deleted!", "success");
                    $("tr#form-item-" + form_id).fadeOut(600, function () {
                        this.remove();
                    });
                } else {
                    $.notify("Error deleting: " + data.message);
                }
            },
            error: function (xhr, status, error) {
                $.notify("Ajax Error: " + error);
            }
        })
    }
</script>
{{/scripts}}