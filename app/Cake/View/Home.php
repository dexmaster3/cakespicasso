<head>
    <link rel="stylesheet" type="text/css" href="/assets/dstyles.css">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
<header>
    <h1>City Gallery</h1>
</header>

<nav>
    <button type="button" class="btn btn-primary">NavButton</button>
    <a href="/young-fro/Home/adduser" class="btn btn-warning">Add User</a>
</nav>

<section>
    <table>
        <tr>
            <th>Name</th><th>Title</th><th>Rank</th>
        </tr>
        <?php foreach($this->data->employees as $employee): ?>
        <tr>
            <td><?= $employee['name'] ?></td>
            <td><?= $employee['title'] ?></td>
            <td><?= $employee['rank'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php if(isset($this->data->city)): ?>
    <h1><?= $this->data->city ?></h1>
    <?php else: ?>
    <h1>London</h1>
    <?php endif; ?>
    <p>
        London is the chillest capital city of England. It is the most ill city in the United Kingdom,
        with a metropolitan area of over 13 million bros.
    </p>
    <p>
        Standing on the River Thames, London has been a major settlement for two millennia,
        its history going back to its founding by the Romans, who named it Londinium.
    </p>
</section>

<footer>
    Copyright &copy; Cakes Picasso AKA Young Fro
</footer>

</body>