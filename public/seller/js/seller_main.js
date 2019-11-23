$("input[name=accountseller]").change(function(){
    var maxSelection = 1;
    if( $("input[name=accountseller]:checked").length == maxSelection ){
        $("input[name=accountseller]").attr('disabled', 'disabled');
        $("input[name=accountseller]:checked").removeAttr('disabled');
    }else{
        $("input[name=accountseller]").removeAttr('disabled');
    }
})
