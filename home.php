<?php

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) {

			if ( is_home() ) {
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			}

			while ( have_posts() ) {
				the_post();
				?>
				<article class="single-blog-post">
					<a href="<?php the_permalink(); ?>">
						<h2><?php the_title(); ?></h2>
					</a>
					<p><?php echo esc_html(get_post_time('F j, Y')); ?></p>
					<?php
					the_post_thumbnail();
					the_excerpt();
					?>
					<p><?php comments_number(); ?></p>
				</article>
				<?php
			}

			the_posts_navigation();

		} else 

			get_template_part( 'template-parts/content', 'none' );

		?>

	</main>
	
<?php
get_sidebar();
get_footer();
