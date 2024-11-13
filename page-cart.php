<?php

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page' );

			$args = array(
				'post_type' => 'product',
				'posts_per_page' => 4,
				'orderby' => 'rand',
			);

			$query = new WP_Query($args);

			if ($query->have_posts()) {
				?>
				<section class="other-products">
					<h2><?php echo esc_html("Check Out Some Other Products"); ?></h2>
					<ul>
					<?php
					while ( $query->have_posts() ) {
						$query->the_post();
						wc_get_template_part('content', 'product');
					}
					?>
					</ul>
				</section>
				<?php
			}
		endwhile;
		?>

	</main>

<?php
get_sidebar();
get_footer();
