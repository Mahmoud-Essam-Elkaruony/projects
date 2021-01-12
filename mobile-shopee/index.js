// Mobile-Sale

$(document).ready(function(){

    // banner owl-carousel owlCarousel()
    $('#banner-area .owl-carousel').owlCarousel({

        dots: true,
        items: 1
    });

    // top-sale owlCarousel 
    $('#top-sale .owl-carousel').owlCarousel({

        loop: true,
        nav: true,
        dots: false,
        responsive:{
            0:{
                items: 1 // 0px = lass than 0px 1 items 
            },
            600:{
                items: 3
            },
            1000:{
                items: 5
            }
        }
    });

    // isotope filter
    var $grid = $('.grid').isotope({

        itemSelector: '.grid-item',
        layoutmethd: 'fitRows'
    });

    // filter items on button click
    $('.button-group').on("click", "button", function(){

        var filterValue = $(this).attr('data-filter');
        $grid.isotope({filter: filterValue});
    });

    // New Phone owl carousel 
    $('#new-phone .owl-carousel').owlCarousel({

        dots: true,
        nav: false,
        responsive:{
            0:{

                items: 1
            },
            600:{

                items: 3
            },
            1000:{

                items: 5
            }
        }
    });

    // Blaog owl carousel 
    $('#blogs .owl-carousel').owlCarousel({

        dots: false,
        loop: true,
        nav: false,
        responsive:{
            0:{

                items: 1
            },
            600:{

                items: 3
            }
        }
    });

    // Quantity product section in cart 
    let qty_up_button    = $('.qty .qty-up');
    let qty_down_button  = $('.qty .qty-down');
    // This is the span tag in <h5>
    let dael_price      = $('#deal-price');

    // Click on qty_up_button
    // Notice: When you click on this button you will get the item_id, 
    // Because of we use the [data-id="5"] in this button.
    qty_up_button.click(function(e){

        // input = data-id = '5' we use [data-id] to identify the item will increase its values
        // And which id you will use  
        // price = <span> tage it have the item_id
        let input = $(`.qty_input[data-id='${$(this).data("id")}']`);
        let price_span = $(`.product_price[data-id='${$(this).data("id")}']`);

        // Change product price useing ajax call
        // item_id_ajx -> this is variable to stored the data form the database by Ajax.php
        // And pass it to the result variable.
        // And when we choose the DATA ID we choose the column ID.
        /* 
            -- Note: The [result] variable it will stored all data from ajax object and return it like this:
            -- Because of that we can get all the data from database by useing its ID. 

            array(1) […]
                0: {…}
                ​​
                item_brand: "Redmi"
                ​​
                item_id: "5"
                ​​
                item_image: "./HTML_Tamplate/assets/products/5.png"
                ​​
                item_name: "Redmi Note 4"
                ​​
                item_price: "122.00"
                ​​
                item_register: "2020-03-28 11:08:57"

        */

        $.ajax({url:"./PHP_Tamplate/ajax.php", type:"post", data:{item_id_ajx:$(this).data('id')}, success:function(result){

            let myObj = JSON.parse(result); // stored all data and convert the string to object
            let item_price = myObj[0]['item_price'];

            if (input.val() >= 1 && input.val() <= 9) {

                input.val(function(i, oldvalue){

                    return ++oldvalue
                });

                price_span.text(parseInt(item_price * input.val()).toFixed(2));

                let subTotal = parseInt(dael_price.text()) + parseInt(item_price);
                dael_price.text(subTotal.toFixed(2));
            }

        }});

    });

    // Click on qty_done_button
    qty_down_button.click(function(e){

        let input = $(`.qty_input[data-id='${$(this).data('id')}']`);
        let price_span = $(`.product_price[data-id='${$(this).data('id')}']`);

        $.ajax({url:"./PHP_Tamplate/ajax.php", type:'post', data:{item_id_ajx:$(this).data('id')}, success:function(result){

            let my_object = JSON.parse(result);
            let item_price = my_object[0]['item_price'];

            if (input.val() > 1 && input.val() <= 10) {

                input.val(function(i, oldval){

                    return --oldval;
                });

                price_span.text(parseInt(item_price * input.val()).toFixed(2));

                let subTotal = parseInt(dael_price.text()) - parseInt(item_price);
                dael_price.text(subTotal.toFixed(2));
            }   

        }});
    });


    
    /*
        This code without Ajax
        ----------------------
        // Quantity product section 
        let qty_up      = $('.qty .qty-up');
        let qty_down    = $('.qty .qty-down');
        let qty_input   = $('.qty .qty_input');

        // Click qty up button 
        qty_up.click(function(e){

            if(qty_input.val() >= 1 && qty_input.val() <= 9) {

                qty_input.val(function(i, oldvalue){

                    return ++oldvalue;
                });
            }
        });

        // Click qty down button 
        qty_down.click(function(e){

            if (qty_input.val() > 1 && qty_input.val() <= 10) {

                qty_input.val(function(i, oldvalue){

                    return --oldvalue;
                });
            }
        });

    */

});