<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // button delete wishlist
        if (isset($_POST['delete_wishlist'])) {

            $cart_db->deleteCart($_POST['wishlist_pro'], 'wishlist');
        }

        // insert into cart button 
        if (isset($_POST['insert-to-cart'])) {

            $cart_db->saveForLater($_POST['add-to-cart-wish'], 'cart', 'wishlist');
        }
    }

?>
<!--Start wishlist section-->
<section id="cart" class="py-3">
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Wishlist</h5>

        <!--shopping cart items-->
        <div class="row">
            <div class="col-sm-9">

                <?php 

                    foreach($product->getData('wishlist') as $wishlist):
                        $wishlist_products = $product->getProductId($wishlist['item_id']);
                        array_map(function($wishlist_items){
                ?>     
                    <!--cart item1-->
                    <div class="row border-top py-3 mt-3">
                        <div class="col-sm-2">
                            <img src="<?php echo $wishlist_items['item_image'] ?? './assets/products/1.png';?>" alt="cart" class="img-fluid">
                        </div>
                        <div class="col-sm-8">
                            <h5 class="font-baloo font-size-20"><?php echo $wishlist_items['item_name'] ?? "Unknown";?></h5>
                            <small><?php echo $wishlist_items['item_brand'] ?? 'Unknown';?></small>
                            <!--Product rating-->
                            <div class="d-flex">
                                <div class="rating text-warning font-size-12">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                </div>
                            </div>
                            <a href="#" class="px-2 font-raleway font-size-14">20,544 rating</a>
                            <!--#Product rating-->
                            
                            <!--Product quantity-->
                            <div class="qty d-flex pt-2">
                                <div class="d-flex font-raleway w-25">
                                    <button class="qty-up border bg-light" data-id="<?php echo $wishlist_items['item_id'] ?? 0;?>"><i class="fas fa-angle-up"></i></button>
                                    <input type="text" data-id="<?php echo $wishlist_items['item_id'] ?? 0;?>" class="qty_input border px-2 w-50 bg-light" disabled value="1" placeholder="1">
                                    <button class="qty-down border bg-light" data-id="<?php echo $wishlist_items['item_id'] ?? 0;?>"><i class="fas fa-angle-down"></i></button>
                                </div>
                                <form method="post">
                                    <input type="hidden" name="wishlist_pro" value="<?php echo $wishlist_items['item_id'];?>">
                                    <button type="submit" name="delete_wishlist" class="btn font-baloo text-danger px-3 border-right">Delete</button>
                                </form>
                                <form method="post">
                                    <input type="hidden" name="add-to-cart-wish" value="<?php echo $wishlist_items['item_id'];?>"> 
                                    <button type="submit" name="insert-to-cart" class="btn font-baloo text-danger">Add to cart</button>
                                </form>
                            </div>
                            <!--#Product quantity-->
                        </div>

                        <div class="col-sm-2 text-right">
                            <div class="font-size-20 text-dabger font-baloo">
                                $<span class="product_price" data-id="<?php echo $wishlist_items['item_id'];?>"><?php echo $wishlist_items['item_price'] ?? 0;?></span>
                            </div>
                        </div>
                        
                    </div>
                    <!--#cart item1-->
                
                <?php 
                    }, $wishlist_products);
                    endforeach;
                ?>

            </div>

        </div>
        <!--#shopping cart items-->
    </div>
</section>
<!--End wishlist section section-->