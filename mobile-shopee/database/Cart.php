<?php

// php cart class
class Cart
{

    public $db = null;
    // $db it will become after you call the object and pass the parameter
    public function __construct(DBController $db) 
    {
        if(! isset($db->con))return null;{

            $this->db = $db;
        }
    }

    // Insert into cart table
    public function insertIntoCart($params = null, $table = "cart")
    {
        // $params -> it will take name of column and value of column
        if ($this->db->con != null) {

            if ($params != null) {
                // "insert into cart(user_id) valuse(0)"
                // get table columns
                // implode-> user_id, item_id
                $columns = implode(',', array_keys($params)); // name of column 
                $values = implode(',', array_values($params)); // value of column

                // ceart sql query 
                // %s it mean input string 
                // 1%s -> $table
                // 2%s -> $columns
                // 3%s -> $values
                $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);

                // execute query 
                $result = $this->db->con->query($query_string);
                return $result; 

            }

        }

    }

    // To get user_id & item_id and insert into cart table
    public function addToCart($userid, $itemid)
    {

        if(isset($userid) && isset($itemid)) {

            $params = array(

                "user_id" => $userid,
                "item_id" => $itemid
            );

            // insert data into cart
            $result = $this->insertIntoCart($params);
            if ($result) {
                // Reload Page
                header("Location:", $_SERVER['PHP_SELF']);
            }

        }
    }

    // Delete cart item useing cart item_id
    public function deleteCart($item_id = null, $table = 'cart'){

        if($item_id !== null) {

            $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id = {$item_id}");

            if($result) {

                header("Location:" . $_SERVER['PHP_SELF']);
            }      

            return $result;
        }
        
    }


    // calculate sub total
    public function getSum($arr) {

        if (isset($arr)) {

            $sum = 0;

            foreach($arr as $item) {

                $sum += floatval($item[0]);

            }   

            return sprintf('%.2f', $sum);
        }

    }
 
    // get item_id of shopping cart list
    // use($kay) We use this method to access to the parameter $key form the fun gatCartId() 
    // $cartArry = 'cart' and $kay = 'item_id'
    // array_map -> it will return to $cart_id  Associative Array 
    // Like this Array ( [0] => 1 [1] => 4 [2] => 13 ) 
    // use() this method to access to the variable outside of the array_map()
    public function getCartId($cartArry = null, $kay = 'item_id') {

        if($cartArry != null) {

            $cart_id = array_map(function($value) use($kay){

                return $value[$kay];

            },$cartArry);

            return $cart_id;
        }
    }

    // Save for later
    public function saveForLater($item_id = null, $saveTable = "wishlist", $fromTable = "cart") {

        if($item_id != null) {

            // This multiple query inside one :)
            $query = "INSERT INTO {$saveTable} SELECT * FROM {$fromTable} WHERE item_id = {$item_id};";
            $query .= "DELETE FROM {$fromTable} WHERE item_id = {$item_id};";

            // Execute multiple query 
            $result = $this->db->con->multi_query($query);

            if($result) {

                // Reload Page
                header("Location:" . $_SERVER['PHP_SELF']);
            }

            return $result;
        }

    }
}