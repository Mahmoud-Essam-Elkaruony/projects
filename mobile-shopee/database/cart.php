<?php 

class Cart
{

    public $cart_db = null;

    public function __construct(DBconnection $cart_db) {

        if(!isset($cart_db->con))return null;{

            // $cart_db-> === con
            // And we pass this value to the property $cart_db to be public and we can access to it.
            $this->cart_db = $cart_db;
            
        }
    }

    // Get  user_id && item_id  and pass it to the method insertIntoCart()
    public function addToCart($itemId, $userId )
    {
        if (isset($itemId) && isset($userId)) {

            $value_Arry = array(

                'item_id' => $itemId,
                'user_id' => $userId
            );
        }
        
        // Insert data into cart
        $result = $this->insertIntoCart($value_Arry);
        if ($result) {

            // Reload Page
            header("Location:", $_SERVER['PHP_SELF']);
        } 
    } 

    // Insert into cart
    // It get the value from addToCart() method and it will insert the value in the table cart.php
    public function insertIntoCart($parameter = null, $table = 'cart') 
    {
        // $params -> it will take name of column and value of column
        if ($this->cart_db->con != null) {

            if ($parameter != null) {
                
                $columns = implode(',', array_keys($parameter));
                $values  = implode(',', array_values($parameter));

                $query_string = sprintf("INSERT INTO %s(%s) VALUES (%s)", $table, $columns, $values);

                // execute query 
                $result = $this->cart_db->con->query($query_string);
                return $result;
            }
        }
    }

    /*  
        -Get item_id from database
        -- use($kay) We use this method to access to the parameter $key form the fun gatCartId() 
        -- $cartArry = it will get all data from cart table and after that we will the $key variable to choose what the column we will use. 
        -- array_map -> it will return to $cart_id  Associative Array 
        -- Like this Array ( [0] => 1 [1] => 4 [2] => 13 ) 
        -- use() this method to access to the variable outside of the array_map()
    */
    public function getCartId($cartArray = null, $key = 'item_id'){
        
        if ($cartArray != null) {

            $cart_id = array_map(function($value) use($key){

                return $value[$key];

            },$cartArray);

            return $cart_id;
        }
    } 

    // Delete from cart table
    public function deleteCart($itemId = null, $table = 'cart') {

        if ($itemId != null) {

            $result = $this->cart_db->con->query("DELETE FROM {$table} WHERE item_id = {$itemId};");

            if ($result) {

                header("Location:" . $_SERVER['PHP_SELF']);
            }

            return $result;
        }
    }

    // Save for later. 
    // We will insert products into the wishlist table from cart table and delete it from cart table.
    // And we display it from the wishlist table.
    public function saveForLater($itemId = null, $saveTable = 'wishlist', $fromTable = 'cart') {
        
        if($itemId != null) {
            
            // This multiple query inside one :)
            $query  = "INSERT INTO {$saveTable} SELECT * FROM {$fromTable} WHERE item_id = {$itemId};";
            $query .= "DELETE FROM {$fromTable} WHERE item_id = {$itemId};";

            // Execute multiple query 
            $result = $this->cart_db->con->multi_query($query);
            
            if ($result) {

                header("Location:" . $_SERVER['PHP_SELF']);
            }   
            return $result;
        }

    }

    // Calculate sub total  
    public function calcuSubTotale($arry) {

        if (isset($arry)) {

            $sum = 0;

            foreach($arry as $item) {

                $sum += floatval($item[0]);    
            }

            return $sum;
        }
    }

}
