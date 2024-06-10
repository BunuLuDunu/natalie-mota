<?php

/**
 * The template for displaying the footer
 */

?>

<footer id="colophon" class="site-footer">
    <?php
    wp_nav_menu([
        'theme_location' => 'footer_menu'
    ]);
    ?>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php
// Appel de la modale de contact 
get_template_part("template-parts/contact");

// Appel de la lightbox
get_template_part("template-parts/lightbox");

?>

<?php wp_footer(); ?>

</body>

</html>