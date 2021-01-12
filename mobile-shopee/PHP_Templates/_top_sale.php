<?php 
    /*
        %s?item_id=%s => product.php?item_id=$item_top['item_id']
    */

    shuffle($product_sh);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['top-sale-submit'])) {

            $cart_db->addToCart($_POST['item_id_por'], $_POST['item_user_por']);
        }
    }

?>

<!-- start Top Sale -->
<section id="top-sale">

    <div class="container py-5">
        <h4 class="font-rubik font-size-20">Top Sale</h4>
        <hr>
        <!-- stsrt owl carousel -->
        <div class="owl-carousel owl-theme">

        <?php foreach($product_sh as $item_top) { ?>
                     
                <div class="item py-2">
                    <div class="product font-rale">
                        <a href="<?php printf('%s?item_id=%s', 'product.php', $item_top['item_id']);?>"><img src=<?php echo $item_top['item_image'] ?? "./assets/products/1.png";?> alt="product1"></a>
                        <div class="text-center">
                            <h6><?php echo $item_top['item_name'] ?? "Unknown";?></h6>
                            <div class="rating text-warning font-size-12">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                            <div class="price py-2">
                                <span><?php echo $item_top['item_price'] ?? "0";?></span>
                            </div>
                            <form method="post">
                                <input type="hidden" name="item_id_por" value="<?php echo $item_top['item_id'] ?? "1";?>">
                                <input type="hidden" name="item_user_por" value="<?php echo $item_top['item_user'] ?? "1";?>">

                                <?php
                                
                                    // Here we will make search useing the in_array method
                                    // getData() -> It will get all data from the table 'cart'
                                    // gatCartId() -> It will get the column item_id 
                                    // If the item_id is in the cart table it will disabled the button add-to-cart 
                                    // If not eixst in the table cart it will enable the button add-to-cart
                                    
                                    // If there is no valus in the database it will send the warning message 
                                    // Becuase of that set the value as null arraty []

                                    if ( in_array($item_top['item_id'], $cart_db->getCartId($product->getData('cart')) ?? []) ) {
                                        
                                        echo '<button type="submit" disabled name="top-sale-submit" class="btn btn-success font-size-12">In_The_Cart</button>';

                                    } else {

                                        echo '<button type="submit" name="top-sale-submit" class="btn btn-warning font-size-12">Add To Cart</button>';
                                    }

                                ?>
                                
                            </form>
                           
                        </div>
                    </div>
                </div>
            <?php } ?>
            
        </div>
        <!-- end owl carousel -->
    </div>

</section> 
<!-- end Top Sale -->