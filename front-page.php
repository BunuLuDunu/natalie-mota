<?php

/**
 * The main template file
 */

get_header();

while (have_posts()) :
    the_post();
?>

    <main>
        <?php get_template_part('template-parts/hero'); ?>
    </main>

<?php

endwhile;

get_footer();
