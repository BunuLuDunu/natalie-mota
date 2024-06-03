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
    // Script charger plus uniquement sur la front page
    if (is_front_page()) {
        wp_enqueue_script('mota-loadmore', get_template_directory_uri() . './js/loadmore.js', '', '', true);
    }
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

// Requête Ajax pour charger plus de posts
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

function load_more_photos()
{
    $page = $_POST['page'];

    $query = new WP_Query([
        'post_type' => 'photo',
        'post_per_page' => 8,
        'paged' => $page
    ]);

    ob_start();
    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
            get_template_part('template-parts/photo-card');
        endwhile;
    endif;
    $html = ob_get_clean();

    wp_send_json_success([
        'html' => $html,
        'is_last_page' => $query->max_num_pages == $page
    ]);
}
