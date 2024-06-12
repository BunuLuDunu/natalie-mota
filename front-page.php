<?php

/**
 * The front-page template file
 */

// Récupérer les categories
$categories = get_terms('categorie');
// Récupérer les formats
$formats = get_terms('format');

get_header();

while (have_posts()) :
    the_post();
?>

    <main>
        <!-- Hero header -->
        <?php get_template_part('template-parts/hero'); ?>

        <!-- Catalogue photo -->
        <section class="photo-list">
            <form id="filters" data-page="2" action="<?php echo admin_url('admin-ajax.php'); ?>" class="photo-list-filters">
                <!-- Inputs pour le bouton charger plus -->
                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('filter_photos'); ?>">
                <input type="hidden" name="action" value="filter_photos">

                <!-- Filtres et tri -->
                <!-- Filtre par catégorie -->
                <select name="categorie" id="categories" aria-label="Catégories">
                    <option value="">Catégories</option>
                    <?php
                    if ($categories) {
                        foreach ($categories as $category) {
                            echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
                        }
                    }
                    ?>
                </select>
                <!-- Filtre par format -->
                <select name="format" id="formats" aria-label="Formats">
                    <option value="">Formats</option>
                    <?php
                    if ($formats) {
                        foreach ($formats as $format) {
                            echo '<option value="' . $format->slug . '">' . $format->name . '</option>';
                        }
                    }
                    ?>
                </select>
                <!-- Filtre par date -->
                <select name="tri" id="dates" aria-label="Trier par">
                    <option value="">Trier par</option>
                    <option value="desc">A partir des plus récentes</option>
                    <option value="asc">A partir des plus anciennes</option>
                </select>
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
            <button type="submit" form="filters" class="load-more-btn button">Charger plus</button>
        </section>
    </main>

<?php

endwhile;

get_footer();
