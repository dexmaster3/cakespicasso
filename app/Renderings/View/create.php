{{body}}

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Rendering Setup
                    <small>Create Rendering</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-lock"></i> <a href="/admin/dashboard">Admin</a>
                    </li>
                    <li>
                        <i class="fa fa-photo"></i> <a href="/renderings/rendering">Renderings</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Edit
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-5" id="drag-layouts">
                <h1>Layout Pieces</h1>
                <hr/>
                <div class="drag-layout" id="contentsection" draggable="true">
                    <h1>Content</h1>
                    Your content will be rendered where this is placed
                    <textarea class="data" name="contentsection[]">{{content_content}}</textarea>
                </div>
                <? foreach($this->data->layouts as $layout): ?>
                <div class="drag-layout" id="layout<?= $layout['id'] ?>" draggable="true">
                    <h1><?= $layout['layout_name'] ?></h1>
                    <?= substr($layout['layout_content'], 0, 100) . ' ...' ?>
                    <textarea class="data" name="layout[]"><?= $layout['layout_content'] ?></textarea>
                </div>
                <? endforeach; ?>
            </div>
            <div class="col-lg-7">
                <h1>Desired Layout</h1>
                <hr/>
                <form action="/renderings/rendering/save" method="post">
                    <div class="form-group">
                        <div id="layout-output">

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Page</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="rendering-frame-sample">

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

{{/body}}

{{scripts}}
<script>
    renderingPiecesDriver();
</script>
{{/scripts}}