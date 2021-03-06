{{body}}

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Pages
                        <small>Edit</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-lock"></i> <a href="/admin/dashboard">Admin</a>
                        </li>
                        <li>
                            <i class="fa fa-file-text-o"></i> <a href="/pages/page">Pages</a>
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
                    <form id="pages-form-create" action="/pages/page/save" method="post">
                        <div class="form-group">
                            <label for="page_name">Page Name</label>
                            <input type="text" class="form-control" id="page_name" name="page_name" required
                                   placeholder="Page name" value="<?= $this->data->page['page_name'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="page_url">Page Url</label>
                            <input type="text" class="form-control" id="page_url" name="page_url" placeholder="Page url" required
                                   value="<?= $this->data->page['page_url'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="form_id">Form Id</label>
                            <input type="text" class="form-control" id="form_id" name="form_id" placeholder="Form Id"
                                   value="<?= $this->data->page['form_id'] ?>">
                            <a style="margin-top: 5px;" class="btn btn-primary" onclick="FormsPreview.showFormsModal();">Show Options</a>
                        </div>
                        <div class="form-group">
                            <label for="rendering_id">Rendering Id</label>
                            <input type="text" class="form-control" id="rendering_id" name="rendering_id" placeholder="Rendering Id"
                                   value="<?= $this->data->page['rendering_id'] ?>">
                            <a style="margin-top: 5px;" class="btn btn-primary" onclick="RenderingsPreview.showRenderingsModal();">Show Options</a>
                        </div>
                        <div class="form-group hidden" style="display: none;">
                            <label for="page_url">Page Url</label>
                            <input type="text" class="form-control" id="page_url" name="id"
                                   value="<?= $this->data->page['id'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="page_html">Page Content</label>
                            <textarea rows="10" class="form-control" id="page_html" name="page_html" required
                                      placeholder="Page content"><?= $this->data->page['page_html'] ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="page-submit-btn">Submit Page</button>
                        <img id="page-submit-img" style="display: none; margin: 10px;" src="/assets/img/ajax-loader.gif">
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
                                <ul class="pagination renderings">
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
            <div class="modal fade" id="forms-modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body" id="forms-modal-body">
                            <nav>
                                <ul class="pagination forms">
                                </ul>
                            </nav>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary save">Select Form</button>
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
<script src="/assets/js/plugins/ckeditor/ckeditor.js"></script>
<script src="/assets/js/plugins/ckeditor/adapters/jquery.js"></script>
<script src="/assets/js/pages.js"></script>
<script>
    //These are for the modals which show rendering options
    RenderingsPreview.contentRenderFrames();
    FormsPreview.contentRenderForms();

    $(document).ready(function() {
        var ckedit = $('textarea#page_html').ckeditor();
    });
</script>
{{/scripts}}