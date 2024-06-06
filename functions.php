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
        wp_enqueue_script('mota-filters', get_template_directory_uri() . './js/filters.js', '', '', true);
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

// Traitement de la requête Ajax pour charger plus de posts
add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');

function filter_photos()

{
    // Vérification de sécurité
    if (!isset($_REQUEST['nonce']) || !wp_verify_nonce($_REQUEST['nonce'], 'filter_photos')) {
        wp_send_json_error("Vous n'avez pas l'autorisation d'effectuer cette action.", 403);
    }

    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $args = [
        'post_type' => 'photo',
        'post_per_page' => 8,
        'paged' => $page,
        'tax_query' => [
            'relation' => 'AND'
        ]
    ];

    if (!empty($_POST['categorie'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $_POST['categorie']
        ];
    }

    if (!empty($_POST['format'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $_POST['format']
        ];
    }

    if (!empty($_POST['tri'])) {
        $args['order'] = $_POST['tri'];
    }

    $query = new WP_Query($args);

    ob_start(); // Temporisation de sortie
    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
            get_template_part('template-parts/photo-card');
        endwhile;
    endif;
    $html = ob_get_clean();  // Obtient le contenu du tempon de sortie actif et le désactive

    // Fonction qui envoie une réponse en json à la requête Ajax indiquant un succès
    wp_send_json_success([
        'query' => $query,
        'html' => $html,
        'is_last_page' => $query->max_num_pages == $page
    ]);
}
