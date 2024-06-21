<?php
/**
 * Register custom post types.
 * Path: wp-athletes-plugin/includes/custom-post-types.php
 * Description: Sets up the custom post type for athletes, providing detailed configurations for labels, supports, and capabilities.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function wp_athletes_register_post_type() {
    $labels = [
        'name'                  => _x('Athletes', 'Post Type General Name', 'wp-athletes'),
        'singular_name'         => _x('Athlete', 'Post Type Singular Name', 'wp-athletes'),
        'menu_name'             => __('Athletes', 'wp-athletes'),
        'name_admin_bar'        => __('Athlete', 'wp-athletes'),
        'archives'              => __('Athlete Archives', 'wp-athletes'),
        'attributes'            => __('Athlete Attributes', 'wp-athletes'),
        'parent_item_colon'     => __('Parent Athlete:', 'wp-athletes'),
        'all_items'             => __('All Athletes', 'wp-athletes'),
        'add_new_item'          => __('Add New Athlete', 'wp-athletes'),
        'add_new'               => __('Add New', 'wp-athletes'),
        'new_item'              => __('New Athlete', 'wp-athletes'),
        'edit_item'             => __('Edit Athlete', 'wp-athletes'),
        'update_item'           => __('Update Athlete', 'wp-athletes'),
        'view_item'             => __('View Athlete', 'wp-athletes'),
        'view_items'            => __('View Athletes', 'wp-athletes'),
        'search_items'          => __('Search Athlete', 'wp-athletes'),
        'not_found'             => __('Not found', 'wp-athletes'),
        'not_found_in_trash'    => __('Not found in Trash', 'wp-athletes'),
        'featured_image'        => __('Profile Picture', 'wp-athletes'),
        'set_featured_image'    => __('Set profile picture', 'wp-athletes'),
        'remove_featured_image' => __('Remove profile picture', 'wp-athletes'),
        'use_featured_image'    => __('Use as profile picture', 'wp-athletes'),
        'insert_into_item'      => __('Insert into athlete', 'wp-athletes'),
        'uploaded_to_this_item' => __('Uploaded to this athlete', 'wp-athletes'),
        'items_list'            => __('Athletes list', 'wp-athletes'),
        'items_list_navigation' => __('Athletes list navigation', 'wp-athletes'),
        'filter_items_list'     => __('Filter athletes list', 'wp-athletes'),
    ];
    $args = [
        'label'               => __('Athlete', 'wp-athletes'),
        'description'         => __('Post Type Description', 'wp-athletes'),
        'labels'              => $labels,
        'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'comments'],
        'taxonomies'          => ['team', 'discipline'],
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true, // Important for Gutenberg editor support
    ];
    register_post_type('athlete', $args);
}

add_action('init', 'wp_athletes_register_post_type');
