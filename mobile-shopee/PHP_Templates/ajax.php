<?php

// Requier MySql Connection 
require("../database/connection_db.php");

// Require products class
require("../database/product.php");

// Connection Object
$db_ajax = new  DBconnection();

// Products Object
$product_ajax = new Product($db_ajax);

// Here it will get all data frome the database and sand it to Index.js
if ($_POST['item_id_ajx']) {

    $result = $product_ajax->getProductId($_POST['item_id_ajx']);
    echo json_encode($result);
}