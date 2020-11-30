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

// gather all post images:     
$allPostIMG = get_posts( array(
    'post_type' => 'attachment',
    'posts_per_page' => -1,
    'post_parent' => $post->ID,
) );
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
	if ($allPostIMG && count($allPostIMG) > 1) {
		echo '<div id="allPostIMG" class="carousel carousel-post">';
		// a carousel with all the post images
		foreach ( $allPostIMG as $PostIMG ) {
			echo '<figure class="carousel-cell">'.wp_get_attachment_image( $PostIMG->ID, 'large', '', array( "class" => "img-responsive carousel-cell-image" ) ).'</figure>';
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
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link('Edit this post'); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
