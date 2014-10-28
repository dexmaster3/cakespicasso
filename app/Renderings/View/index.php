<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Renderings
                    <small>View Renderings</small>
                </h1>
                <a href="/renderings/rendering/create" class="btn btn-success">Create New</a>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <? foreach($this->data->renderings as $rendering): ?>
                    <iframe class="rendering" src="/display/display/rendering?id=<?= $rendering['id'] ?>"></iframe>
                <? endforeach; ?>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->