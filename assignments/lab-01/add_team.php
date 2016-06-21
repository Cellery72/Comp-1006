<?php
    // $_POST to variables
    $team_name = $_POST['name'];
    $sport = $_POST['sport'];
    $league = $_POST['league'];

    // connection to Local database
    //$dbh = new PDO("mysql:host=localhost;dbname=comp-1006-lesson-examples","root","");
    // connection to Azure Database

    $dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_866e6052803773b", "bef99d16faecee", "6fed48b7");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    // build the SQL

    $sql = 'INSERT INTO teams (team_name, sport_id, league_id) VALUES (:name, (SELECT sport_id from sports WHERE sport_name= :sport),(SELECT league_id from leagues WHERE league_name=:league))';
    $sth = $dbh->prepare($sql);

    // prepare our SQL
    $sth->bindParam(':name',$team_name, PDO::PARAM_STR, 100 );
    $sth->bindParam(':sport',$sport, PDO::PARAM_STR, 15 );
    $sth->bindParam(':league',$league, PDO::PARAM_STR, 5 );

    // extecute the SQL
    $sth->execute();

    // close our connection
    $dbh = null;

    header("Location: index.php");
    exit;
?>