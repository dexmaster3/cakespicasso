<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Blank Page
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="/cms/admin/index">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Blank Page
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <form action="/admin/admin/layouts?action=post" method="post">
                    <div class="form-group">
                        <label for="page_name">Layout Name</label>
                        <input type="text" class="form-control" id="layout_name" name="layout_name"
                               placeholder="Layout name" value="<?= $this->data->page['layout_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="page_url">Layout Parent</label>
                        <input type="text" class="form-control" id="layout_parent" name="layout_parent"
                               placeholder="Layout Parent" value="<?= $this->data->page['layout_parent'] ?>">
                    </div>
                    <div class="form-group hidden" style="display: none;">
                        <input type="text" class="form-control" id="id" name="id"
                               value="<?= $this->data->page['id'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="page_html">Layout Content</label>
                        <textarea rows="20" class="form-control" id="layout_content" name="layout_content"
                                  placeholder="Layout content"><?= $this->data->page['layout_content'] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Page</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->