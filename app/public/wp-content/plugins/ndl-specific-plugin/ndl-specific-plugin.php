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
}
add_action('init', 'ndl_post_types');

// Fonction qui permet de cacher l'admin bar pour les non-admins
function remove_admin_bar(){
    if (!current_user_can('administrator') && !is_admin())
        show_admin_bar(false);
}
add_action('after_setup_theme', 'remove_admin_bar');

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
    if (isset($_POST['save']) || isset($_POST['publish']))
        if (preg_match('/post=([0-9]*)/', $location, $match)){
            $pl = get_permalink($match[1]);
            if ($pl) wp_redirect($pl);
        }
    exit;
}
add_filter('redirect_post_location', 'ndl_on_post_redirect');

// Fonction qui redirige vers la corbeille une fois qu'un événement a été supprimé
function ndl_trash_redirect(){
    wp_redirect(home_url('/events/'));
    exit;
}
add_action('trashed_post', 'ndl_trash_redirect');