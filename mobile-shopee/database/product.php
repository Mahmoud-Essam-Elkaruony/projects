<?php

class product 
{

    public $db = null;

    public function __Construct(DBconnection $db) {

        if(!isset($db->con))return null;{

            $this->db = $db;
        }
    }

    // Fetch prodct data useing getData method
    public function getData($table = 'product'){

        $result = $this->db->con->query("SELECT * FROM {$table}");
        $resultArray = array();
        
        // Fetch prodct data one by one 
        // MYSQLI_ASSOC -> It will get the value as keys and valus
        while($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){

            $resultArray[] = $item;
        } 

        return $resultArray;
    }

    // Get products ID
    public function getProductId($product_id = null, $table = 'product') {

        $result = $this->db->con->query("SELECT * FROM {$table} WHERE item_id={$product_id}");
        $arrayResult = array();

        while($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $arrayResult[] = $item;
        }

        return $arrayResult;
    } 


}