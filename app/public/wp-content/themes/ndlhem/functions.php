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