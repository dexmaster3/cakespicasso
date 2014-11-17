{{body}}

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Activities
                        <? if(isset($route['params']['user']) && $route['params']['user'] > 0): ?>
                            <? foreach ($this->data->users as $user): ?>
                                <? if ($user['id'] == $route['params']['user']): ?>
                                    <small>Activity for: <?= ucfirst($user['username']) ?></small>
                                <? endif; ?>
                            <? endforeach; ?>
                        <? else: ?>
                            <small>Activity for: All</small>
                        <? endif; ?>
                </h1>

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-tachometer"></i> <a href="/admin/dashboard">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-edit"></i> <a href="/admin/dashboard/activity">Activity</a>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-4 form-inline" style="margin-bottom: 15px;">
                <select id="user-activity-select" class="form-control form-group">
                    <option value="0">--Select User--</option>
                    <? foreach($this->data->users as $user): ?>
                    <option value="<?= $user['id'] ?>"><?= ucfirst($user['username']) ?></option>
                    <? endforeach; ?>
                </select>
                <button onclick="changeUserActivityView();" class="form-group btn btn-default">Select</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Note</th>
                        <th>Icon</th>
                        <th>Author Id</th>
                        <th>Date Created</th>
                    </tr>
                    </thead>
                    <?php foreach ($this->data->activities as $activity): ?>
                        <tr id="activity-item-<?= $activity['id'] ?>">
                            <td>
                                <?= $activity['name'] ?>
                            </td>
                            <td>
                                <?= $activity['description'] ?>
                            </td>
                            <td>
                                <?= $activity['note'] ?>
                            </td>
                            <td>
                                <?= $activity['type'] ?>
                            </td>
                            <td>
                                <?= $activity['author_id'] ?>
                            </td>
                            <td>
                                <time><?= $activity['date_modified'] ?></time>
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
<script>
    function changeUserActivityView() {
        var user_id = $("#user-activity-select").val();
        window.location.href = "/admin/dashboard/activity?user=" + user_id;
    }
</script>
{{/scripts}}