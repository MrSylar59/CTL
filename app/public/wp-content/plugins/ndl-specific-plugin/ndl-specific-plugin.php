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
        'supports' => ['title', 'editor', 'excerpt']
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

add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if( is_category() ) {
    $post_type = get_query_var('post_type');
    if($post_type)
        $post_type = $post_type;
    else
        $post_type = array('nav_menu_item', 'post', 'classe'); // don't forget nav_menu_item to allow menus to work!
    $query->set('post_type',$post_type);
    return $query;
    }
}