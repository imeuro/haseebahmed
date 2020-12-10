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
	$cat = get_the_category($post->id);

	if (count($cat) == 1) {
		$bordercat = ' border-color-'.$cat[0]->slug;
	} else {
		// linear gradient...
		$singlebordercat = null;
		$bordercat = '" style="border-image-slice: 1; border-image-source: linear-gradient(90deg, ';
		foreach ($cat as $cats) {
			$singlecolor = get_field('category_color','category_'.$cats->cat_ID);
			$singlebordercat .= $singlecolor.',';
		}
		$bordercat .= substr($singlebordercat, 0, -1);
		$bordercat .= ')';
		// $bordercat = '" style="border-image-slice: 1; border-image-source: linear-gradient(90deg, red 0 40%, blue 60% 100%)';

	}
	?>
	<a class="glightbox<?php echo $bordercat ?>" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
		<div class="entry-header">
			<div class="entry-excerpt"><?php the_excerpt(); ?></div>
		</div>
		<p class="entry-date"><?php the_date('d M'); ?></p>
		<img class="carousel-cell-image" 
			srcset="<?php echo esc_attr( $img_srcset ); ?>" 
			sizes="(min-width: 960px) 1920px, 100wv" 
			src="<?php echo $img_src; ?>" />


		<!-- .entry-header -->

	</a>
</figure><!-- #post-<?php the_ID(); ?> -->
