{{body}}
<div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Content
                        <small>All current pages</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-lock"></i> <a href="/admin/dashboard">Admin</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file-text-o"></i> <a href="/pages/page">Content</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row" style="margin-bottom: 1em;">
                <div class="col-lg-12">
                    <a href="/pages/page/create" class="btn btn-success">Add Page +</a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>Page Name</th>
                            <th>Page URL</th>
                            <th>Rendering Id</th>
                            <th>Page HTML</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <? foreach ($this->data->pages as $page): ?>
                            <tr>
                                <td>
                                    <?= $page['page_name'] ?>
                                </td>
                                <td>
                                    <?= $page['page_url'] ?>
                                </td>
                                <td>
                                    <?= $page['rendering_id'] ?>
                                </td>
                                <td>
                                    <?= $page['page_html'] ?>
                                </td>
                                <td>
                                    <a href="/pages/page/edit?id=<?= $page['id'] ?>" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <a href="/pages/page/delete?id=<?= $page['id'] ?>" class="btn btn-danger">Delete</a>
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