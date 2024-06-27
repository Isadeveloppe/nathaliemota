<?php get_header(); ?>

<h1 class="novisible"><?php the_title(); ?></h1>

<?php

$args = array(
	'post_type' => 'photographie',
	'posts_per_page' => 1,
	'orderby' => 'rand',
);

$query = new WP_Query($args);

if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

		<a href="<?php echo esc_url(get_permalink()); ?>">
			<div class="photoContainer" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
				<h2 class="title1">Photographe Event</h2>
			</div>
		</a>


<?php endwhile;
endif ?>
<?php wp_reset_postdata(); ?>

<div class="l"></div>

<div>
	<span class="categories">Catégories</span>
	<span class="formats">Formats</span>
	<span class="trier">Trier par</span>
</div>

<div class="catalogue_photos"> <?php get_template_part('templates-parts/photo-block'); ?> </div>

<div class="lightbox">
	<button class="lightbox_close">Fermer</button>
	<button class="lightbox_next"><i class="fa-solid fa-chevron-right"></i></button>
	<button class="lightbox_prev"><i class="fa-solid fa-chevron-left"></i></button>
		<div class="lightbox_container"></div>
	<img src=<?php echo get_theme_file_uri() . '/assets/img/tortue.jpg'; ?>>
</div>


<?php get_footer(); ?>