<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HAveniceWP
 */

function the_related_links() {
	$relateds = get_field('related_links',$post->ID);
	//print_r($relateds);
	if ($relateds) :
		$out = '<ul class="relatedposts">';
		foreach ($relateds as $related) {
			$out .= '<li><a href="'.get_permalink($related->ID).'" title="'.$related->post_title.'">'.$related->post_title.'</a></li>';
		}
		$out .= '</ul>';
	endif;

	echo $out;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		 ?>
	</header><!-- .entry-header -->

	
	<div id="allPostIMG" class="carousel carousel-post">
		<?php havenicewp_post_thumbnail(); ?>
		<div class="extra_content"><?php the_field('extra_content'); ?></div>
		<div class="related_links"><?php the_related_links(); ?></div>
	</div>



	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'havenicewp' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link('Edit this page'); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
