require('imports-loader?this=>window!./js/modernizr.custom.46884.js');
require('./js/jquery.slicebox');

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
});
