<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HAveniceWP
 */

?>
<figure id="post-<?php the_ID(); ?>" <?php post_class('carousel-cell'); ?>>

	<?php 
	$id = get_post_thumbnail_id();
	$size = 'medium_large';
	$img_src = wp_get_attachment_image_url( $id, $size );
	$img_srcset = wp_get_attachment_image_srcset( $id, $size );
	$title = get_the_title();
	$alt = (get_post_meta($id, '_wp_attachment_image_alt')[0]) ? get_post_meta($id, '_wp_attachment_image_alt')[0] : $title;

	// the_post_thumbnail('medium_large', ['class' => 'carousel-cell-image', 'title' => get_the_title()]); 
	?>
	<img class="carousel-cell-image"
  data-flickity-lazyload-srcset="<?php echo esc_attr( $img_srcset ); ?>" sizes="(min-width: 960px) 1920px, 100wv"
  data-flickity-lazyload-src="walrus-large.jpg" />
	<?php 
	?>

	<figcaption class="entry-header">
		<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		?>
	</figcaption><!-- .entry-header -->

<!-- 
	<div class="entry-content">
		<?php
		/*
		the_content(
			sprintf(
				wp_kses(
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

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'havenicewp' ),
				'after'  => '</div>',
			)
		);*/
		?>
	</div>

	<footer class="entry-footer">
		<?php // havenicewp_entry_footer(); ?>
	</footer>

 -->
</figure><!-- #post-<?php the_ID(); ?> -->
