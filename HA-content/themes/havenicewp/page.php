<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HAveniceWP
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			//print_r($post);
			if ($post->ID == 202) :
				get_template_part( 'template-parts/content', 'page-202' );
			else :
				get_template_part( 'template-parts/content', 'page' );
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
