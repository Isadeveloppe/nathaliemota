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
        <button class="contactButton">Contact</button>


        <div class="thumbnail_container">
          <div class="current_thumbnail">
            <?php
            // Récupérer le post actuel, le post précédent et le post suivant
            $current_post = get_post();
            $prev_post = get_previous_post();
            $next_post = get_next_post();

            // Récupérer les URL des miniatures
            $current_thumbnail = $current_post ? get_the_post_thumbnail_url($current_post->ID, 'thumbnail') : '';
            $prev_thumbnail = $prev_post ? get_the_post_thumbnail_url($prev_post->ID, 'thumbnail') : '';
            $next_thumbnail = $next_post ? get_the_post_thumbnail_url($next_post->ID, 'thumbnail') : '';
            ?>

            <!-- Conteneur pour afficher la miniature actuelle -->
            <img id="displayed-thumbnail" src="<?php echo esc_url($current_thumbnail); ?>" alt="Current Thumbnail">

            <nav class="navigation_arrows">
              <?php if ($prev_post) : ?>
                <a href="#" class="prev-link" data-image="<?php echo esc_url($prev_thumbnail); ?>">←</a>
              <?php endif; ?>
              <?php if ($next_post) : ?>
                <a href="#" class="next-link" data-image="<?php echo esc_url($next_thumbnail); ?>">→</a>
              <?php endif; ?>
            </nav>

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