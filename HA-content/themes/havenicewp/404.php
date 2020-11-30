<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package HAveniceWP
 */

get_header();
?>

	<main id="primary" class="site-main">

		<div class="simpletextdiv">

			<div class="simpletextdiv-cell">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'havenicewp' ); ?></h1>
				<p><a href="<?php echo home_url() ?>" title="Home Page">It looks like nothing was found at this location.<br>Maybe try <strong>heading to the Home Page</strong></a>?</p>
			</div>

		</div><!-- .carousel-main -->

	</main><!-- #main -->

<?php
get_footer();
