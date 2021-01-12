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


});