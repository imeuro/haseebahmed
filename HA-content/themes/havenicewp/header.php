<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HAveniceWP
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<script>
	const qPath = '<?php echo home_url() ?>/wp-json/wp/v2/posts';
	const uPath = '<?php echo wp_get_upload_dir()["baseurl"] ?>';
	const hPath = '<?php echo home_url() ?>';
</script>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'havenicewp' ); ?></a>
	<?php if (is_home() || is_front_page() || is_404()) : ?>
		<header id="masthead" class="site-header">
		
			<nav id="site-navigation" class="main-navigation">

				<button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><?php esc_html_e( 'Categories', 'havenicewp' ); ?></button>
				<button class="alignright"><a class="glightbox" href="<?php echo get_permalink($post=2) ?>">About</a></button>
				<form class="primary-menu" method="GET" id="catMenu">
					<ul>
					<?php
						if( $terms = get_terms( array( 
							'taxonomy' => 'category', 
							'exclude' => 1,
							'hide_empty' => false, 
							'orderby' => 'ID' 
						) ) ) : 
				 
							foreach ( $terms as $term ) :
								$category = get_category( $term->term_id );
								echo '<li><input class="color-' . $category->slug . '" type="checkbox" value="' . $term->term_id . '" id="menu-' . $term->name . '" name="categories" />';
								echo '<label class="color-' . $category->slug . '" for="menu-' . $term->name . '">' . $term->name . '</label></li>';
							endforeach;
						endif;
					?>
					</ul>
				</form>
			</nav><!-- #site-navigation -->
		</header><!-- #masthead -->
	<?php endif; ?>