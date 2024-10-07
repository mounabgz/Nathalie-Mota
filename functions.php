<?php

function nathalieMota_enqueue_styles() {
    wp_enqueue_style( 'nathalieMota-style', get_template_directory_uri() . '/style.css' ); 
    wp_enqueue_script( 'nathalieMota-scripts', get_template_directory_uri() . '/js/script.js', array(), null, true );
    wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'nathalieMota_enqueue_styles' );


function nathalieMota_support(){
    add_theme_support ('menus'); //Créer l'onget menu dans le back-office 
    add_theme_support ('custom-logo'); //Créer une zone pour ajouter le logo dans le customizer
    add_theme_support('post-thumbnails'); //Ajoute les sections "images mises en avant" dans les posts
    add_image_size( 'custom-thumbnail', 500, 500, true ); // Dimensions des vignettes
}
add_action ('after_setup_theme', 'nathalieMota_support', 'post-thumbnails', array('photo'), 'custom-thumbnail');

// MENU

function nathalieMota_menus() {
    register_nav_menus( array(
        'Header' => 'En tête du menu',
        'Footer' => 'Pied De Page',
    ) );
}
add_action('after_setup_theme','nathalieMota_menus');