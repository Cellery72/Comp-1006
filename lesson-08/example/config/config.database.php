<?php

if (preg_match( '/azure//i', $_SERVER['HTTP_HOST'])){
    // database configuration for remote server
    define('DBHOST', 'localhost');
    define('DBNAME', 'comp-1006-lesson-examples');
    define('DBUSER', 'root');
    define('DBPASS', '');
}
else {
    // database configuration for local server
    define('DBHOST', 'localhost');
    define('DBNAME', 'comp-1006-lesson-examples');
    define('DBUSER', 'root');
    define('DBPASS', '');
}