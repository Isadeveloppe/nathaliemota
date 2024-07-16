<?php get_template_part('templates-parts/lightbox'); ?>
</main>

<footer class=footer>
	<nav class="footerform">
            <?php  wp_nav_menu( array(
            'theme_location' => 'footer',
            'container'      => 'footerform',
            'container_id'   => 'footer-menu',
            'menu_class'     => 'footerbar'
            ) );
            ?>
            </div>
    </nav>
   
</footer>
<?php get_template_part('templates-parts/pop-up'); ?>
<?php get_template_part('templates-parts/modale'); ?>


<?php wp_footer(); ?>

</body>

