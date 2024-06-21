<?php
/**
 * Register custom taxonomies.
 * Path: wp-athletes-plugin/includes/custom-taxonomies.php
 * Description: Sets up custom taxonomies for teams and disciplines associated with the Athlete post type, including hierarchical settings and REST API support.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function register_athlete_taxonomies() {
    // Team taxonomy
    register_taxonomy('team', 'athlete', array(
        'label' => __('Teams', 'wp-athletes'),
        'labels' => array(
            'name' => _x('Teams', 'taxonomy general name', 'wp-athletes'),
            'singular_name' => _x('Team', 'taxonomy singular name', 'wp-athletes'),
            'search_items' =>  __('Search Teams', 'wp-athletes'),
            'all_items' => __('All Teams', 'wp-athletes'),
            'parent_item' => __('Parent Team', 'wp-athletes'),
            'parent_item_colon' => __('Parent Team:', 'wp-athletes'),
            'edit_item' => __('Edit Team', 'wp-athletes'),
            'update_item' => __('Update Team', 'wp-athletes'),
            'add_new_item' => __('Add New Team', 'wp-athletes'),
            'new_item_name' => __('New Team Name', 'wp-athletes'),
            'menu_name' => __('Teams', 'wp-athletes'),
        ),
        'rewrite' => array('slug' => 'team'),
        'hierarchical' => true,
        'show_in_rest' => true, // Important for Gutenberg editor support
    ));

    // Discipline taxonomy
    register_taxonomy('discipline', 'athlete', array(
        'label' => __('Disciplines', 'wp-athletes'),
        'labels' => array(
            'name' => _x('Disciplines', 'taxonomy general name', 'wp-athletes'),
            'singular_name' => _x('Discipline', 'taxonomy singular name', 'wp-athletes'),
            'search_items' =>  __('Search Disciplines', 'wp-athletes'),
            'all_items' => __('All Disciplines', 'wp-athletes'),
            'parent_item' => __('Parent Discipline', 'wp-athletes'),
            'parent_item_colon' => __('Parent Discipline:', 'wp-athletes'),
            'edit_item' => __('Edit Discipline', 'wp-athletes'),
            'update_item' => __('Update Discipline', 'wp-athletes'),
            'add_new_item' => __('Add New Discipline', 'wp-athletes'),
            'new_item_name' => __('New Discipline Name', 'wp-athletes'),
            'menu_name' => __('Disciplines', 'wp-athletes'),
        ),
        'rewrite' => array('slug' => 'discipline'),
        'hierarchical' => false,
        'show_in_rest' => true, // Important for Gutenberg editor support
    ));
}

add_action('init', 'register_athlete_taxonomies');
