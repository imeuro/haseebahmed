<?php 

add_image_size( 'medium_large', '1920', '1080', false );
add_filter('show_admin_bar', '__return_false');

/* Remove jQuery From WordPress [FE only] */
function JQuery_ancheno() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', false);
    }
}
add_action('init', 'JQuery_ancheno');

function category_nav_class( $classes, $item ){
    if( 'category' == $item->object ){
        $category = get_category( $item->object_id );
        $classes[] = 'color-' . $category->slug;
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'category_nav_class', 10, 2 );