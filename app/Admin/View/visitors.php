{{body}}

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Visitors
                        <small>Public Pages</small>
                </h1>

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-tachometer"></i> <a href="/admin/dashboard">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-edit"></i> <a href="/admin/dashboard/visitors">Visitors</a>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Provided As</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Country Code</th>
                        <th>ISP</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Organization Name</th>
                        <th>Ip Address</th>
                        <th>Region</th>
                        <th>Region Name</th>
                        <th>Timezone</th>
                        <th>Zipcode</th>
                        <th>Date Added</th>
                    </tr>
                    </thead>
                    <?php foreach ($this->data->trackings as $visitor): ?>
                        <tr>
                            <td>
                                <?= $visitor['id'] ?>
                            </td>
                            <td>
                                <?= $visitor['as'] ?>
                            </td>
                            <td>
                                <?= $visitor['city'] ?>
                            </td>
                            <td>
                                <?= $visitor['country'] ?>
                            </td>
                            <td>
                                <?= $visitor['countryCode'] ?>
                            </td>
                            <td>
                                <?= $visitor['isp'] ?>
                            </td>
                            <td>
                                <?= $visitor['lat'] ?>
                            </td>
                            <td>
                                <?= $visitor['lon'] ?>
                            </td>
                            <td>
                                <?= $visitor['org'] ?>
                            </td>
                            <td>
                                <?= $visitor['query'] ?>
                            </td>
                            <td>
                                <?= $visitor['region'] ?>
                            </td>
                            <td>
                                <?= $visitor['regionName'] ?>
                            </td>
                            <td>
                                <?= $visitor['timezone'] ?>
                            </td>
                            <td>
                                <?= $visitor['zip'] ?>
                            </td>
                            <td>
                                <time><?= $visitor['date_modified'] ?></time>
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

{{/body}}

{{scripts}}

{{/scripts}}