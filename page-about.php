<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package An_Store
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		<section class="about-accordion"> 
		<h2>History</h2>
		<?php
		if (have_rows('works')) : ?>
		<?php while (have_rows('works')) : the_row(); ?>
		<article>
			<h3>
				<button class="accordion-title">
					<?php echo get_sub_field('group_heading');?>
					<svg class="accordion-icon" width="20px" height="20px" viewBox="0 -5 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
    				<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
       				 <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-572.000000, -1200.000000)" fill="#000000">
           			 <path d="M595.688,1200.28 C595.295,1199.89 594.659,1199.89 594.268,1200.28 L583.984,1211.57 L573.702,1200.28 C573.31,1199.89 572.674,1199.89 572.282,1200.28 C571.89,1200.68 571.89,1201.32 572.282,1201.71 L583.225,1213.72 C583.434,1213.93 583.711,1214.02 583.984,1214 C584.258,1214.02 584.535,1213.93 584.745,1213.72 L595.688,1201.71 C596.079,1201.32 596.079,1200.68 595.688,1200.28" id="chevron-down" sketch:type="MSShapeGroup">
					</path>
        			</g>
    				</g>
					</svg>
				</button>
			</h3>
			<div class="accordion-content">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php if (have_rows('contents')) : ?>
						<?php while (have_rows('contents')): the_row(); ?>
								<div class="swiper-slide">
									<h4> <?php echo get_sub_field('single_content_title') ?> </h4>
									<p> <?php echo get_sub_field('single_content_description') ?> </p>
								
									<?php if (have_rows('single_content')) : ?>
										<?php while (have_rows('single_content')) : the_row(); ?>
										
										<?php 
										if (get_row_layout() == 'image_type') {
										$image = get_sub_field('image');
										if($image) {
											echo wp_get_attachment_image($image, 'full');
										} 
										} else if (get_row_layout() == 'embed_type') {
										$embed = get_sub_field('embed');
										if($embed) {
											echo $embed;
										}
										}
										?>
								</div>
						
						<?php endwhile;
						endif; ?>

						<?php endwhile;
						endif; ?>
					</div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
				</div>
			</div>
		</article>

		<?php endwhile;
		endif; ?>

		</section>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
