<? get_header() ?>

 <?php
    //autorisation d'acces
	if (is_user_logged_in()) {
	 	$user = wp_get_current_user();
	    $classe = get_user_meta($user->id, 'acces', false);
	    $categories = get_the_category();
	    $category = $categories[0]->slug;
	    if (is_array($classe[0])) {
	        $autorisation = in_array($category, $classe[0]);
	    }else{
	        if ($classe[0] == $category) {
	            $autorisation = true;
	        }else{
	            $autorisation = false;
	        }
	    }
    	$user_roles = $user->roles;
	    if ($autorisation || in_array("professeur",$user_roles) || in_array("administrator", $user_roles)) {
		    while(have_posts()){
		        the_post();?>

		    <div class="container-fluid">
		        <div class="row">
		            <div class="col-3 d-none d-lg-block">
		                <h5 class='text-center'>Liens utiles</h5>
		                <? wp_nav_menu(['theme_location' => 'headerMenuLocation']) ?>
		            </div>

		            <div class="col-12 col-lg-9">
		                <div class="bg-blue container">
		                	<? if (wp_get_current_user()->ID == get_post()->post_author || current_user_can('manage_options')) { ?>
		                        <div class="row">
		                            <div class="col text-center">
		                                <h4>Options sur l'article</h4>
		                                <a class="btn btn-info m-4" href="<? echo get_edit_post_link() ?>">Modifier</a>
		                                <a class="btn btn-danger" href="<? echo get_delete_post_link() ?>">Supprimer</a>
		                                <hr>
		                            </div>
		                        </div>
		                	<?php } ?>
		                    <div class="text-center"><h2 class="pt-4 mb-3"><? the_title() ?></h2></div>

		                    <? the_content() ?>

		                    <hr>
		                    <p class="text-center"><a href="<? echo get_category_link(get_post()->post_category[0]) ?>">Retourner au blog de classe >></a></p>

		                </div>
		            </div>

		    <?php
		    }
		}else{
			?>
			<div class="container-fluid">
		        <div class="row">
		            <div class="col-3 d-none d-lg-block">
		                <h5 class='text-center'>Liens utiles</h5>
		                <? wp_nav_menu(['theme_location' => 'headerMenuLocation']) ?>
		            </div>

		            <div class="col-12 col-lg-9">
		                <div class="bg-blue container text-center">
		                	<h5>Vous n'avez pas le droit d'accéder à cette page</h5>
		                </div>
		        	</div>
		        </div>
		    </div>
		<?php
		}
	}else{
		?>
		<div class="container-fluid">
	        <div class="row">
	            <div class="col-3 d-none d-lg-block">
	                <h5 class='text-center'>Liens utiles</h5>
	                <? wp_nav_menu(['theme_location' => 'headerMenuLocation']) ?>
	            </div>

	            <div class="col-12 col-lg-9">
	                <div class="bg-blue container text-center">
	                	<h5>Vous n'avez pas le droit d'accéder à cette page</h5>
	                </div>
	        	</div>
	        </div>
	    </div>
	<?php
	}
    ?>

<? get_footer() ?>

