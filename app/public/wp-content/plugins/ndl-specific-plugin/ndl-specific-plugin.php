<?php
/*
    Plugin Name: NDL Specific Plugin (do not deactivate)
    Description: Plugin qui gère toutes les spécificités du site de l'école Notre Dame de Lourde Saint-Corneille. Ne pas désactiver
    Author: Thomas De Maen & Cyril Dumoulin
    Version: 1.0
*/

// Fonction qui défini tous les custom post types
function ndl_post_types(){
    // On enregsitre les événements :
    register_post_type('event', [
        'capability_type' => 'event',
        'map_meta_cap' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'has_archive' => true,
        'public' => true,

        'labels' => [
            'name' => 'Événements',
            'add_new_item' => 'Ajouter un événement',
            'edit_item' => 'Modifier événement',
            'all_items' => 'Tous les événements',
            'singular_name' => 'Événement'
        ],
        'rewrite' => [
            'slug' => 'events'
        ],
        'supports' => ['title', 'editor']
    ]);

    // On enregistre les circulaires
    register_post_type('circulaire', [
        'capability_type' => 'circulaire',
        'map_meta_cap' => true,
        'menu_icon' => 'dashicons-media-document',
        'has_archive' => true,
        'public' => true, 
        'exclude_from_search' => true,

        'labels' => [
            'name' => 'Circulaires',
            'add_new_item' => 'Ajouter une circulaire',
            'edit_item' => 'Modifier circulaire',
            'all_items' => 'Toutes les circulaires',
            'singular_name' => 'Circulaire'
        ],
        'rewrite' => [
            'slug' => 'circulaires'
        ],
        'taxonomies'  => array( 'category' ),
        'supports' => ['title', 'custom-fields']
    ]);
}
add_action('init', 'ndl_post_types');

// Fonction qui permet de cacher l'admin bar pour les non-admins
function remove_admin_bar(){
    if (!current_user_can('administrator') && !is_admin())
        show_admin_bar(false);
}
add_action('after_setup_theme', 'remove_admin_bar');

add_action('init','classe_post_types');

function classe_post_types(){
    register_post_type('classe',array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'public' => true,
        'labels' => array(
            'name' => 'Article Classe',
            'add_new_item' => 'Ajouter un nouvel Article Classe',
            'edit_item' => 'Editer Article Classe',
            'all_items' => 'Tout les Articles Classe',
            'singular_name' => 'Article Classe'     
        ),
        'menu_icon' => 'dashicons-welcome-learn-more',
        'taxonomies'  => array( 'category' )
    ));
}

add_filter('pre_get_posts', 'query_post_type_classe');
function query_post_type_classe($query) {
  if( is_category() ) {
    $post_type = get_query_var('post_type');
    if($post_type)
        $post_type = $post_type;
    else
        $post_type = array('nav_menu_item', 'post', 'classe', 'circulaire'); // don't forget nav_menu_item to allow menus to work!
    $query->set('post_type',$post_type);
    return $query;
    }
}

/*add_filter('pre_get_posts', 'query_post_type_circulaire');
function query_post_type_circulaire($query) {
  if( is_category() ) {
    $post_type = get_query_var('post_type');
    if($post_type)
        $post_type = $post_type;
    else
        $post_type = array('nav_menu_item', 'post', 'circulaire'); // don't forget nav_menu_item to allow menus to work!
    $query->set('post_type',$post_type);
    return $query;
    }
}*/

function add_js_scripts() {
    wp_enqueue_script( 'script', get_template_directory_uri().'/js/script.js', array('jquery'), '1.0', true );

    // pass Ajax Url to script.js
    wp_localize_script('script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
add_action('wp_enqueue_scripts', 'add_js_scripts');

add_action( 'wp_ajax_nopriv_add_classe_post', 'add_classe_post' ); //This action calls for non-authenticated users as well
add_action( 'wp_ajax_add_classe_post', 'add_classe_post' ); //This action calls only for authenticated user

function add_classe_post() {
    
    $post = array('post_author'=>$_POST['post_author'],'post_content'=>$_POST['post_content'],'post_title'=>$_POST['post_title'],'post_type'=>'classe','post_status'=>'publish','post_category'=>$_POST['post_category']);
    $reponse = wp_insert_post($post);
    if ($reponse == 0) {
        $data["feedback"] = "ko";
    }else{
        $data["feedback"] = "ok";
    }
    $data["post"] = $post;
    $data["reponse"] = $reponse;
    echo json_encode($data);
    die();
}

// Fonction qui redirige les admins vers le panel et les utilisateurs sur la front page
function ndl_login_redirect($redirect_to, $request, $user){
    if (isset($user->roles) && is_array($user->roles)){
        // On vérifie le rôle de l'utilisateur
        if (!in_array('administrator', $user->roles)){
            $redirect_to = home_url();
        }
    }

    return $redirect_to;
}
add_filter('login_redirect', 'ndl_login_redirect', 10, 3);

// Fonction qui s'assure de récupérer les événements en fonction de la date
function ndl_adjust_queries($query){
    $today = date('Ymd');

    if (!is_admin() && is_post_type_archive('event') && $query->is_main_query()) {
        $query->set('orderby', 'meta_value_num');
        $query->set('meta_key', 'event_date');
        $query->set('order', 'ASC');
        $query->set('meta_query', [[
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'numeric'
        ]]);
    }
}
add_action('pre_get_posts', 'ndl_adjust_queries');

// Fonction qui redirige les non-administrateurs vers le post qu'ils ont publié après publication
function ndl_on_post_redirect($location) {
    if (isset($_POST['save']) || isset($_POST['publish'])){
        if (preg_match('/post=([0-9]*)/', $location, $match)){

            if (in_array('administrator', wp_get_current_user()->roles)){
                wp_redirect(admin_url('/edit.php?post_type=' . get_post_type($match[1])));
                exit;
            }
            else {
                $pl = get_permalink($match[1]);
                if ($pl) {
                    wp_redirect($pl);
                    exit;
                }
            }
        }
    }
}
add_filter('redirect_post_location', 'ndl_on_post_redirect');

// Fonction qui redirige vers la corbeille une fois qu'un événement a été supprimé
function ndl_trash_redirect($post_id){
    if (in_array('administrator', wp_get_current_user()->roles))
        return;

    switch (get_post_type($post_id)){
        case 'event': 
            wp_redirect(home_url('/events/'));
        exit;
        default: break;
    }

    return;
}
add_action('trashed_post', 'ndl_trash_redirect');