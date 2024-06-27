<?php
/*
  Template Name: Photographie
*/
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article class="post">

      <h1 class="title"><?php the_title(); ?></h1>

      <div class="container">

        <div>
          <ul class="list-container">
            <li>Référence:<?php $value = get_field("reference_photo");
                          if ($value) {
                            echo wp_kses_post($value);
                          } else {
                            echo 'empty';
                          }
                          ?>
            </li>

            <li>Catégorie:<?php $categories = get_the_terms(get_the_ID(), 'categorie_photo');
                          foreach ($categories as $categorie) {
                            echo $categorie->name;
                          }
                          ?>
            </li>

            <li>Format:<?php $formats = get_the_terms(get_the_ID(), 'format_photo');
                        foreach ($formats as $format) {
                          echo $format->name;
                        }
                        ?>
            </li>

            <li>Type: <?php echo get_field('type'); ?></li>

            <li>Année: <?php echo get_field('annee_photo'); ?></li>
          </ul>
        </div>

        <div class="imageContainer"><?php the_content(); ?></div>
      </div>

      <div class="infos">
        <p>Cette photo vous intéresse?</p>
        <button id="contactButton">Contact</button>


        <div class="carousel_container">
        
          <div class="carousel_track_container">
            <ul class="carousel-track">

            <?php
            $image_ids = array(91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106); 
            foreach ($image_ids as $index => $image_id) {
                $image_url = wp_get_attachment_url($image_id);
                if ($image_url) {
                    $current_class = ($index === 0) ? 'current-slide' : '';
                    echo '<li class="carousel-slide ' . $current_class . '"><img src="' . esc_url($image_url) . '" alt="Image ' . $image_id . '"></li>';
                }
            }
            ?>
            </ul>
    </div>
    <div class="carousel-buttons">
    <button class="carousel-button prev-button">&#10096;</button>
    <button class="carousel-button next-button">&#10097;</button>
    </div>
</div>


      </div>
      </div>
      </div>

      <p>Vous aimerez aussi</p><br>
      <div class="imagesContainer">
        <div class="cardsContainer">

          <?php

          $args = array(
            'post_type' => 'photographie',
            'posts_per_page' => 2,
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

        </div>

    <?php endwhile;
          endif ?>

      </div>

      <?php wp_reset_postdata(); ?>

    </article>

<?php endwhile;
endif; ?>
<?php get_footer() ?>