<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package An_Store
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<?php wp_nav_menu(array( 'theme_location' => 'footer-social-media')); ?>
			<?php wp_nav_menu(array( 'theme_location' => 'footer-company-info')); ?>
			<?php wp_nav_menu(array( 'theme_location' => 'footer-resources')); ?>
			<?php wp_nav_menu(array( 'theme_location' => 'footer-site-navigation')); ?>
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %1$s by %2$s.', 'an-store' ), 'an-store', '<a href="http://underscores.me/">Dongwon, Frazer, Keanna</a>' );
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
