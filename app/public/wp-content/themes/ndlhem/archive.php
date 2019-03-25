<? get_header() ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-3 d-none d-lg-block">
            <h5 class='text-center'>Liens utiles</h5>
            <? wp_nav_menu(['theme_location' => 'headerMenuLocation']) ?>
        </div>
        <div class="col-12 col-lg-9">

 <?php
    while(have_posts()){
        the_post();?>

            <div class="bg-blue container">
                <div class="text-center"><h2 class="pt-4 mb-3"><a href="<? the_permalink() ?>"><? the_title() ?></a></h2></div>

                <? echo wp_trim_words(get_the_content(), 25) ?><a href="<? the_permalink() ?>">Lire la suite</a>

                <hr>
            </div>

    <?php
    }

    echo paginate_links();
    ?>

        </div>

<? get_footer() ?>