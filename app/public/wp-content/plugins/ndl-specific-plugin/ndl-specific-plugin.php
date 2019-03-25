<?php
/*
    Plugin Name: NDL Specific Plugin (do not deactivate)
    Description: Plugin qui gère toutes les spécificités du site de l'école Notre Dame de Lourde Saint-Corneille. Ne pas désactiver
    Author: Thomas De Maen & Cyril Dumoulin
    Version: 1.0
*/

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