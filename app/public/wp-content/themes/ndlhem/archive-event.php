<? get_header() ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-3 d-none d-lg-block">
            <h5 class='text-center'>Liens utiles</h5>
            <? wp_nav_menu(['theme_location' => 'headerMenuLocation']) ?>
        </div>
        <div class="col-12 col-lg-9">
        <div class="bg-blue container">
            <div class="container text-center"><h2>Tous les événements à venir</h2></div>
            <hr>

            <? if (in_array('professeur', wp_get_current_user()->roles) || current_user_can('manage_options')) { ?>
                <div class="row">
                    <div class="col text-center">
                        <h4>Ajoutez un nouvel événement</h4>
                        <a class="btn btn-info m-4" href="<? echo admin_url('post-new.php?post_type=event') ?>">Créer un événement</a>
                        <hr>
                    </div>
                </div>
            <? } ?>

 <?php
    while(have_posts()){
        the_post();?>
                <div class="row">
                    <div class="col-2">
                        <a class="event-date" href="<? the_permalink() ?>">
                            <div>
                                <span class="event-month"><? echo date_i18n('M', strtotime(get_field('event_date')), true) ?></span>
                                <span class="event-day"><? echo date_i18n('d', strtotime(get_field('event_date')), true) ?></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-10">
                        <div class="text-center"><h4 class="event-title"><a href="<? the_permalink() ?>"><? the_title() ?></a></h4></div>
                        <p><? echo wp_trim_words(get_the_content(), 15) ?><a href="<? the_permalink() ?>">Lire la suite</a></p>
                    </div>
                </div>
            
    <?php
    }
    ?>
        </div>
    <div class="bg-blue container">
        <? echo paginate_links() ?>
        <hr>
        <p class="text-center">Envie de consulter nos anciens événements ? <a href="<? echo site_url('/anciens-evenements') ?>">Cliquez ici.</a></p>
    </div>
</div>

<? get_footer() ?>