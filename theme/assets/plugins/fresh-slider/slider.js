require('./freshslider.1.0.0');

$(document).ready(function () {
    $("#priceRange").freshslider({
        range: true, // true or false
        step: 1,
        text: true,
        min: parseInt($('input[name=minP]').val()),
        max: parseInt($('input[name=maxP]').val()),
        unit: null, // the unit which slider is considering
        enabled: true, // true or false
        value: 10, // a number if unranged , or 2 elements array contains low and high value if ranged
        onchange:function(low, high) {
            $('input[name=minP]').val(low);
            $('input[name=maxP]').val(high);
            //$('#priceRangeFilter').attr('href', window.location.href)
        }
    });
});
