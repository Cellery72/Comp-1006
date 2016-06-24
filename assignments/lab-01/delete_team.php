<?php

// session start
session_start();

// assign the post value to a variable
$team_id = $_POST['id'];

// is artist ID empty?
if ( empty( $team_id ) ) {
    $_SESSION['fail'] = "You have not seelcted a team to delete.<br>";
    header( 'Location: confirmed.php' );
    exit;
}

// connect to the DB
$dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_866e6052803773b", "bef99d16faecee", "6fed48b7");
$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

// build the SQL
$sql = 'DELETE FROM teams WHERE team_id = :id';

// prepare the SQL
$sth = $dbh->prepare( $sql );

// bind the value
$sth->bindParam( ':id', $team_id, PDO::PARAM_INT );

// execute
$sth->execute();

// close the DB
$dbh = null;

// redirect to confirm with success message
$_SESSION['success'] = "You have successfully deleted the team.<br>";
header( 'Location: confirmed.php' );
exit;