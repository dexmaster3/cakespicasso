{{body}}

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Forms
                    <small>Edit</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-lock"></i> <a href="/admin/dashboard">Admin</a>
                    </li>
                    <li>
                        <i class="fa fa-pencil"></i> <a href="/forms/form">Forms</a>
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
                <form action="/pages/page/index" method="post">
                    <div class="form-group">
                        <label for="form_name">Form Name</label>
                        <input type="text" class="form-control" id="form_name" name="form_name"
                               value="<?= $this->data->page['form_name'] ?>">
                    </div>
                    <div class="form-group hidden" style="display: none;">
                        <label for="page_url">Page Url</label>
                        <input type="text" class="form-control" id="page_url" name="id"
                               value="<?= $this->data->page['id'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Form Elements</label>
                        <ul class="list-inline form-items">
                            <li draggable="true" data-view="<div class='form-item'><label>Text Input</label>
                            <input type='text' class='form-control'></div>">Text Input</li>
                            <li draggable="true">Text Area</li>
                            <li draggable="true">Radio Buttons</li>
                            <li draggable="true">Select Dropper</li>
                            <li draggable="true">Button</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="form_name">Form Name</label>
                        <div class="form-preview form-control" style="min-height: 100px;">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="form_html">Form Html Translation</label>
                        <textarea rows="10" class="form-control" id="form_html" name="form_html"><?= $this->data->page['form_html'] ?></textarea>
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
<script src="/assets/js/ckeditor/ckeditor.js"></script>
<script src="/assets/js/ckeditor/adapters/jquery.js"></script>
<script src="/assets/js/forms.js"></script>
{{/scripts}}