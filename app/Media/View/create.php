{{body}}
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Media
                    <small>Upload Files</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-lock"></i> <a href="/admin/dashboard">Admin</a>
                    </li>
                    <li>
                        <i class="fa fa-file-image-o"></i> <a href="/media/media">Media</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file-text-o"></i> <a href="/media/media/create">Create</a>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <form action="/media/media/upload" class="dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <a href="/media/media" class="btn btn-primary">Return to Media</a>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
{{/body}}


{{scripts}}
<script src="/assets/js/plugins/dropzone/dropzone.js"></script>
{{/scripts}}