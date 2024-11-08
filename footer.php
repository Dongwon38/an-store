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
			<section>
				<?php wp_nav_menu(array( 'theme_location' => 'footer-social-media')); ?>
			</section>
			<section>
				<h3><?php echo esc_html("Company Information"); ?></h3>
				<?php wp_nav_menu(array( 'theme_location' => 'footer-company-info')); ?>
			</section>
			<section>
				<h3><?php echo esc_html("Resources"); ?></h3>
				<?php wp_nav_menu(array( 'theme_location' => 'footer-resources')); ?>
			</section>
			<section>
				<h3><?php echo esc_html("Site Navigation"); ?></h3>
				<?php wp_nav_menu(array( 'theme_location' => 'footer-site-navigation')); ?>
			</section>
			<section class="footer-copyright">
				<p>&copy; 
					<?php 
					echo date('Y');
					echo esc_html(" | A Website By: ");
					?>
					<a href="<?php echo esc_url("https://dongwonkang.info"); ?>" target="_blank"><?php echo esc_html("Dongwon"); ?></a>
					<?php echo esc_html(', '); ?>
					<a href="<?php echo esc_url("https://frazermok.com"); ?>" target="_blank"><?php echo esc_html("Frazer"); ?></a>
					<?php echo esc_html(', & '); ?>
					<a href="<?php echo esc_url("https://keannabayaua.com/"); ?>" target="_blank"><?php echo esc_html("Keanna"); ?></a>
				</p>
			</section>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
