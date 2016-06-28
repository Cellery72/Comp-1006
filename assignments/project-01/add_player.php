<?php

// $_POST to variables
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$position = $_POST['position'];
$team_id = $_POST['team_id'];
$dob = $_POST['dob'];


// Commence Validation...
session_start();
$validated = true;

// error msg
$error_msg = "";

// validate a team has been selected
if (empty($team_id)) {
    $error_msg .= "A team must be selected.<br>";
    $validated = false;
}

// validate the first name isn't empty
if (empty($first_name)) {
    $error_msg .= "The first name can't be empty.<br>";
    $validated = false;
} else {
    $first_name = filter_var($first_name, FILTER_SANITIZE_STRING);
}

// validate the last name isn't empty
if (empty($last_name)) {
    $error_msg .= "The last name can't be empty.<br>";
    $validated = false;
} else {
    $last_name = filter_var($last_name, FILTER_SANITIZE_STRING);
}

if ($validated == false) {
    // set our session variable with the error message
    $_SESSION['fail'] = "The song could not be added:<br>{$error_msg}";

    // redirect the user and exit the script
    header('Location: confirmed.php');
    exit;
}

// db config..
$dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_866e6052803773b", "bef99d16faecee", "6fed48b7");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$sql = 'INSERT INTO `players` (first_name, last_name, DOB, position, team_id) VALUES ( :first_name, :last_name, :dob, :position, :team_id);';
$sth = $dbh->prepare($sql);

// prepare our SQL
$sth->bindParam(':team_id', $team_id, PDO::PARAM_INT);
$sth->bindParam(':first_name', $first_name, PDO::PARAM_STR, 30);
$sth->bindParam(':last_name', $last_name, PDO::PARAM_STR, 30);
$sth->bindParam(':position', $position, PDO::PARAM_STR, 30);
$sth->bindParam(':dob', $dob, PDO::PARAM_STR, 15);

// extecute the SQL
$sth->execute();

// close our connection
$dbh = null;

header("Location: players.php?team_id=" . $team_id);
exit;

?>