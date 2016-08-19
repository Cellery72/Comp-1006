<?php

require_once '/lesson-08/example/config/config.database.php';

class Database {

    // Database Properties
    private $dbh;
    private $sth;
    private $error;

    // Database Constructor
    public function __construct () {

        try {
            $this->dbh = new PDO("mysql:host={DBHOST};dbname={DBNAME}", DBUSER, DBPASS);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $ex)
        {
            $this->error = $ex;
        }
    }

    public function getError(){
        return is_null($this->error) ?  false :  $this->error->getMessage();
    }


}