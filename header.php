<?php

/**
 * The header for our theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"></a>

        <header id="masthead" class="site-header">
            <nav id="site-navigation" class="main-navigation">
                <?php the_custom_logo(); ?>
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary_menu'
                ]);
                ?>

                <button class="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <div class="site-menu">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'primary_menu'
                    ]);
                    ?>
                </div>

            </nav><!-- #site-navigation -->
        </header><!-- #masthead -->