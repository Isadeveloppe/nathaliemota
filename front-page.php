<?php get_header(); ?>

<h1 class="novisible"><?php the_title(); ?></h1>

<article>
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

<div class="selection">
    <?php 
    $categoriesList = get_terms(array(
        'taxonomy'   => 'categorie_photo',
        'hide_empty' => false,
    )); 
    $formatsList = get_terms(array(
        'taxonomy'   => 'format_photo',
        'hide_empty' => false,
    )); 
    $trierparsList = array(
        'asc' => 'à partir des plus anciennes',
        'desc' =>'à partir des plus récentes',
    )
   
    ?>

    <div class="taxo">
        <select class="filter" id="categorie">
            <option value="">CATÉGORIES</option>
            <?php foreach ($categoriesList as $categorie) {
                echo "<option value='" . $categorie->slug . "'>" . $categorie->name . "</option>";
            }
            ?>
        </select>

        <select class="filter" id="format">
            <option value="">FORMATS</option>
            <?php foreach ($formatsList as $format) {
                echo "<option value='" . $format->slug . "'>" . $format->name . "</option>";
            }
            ?>
        </select>
    </div>

    <div class="trier-par">
        <select class="filter" id="orderby">
            <option value="">TRIER PAR</option>
            <?php foreach ($trierparsList as $value =>$label) {
                echo "<option value='" . $value . "'>" . $label . "</option>";
            }
            ?>
        </select>
    </div>
</div>


<div class="catalogue-container">
<div class="catalogue_photos">
	<?php
	$args = array(
		'post_type' => 'photographie',
		'posts_per_page' => 8,
		'paged' => 1,
	);

	$query = new WP_Query($args);

	if ($query->have_posts()) :
		while ($query->have_posts()) : $query->the_post(); 
			get_template_part('templates-parts/photo-block'); 
		endwhile;
	endif;

	wp_reset_postdata();
	?>
</div>
</div>

<button id="load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">Charger plus</button

<?php get_footer(); ?>