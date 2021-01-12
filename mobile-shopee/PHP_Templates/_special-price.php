<?php 

    // Here we will get all product and pass it to $brand
    $brand = array_map(function($pro){ 

        return $pro['item_brand'];

    }, $product_sh);

    $unique = array_unique($brand);  
    sort($unique); 
    shuffle($product_sh);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['btn_submit_special_price'])) {

            $cart_db->addToCart($_POST['special_price_itemid'], $_POST['special_price_userid']);
        }
    }

    // Pass to the array_map
    $inCart = $cart_db->getCartId($product->getData('cart'));
    
?>


<!--start special price-->
<section id="special-price">  
    <div class="container">

        <h6 class="font-rubik font-size-20">Special Price</h6>
        <div id="filters" class="button-group text-right font-baloo font-size-16">
            <button class="btn is-checked" data-filter="*">All-Brand</button>
            <?php
            
                array_map(function($brand_class){

                    printf("<button class='btn' data-filter='.%s'>%s</button>", $brand_class, $brand_class);

                }, $unique);

            ?>
            
        </div>

        <div class="grid">
            <!-- array_map -> return $product_shuffle as an array and pass it to parm $itme -->
            <?php array_map(function($special_pro) use($inCart){ ?>

                <div class="grid-item border <?php echo $special_pro['item_brand'] ?? 'Brand';?>">
                    <div class="item py-2" style="width: 200px;">
                        <div class="product font-raleway">
                            <a href="<?php printf('%s?item_id=%s', 'product.php', $special_pro['item_id']); ?>"><img src="<?php echo $special_pro['item_image'] ?? 'assets/products/13.png';?>" alt="product11" style="width: 200px;"></a>
                            <div class="text-center">
                                <h6><?php echo $special_pro['item_name'] ?? 'Apple'; ?></h6>
                                <div class="rating text-warning font-size-12">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                </div>
                                <div class="price py-2">
                                    <span>$<?php echo $special_pro['item_price'] ?? '0';?></span>
                                </div>
                                <form method="post">
                                    <input  type="hidden" name="special_price_itemid" value="<?php echo $special_pro['item_id'];?>">
                                    <input  type="hidden" name="special_price_userid" value="<?php echo $special_pro['user_id'] ?? '1';?>">
                                    <?php
                                        // Here we will disblay one buttom from thoes button 
                                        // If there is no valus in the database it will send the warning message 
                                        // Becuase of that set the value as null arraty []
                                        if ( in_array($special_pro['item_id'], $inCart ?? []) ) {

                                            echo '<button type="submit" disabled name="btn_submit_special_price" class="btn btn-success font-size-12">In_the_Cart</button>';

                                        } else {

                                            echo '<button type="submit" name="btn_submit_special_price" class="btn btn-warning font-size-12">Add To Cart</button>';
                                        }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php }, $product_sh);?>

        </div>

    </div>
</section>
<!--end special price-->