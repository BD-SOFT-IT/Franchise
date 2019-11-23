$(function() {
    "use strict";

    // Toggle Category Menu in Small Device
    $('#sidebarContentTitle').click(function (e) {
        let dWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        if((window.location.pathname === '/' && dWidth < 992) || window.location.pathname !== '/') {
            let menu = $(this).next();
            menu.slideToggle("slow");
        }
    });

    // Toggle Category Menu Sub Items in Small Device
    $('.menu-toggler').click(function (e) {
        e.preventDefault();
        $(this).parent().next().slideToggle('slow');
        let icon = $(this).children().first();
        if(icon.hasClass('ion-ios-add')) {
            icon.removeClass('ion-ios-add').addClass('ion-ios-remove');
        }
        else if(icon.hasClass('ion-ios-remove')) {
            icon.removeClass('ion-ios-remove').addClass('ion-ios-add');
        }
    });

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

    // nice select
    $(document).ready(function() {
        $('select.niceSelect').niceSelect();
    });

    // Product Single ExZoom
    if($('#productSingleExZoom').length !== 0) {
        $("#productSingleExZoom").exzoom({
            // thumbnail nav options
            /*"navWidth": 60,
            "navHeight": 60,
            "navItemNum": 5,
            "navItemMargin": 7,
            "navBorder": 1,*/
            // autoplay
            "autoPlay": true,
            // autoplay interval in milliseconds
            "autoPlayTimeout": 2000
        });
    }

    $(document).ready(function () {
        if(window.location.href.indexOf("#accountWishlist") > -1) {
            $('#accountWishlist-tab').tab('show');
        }
        else if(window.location.href.indexOf("#accountOrders") > -1) {
            $('#accountOrders-tab').tab('show');
        }
        else if(window.location.href.indexOf("#accountProfile") > -1) {
            $('#accountProfile-tab').tab('show');
        }
        else if(window.location.href.indexOf("#accountSettings") > -1) {
            $('#accountSettings-tab').tab('show');
        }


        $('.product-sort-select .nice-select.niceSelect ul li').on('click', function() {
            $('input[name=sortBy]').val($(this).attr('data-value'));
            $('#filterForm').submit();
        });

        $('.product-pagination a.page-link').on('click', function(e) {
            e.preventDefault();
            $('input[name=page]').val($(this).attr('href').split('page=')[1]);
            $('#filterForm').submit();
        });

        $( "#toggleFilterProduct" ).click(function() {
            $('#shopSidebar').toggle();
        });
    });
});
