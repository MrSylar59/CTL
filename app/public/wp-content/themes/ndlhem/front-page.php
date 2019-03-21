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
            <div class="col">
                <h5 class="text-center">Agenda du mois</h5>
                <!-- TODO: Implémenter l'agenda -->
            </div>
        </div>
    </div>
</div>

<? get_footer() ?>