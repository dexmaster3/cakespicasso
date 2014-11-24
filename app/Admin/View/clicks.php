{{body}}

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Clicks
                    <small>Website click coords</small>
                </h1>

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-tachometer"></i> <a href="/admin/dashboard">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-edit"></i> <a href="/admin/dashboard/clicks">Clicks</a>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <button style="margin-bottom: 10px;" onclick="clickHandler.displayClicks(clickCoordTable);" class="btn btn-primary">Show Current Clicks</button>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-striped" id="clicks-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>X Coord</th>
                        <th>Y Coord</th>
                        <th>Location</th>
                        <th>Date Added</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>X Coord</th>
                        <th>Y Coord</th>
                        <th>Location</th>
                        <th>Date Added</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

{{/body}}

{{scripts}}
<script src="/assets/js/plugins/datatables/jquery.dataTables.js"></script>
<script src="/assets/js/plugins/datatables/dataTables.bootstrap.js"></script>
<script>
    var clickCoordTable;
    $(document).on('ready', function () {
        clickCoordTable = $("#clicks-table").dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "/Analytics/Analytics/getnextclicks",
                "type": "POST"
            },
            "columns": [
                {"name": "id", "data": "id"},
                {"name": "x", "data": "x"},
                {"name": "y", "data": "y"},
                {"name": "location", "data": "location"},
                {"name": "date_modified", "data": "date_modified"}
            ]
        });
    });
</script>
{{/scripts}}