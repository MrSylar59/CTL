<? get_header() ?>
<? include_once "data/fete/fete.php" ?>

<!-- Message d'accueil -->
<div class="mb-4">
    <div class="container-fluid">
        <div class="row d-none d-lg-flex">
            <div class="col-4 text-center p-0 p-md-3" id="date">
                <h6>Nous sommes le <? echo date_i18n('l j F Y') ?></h6>
                <h6>Nous fêtons les <? echo get_fete() ?></h6>
            </div>
            <div class="col-8 p-0 p-md-3">
                <h2 id="welcome" class="text-sm-center text-lg-left">Bienvenue sur le site de l'école Notre Dame de Lourdes Saint-Corneille</h2>
            </div>
        </div>
        <div class="row d-lg-none d-flex">
            <div class="col-12 p-0 p-md-3">
                <h2 id="welcome" class="text-sm-center text-lg-left">Bienvenue sur le site de l'école Notre Dame de Lourdes Saint-Corneille</h2>
            </div>
            <div class="col-12 text-center" style="padding-left:20px;padding-right:20px" id="date">
                <span style="text-align: left;padding-left: 20px;">
                    <h6>Nous sommes le <? echo date_i18n('l j F Y') ?></h6>
                    <h6>Nous fêtons les <? echo get_fete() ?></h6>
                </span>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col d-none d-lg-block">
                <h5 class='text-center'>Liens utiles</h5>
                <?php wp_nav_menu(['theme_location' => 'headerMenuLocation']) ?>
            </div>

            <!-- Le carousel -->
            <div class="col col-12 col-lg-6">
                <div class="carousel slide mb-sm-3" data-ride="carousel" id="carousel-1">
                    <div class="carousel-inner rounded" role="listbox">
                        <div class="carousel-item active">
                            <img class="w-100 d-block" src="<? echo get_theme_file_uri("/img/default-carousel/ecole.jpg") ?>" alt="L'école NDL">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 d-block" src="<? echo get_theme_file_uri("/img/default-carousel/promenade.png") ?>" alt="Les promenades familliales">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 d-block" src="<? echo get_theme_file_uri("/img/default-carousel/celebration.png") ?>" alt="La célébration de fin d'année">
                        </div>
                    </div>

                    <div>
                        <a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <ol class="carousel-indicators">
                        <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-1" data-slide-to="1"></li>
                        <li data-target="#carousel-1" data-slide-to="2"></li>
                    </ol>
                </div>
            </div>

            <!-- L'agenda -->
            <div class="col bg-blue">
                <h5 class="mb-4 text-center">Agenda des événements à venir</h5>
                <?php
                    $today = date('Ymd');
                    $events = new WP_Query([
                        'posts_per_page' => 3,
                        'post_type' => 'event',
                        'orderby' => 'meta_value_num',
                        'meta_key' => 'event_date',
                        'order' => 'ASC',
                        'meta_query' => [
                            [
                                'key' => 'event_date',
                                'compare' => '>=',
                                'value' => $today,
                                'type' => 'numeric'
                            ]
                        ]
                    ]);

                    while($events->have_posts()){
                        $events->the_post();
                        ?>
                        <div class="row">
                            <div class="col-12 col-md-2 col-lg-12 col-xl-2 p-xl-0">
                                <a class="event-date" href="<? the_permalink() ?>">
                                    <div>
                                        <span class="event-month"><? echo date_i18n('M', strtotime(get_field('event_date')), true) ?></span>
                                        <span class="event-day"><? echo date_i18n('d', strtotime(get_field('event_date')), true) ?></span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 col-md-10 col-lg-12 col-xl-10">
                                <h5 class="event-title"><a href="<? the_permalink() ?>"><? the_title() ?></a></h5>
                                <p><? echo wp_trim_words(get_the_content(), 15) ?><a href="<? the_permalink() ?>">Lire la suite</a></p>
                            </div>
                        </div>
                        <?php
                    }

                    wp_reset_postdata();
                ?>

                <div class="text-center"><a href="<? echo get_post_type_archive_link('event') ?>">Voir tous les événements</a></div>
            </div>
        </div>
    </div>
</div>

<? get_footer() ?>