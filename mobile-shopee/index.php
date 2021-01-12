<?php
    ob_start();
    // include header.php file
    include("header.php");
?>
<?php

    /*
        Here we call all pges we need to desplay 
    */
?>

<?php

    //include _banner-area.php 
    include("./PHP_Tamplate/_banner-area.php");

    //include _top_sale.php 
    include("./PHP_Tamplate/_top_sale.php");

    //include _top_sale.php 
    include("./PHP_Tamplate/_special-price.php");

    //include _banner-ads.php 
    include("./PHP_Tamplate/_banner-ads.php");

    //include _new-phone.php 
    include("./PHP_Tamplate/_new-phone.php");

    //include _blogs.php 
    include("./PHP_Tamplate/_blogs.php");


?>

<?php
    // include footer.php file
    include("footer.php");
?>