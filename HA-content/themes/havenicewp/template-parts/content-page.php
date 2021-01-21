<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HAveniceWP
 */

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

	<?php 
	if ($allPostIMG || has_post_thumbnail()) {
		echo '<div id="allPostIMG" class="carousel carousel-post">';
		// a carousel with all the post images

		// shows the post_thumbnail:
		if (has_post_thumbnail()) :
			echo '<figure class="carousel-cell">'.get_the_post_thumbnail( $post->ID, 'large', '', array( "class" => "img-responsive carousel-cell-image" ) );
			echo '<figcaption>'.wp_get_attachment_caption( $thumbnailID ).'</figcaption></figure>';
		endif;
		// shows other pics:
		if ($allPostIMG) :
			foreach ( $allPostIMG as $PostIMG ) {
				echo '<figure class="carousel-cell">'.wp_get_attachment_image( $PostIMG["attached_image"], 'large', '', array( "class" => "img-responsive carousel-cell-image" ) );

				if ($PostIMG["attached_caption"] && $PostIMG["attached_caption"] != '') :
					$caption = $PostIMG["attached_caption"];
				else :
					$caption = wp_get_attachment_caption($PostIMG["attached_image"]);
				endif;

				echo '<figcaption>'. $caption .'</figcaption></figure>';
	        }
	    endif;
        echo '</div>';

	}
	?>



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
