<?php

add_action('wp_enqueue_scripts', 'mota_enqueue_scripts');
function mota_enqueue_scripts()
{
    wp_enqueue_style('mota-style', get_stylesheet_uri());
    // Script menu de navigation
    wp_enqueue_script('mota-navigation', get_template_directory_uri() . './js/navigation.js', '', '', true);
    // Script modale de contact seulement sur la page single-photo
    if (is_singular('photo')) {
        wp_enqueue_script('mota-contact', get_template_directory_uri() . './js/contact.js', '', '', true);
    }
    // Script lightbox photo
    wp_enqueue_script('mota-lightbox', get_template_directory_uri() . './js/lightbox.js', '', '', true);
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

// Images mises en avant
add_theme_support('post-thumbnails');
