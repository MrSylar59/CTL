<? get_header() ?>


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
            <?php
                //autorisation d'acces
                $user = wp_get_current_user();
                $classe = get_user_meta($user->id, 'acces', false);
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
            <div class="bg-blue container">
            <?php 
                
            // ajouter la liste des enseignants de la classe ou des enfants
                
            ?>
            </div>
            <?php
                if (($autorisation && in_array("professeur", $user_roles)) || in_array("administrator", $user_roles)) {
                    //moyen de post
                    ?>
                    <div class="create-classe container bg-blue text-center">
                        <h2>Créer un Nouvel Article</h2>
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
                        <hr>
                    </div>

                    <?php
                }
            ?>
 <?php
    if ($autorisation || in_array("professeur",$user_roles) || in_array("administrator", $user_roles)) {
        while(have_posts()){
            the_post();?>

            <div class="bg-blue container">
                <div class="text-center">
                    <h2 class="pt-4 mb-3"><a href="<? the_permalink() ?>"><? the_title() ?></a></h2>

                <? echo wp_trim_words(get_the_content(), 25) ?><a href="<? the_permalink() ?>">Lire la suite</a>

                <hr>
            </div>

            <?php
        }
        echo paginate_links();
    }
    else{
        echo "<div class='bg-blue container text-center'> Vous n'avez pas les droits pour accéder à cette endroit ! </div>";
    }
    ?>
    
    

        </div>

<? get_footer() ?>