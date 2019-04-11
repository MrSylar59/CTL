<?php

function ndl_import_files(){
    // Import des styles
    wp_enqueue_style('ndl_bootstrap', get_theme_file_uri('/css/bootstrap.css'));
    wp_enqueue_style('ndl_main_style', get_stylesheet_uri());

    // Import des scripts
    wp_enqueue_script('ndl_bootstrapJS', get_theme_file_uri('/js/bootstrap.bundle.js'), ['jquery'], '4.0', true);
}
add_action('wp_enqueue_scripts', 'ndl_import_files');

function ndl_features(){
    add_theme_support('title-tag');
    // Pour créer des menus dynamiques avec wordpress
    register_nav_menu('headerMenuLocation', 'Menu de navigation principal');
}
add_action('after_setup_theme', 'ndl_features');

function ndl_login(){
    wp_enqueue_style('ndl_login_style', get_theme_file_uri('/css/login.css'));
}
add_action('login_enqueue_scripts', 'ndl_login');

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

// Fonction qui redirige les admins vers le panel et les utilisateurs sur la front page
function ndl_login_redirect($redirect_to, $request, $user){
    if (isset($user->roles) && is_array($user->roles)){
        // On vérifie le rôle de l'utilisateur
        if (in_array('subscriber', $user->roles)){
            $redirect_to = home_url();
        }
    }

    return $redirect_to;
}
add_filter('login_redirect', 'ndl_login_redirect', 10, 3);

