<?php
    // Local DB Connection
    //$dbh = new PDO("mysql:host=localhost;dbname=comp-1006-lesson-examples", "root", "");
    // Azure DB Connection
    $dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_866e6052803773b", "bef99d16faecee", "6fed48b7");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // build statement
    $sql = 'SELECT * FROM heroes';

    // prepare our SQL
    // $artists = $dbh->query( $sql );
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $heroes = $sth->fetchAll();
    $row_count = $sth->rowCount();

    // close the DB connection
    $dbh = null;
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
    <title>Professional Sports Teams</title>
</head>
<body>
<div class="container">
    <!-- Create FORM -->
    <section>
        <h1 class="page-header text-center">Add Heros!</h1>
        <form action="add_hero.php" method="post">
            <fieldset>
                <div class="row">
                    <!-- first Name -->
                    <div class="text-center col-xs-3 form-group">
                        <label for="name">First Name</label>
                        <input class="form-control" type="text" name="first">
                    </div>
                    <!-- Last Name -->
                    <div class="text-center col-xs-3 form-group">
                        <label for="name">Last Name</label>
                        <input class="form-control" type="text" name="last">
                    </div>
                    <!-- Alias -->
                    <div class="text-center col-xs-3 form-group">
                        <label for="name">Alias</label>
                        <input class="form-control" type="text" name="alias">
                    </div>
                    <!-- Powers -->
                    <div class="text-center col-xs-3 form-group">
                        <label for="name">Powers</label>
                        <input class="form-control" type="text" name="powers">
                    </div>
                </div>
                <div class="row text-right">
                    <button class="btn btn-success">Add Hero</button>
                </div>
            </fieldset>
        </form>
    </section>
    <?php if ($row_count > 0): ?>
        <section>
            <div class="container">
                <div class="row">
                    <h2>Hero Info</h2>
                    <hr>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Alias</th>
                            <th>Powers</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($heroes as $hero): ?>
                            <tr>
                                <td><?= $hero['first_name'] ?></td>
                                <td><?= $hero['last_name'] ?></td>
                                <td><?= $hero['alias'] ?></td>
                                <td><?= $hero['powers'] ?></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    <?php endif ?>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>