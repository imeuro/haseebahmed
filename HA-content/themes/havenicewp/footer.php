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
		<?php if (is_home() || is_front_page()) : ?>
			<nav id="steps-navigation" class="secondary-navigation">

				<button class="menu-toggle" aria-controls="secondary-navigation" aria-expanded="false"><?php esc_html_e( 'Steps', 'havenicewp' ); ?></button>

				<form class="secondary-menu" method="GET" id="tagMenu">
					<ul>
					<?php
						if( $terms = get_terms( array( 
							'taxonomy' => 'post_tag', 
							'hide_empty' => false, 
							'orderby' => 'ID' 
						) ) ) : 
				 
							foreach ( $terms as $term ) :
								echo '<li><input type="checkbox" value="' . $term->term_id . '" id="menu-' . $term->name . '" name="tags" />';
								echo '<label for="menu-' . $term->name . '">' . $term->name . '</label></li>';
							endforeach;
							echo '<li class="alignright"><a id="clearAllFilters" name="clearAllFilters">clear filters</a></li>';
						endif;
					?>
					</ul>
				</form>
			</nav><!-- #site-navigation -->	
		<?php endif; ?>
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
