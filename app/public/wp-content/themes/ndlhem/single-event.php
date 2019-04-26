<? get_header() ?>

 <?php
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
                                <h4>Options sur l'événement</h4>
                                <a class="btn btn-info m-4" href="<? echo get_edit_post_link() ?>">Modifier l'événement</a>
                                <a class="btn btn-danger" href="<? echo get_delete_post_link() ?>">Supprimer l'événement</a>
                                <hr>
                            </div>
                        </div>
                    <? } ?>
                    <div class="text-center">
                        <h2 class="pt-4 mb-3"><? the_title() ?></h2>
                        <p class="lead"><small style="font-weight:small;"><? echo date_i18n('j M Y', strtotime(get_field('event_date')), true) ?> - Posté par <? the_author() ?></small></p>
                    </div>

                    <? the_content() ?>

                    <hr>
                    <p class="text-center"><a href="<? echo get_post_type_archive_link('event') ?>">Retourner aux événements >></a></p>

                </div>
            </div>

    <?php
    }
    ?>

<? get_footer() ?>