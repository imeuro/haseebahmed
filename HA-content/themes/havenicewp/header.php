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
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'havenicewp' ); ?></a>

	<header id="masthead" class="site-header">

		<nav id="site-navigation" class="main-navigation">

			<form class="primary-menu" method="GET" id="catMenu">
				<?php
					if( $terms = get_terms( array( 
						'taxonomy' => 'category', 
						'exclude' => 1,
						'hide_empty' => false, 
						'orderby' => 'ID' 
					) ) ) : 
			 
						foreach ( $terms as $term ) :
							$category = get_category( $term->term_id );
							echo '<input class="color-' . $category->slug . '" type="checkbox" value="' . $term->term_id . '" id="menu-' . $term->name . '" name="categories" />';
							echo '<label class="color-' . $category->slug . '" for="menu-' . $term->name . '">' . $term->name . '</label>';
						endforeach;
						echo '<div class="alignright"><a href="'.get_permalink( get_page_by_title( 'About' ) ).'">About</a></div>';
					endif;
				?>
			</form>

			<!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php //esc_html_e( 'Categories:', 'havenicewp' ); ?></button> -->
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
