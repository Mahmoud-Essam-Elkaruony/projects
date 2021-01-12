<?php 
    
    $item_id    = $_GET['item_id'] ?? 0;
    $item_data  = $product->getData();

    foreach($item_data as $item_pro): 
        if ($item_pro['item_id'] == $item_id):

    
?>

<!--Start product-->
<section id="product" class="py-3">
    <div class="container">
        <div class="row">

            <div class="col-sm-6">
                <img src="<?php echo $item_pro['item_image'] ?? 'assets/products/1.png';?>" alt="product1" class="img-fluid">
                <div class="form-row pt-4 font-size-16 font-baloo">
                    <div class="col">
                        <button type="submit" class="btn btn-danger form-control">Proded To Buy</button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-warning form-control">Add To Cart</button>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 py-5">
                <h5 class=" font-baloo font-size-20"><?php echo $item_pro['item_name'] ?? 'Samsung Galaxy S6 edge';?></h5>
                <small><?php echo $item_pro['item_brand'] ?? 'Brand';?></small>
                <div class="d-flex">
                    <div class="rating text-warning font-size-12">
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="far fa-star"></i></span>
                        <a href="#" class="px-2 font-raleway font-size-14">20.532 rating | 1000+ answered questions</a>
                    </div>
                </div>
                <hr class="m-0">

                <!--Start product price-->
                <table class="my-3">
                    <tr class="font-raleway font-size-14">
                        <td>M.R.P</td>
                        <td><strike>$160.00</strike></td>
                    </tr>
                    <tr class="font-raleway font-size-14">
                        <td>Deal Price</td>
                        <td class="font-size-20 text-danger">$<span><?php echo $item_pro['item_price'] ?? '1';?></span><small class="text-dark font-size-12">&nbsp;Inclusive of all taxes</small></td>
                    </tr>
                    <tr class="font-raleway font-size-14">
                        <td >You Save</td>
                        <td class="font-size-20 text-danger">$<span>10.00</span></td>
                    </tr>
                </table>
                <!--End product price-->

                <!--Start Policy-->
                <div class="policy">
                    <div class="d-flex">

                        <div class="return text-center mr-5">
                            <div class="font-size-20 my-2 color-second">
                                <span><i class="fas fa-retweet  border p-3 rounded-pill"></i></span>
                            </div>
                            <a href="#" class="font-raleway font-size-12">10 Days <br>Replacement</a>
                        </div>

                        <div class="return text-center mr-5">
                            <div class="font-size-20 my-2 color-second">
                                <span><i class="fas fa-truck border p-3"></i></span>
                            </div>
                            <a href="#" class="font-raleway font-size-12">TITO<br>Delivery</a>
                        </div>

                        <div class="return text-center mr-5">
                            <div class="font-size-20 my-2 color-second">
                                <span><i class="fas fa-check-double p-3"></i></span>
                            </div>
                            <a href="#" class="font-raleway font-size-12">1 Year<br>Warranty</a>
                        </div>

                    </div>
                </div>
                <!--End Policy-->
                <hr>

                <!--Start order detalis-->
                <div id="order-detalis" class="font-raleway d-flex flex-column text-dark">
                    <small>Delivery by: Mar 29 - Apr 1</small>
                    <small>Sold by <a href="#">TITO Electornics</a> (4.5 out of 5 | 18.189 rating)</small>
                    <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver To Customer - 424220</small>
                </div>
                <!--End order detalis-->

                <!--Start Colo and quantity -->
                <div class="row">

                    <div class="col-sm-6">
                        <!--Start Color-->
                        <div class="color my-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="font-baloo">color</h6>
                                <div class="p-2 color-primary-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                <div class="p-2 color-yellow-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                <div class="p-2 color-second-bg rounded-circle"><button class="btn font-size-14"></button></div>
                            </div>
                        </div>
                        <!--End Color-->
                    </div>

                    <div class="col-sm-6">
                        <!--Start product quantity-->
                            <div class="qty d-flex">
                                <h6 class="font-baloo">Qty</h6>
                                <div class="px-4 d-flex font-rale">
                                    <button class="qty-up border bg-light" data-id="<?php echo $item_pro['item_id'] ?? 0; ?>"><i class="fas fa-angle-up"></i></button>
                                    <input type="text" data-id="<?php echo $item_pro['item_id'] ?? 0; ?>" class="qty_input border px-2 w-50 bg-light" disabled value="1" placeholder="1">
                                    <button class="qty-down border bg-light" data-id="<?php echo $item_pro['item_id'] ?? 0; ?>"><i class="fas fa-angle-down"></i></button>
                                </div>
                            </div>
                        <!--Start product quantity -->
                    </div>
                </div>
                <!--End Colo and quantity -->

                <!--Start Size-->
                <div class="size my-3">
                    <h6 class="font-baloo">Size</h6> 
                    <div class="d-flex justify-content-between w-75">
                        <div class="font-rubik border p-2">
                            <button class="btn p-0 font-size-14">4GB RAM</button>
                        </div>
                        <div class="font-rubik border p-2">
                            <button class="btn p-0 font-size-14">6GB RAM</button>
                        </div>
                        <div class="font-rubik border p-2">
                            <button class="btn p-0 font-size-14">8GB RAM</button>
                        </div>
                    </div>
                </div>
                <!--End Size-->

            </div>

            <!--Start Product Description-->
            <div class="col-12">
                <h6 class="font-rubik">Product Description</h6>
                <hr>
                <p class="font-raleway font-size-14">
                    Having issue with my S6E, when charging its decreased but once I off it its continue charging and the battery drain fast. I change the battery the same thing. What could be the problem. 
                </p>
                <p class="font-raleway font-size-14">
                    Is there anyway to downgrade s6 edge from 7.0 to 6.0.1 i have the 925f version with firmware G925fxxu6erc1 country uk bacause after nougat update its lag the phone get hot when i'm using it and the icons are horrible some icons from grace ux an...
                </p>
            </div>
            <!--End Product Description-->                        

        </div>
    </div>
</section>
<!--End product-->

<?php 
    endif;
    endforeach;
?>  