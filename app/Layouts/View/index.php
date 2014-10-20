<?php require 'head.php'?>

<body>

<div id="wrapper">
    <?php include 'navbar.php' ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Layouts
                        <small>All layouts</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row" style="margin-bottom: 1em;">
                <div class="col-lg-12">
                    <a href="/layout/layout/create" class="btn btn-success">Add Page +</a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>Layout Name</th>
                            <th>Layout HTML</th>
                            <th>Layout Parent ID</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <?php foreach($this->data->layouts as $layout): ?>
                            <tr>
                                <td>
                                    <?= $layout['layout_name'] ?>
                                </td>
                                <td>
                                    <?= $layout['layout_content'] ?>
                                </td>
                                <td>
                                    <?= $layout['layout_parent'] ?>
                                </td>
                                <td>
                                    <a href="/cms/layout/edit?id=<?= $layout['id'] ?>" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <a href="/cms/layout/delete?id=<?= $layout['id'] ?>" class="btn btn-danger">Delete</a>
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