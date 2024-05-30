<?php

/**
 * The template for the hero header
 */
?>

<section class="hero">
    <?php
    $query = new WP_Query([
        'post_type' => 'photo',
        'posts_per_page' => 1,
        'orderby' => 'rand'
    ]);

    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();

            $image = get_the_post_thumbnail_url();
    ?>
            <img src="<?php echo $image; ?>">
    <?php
        endwhile;
    endif;
    wp_reset_query();
    ?>
    <h1 class="hero-title"><?php the_title(); ?></h1>
</section>