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
                        Blank Page
                        <small>Subheading</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="/cms/admin/index">Dashboard</a>
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
                    <table class="table-bordered">
                        <?php foreach($this->data->pages as $page): ?>
                        <tr>
                            <td>
                            PageName = <?= $page['page_name'] ?>
                            </td>
                            <td>
                                PageUrl = <?= $page['page_url'] ?>
                            </td>
                            <td>
                                PageHTML = <?= $page['page_html'] ?>
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
