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
                <form id="forms-create-form" action="/forms/form/save" method="post">
                    <div class="form-group">
                        <label for="form_name">Form Name</label>
                        <input type="text" class="form-control" id="form_name" name="form_name" required
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
                            <li draggable="true" data-placeholder="Placeholder" data-label="Text Input" data-type="text"
                                data-name="text_one" data-view="<div class='form-item'><label>Text Input</label>
                            <input name='text_one' type='text' class='form-control'></div>">Text Input
                            </li>
                            <li draggable="true" data-placeholder="Placeholder" data-label="Textarea Input"
                                data-type="textarea" data-name="textarea_one" data-view="<div class='form-item'><label>Textarea Input</label>
                            <textarea name='textarea_one' class='form-control'></textarea></div>">Text Area
                            </li>
                            <li draggable="true" data-placeholder="Placeholder" data-label="Radio Input"
                                data-type="radio" data-name="radio_one" data-view="<div class='form-item'>
                            <label><input name='radio_opts' type='radio' value='opt1' checked>Option 1</label><label><input name='radio_opts' type='radio' value='opt2'>Option 2</label><label><input name='radio_opts' type='radio' value='opt3'>Option 3</label></div>">
                                Radio Buttons
                            </li>
                            <li draggable="true" data-placeholder="Placeholder" data-label="Select Input"
                                data-type="select" data-name="select_one" data-view="<div class='form-item'><label>Select Input</label>
                            <select name='select_one' class='form-control'>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option></select></div>">Select Dropper
                            </li>
                            <li draggable="true" data-placeholder="Placeholder" data-label="Button Input"
                                data-type="button" data-name="button_one" data-view="<div class='form-item'>
                            <button type='button' class='btn btn-primary'>Submit</button></div>">Button
                            </li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="form_name">Form Sampler</label>

                        <div id="form-preview" class="form-control" style="min-height: 100px;height:100%;">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="form_html">Form Html Translation</label>
                        <textarea rows="10" class="form-control" id="form_html" required
                                  name="form_html"><?= $this->data->page['form_html'] ?></textarea>
                    </div>
                    <button id="form-submitter" type="submit" class="btn btn-primary">Submit Page</button>
                    <img id="form-spinner" style="display: none; margin: 10px;" src="/assets/img/ajax-loader.gif">
                </form>
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
            <label for="name" id="label-name"> Field ID/Name
                <input class="pop-name form-control cereal" type="text" name="name" id="name" value="text_one">
            </label>
            <label for="label" id="label-label"> Label
                <input class="pop-label form-control cereal" type="text" name="label" id="label" value="Text Input">
            </label>
            <label for="choices" id="label-choices"> Choices
                <textarea class="pop-choices form-control cereal" name="choices" id="choices"></textarea>
            </label>
            <label for="placeholder" id="label-placeholder"> Placeholder
                <input class="pop-placeholder form-control cereal" type="text" name="placeholder" id="placeholder"
                       value="placeholder">
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
<script src="/assets/js/forms.js"></script>
{{/scripts}}