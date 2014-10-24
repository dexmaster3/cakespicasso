<?php require 'head.php' ?>

<body>

<div id="wrapper">
    <?php include 'navbar.php' ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Pages
                        <small>All current pages</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row" style="margin-bottom: 1em;">
                <div class="col-lg-12">
                    <a href="/cms/pages/create" class="btn btn-success">Add Page +</a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>Page Name</th>
                            <th>Page URL</th>
                            <th>Page HTML</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <?php foreach ($this->data->pages as $page): ?>
                            <tr>
                                <td>
                                    <?= $page['page_name'] ?>
                                </td>
                                <td>
                                    <?= $page['page_url'] ?>
                                </td>
                                <td>
                                    <?= $page['page_html'] ?>
                                </td>
                                <td>
                                    <a href="/cms/pages/edit?id=<?= $page['id'] ?>" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <a href="/cms/pages/delete?id=<?= $page['id'] ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery Version 1.11.0 -->
<script src="/assets/js/jquery-1.11.0.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/assets/js/bootstrap.min.js"></script>

</body>

</html>
