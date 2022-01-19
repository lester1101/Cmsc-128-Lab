const responsive = {    //this is for the width of the page, if ever it is 0 and 320, it will give 1 item
    0: {                //if it is in 560 it will give two items 
        items: 1        //if it is in 960 it will give 3 items
    },  
    320: {
        items: 1
    },
    560: {
        items: 2
    },
    960: {
        items: 3
    }
}

$(document).ready(function () {

    $nav = $('.nav');

    // owl-crousel for the page content
    $('.owl-carousel').owlCarousel({
        loop: true,
        autoplay: false,
        autoplayTimeout: 3000,
        dots: false,
        nav: true,
        navText: [$('.owl-navigation .owl-nav-prev'), $('.owl-navigation .owl-nav-next')],
        responsive: responsive
    });


    // giving function to the upward button
    $('.move-up span').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    })

    // Action on scroll instance
    AOS.init();

});