<?php
/*
  Template Name: Contact
*/
get_header();
if (have_posts()) : while (have_posts()) : the_post();
?>
		<h1 class="novisible"><?php the_title(); ?></h1>
		<div class="content">
			<?php the_content(); ?>
					
		</div>
<?php
	endwhile;
endif;
get_footer();
?>