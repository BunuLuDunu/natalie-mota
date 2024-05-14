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

<?php wp_footer(); ?>

</body>

</html>