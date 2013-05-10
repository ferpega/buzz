$(document).ready(function(){

    $("#load_more").click(function(){
            var self = this;
            $(self).html("cargando...");
            $.get(window.ajax_url, {limit: 20, offset: $(".row.post").length }, function(data){
                if(data){
                    $("#post_list").append(data);
                    $(self).html("cargar más!");
                }else{
                    $(self).html("no hay más dude!");
                }

            });

    });

    $('#publish textarea').keydown(function(e) {
        if (e.keyCode == 13 && $(this).val()) {
            $('#publish').submit();
        }
    });



});
