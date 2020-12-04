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


/* add categories_names field to wp rest api response:
   https://wordpress.stackexchange.com/questions/287931/ */
function wpse_287931_register_categories_names_field()
{
    register_rest_field(
        array('post'),
        'pubdate',
        array(
            'get_callback'    => 'wpse_287931_get_date',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field(
        array('post'),
        'categories_slug',
        array(
            'get_callback'    => 'wpse_287931_get_categories_names',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field(
        array('post'),
        'categories_colors',
        array(
            'get_callback'    => 'wpse_287931_get_categories_colors',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}

add_action('rest_api_init', 'wpse_287931_register_categories_names_field');

function wpse_287931_get_date($object, $field_name, $request)
{
    $post_date = get_the_date('d M',$object['id']);
    return $post_date;
}
function wpse_287931_get_categories_names($object, $field_name, $request)
{
    $formatted_categories = array();
    $categories = get_the_category($object['id']);
    foreach ($categories as $category) {
        $formatted_categories[] = $category->slug;
    }
    return $formatted_categories;
}
function wpse_287931_get_categories_colors($object, $field_name, $request)
{
    $colors_categories = array();
    $categories = get_the_category($object['id']);

    foreach ($categories as $category) {
        $colors_categories[] = get_field('category_color','category_'.$category->cat_ID);
    }
    return $colors_categories;
}