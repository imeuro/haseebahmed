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

			<form class="secondary-menu" method="GET" id="tagMenu">
				<?php
					if( $terms = get_terms( array( 
						'taxonomy' => 'post_tag', 
						'hide_empty' => false, 
						'orderby' => 'ID' 
					) ) ) : 
			 
						foreach ( $terms as $term ) :
							echo '<input type="checkbox" value="' . $term->term_id . '" id="menu-' . $term->name . '" name="tags" />';
							echo '<label for="menu-' . $term->name . '">' . $term->name . '</label>';
						endforeach;
						echo '<div class="alignright"><a id="clearAllFilters" name="clearAllFilters">clear filters</a></div>';
					endif;
				?>
			</form>

			<!-- <button class="menu-toggle" aria-controls="secondary-menu" aria-expanded="false"><?php esc_html_e( 'Steps:', 'havenicewp' ); ?></button> -->
		</nav><!-- #site-navigation -->	
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
