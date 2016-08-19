<?php

require_once './classes/database.php';

// instantitate Database class
$dbh = new Database();

if ( $err = $dbh->getError()){
    echo $err;
} else {
    echo "We are connected successfully";
}



