<?php
    ob_start();
    // include header.php file
    include("header.php");
?>

<?php
    //include _cart-template or _cart_notfound.php
    // the count() methosd check if there is products in cart table if there is,
    // It will include the _cart-template.php page if not it will include _cart_notfound.php page
    count($product->getData("cart")) ? include("./PHP_Tamplate/_cart-template.php") : include("PHP_Tamplate/notfound/_cart_notfound.php");

    //include _new-phone.php
    include("./PHP_Tamplate/_new-phone.php");

?>

<?php
    //include footer.php file
    include("footer.php");
?>