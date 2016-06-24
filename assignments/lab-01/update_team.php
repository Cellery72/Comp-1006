<?php

// start the session
session_start();

// $_POST to variables
$team_name = $_POST['name'];
$sport = $_POST['sport'];
$league = $_POST['league'];
$id = $_POST['id'];

// validate
// set our validation flag variable
$validated = true;

// set variable to store error messages
$error_msg = "";

// check that the team id isn't empty
if ( empty( $id ) ) {
    // concatenate an error message
    $error_msg .= "You must select a team.<br>";

    // set the validation state
    $validated = false;
}

// check if the name was passed
if ( empty( $team_name ) ) {
    // concatenate an error message
    $error_msg .= "The team name cannot be empty.<br>";

    // set the validate state
    $validated = false;
} else {
    // sanitize the data
    $name = filter_var( $team_name, FILTER_SANITIZE_STRING );
}

// check if the league was passed
if ( empty( $league ) ) {
    // concatenate an error message
    $error_msg .= "The league cannot be empty.<br>";

    // set the validate state
    $validated = false;
} else {
    // sanitize the data
    $name = filter_var( $league, FILTER_SANITIZE_STRING );
}

// check if the sport was passed
if ( empty( $sport ) ) {
    // concatenate an error message
    $error_msg .= "The sport cannot be empty.<br>";

    // set the validate state
    $validated = false;
} else {
    // sanitize the data
    $name = filter_var( $sport, FILTER_SANITIZE_STRING );
}


// if the validation has failed, redirect the user to the confirmation page
if ( $validated == false ) {
    // set our session variable with the error message
    $_SESSION['fail'] = "The team could not be added:<br>{$error_msg}";

    // redirect the user and exit the script
    header( 'Location: confirmed.php' );
    exit;
}

// connect to the DB
$dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_866e6052803773b", "bef99d16faecee", "6fed48b7");
$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

// build the SQL
$sql = 'UPDATE teams SET team_name=:name, sport_id=(SELECT sport_id FROM sports where sport_name=:sport), league_id=(SELECT league_id FROM leagues where league_name=:league) WHERE team_id = :id';
// prepare our SQL
$sth = $dbh->prepare( $sql );

// bind the values
$sth->bindParam( ':name', $team_name, PDO::PARAM_STR, 50 );
$sth->bindParam( ':sport', $sport, PDO::PARAM_STR, 10 );
$sth->bindParam( ':league', $league, PDO::PARAM_STR, 3 );
$sth->bindParam( ':id', $id, PDO::PARAM_INT );

// execute the SQL
$sth->execute();

// close the connection
$dbh = null;

// we set the 'success' session variable and store our message
$_SESSION['success'] = "Team was updated successfully.<br>";

// we redirect to the confirmation page
header( 'Location: confirmed.php' );
exit;











