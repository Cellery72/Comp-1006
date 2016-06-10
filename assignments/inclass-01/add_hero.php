<?php
    // $_POST to variables
    $last = $_POST['last'];
    $first = $_POST['first'];
    $alias = $_POST['alias'];
    $powers = $_POST['powers'];

    // connection to Local database
    //$dbh = new PDO("mysql:host=localhost;dbname=comp-1006-lesson-examples","root","");
    // connection to Azure Database

    $dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_866e6052803773b", "bef99d16faecee", "6fed48b7");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    // build the SQL
    $sql = 'INSERT INTO heroes (first_name, last_name, alias, powers) VALUES (:first_name, :last_name, :alias, :powers)';
    $sth = $dbh->prepare($sql);

    // prepare our SQL
    $sth->bindParam(':first_name',$first, PDO::PARAM_STR, 30 );
    $sth->bindParam(':last_name',$last, PDO::PARAM_STR, 30 );
    $sth->bindParam(':alias',$alias, PDO::PARAM_STR, 15 );
    $sth->bindParam(':powers',$powers, PDO::PARAM_STR, 50 );

    // extecute the SQL
    $sth->execute();

    // close our connection
    $dbh = null;

    header("Location: index.php");
    exit;
?>