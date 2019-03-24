<!DOCTYPE html>
    <html lang="<? language_attributes() ?>">
    <head>
        <meta charset="<? bloginfo('charset') ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <? wp_head() ?>
    </head>

    <body <? body_class() ?>>
        <header>
            <nav class="navbar navbar-light navbar-expand-md text-black-50 navigation-clean-button pt-sm-0 pb-sm-0 mb-4 mb-sm-5">
                <div class="container">
                    <a class="navbar-brand" href="<? echo site_url() ?>">
                        <img src="<? echo get_theme_file_uri('/img/logo.png') ?>" class="img-fluid mr-1" style="width: 70px;height: auto;" alt="Logo NDL">
                        <? bloginfo('name') ?>
                    </a>
                    <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse text-right d-md-flex justify-content-md-end" id="navcol-1">
                        <span class="navbar-text actions"> 
                            <a href="/wp-register.php" class="login">Insciption</a>
                            <a class="btn btn-light action-button" role="button" href="/wp-login.php">Connexion</a>
                        </span>

                        <div class="d-block d-lg-none text-center" style="margin-bottom:5px;">
                            <? wp_nav_menu(['theme_location' => 'headerMenuLocation']) ?>
                        </div>

                    </div>
                </div>
            </nav>
        </header>