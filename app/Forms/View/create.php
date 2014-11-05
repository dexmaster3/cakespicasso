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
                            <li draggable="true" data-placeholder="Placeholder" data-label="Text Input" data-type="text" data-name="text_one" data-view="<div class='form-item'><label>Text Input</label>
                            <input type='text' class='form-control'></div>">Text Input
                            </li>
                            <li draggable="true" data-placeholder="Placeholder" data-label="Textarea Input" data-type="textarea" data-name="textarea_one" data-view="<div class='form-item'><label>Textarea Input</label>
                            <textarea class='form-control'></textarea></div>">Text Area</li>
                            <li draggable="true" data-placeholder="Placeholder" data-label="Radio Input" data-type="radio" data-name="radio_one" data-view="<div class='form-item radio'>
                            <label><input name='radio_opts' type='radio' value='opt1' checked>Option 1</label><label><input name='radio_opts' type='radio' value='opt2'>Option 2</label><label><input name='radio_opts' type='radio' value='opt2'>Option 3</label></div>">Radio Buttons</li>
                            <li draggable="true" data-placeholder="Placeholder" data-label="Select Input" data-type="select" data-name="select_one" data-view="<div class='form-item'><label>Select Input</label>
                            <select class='form-control'>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option></div>">Select Dropper</li>
                            <li draggable="true" data-placeholder="Placeholder" data-label="Button Input" data-type="button" data-name="button_one" data-view="<div class='form-item'><label>Button</label>
                            <button type='button' class='btn btn-primary'>Press Me</button></div>">Button</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="form_name">Form Name</label>

                        <div id="form-preview" class="form-control" style="min-height: 100px;height:100%;">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="form_html">Form Html Translation</label>
                        <textarea rows="10" class="form-control" id="form_html"
                                  name="form_html"><?= $this->data->page['form_html'] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Page</button>
                </form>
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

<div id="popover-window" class="popover right" style="top: 14.5px; left: 800px; display: none;">
    <div class="arrow"></div>
    <h3 class="popover-title">Text Input</h3>
    <div class="popover-content">
            <div id="popover-form" class="form-group">
                <label> ID / Name </label>
                <input class="pop-name form-control" data-type="input" type="text" name="name" id="name" value="text_one">
                <label> Label Text </label>
                <input class="pop-label form-control" data-type="input" type="text" name="label" id="label" value="Text Input">
                <label>Placeholder </label>
                <input class="pop-placeholder form-control" data-type="input" type="text" name="placeholder" id="placeholder" value="placeholder">
                <label class="checkbox control-group" style="margin-left: 22px;">
                    <input type="checkbox" data-type="checkbox" class="form-inline" name="required" id="required">Required
                </label>
                <hr>
                <a href="javascript:void(0);" id="popover-save" class="btn btn-primary">Save</a>
                <a href="javascript:void(0);" id="popover-delete" class="btn btn-danger">Delete</a>
                <a href="javascript:void(0);" id="popover-cancel" class="btn btn-default">Cancel</a>
            </div>
    </div>
</div>

{{/body}}

{{scripts}}
<script src="/assets/js/ckeditor/ckeditor.js"></script>
<script src="/assets/js/ckeditor/adapters/jquery.js"></script>
<script src="/assets/js/forms.js"></script>
{{/scripts}}