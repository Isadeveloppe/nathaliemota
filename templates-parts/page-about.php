<?php
/*
  Template Name: A propos
*/
get_header();
if (have_posts()) : while (have_posts()) : the_post();
?>
		<h1 class="novisible"><?php the_title(); ?></h1>
		<div class="content">

<section class="container">
	<h2 class="title2">Lorem ipsum</h2>

<p class="lorem">Nunc velit augue, scelerisque dignissim, lobortis et, aliquam in, risus. In eu eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Curabitur vulputate elit viverra augue. Mauris fringilla, tortor sit amet malesuada mollis, sapien mi dapibus odio, ac imperdiet ligula enim eget nisl. Quisque vitae pede a pede aliquet suscipit. Phasellus tellus pede, viverra vestibulum, gravida id, laoreet in, justo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer commodo luctus lectus. Mauris justo. Duis varius eros. Sed quam. Cras lacus eros, rutrum eget, varius quis, convallis iaculis, velit. Mauris imperdiet, metus at tristique venenatis, purus neque pellentesque mauris, a ultrices elit lacus nec tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Praesent malesuada. Nam lacus lectus, auctor sit amet, malesuada vel, elementum eget, metus. Duis neque pede, facilisis eget, egestas elementum, nonummy id, neque.<br><br>

Quisque aliquam ipsum sed turpis. Pellentesque laoreet velit nec justo. Nam sed augue. Maecenas rutrum quam eu dolor. Fusce consectetuer. Proin tellus est, luctus vitae, molestie a, mattis et, mauris. Donec tempor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis ante felis, dignissim id, blandit in, suscipit vel, dolor. Pellentesque tincidunt cursus felis. Proin rhoncus semper nulla. Ut et est. Vivamus ipsum erat, gravida in, venenatis ac, fringilla in, quam. Nunc ac augue. Fusce pede erat, ultrices non, consequat et, semper sit amet, urna.<br><br>

Phasellus vestibulum orci vel mauris. Fusce quam leo, adipiscing ac, pulvinar eget, molestie sit amet, erat. Sed diam. Suspendisse eros leo, tempus eget, dapibus sit amet, tempus eu, arcu. Vestibulum wisi metus, dapibus vel, luctus sit amet, condimentum quis, leo. Suspendisse molestie. Duis in ante. Ut sodales sem sit amet mauris. Suspendisse ornare pretium orci. Fusce tristique enim eget mi. Vestibulum eros elit, gravida ac, pharetra sed, lobortis in, massa. Proin at dolor. Duis accumsan accumsan pede. Nullam blandit elit in magna lacinia hendrerit. Ut nonummy luctus eros. Fusce eget tortor.</p>
</section>

			<?php the_content(); ?>
		</div>
<?php
	endwhile;
endif;
get_footer();
?>