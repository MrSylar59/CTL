<? get_header() ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-3 d-none d-lg-block">
            <h5 class='text-center'>Liens utiles</h5>
            <? wp_nav_menu(['theme_location' => 'headerMenuLocation']) ?>
        </div>
        <div class="col-12 col-lg-9">
        <div class="bg-blue container">
            <div class="container text-center"><h2>Toutes les circulaires</h2></div>
            <hr>
 <?php
    while(have_posts()){
        the_post();
        $file = get_field('circulaire_file')
        ?>
                <div class="row">
                    <div class="col">
                        <a class="event-date" href="<? echo $file['url'] ?>">
                            <span><? the_title(); echo ' (' . $file['filename'] . ')'  ?></span>
                        </a>
                    </div>
                </div>
            
    <?php
    }
    ?>
        </div>
    <div class="bg-blue container">
        <? echo paginate_links() ?>
    </div>
</div>

<? get_footer() ?>