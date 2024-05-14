<?php

add_action('wp_enqueue_scripts', 'mota_enqueue_scripts');
function mota_enqueue_scripts()
{
    wp_enqueue_style('mota-style', get_stylesheet_uri());
    wp_enqueue_script('mota-navigation', get_template_directory_uri() . './js/navigation.js', '', '', true);
}

// Menu de navigation
add_action('after_setup_theme', 'add_nav_menus');
function add_nav_menus()
{
    register_nav_menus(array(
        'primary_menu' => 'Menu Principal',
        'footer_menu' => 'Menu Footer',
    ));
}

// Custom Logo
add_theme_support('custom-logo');
