<?php
    ob_start();
    // include header.php file
    include("header.php");
?>

<?php

    //include _wishlist_template.php or _wishlist_notfound.php
    // the count() methosd check if there is products in wishlist table if there is,
    // It will include the _wishlist-template.php page if not it will include _wishlist_notfound.php page.
    count($product->getData('wishlist')) ? include("PHP_Tamplate/_wishlist-template.php") : include("PHP_Tamplate/notfound/_wishlist_notfound.php");

    //include _new-phone.php
    include("./PHP_Tamplate/_new-phone.php");


?>

<?php
    //include footer.php file
    include("footer.php");
?>