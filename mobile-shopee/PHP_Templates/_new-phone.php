<?php

    shuffle($product_sh);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['btn_submit_new_phone'])) {

            $cart_db->addToCart($_POST['new_phone_itemid'], $_POST['new_phone_userid']);
        }
    }

    $inCart = $cart_db->getCartId($product->getData('cart'));
?>

<!--Start new phone section-->
<section id="new-phone">
    <div class="container">
        <h6 class="font-rubik font-size-20">New Phone</h6>
        <!--Start owl carousel-->
        <div class="owl-carousel owl-theme">

            <?php foreach($product_sh as $newPro){ ?>

                <div class="item py-2 bg-light">
                    <div class="product font-raleway">
                        <a href="<?php printf("%s?item_id=%s", 'product.php', $newPro['item_id']);?>"><img src="<?php echo $newPro['item_image'] ?? './assets/products/1.png';?>" alt="product1"></a>
                        <div class="text-center">
                            <h6><?php echo $newPro['item_name'] ?? 'Unknown';?></h6>
                            <div class="rating text-warning font-size-12">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                            <div class="price py-2">
                                <span>$<?php echo $newPro['item_price'] ?? "0";?></span>
                            </div>
                            <form method="post">
                                <input type="hidden" name="new_phone_itemid" value="<?php echo $newPro['item_id'];?>">
                                <input type="hidden" name="new_phone_userid" value="<?php echo $newPor['user_id'] ?? '2';?>">
                                <?php
                                    // If there is no valus in the database it will send the warning message 
                                    // Becuase of that set the value as null arraty []
                                    if ( in_array($newPro['item_id'], $cart_db->getCartId($product->getData('cart')) ?? []) ) {

                                        echo '<button type="submit" disabled name="btn_submit_new_phone" class="btn btn-success font-size-12">In_The_Cart</button>';

                                    } else {

                                        echo '<button type="submit"  name="btn_submit_new_phone" class="btn btn-warning font-size-12">Add To Cart</button>';
                                    }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
        <!--End owl carousel-->

    </div>
</section>
<!--End new phone section-->