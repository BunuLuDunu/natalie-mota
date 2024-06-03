<?php

/**
 * The template for displaying all single photos
 */

// Récupérer la référence de la photo
$reference_photo = get_field('reference');
// Récupérer les catégories
$categories = get_the_terms(get_the_ID(), 'categorie');
// Récupérer les formats
$formats = get_the_terms(get_the_ID(), 'format');
// Récupérer le type
$type = get_field('type');
// Récupérer la date de prise de la photo
$annee = get_the_date('Y');
// Récupérer l'image mise en avant
$image = get_the_post_thumbnail();
// Récupérer la photo précédente
$prev_photo = get_previous_post();
// Récupérer la photo suivante
$next_photo = get_next_post();

get_header();

/* Début de la Loop */
while (have_posts()) :
	the_post();
?>

	<main>
		<section class="photo">
			<div class="photo-info-container">
				<div class="photo-info">
					<!-- Titre de la photo -->
					<h2><?php the_title(); ?></h2>
					<ul class="photo-description">
						<!-- Référence de la photo -->
						<li class="photo-description-item">Référence :
							<?php echo $reference_photo ?? 'Inconnue'; ?>
						</li>
						<!-- Catégorie de la photo -->
						<li class="photo-description-item">Catégorie :
							<?php
							if ($categories) {
								foreach ($categories as $category) {
									echo $category->name;
								}
							} else {
								echo 'Inconnue';
							}
							?>
						</li>
						<!-- Format de la photo -->
						<li class="photo-description-item">Format :
							<?php
							if ($formats) {
								foreach ($formats as $format) {
									echo $format->name;
								}
							} else {
								echo 'Inconnu';
							}
							?>
						</li>
						<!-- Type de la photo -->
						<li class="photo-description-item">Type :
							<?php echo $type ?? 'Inconnu'; ?>
						</li>
						<!-- Année de prise de la photo -->
						<li class="photo-description-item">Année :
							<?php echo $annee ?? 'Inconnue'; ?>
						</li>
					</ul>
				</div>
				<div class="photo-image">
					<!-- Affichage de la photo -->
					<?php echo $image ?? 'Indisponible'; ?>
				</div>
				<!-- Bouton de contact -->
				<div class="contact-info">
					<p>Cette photo vous intéresse ?</p>
					<button class="contact-btn button" data-reference="<?php echo $reference_photo; ?>">Contact</button>
				</div>
				<!-- Navigation photo précédente/suivante -->
				<div class="contact-nav">
					<div class="contact-nav-thumbnail">
						<?php if (!empty($prev_photo)) : ?>
							<img src="<?php echo get_the_post_thumbnail_url($prev_photo, 'thumbnail'); ?>" loading="lazy">
						<?php endif ?>
						<?php if (!empty($next_photo)) : ?>
							<img src="<?php echo get_the_post_thumbnail_url($next_photo, 'thumbnail'); ?>" loading="lazy">
						<?php endif ?>
					</div>
					<div class="contact-nav-arrows">
						<?php if (!empty($prev_photo)) : ?>
							<a href="<?php echo get_permalink($prev_photo); ?>">
								<svg width="26" height="8" viewBox="0 0 26 8" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M0.646447 3.64645C0.451184 3.84171 0.451184 4.15829 0.646447 4.35355L3.82843 7.53553C4.02369 7.7308 4.34027 7.7308 4.53553 7.53553C4.7308 7.34027 4.7308 7.02369 4.53553 6.82843L1.70711 4L4.53553 1.17157C4.7308 0.976308 4.7308 0.659725 4.53553 0.464463C4.34027 0.269201 4.02369 0.269201 3.82843 0.464463L0.646447 3.64645ZM1 4.5H26V3.5H1V4.5Z" fill="black" />
								</svg>
							</a>
						<?php endif ?>
						<?php if (!empty($next_photo)) : ?>
							<a href="<?php echo get_permalink($next_photo); ?>">
								<svg width="26" height="8" viewBox="0 0 26 8" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M25.3536 3.64645C25.5488 3.84171 25.5488 4.15829 25.3536 4.35355L22.1716 7.53553C21.9763 7.7308 21.6597 7.7308 21.4645 7.53553C21.2692 7.34027 21.2692 7.02369 21.4645 6.82843L24.2929 4L21.4645 1.17157C21.2692 0.976307 21.2692 0.659725 21.4645 0.464463C21.6597 0.269201 21.9763 0.269201 22.1716 0.464463L25.3536 3.64645ZM25 4.5H0V3.5H25V4.5Z" fill="black" />
								</svg>
							</a>
						<?php endif ?>
					</div>
				</div>
			</div>
		</section>
		<?php
		$query = new WP_Query([
			'post_type' => 'photo',
			'posts_per_page' => 2,
			'post__not_in' => [get_the_ID()],
			'tax_query' => [
				[
					'taxonomy' => 'categorie',
					'field' => 'term_id',
					'terms' => array_map(function ($category) {
						return $category->term_id;
					}, $categories)
				]
			]
		]);

		if ($query->have_posts()) :
		?>
			<section class="suggestions">
				<div class="suggestions-container">
					<h3 class="suggestions-title">Vous aimerez aussi</h3>
					<div class="suggestions-photos">
						<?php
						while ($query->have_posts()) :
							$query->the_post();
							get_template_part('template-parts/photo-card');
						endwhile;
						?>
					</div>
				</div>
			</section>
		<?php
		endif;
		?>
	</main>

<?php

endwhile; // Fin de la loop.

get_footer();
