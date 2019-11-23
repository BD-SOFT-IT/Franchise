$("input[name = type_of_seller]").change(function(){
    var maxSelection = 1;
    if( $("input[name = type_of_seller]:checked").length == maxSelection ){
        $("input[name = type_of_seller]").attr('disabled', 'disabled');
        $("input[name = type_of_seller]:checked").removeAttr('disabled');
    }else{
        $("input[name = type_of_seller]").removeAttr('disabled');
    }
})
