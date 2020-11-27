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
<?php if (is_home() || is_front_page()) : ?>
	<footer id="colophon" class="site-footer">
		
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
					endif;
				?>
				</ul>
			</form>
		</nav><!-- #site-navigation -->	
		
		<a id="clearAllFilters" class="alignright" name="clearAllFilters">clear filters</a>
	</footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
