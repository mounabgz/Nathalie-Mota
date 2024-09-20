<?php

function nathalieMota_enqueue_styles() {
    wp_enqueue_style( 'nathalieMota-style', get_template_directory_uri() . '/style.css' ); 
    wp_enqueue_script( 'nathalieMota-scripts', get_template_directory_uri() . '/js/script.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'nathalieMota_enqueue_styles' );


function nathalieMota_support(){
    add_theme_support ('menus');
    add_theme_support ('custom-logo');
}
add_action ('after_setup_theme', 'nathalieMota_support');

// MENU

function nathalieMota_menus() {
    register_nav_menus( array(
        'Header' => 'En tête du menu',
        'Footer' => 'Pied De Page',
    ) );
}
add_action('after_setup_theme','nathalieMota_menus');

