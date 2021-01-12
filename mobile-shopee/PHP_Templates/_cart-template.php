<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Delete from cart table button
        if (isset($_POST['delete_item_cart'])) {

            $cart_db->deleteCart($_POST['cart_itemid']);
        }

        // Save for later button
        if (isset($_POST['save_later_submit'])) {

            $cart_db->saveForLater($_POST['item_save_later']);
        }   
    }

?>
<!--Start shopping cart section-->
<section id="cart" class="py-3">
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Shopping-Cart</h5>

        <!--shopping cart items-->
        <div class="row">
            <div class="col-sm-9">

                <?php
                    // getData() = It will get all products from the cart table 
                    // And we will use the column item_id to pass it to getProductId() method
                    // And getProductId() it will pass the value as associated array KEY and VALUE
                    // Like this Array ( [0] => Array ( [item_id] => 5 [item_brand] => Redmi [item_name] => Redmi Note 4 [item_price] => 122.00 [item_image] => ./HTML_Tamplate/assets/products/5.png [item_register] => 2020-03-28 11:08:57 ) ) 
                    // And we will use the variable $cart to stored the associated array
                    // And pass it to the array_map() and array_map will return it element by element  
                    foreach($product->getData('cart') as $cart_pro):
                        $cart = $product->getProductId($cart_pro['item_id']);
                        $subTotal[] = array_map(function($itemInCart){
                ?>     
                    <!--cart item1-->
                    <div class="row border-top py-3 mt-3">
                        <div class="col-sm-2">
                            <img src="<?php echo $itemInCart['item_image'] ?? './assets/products/1.png';?>" alt="cart" class="img-fluid">
                        </div>
                        <div class="col-sm-8">
                            <h5 class="font-baloo font-size-20"><?php echo $itemInCart['item_name'] ?? "Unknown";?></h5>
                            <small><?php echo $itemInCart['item_brand'] ?? 'Unknown' ;?></small>
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
                                    <button class="qty-up border bg-light" data-id="<?php echo $itemInCart['item_id'] ?? 0;?>"><i class="fas fa-angle-up"></i></button>
                                    <input type="text" data-id="<?php echo $itemInCart['item_id'] ?? 0;?>" class="qty_input border px-2 w-50 bg-light" disabled value="1" placeholder="1">
                                    <button class="qty-down border bg-light" data-id="<?php echo $itemInCart['item_id'] ?? 0;?>"><i class="fas fa-angle-down"></i></button>
                                </div>
                                <form method="post">
                                    <input  type="hidden" name="cart_itemid" value="<?php echo $itemInCart['item_id'] ?? 'There is no items to delete';?>">
                                    <button type="submit" name="delete_item_cart" class="btn font-baloo text-danger px-3 border-right ">Delete</button>
                                </form>
                                
                                <form method="post">
                                    <input type="hidden" name="item_save_later" value="<?php echo $itemInCart['item_id'] ?? 0;?>">
                                    <button type="submit" name="save_later_submit" class="btn font-baloo text-danger">Save For Latter</button>
                                </form>

                            </div>
                            <!--#Product quantity-->
                        </div>

                        <div class="col-sm-2 text-right">
                            <div class="font-size-20 text-dabger font-baloo">
                                $<span class="product_price" data-id="<?php echo $itemInCart['item_id'] ?? 0;?>"><?php echo $itemInCart['item_price'] ?? '0';?></span>
                            </div>
                        </div>
                        
                    </div>
                    <!--#cart item1-->

                <?php
                        return $itemInCart['item_price'];
                    }, $cart);
                    endforeach;
                ?>
            </div>

            <!--Subtotal section-->
            <div class="col-sm-3 d-flex h-50 px-50"> 
                <div class="sub-total border text-center mt-2"> 
                    <h6 class="font-size-12 font-raleway text-success py-3"><i class="fas fa-check">Your order is eligible for FREE Delivery</i></h6>
                    <div class="border-top py-4">
                        <h5 class="font-baloo font-size-20">Subtotal(<?php echo isset($subTotal) ? count($subTotal) : 0;?>item)&nbsp;<span class="text-danger">$</span><span class="text-danger" id="deal-price"><?php echo isset($subTotal) ? $cart_db->calcuSubTotale($subTotal) : 0;?></span></h5>                   
                        <button type="submit" class="btn btn-warning mt-3">Proceed To Buy</button>
                    </div>
                </div>
            </div>
            <!--#Subtotal section-->

        </div>
        <!--#shopping cart items-->
    </div>
</section>
<!--End shopping cart section-->