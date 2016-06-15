<?php

	// session start
	session_start();

	// assign the post value to a variable
	$artist_id = $_POST['id'];

	// is artist ID empty?
	if (empty($artist_id)){
		$_SESSION['Fail'] = "You have not selected an artist to delete.<br>";
		header('Location: confirmed.php');
		exit;
	}

    $dbh = new PDO("mysql:host=localhost;dbname=comp-1006-lesson-examples","root","");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $sql = 'DELETE FROM artists where id = :id';


    // prepare the SQL
    $sth = $dbh->prepare($sql);
    
    // bind the value to the placeholder
	$sth->bindParam(':id', $artist_id, PDO::PARAM_INT);

	// execute
	$sth->execute();

	$dbh = null;

	// redirect to confirm with a success message
	$_SESSION['success'] = "You have successfully deleted te artist.<br>";
	header('Location: confirmed.php');
	exit;