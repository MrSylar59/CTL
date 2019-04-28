<? get_header() ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-3 d-none d-lg-block">
            <h5 class='text-center'>Liens utiles</h5>
            <? wp_nav_menu(['theme_location' => 'headerMenuLocation']) ?>
        </div>
        <div class="col-12 col-lg-9">
            <div class="bg-blue container">
            	<? if (is_user_logged_in()) {?>
	            	<h2 class="text-center">Mon espace Classe</h2>
	            	<h3 class="text-center">Mes Classes</h3>
					<?php
						$user = wp_get_current_user();
					    $user_roles = $user->roles;
						$categories = get_categories(['hide_empty' => 0]);
						if (in_array("administrator", $user_roles)) {
							foreach ( $categories as $category) {?>
								<div>
									<? $cat_id = $category->term_id;?>
									<a href="<?echo get_category_link($cat_id);?>"><?echo $category->name?></a>									
								</div><?
							}
						}else{
							$classe = get_user_meta($user->id, 'acces', false);
							foreach ($classe as $liste) {
								foreach ($liste as $slug) {
									echo $value;
									$category = get_category_by_slug($slug);?>
									<div>
										<? $cat_id = $category->term_id;?>
										La classe de <a href="<?echo get_category_link($cat_id);?>"><?echo $category->name?></a>									
									</div><?
								}
							}
							if (! in_array("professeur",$user_roles)) {?>
	            				<h3 class="text-center">Les notes</h3>
	            				Veuillez consultez les notes sur <a href="https://www.edumoov.com/">edumoov</a><?
							}
						}
					?>
				<? }else{?>
					Vous devez être connecté
				<?}?>
			</div>
		</div>
	</div>
</div>

<? get_footer() ?>