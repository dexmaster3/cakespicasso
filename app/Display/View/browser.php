<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Welcome to Cakes Picasso AKA YoungFro">
    <meta name="author" content="DEX!">

    <title>Cakes Picasso</title>

    <!-- Bootstrap Core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/admin.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
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

</body>