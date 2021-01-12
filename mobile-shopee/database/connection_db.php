<?php

class DBconnection 
{

    // database connection properties
    protected $host         = 'localhost';
    protected $user         = 'root';
    protected $passwored    = '';
    protected $database     = 'mobile_sale';

    // connection propery
    public $con = null;
    
    // Call constructor
    public function __construct()
    {
        $this->con = mysqli_connect($this->host, $this->user, $this->passwored, $this->database);

        if ($this->con->connect_error) {

            echo 'Fail' . $this->con->connect_error;
        }
    }

    // This is for destruction function -> colseconnetion()
    public function __destruct() {

        $this->colseConnetion();
    } 

    // For mysqli closing connection
    protected function colseConnetion() {

        if ($this->con != null) {

            $this->con->close();
            $this->con = null;
        }
    }

}