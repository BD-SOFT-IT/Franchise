$(function() {
    "use strict";
    let Page = (function() {
        let $navArrows = $( '#nav-arrows' ).hide(),
            $shadow = $( '#shadow' ).hide(),
            slicebox = $( '#sb-slider' ).slicebox( {
                onReady : function() {
                    $navArrows.show();
                    $shadow.show();
                },
                //perspective : 1200,
                orientation : 'r',
                cuboidsRandom : true,
                disperseFactor : 30,
                autoplay: true,
                interval: 3500,
            } ),
            init = function() {
                initEvents();
            },
            initEvents = function() {
                // add navigation events
                $navArrows.children( ':first' ).on( 'click', function() {
                    slicebox.next();
                    return false;
                } );
                $navArrows.children( ':last' ).on( 'click', function() {
                    slicebox.previous();
                    return false;
                } );
            };
        return { init : init };
    })();
    Page.init();

    // Index Tabbed Owl Carousel
    $('.index-tabbed-carousel.owl-carousel').owlCarousel({
        items: 4,
        loop: true,
        nav: true,
        slideTransition: 'ease-in-out',
        dots: false,
        navText: ['<i class="icon ion-ios-arrow-back" title="Previous"></i>','<i class="icon ion-ios-arrow-forward" title="Next"></i>'],
        autoplay: true,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive:{
            0:{ items:1 },
            576:{ items:2 },
            768:{ items:3 },
            992:{ items:4 },
        }
    });
});
