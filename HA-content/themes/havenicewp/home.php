<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HAveniceWP
 */

get_header();
?>

	<main id="primary" class="site-main">
		<script>
			const qPath = '<?php echo home_url() ?>/wp-json/wp/v2/posts';
			const uPath = '<?php echo wp_get_upload_dir()["baseurl"] ?>';
		</script>
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

<!-- 		<div class="carousel carousel-nav" data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false, "lazyLoad": true }'>
			<?php if ( have_posts() ) :
				while ( have_posts() ) :
				the_post();
				the_post_thumbnail('thumbnail', ['class' => 'carousel-cell', 'title' => get_the_title()]);
				endwhile;
			endif; ?>
  		</div>
 -->		
	</main><!-- #main -->

<?php
get_footer();
