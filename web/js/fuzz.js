$(document).ready(function(){

    $.get(template_url, function(template){


        var compiledTemplate = Mustache.compile(template);


        $("#load_more").click(function(){
            var self = this;
            $(self).html("cargando...");
            $.getJSON(window.ajax_url, {limit: 20, offset: $(".row.post").length }, function(data){
                if(data.length){


                    for(i in data){
                        var item = data[i];
                        $("#post_list").append(compiledTemplate({text: item.text, date: item.created_at}));
                    }
                    $(self).html("cargar más!");
                }else{
                    $(self).html("no hay más dude!");
                }

            });

        });


    });



});
