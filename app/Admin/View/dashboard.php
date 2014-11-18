{{body}}

<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard
            <small>Statistics Overview</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= count($this->data->messages) ?></div>
                        <div>Messages!</div>
                    </div>
                </div>
            </div>
            <a href="/messages/message">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-hand-o-up fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $this->data->clicks[0] ?></div>
                        <div>Total Admin Clicks!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">124</div>
                        <div>New Orders!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">13</div>
                        <div>Support Tickets!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Usage By Type</h3>
            </div>
            <div class="panel-body">
                <div id="morris-donut-chart"></div>
                <div class="text-right">
                    <a onclick="goToFocusedDonutItem();">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Total Activity</h3>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    <? $i = 0; foreach(array_reverse($this->data->activities) as $activity): ?>
                    <a href="#" class="list-group-item">
                        <span class="badge"><?= Display_DisplayHelper::friendlyElapsedTime($activity['date_modified']); ?></span>
                        <i class="<?= $activity['type'] ?>"></i> <?= $activity['description'] ?>
                    </a>
                    <? if(++$i > 10){ break;} ?>
                    <? endforeach; ?>
                </div>
                <div class="text-right">
                    <a href="/admin/dashboard/activity">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> New Public Visitors</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Visitor #</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Ip Address</th>
                            <th>First Visit</th>
                        </tr>
                        </thead>
                        <tbody>
                        <? foreach($this->data->trackings as $tracking): ?>
                        <tr>
                            <td><?= $tracking['id'] ?></td>
                            <td><?= $tracking['country'] ?></td>
                            <td><?= $tracking['city'] ?></td>
                            <td><?= $tracking['query'] ?></td>
                            <td><span class="badge"><?= Display_DisplayHelper::friendlyElapsedTime($tracking['date_modified']); ?></span></td>
                        </tr>
                        <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="/admin/dashboard/visitors">View All Visitors <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

{{/body}}

{{scripts}}

<!-- Morris Charts JavaScript -->
<script src="/assets/js/plugins/morris/raphael.min.js"></script>
<script src="/assets/js/plugins/morris/morris.min.js"></script>
<script src="/assets/js/plugins/morris/morris-data.js"></script>
<script>
    createCharts(<?= json_encode($this->data->donut) ?>);
</script>
{{/scripts}}