<?php


class DBController
{
    // Datatase Connection Properties
    protected $host = 'localhost';
    protected $user = 'root';
    protected $password = '';
    protected $database = 'shopee';

    // connection property
    public $con = null;

    // call constructor
    public function __construct()
    {
        $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        if($this->con->connect_error){

            echo "Fail" . $this->con->connect_error;
        }

    }

    // This is for destruction function -> colseConnection()
    public function __destruct()
    {
        $this->colseConnection();
    }

    // For mysqli closing connection
    protected function colseConnection() {

        if ($this->con != null) {

            $this->con->close();
            $this->con = null;
        }
    }

    


}

