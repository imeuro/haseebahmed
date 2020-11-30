<?php
/**
 * The home page template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HAveniceWP
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php 
		if ( have_posts() ) : ?>

			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>

			<div id="Qtarget" class="carousel carousel-main">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'home' );

			endwhile; ?>
			</div>

		<?php
		endif; ?>
	</main><!-- #main -->

<?php
get_footer();
