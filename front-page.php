<?php

/**
 * The front-page template file
 */

get_header();

while (have_posts()) :
    the_post();
?>

    <main>
        <!-- Hero header -->
        <?php get_template_part('template-parts/hero'); ?>

        <!-- Catalogue photo -->
        <section class="photo-list">
            <form action="<?php echo admin_url('admin-ajax.php'); ?>" class="photo-list-filters">
                <input type="hidden" name="action" value="load_more_photos">
                <input type="hidden" name="page" value="2">
            </form>
            <div class="photo-list-container">
                <?php
                $query = new WP_Query([
                    'post_type' => 'photo',
                    'post_per_page' => 8,
                ]);

                if ($query->have_posts()) :
                    while ($query->have_posts()) :
                        $query->the_post();
                        get_template_part('template-parts/photo-card');
                    endwhile;
                endif;
                ?>
            </div>
            <button class="load-more-btn button">Charger plus</button>
        </section>
    </main>

<?php

endwhile;

get_footer();
