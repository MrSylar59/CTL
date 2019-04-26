
jQuery( document ).ready( function ( $ ) {
    $( '#new-article-classe-btn' ).on( 'click', function(e){
        var title = document.getElementById('new-article-classe-title').value;
        console.log(title);
        var content = document.getElementById('new-article-classe-content').value;
        console.log(content);
        var auteur = document.getElementById('new-article-classe-auteur').value;
        console.log(auteur);
        var cat = document.getElementById('new-article-classe-cat').value;
        console.log(cat);
        if (title != "" && content != "") {
            jQuery.ajax({url : ajaxurl,
                type : 'post',
                data : {
                    action : "add_classe_post",
                    post_author : auteur,
                    post_content: content,
                    post_title : title,
                    post_category : [cat]
                },
                success : function(oRep){
                    console.log(oRep);
                    repserv = JSON.parse(oRep);
                    console.log(repserv);
                    if (repserv.feedback = 'ok') {
                        document.location.reload();
                    }
                    else{
                        console.log("echec");
                    }
                }
            });
        }else{
            document.getElementById("alert-champ").style.display = 'block';
            setTimeout(function(){
                $("#alert-champ").hide('slow');
            }, 3000);
        }
    });
});
