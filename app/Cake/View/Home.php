<head>
<style>
    header {
        background-color:black;
        color:white;
        text-align:center;
        padding:5px;
    }
    nav {
        line-height:30px;
        background-color:#eeeeee;
        height:300px;
        width:100px;
        float:left;
        padding:5px;
    }
    section {
        width:350px;
        float:left;
        padding:10px;
    }
    footer {
        background-color:black;
        color:white;
        clear:both;
        text-align:center;
        padding:5px;
    }
</style>
</head>
<body>
<header>
    <h1>City Gallery</h1>
</header>

<nav>
    <?php foreach($data as $datak => $datav): ?>
        <span><h2><?= $datak ?></h2><h3><?= $datav ?></h3></span>
    <?php endforeach; ?>
</nav>

<section>
    <?php if(isset($data->city)): ?>
    <h1><?= $data->city ?></h1>
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