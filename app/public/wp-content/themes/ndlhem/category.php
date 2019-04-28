<? get_header() ?>

<script type="text/javascript">
    jQuery( document ).ready( function ( $ ) {
        $( '#articles_btn' ).on( 'click', function(){
            document.getElementById('post_classe').style.display = "block";
            document.getElementById('post_circulaire').style.display = "none";
            document.getElementById('circulaires_btn').classList.remove('active');

        })
        $( '#circulaires_btn' ).on( 'click', function(){
            document.getElementById('post_classe').style.display = "none";
            document.getElementById('post_circulaire').style.display = "block";
            document.getElementById('articles_btn').classList.remove('active');
        })
    })
</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-3 d-none d-lg-block">
            <h5 class='text-center'>Liens utiles</h5>
            <? wp_nav_menu(['theme_location' => 'headerMenuLocation']) ?>
        </div>
        <div class="col-12 col-lg-9">
            <div class="bg-blue container">
                <h2 class="text-center">Classe de <?php echo single_cat_title();?></h2>
            </div>
            <div class="bg-blue container">
                <div class="btn-group btn-group-toggle" data-toggle="buttons" style="width: 100%">
                    <button class="btn btn-info" id="articles_btn" style="width: 50%">Articles</button>
                    <button class="btn btn-info" id="circulaires_btn" style="width: 50%">Circulaires</button> 
                </div>
            </div>
            <?php
                //autorisation d'acces
                $user = wp_get_current_user();
                $classe = get_user_meta($user->id, 'access', false);
                $categories = $wp_query->get_queried_object();
                if (is_array($classe[0])) {
                    $autorisation = in_array($categories->slug, $classe[0]);
                }else{
                    if ($classe[0] == $categories->slug) {
                        $autorisation = true;
                    }else{
                        $autorisation = false;
                    }
                }
                $user_roles = $user->roles;
                $cat = get_cat_ID($categories->slug);
            ?>
            <div id="post_classe">
                <div class="bg-blue text-center">
                    <h2 class="center">Les Articles</h2>
                </div>
            <?php
                if (($autorisation && in_array("professeur", $user_roles)) || in_array("administrator", $user_roles)) {
                    //moyen de post
                    ?>
                    <div class="create-classe container bg-blue text-center">
                        <hr>
                        <h4>Créer un Nouvel Article</h4>
                        <div class='row'>
                            <input id='new-article-classe-title' class="form-control" placeholder="Titre" style="margin-left: 15px; margin-right: 15px;">
                        </div>
                        <div class="row">
                            <textarea id='new-article-classe-content' class="form-control" placeholder="Votre article" style="margin-left: 15px; margin-right: 15px; height: 150px"></textarea>
                        </div>
                        <input type="hidden" id="new-article-classe-auteur" value="<?php echo $user->id; ?>">
                        <input type="hidden" id="new-article-classe-cat" value="<?php  echo $cat; ?>">
                        <button class="btn btn-info" id="new-article-classe-btn" style="margin-top: 10px;">Créer l'Article</button>
                        <div class="alert alert-warning" id="alert-champ" role="alert" style="display: none; margin-top: 15px;">
                          Attention tous les champs sont requis !!!
                        </div>
                    </div>

                    <?php
                }
            ?>
 <?php
    if ($autorisation || in_array("professeur",$user_roles) || in_array("administrator", $user_roles)) {
        while(have_posts()){
            the_post();?>

            <?if( get_post_type(get_post()) == "classe" ){ 
                                                                //in_array(get_post_type(get_post()),array("classe","circulaire") )s
                ?>
                
                <div class="bg-blue container">
                    <hr>
                    <div class="text-center">
                        <h2 class="pt-4 mb-3"><a href="<? the_permalink() ?>"><? the_title() ?></a></h2>

                        <? echo wp_trim_words(get_the_content(), 25) ?><a href="<? the_permalink() ?>"> Lire la suite</a>

                    </div>
                </div>

            <?php
            }
        }?>
        </div>
        <?/*
        <div id="post_gallery" style="display: none">
            <div class="bg-blue text-center"><h2 class="center">Les Galeries Photos</h2></div>
            <?php
            if (($autorisation && in_array("professeur", $user_roles)) || in_array("administrator", $user_roles)) {?>
                <div class="bg-blue container">
                    <hr>
                    <div class="col text-center">
                        <a class="btn btn-info m-4" href="<? echo admin_url('post-new.php?post_type=foogallery') ?>">Créer une Galerie photo</a>
                    </div>
                </div>
                <?
            }?>
        <?
        while(have_posts()){
            the_post();?>

            <?if( get_post_type(get_post()) == "foogallery" ){ ?>
                
                <div class="bg-blue container">
                    <hr>
                    <div class="text-center">                     
                        <div>
                            <? if( wp_get_current_user()->ID == get_post()->post_author || current_user_can('manage_options')){ ?>
                            <a class="btn btn-danger" href="<? echo get_delete_post_link(get_post()->ID) ?>">Supprimer</a>
                                        <a class="btn btn-info m-4" href="<? echo get_edit_post_link(get_post()->ID) ?>">Modifier</a>
                            <?}?>
                        </div>
                        <h2 class="pt-4 mb-3"><a href="<?php the_permalink() ?>"><? the_title() ?></a></h2>
                            <?
                            $shortcode = '[foogallery id="'.get_post()->ID.'"]';
                            echo do_shortcode($shortcode);?>
                    </div>
                </div>

            <?php
            }
        }
        echo paginate_links();
        ?>
        </div>*/?>
        <div id="post_circulaire" style="display: none">
            <div class="bg-blue text-center">
                <h2>Les Circulaires</h2>
            </div>
            <?php
            if (($autorisation && in_array("professeur", $user_roles)) || in_array("administrator", $user_roles)) {?>
                <div class="bg-blue container">
                    <hr>
                    <div class="col text-center">
                        <a class="btn btn-info m-4" href="<? echo admin_url('post-new.php?post_type=circulaire') ?>">Ajouter une Circulaire</a>
                    </div>
                </div>
                <?
            }?>
        <?
        while(have_posts()){
            the_post();?>

            <?if( get_post_type(get_post()) == "circulaire" ){ ?>
                
                <div class="bg-blue container circulaire">
                    <hr>
                    <div class="text-center">
                        <? $file = get_field('circulaire');
                        $url = wp_get_attachment_url( $file );
                        $filename = basename ( get_attached_file( $file ) ); ?>                       
                        <div>
                            <? if( wp_get_current_user()->ID == get_post()->post_author || current_user_can('manage_options')){ ?>
                            <a class="btn btn-danger" href="<? echo get_delete_post_link(get_post()->ID) ?>">Supprimer</a>
                                        <a class="btn btn-info m-4" href="<? echo get_edit_post_link(get_post()->ID) ?>">Modifier</a>
                            <?}?>
                        </div>
                        <h2 class="pt-4 mb-3"><a href="<?php echo $url; ?>"><? the_title() ?></a>

                        </h2>
                        <? echo $filename ?>
                        <a href="<?php echo $url; ?>" download><span class="dashicons dashicons-download"></span></a>
                        
                    </div>
                </div>

            <?php
            }
        }
        echo paginate_links();
        ?>
        </div>
        <?
    }
    else{
        echo "<div class='bg-blue container text-center'> Vous n'avez pas les droits pour accéder à cette endroit ! </div>";
    }
    ?>
    
    

        </div>

<? get_footer() ?>