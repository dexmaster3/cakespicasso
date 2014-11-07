{{body}}
<div id="page-wrapper">
<div class="container-fluid" style="margin: 20px;">
<div class="row">
    <div class="col-lg-12">
        <h1>Browsable Pages</h1>
        <table class="table table-bordered table-hover table-responsive">
            <thead>
            <tr>
                <th>Page Name</th>
                <th>Page URL</th>
                <th>Rendering Id</th>
                <th>Content</th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($this->data->pages as $page): ?>
                <tr>
                    <td>
                        <a class="btn btn-success" href="/<?= $page['page_url'] ?>" target="_blank">
                        <?= $page['page_name'] ?>
                        </a>
                    </td>
                    <td>
                        <?= $page['page_url'] ?>
                    </td>
                    <td>
                        <?= $page['rendering_id'] ?>
                    </td>
                    <td>
                        <?= $page['page_html'] ?>
                    </td>
                </tr>
            <? endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
{{/body}}