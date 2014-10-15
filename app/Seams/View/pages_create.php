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
                    <form action="/cms/pages/createpage">
                        <div class="form-group">
                            <label for="page_name">Page Name</label>
                            <input type="text" class="form-control" id="page_name" name="page_name" placeholder="Page name">
                        </div>
                        <div class="form-group">
                            <label for="page_url">Page Url</label>
                            <input type="text" class="form-control" id="page_url" name="page_url" placeholder="Page url">
                        </div>
                        <div class="form-group">
                            <label for="page_html">Page Name</label>
                            <textarea type="text" class="form-control" id="page_html" name="page_html" placeholder="Page html"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Page</button>
                    </form>
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
