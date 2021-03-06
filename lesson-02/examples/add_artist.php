<?php
    // $_POST to variables
    $artist_name = $_POST['name'];
    $bio_link = $_POST['bio_link'];

    // connection to database
    $dbh = new PDO("mysql:host=localhost;dbname=comp-1006-lesson-examples","root","");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    // build the SQL
    $sql = 'INSERT INTO artists (name, bio_link) VALUES (:name, :bio_link)';
    $sth = $dbh->prepare($sql);

    // prepare our SQL
    $sth->bindParam(':name',$artist_name, PDO::PARAM_STR, 50 );
    $sth->bindParam(':bio_link',$bio_link, PDO::PARAM_STR, 100 );

    // extecute the SQL
    $sth->execute();

    // close our connection
    $dbh = null;

    // provide confirmation
    header("Location: new_artist.php");

?>