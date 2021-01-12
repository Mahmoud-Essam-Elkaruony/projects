<?php 

// Notice: This file you have to call it in the header section.  

// Require MySQL Connection 
require("./database/connection_db.php");

// Require product class
require("./database/product.php");

// Require cart class
require("./database/cart.php");

// Require sein-logout class
require("./database/signin.php");

// -----------------------------------------------

// [Objects]

// DBconnection Object 
$con_db = new DBconnection();

// Product Object 
$product = new product($con_db);
$product_sh = $product->getData();

// Cart Object
$cart_db = new cart($con_db);

// Sein Object
$signin_db = new Signin($con_db);