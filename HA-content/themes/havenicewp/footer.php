<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HAveniceWP
 */

?>

	<footer id="colophon" class="site-footer">
		<nav id="steps-navigation" class="secondary-navigation">
			<button class="menu-toggle" aria-controls="secondary-menu" aria-expanded="false"><?php esc_html_e( 'Steps:', 'havenicewp' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'secondary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->	
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
