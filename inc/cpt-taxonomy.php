<?php
// Add custom post type
function cac_register_custom_post_types()
{
    // Register Careers
    $labels = array(
        'name'                  => _x('Careers', 'post type general name'),
        'singular_name'         => _x('Career', 'post type singular name'),
        'menu_name'             => _x('Careers', 'admin menu'),
        'name_admin_bar'        => _x('Career', 'add new on admin bar'),
        'add_new'               => _x('Add New', 'Career'),
        'add_new_item'          => __('Add New Career'),
        'new_item'              => __('New Career'),
        'edit_item'             => __('Edit Career'),
        'view_item'             => __('View Career'),
        'all_items'             => __('All Careers'),
        'search_items'          => __('Search Careers'),
        'parent_item_colon'     => __('Parent Careers:'),
        'not_found'             => __('No Careers found.'),
        'not_found_in_trash'    => __('No Careers found in Trash.'),
        'archives'              => __('Career Archives'),
        'insert_into_item'      => __('Insert into Career'),
        'uploaded_to_this_item' => __('Uploaded to this Career'),
        'filter_item_list'      => __('Filter Careers list'),
        'items_list_navigation' => __('Careers list navigation'),
        'items_list'            => __('Careers list'),
        'featured_image'        => __('Career featured image'),
        'set_featured_image'    => __('Set Career featured image'),
        'remove_featured_image' => __('Remove Career featured image'),
        'use_featured_image'    => __('Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'our-careers'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 4,
        'menu_icon'          => 'dashicons-megaphone',
        'supports'           => array('title', 'thumbnail'),
    );

    register_post_type('cac-careers', $args);

    // Register Catering Pages
    $labels = array(
        'name'               => _x('Catering', 'post type general name'),
        'singular_name'      => _x('Catering', 'post type singular name'),
        'menu_name'          => _x('Catering', 'admin menu'),
        'name_admin_bar'     => _x('Catering', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'Catering'),
        'add_new_item'       => __('Add New Catering'),
        'new_item'           => __('New Catering'),
        'edit_item'          => __('Edit Catering'),
        'view_item'          => __('View Catering'),
        'all_items'          => __('All Caterings'),
        'search_items'       => __('Search Catering'),
        'parent_item_colon'  => __('Parent Catering:'),
        'not_found'          => __('No Catering found.'),
        'not_found_in_trash' => __('No Catering found in Trash.'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'catering-packages'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-food',
        'supports'           => array('title', 'thumbnail'),
    );

    register_post_type('cac-catering', $args);

    // Register Store Locations
    $labels = array(
        'name'               => _x('Store Locations', 'post type general name'),
        'singular_name'      => _x('Store Locations', 'post type singular name'),
        'menu_name'          => _x('Store Locations', 'admin menu'),
        'name_admin_bar'     => _x('Store Locations', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'Store Location'),
        'add_new_item'       => __('Add New Store Locations'),
        'new_item'           => __('New Store Locations'),
        'edit_item'          => __('Edit Store Locations'),
        'view_item'          => __('View Store Locations'),
        'all_items'          => __('All Store Locations'),
        'search_items'       => __('Search Store Locations'),
        'parent_item_colon'  => __('Parent Store Locations:'),
        'not_found'          => __('No Store Locations found.'),
        'not_found_in_trash' => __('No Store Locations found in Trash.'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'store-locations'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-location',
        'supports'           => array('title', 'thumbnail'),
    );

    register_post_type('cac-store-locations', $args);
}
add_action('init', 'cac_register_custom_post_types');


function cac_register_taxonomies()
{
    // Add Store Locations taxonomy
    $labels = array(
        'name'              => _x('Store Locations', 'taxonomy general name'),
        'singular_name'     => _x('Store Locations', 'taxonomy singular name'),
        'search_items'      => __('Search Store Locations'),
        'all_items'         => __('All Store Locations'),
        'parent_item'       => __('Parent Store Locations'),
        'parent_item_colon' => __('Parent Store Locations:'),
        'edit_item'         => __('Edit Store Locations'),
        'update_item'       => __('Update Store Locations'),
        'add_new_item'      => __('Add New Store Locations'),
        'new_item_name'     => __('New Career Store Locations'),
        'menu_name'         => __('Store Locations'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'store-locations-taxo'),
    );

    register_taxonomy('cac-store-locations-taxo', array('cac-careers', 'product'), $args);
}
add_action('init', 'cac_register_taxonomies');

// So that you dont have to manually reset permalinks
function cac_rewrite_flush()
{
    cac_register_custom_post_types();
    cac_register_taxonomies();
    flush_rewrite_rules();
}

add_action('after_switch_theme', 'cac_rewrite_flush');

// Change placeholder text of CPT
function wpb_change_title_text($title)
{
    $screen = get_current_screen();

    if ('cac-store-locations' == $screen->post_type) {
        $title = 'Add Store Locations';
    }
    if ('cac-careers' == $screen->post_type) {
        $title = 'Add Career Listing';
    }
    if ('cac-catering-packages' == $screen->post_type) {
        $title = 'Add Catering Packages';
    }
    return $title;
}

add_filter('enter_title_here', 'wpb_change_title_text');
