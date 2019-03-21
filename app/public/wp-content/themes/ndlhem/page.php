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
                    <div class="text-center"><h2 class="pt-4 mb-3"><? the_title() ?></h2></div>

                    <? the_content() ?>

                </div>
            </div>

    <?php
    }
    ?>

<? get_footer() ?>