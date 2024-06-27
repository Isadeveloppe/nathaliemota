<?php

$args = array(
  'post_type' => 'photographie',
  'posts_per_page' => 8,
  'tax_query' => [
    [
      'taxonomy' => 'categorie_photo',
      'field' => 'slug',
      'terms' => array('concert', 'mariage', 'reception', 'television'),

    ]
  ]
);

$query = new WP_Query($args);

if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

    <a href="<?php echo esc_url(get_permalink()); ?>">
      <div class="cardPhoto" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
    </a>


<?php endwhile;
endif ?>

<?php wp_reset_postdata(); ?>