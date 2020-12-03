<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HAveniceWP
 */

$cat = get_the_category($post->id);

if (count($cat) == 1) {
	$bordercat = ' background-color-'.$cat[0]->slug;
} else {
	// linear gradient...
	$singlebordercat = null;
	$bordercat = '" style="background: linear-gradient(90deg, ';
	foreach ($cat as $cats) {
		$singlecolor = get_field('category_color','category_'.$cats->cat_ID);
		$singlebordercat .= $singlecolor.',';
	}
	$bordercat .= substr($singlebordercat, 0, -1);
	$bordercat .= ')';
	// $bordercat = '" style="border-image-slice: 1; border-image-source: linear-gradient(90deg, red 0 40%, blue 60% 100%)';

}

$allPostIMG = get_field('attached_images',$post->ID);
$thumbnailID = get_post_thumbnail_id($post->ID)
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-entry-header<?php echo $bordercat ?>">
		<?php
		if ( is_singular() ) :
			echo '<h1 class="entry-title">';
			the_title( '', '' );
			echo " (";
			the_date('d M');
			echo ")</h1>";
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		 ?>
	</header><!-- .entry-header -->

	<?php 
	if ($allPostIMG) {
		echo '<div id="allPostIMG" class="carousel carousel-post">';
		// a carousel with all the post images

		// codice per mostrare la post_thumbnail:
		// echo '<figure class="carousel-cell">'.get_the_post_thumbnail( $post->ID, 'large', '', array( "class" => "img-responsive carousel-cell-image" ) );
		// echo '<figcaption>'.wp_get_attachment_caption( $thumbnailID ).'</figcaption></figure>';
		
		foreach ( $allPostIMG as $PostIMG ) {
			echo '<figure class="carousel-cell">'.wp_get_attachment_image( $PostIMG["attached_image"], 'large', '', array( "class" => "img-responsive carousel-cell-image" ) );
			echo '<figcaption>'. $PostIMG["attached_caption"] .'</figcaption></figure>';
        }
        echo '</div>';

	} else {
		havenicewp_post_thumbnail();
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

		<?php 
		if( get_field('extra_content') || get_field('related_links') ) : ?>
			<div class="extra_content"><?php the_field('extra_content'); ?></div>
			<div class="related_links"><?php the_related_links(); ?></div>
		<?php endif; ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link('Edit this post'); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
