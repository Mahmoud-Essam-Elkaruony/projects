<?php

// Use to fetch product data
class Product
{

    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con))return null;{

            $this->db = $db;
        }
    }

    // fetch product data using getData method
    public function getData($table = 'product') {

        $result = $this->db->con->query("SELECT * FROM {$table}");

        $resultArray = array();

        // fetch product data one by one 
        // MYSQLI_ASSOC -> It will get the value as keys and valus
        while($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){

            $resultArray[] = $item;
        }

        return $resultArray;
    }

    // get product useing item_id
    public function getProduct($item_id = null, $table = 'product') {

        $result = $this->db->con->query("SELECT * FROM {$table} WHERE item_id={$item_id}");

        $resultArray = array();

        // fetch product data one by one
        while($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $resultArray[] = $item;
        }

        return $resultArray;
    }

}