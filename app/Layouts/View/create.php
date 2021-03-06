{{body}}

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Layouts
                    <small>Edit your layout piece</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-lock"></i> <a href="/admin/dashboard">Admin</a>
                    </li>
                    <li>
                        <i class="fa fa-edit"></i> <a href="/layouts/layout">Layouts</a>
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
                <form id="layout-form" action="/layouts/layout/post" method="post">
                    <div class="form-group">
                        <label for="page_name">Layout Name</label>
                        <input type="text" class="form-control" id="layout_name" name="layout_name" required
                               placeholder="Layout name" value="<?= $this->data->page['layout_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="page_name">Tag Names</label>
                        <p class="tag-drag" draggable="true" data-text="{{content_content}}"> {{content_content}} </p>
                        <p class="tag-drag" draggable="true" data-text="{{form_content}}"> {{form_content}} </p>
                        <p class="tag-drag" draggable="true" data-text="{{drag_content}}"> {{drag_content}} </p>
                    </div>
                    <div class="form-group hidden" style="display: none;">
                        <input type="text" class="form-control" id="id" name="id"
                               value="<?= $this->data->page['id'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="page_html">Layout Content</label>
                        <textarea rows="20" class="form-control" id="layout_content" name="layout_content" required
                                  placeholder="Layout content"><?= $this->data->page['layout_content'] ?></textarea>
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

{{/body}}

{{scripts}}
<script src="/assets/js/plugins/ckeditor/ckeditor.js"></script>
<script src="/assets/js/plugins/ckeditor/adapters/jquery.js"></script>
<script src="/assets/js/layout.js"></script>
<script>
    var form = $("#layout-form");
    form.on('submit', function(ev){
        $("#form-submitter").attr("disabled", "");
        $("#form-spinner").css("display", "inline");
        ev.preventDefault();
        var info = {
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serializeArray()
        };

        ajaxhandle(info, function(data){
            $.notify(data.message, data.type);
            if (data.success) {
                setTimeout(function(){
                    window.location.href = data.redirect;
                }, 1800);
            } else {
                $("#form-submitter").removeAttr("disabled");
                $("#form-spinner").css("display", "none");
            }
        });
    });
    $(document).ready(function() {
        var ckedit = $('textarea#layout_content').ckeditor({
            startupMode: "source"
        });
    });
</script>
{{/scripts}}