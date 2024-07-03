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

<!-- SELECTION-->
<?php $categoriesList = get_terms(array(
	'taxonomy'   => 'categorie_photo',
	'hide_empty' => false,
)); ?>

<?php $formatsList = get_terms(array(
	'taxonomy'   => 'format_photo',
	'hide_empty' => false,
)); ?>

<?php $trierparsList = get_terms(array(
	'taxonomy' => 'tri_photo',
	'hide_empty' => false,
)); ?>

<div class="filters">
	<select name="" id="categorie">
		<option value="">Catégorie</option>
		<?php foreach ($categoriesList as $categorie) {
			echo "<option value='" . $categorie->slug . "'>" . $categorie->name . "</option>";
		}

		?>
	</select>
</div>


<select name="" id="format">
	<option value="">Format</option>
	<?php foreach ($formatsList as $format) {
		echo "<option value='" . $format->slug . "'>" . $format->name . "</option>";
	}

	?>
</select>

<select name="" id="trier par">
	<option value="">Trier par</option>
	<?php foreach ($trierparsList as $trierpar) {
		echo "<option value='" . $trierpar->slug . "'>" . $trierpar->name . "</option>";
	}

	?>
</select>



<div class="catalogue_photos"> <?php get_template_part('templates-parts/photo-block'); ?> </div>

<!-- LIGHTBOX -->
<div class="lightbox">
	<button class="lightbox_close"><i class="fa-solid fa-xmark"></i></button>
	<button class="lightbox_prev"><i class="fa-solid fa-arrow-left"></i></button>
	<button class="lightbox_next"><i class="fa-solid fa-arrow-right"></i></button>

	<div class="lightbox_container"></div>
	<img class="photo" src=<?php echo get_theme_file_uri() . '/assets/img/nathalie-15.jpeg.webp'; ?>>

	<!-- Image | Information de la Photo -->
	<img src="" class="middle-image" />
	<div class="info-photo">
		<span id="modal-reference"></span>
		<span id="modal-category"></span>
	</div>
</div>
</div>
</div>







<?php get_footer(); ?>