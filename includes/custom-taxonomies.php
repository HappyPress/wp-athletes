<?php
/**
 * Register custom taxonomies.
 * Path: wp-athletes-plugin/includes/custom-taxonomies.php
 * Description: Sets up custom taxonomies for athletes, providing detailed configurations for labels and supports.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function wp_athletes_register_team_taxonomy() {
    $labels = [
        'name'                       => _x('Teams', 'Taxonomy General Name', 'wp-athletes'),
        'singular_name'              => _x('Team', 'Taxonomy Singular Name', 'wp-athletes'),
        'menu_name'                  => __('Teams', 'wp-athletes'),
        'all_items'                  => __('All Teams', 'wp-athletes'),
        'parent_item'                => __('Parent Team', 'wp-athletes'),
        'parent_item_colon'          => __('Parent Team:', 'wp-athletes'),
        'new_item_name'              => __('New Team Name', 'wp-athletes'),
        'add_new_item'               => __('Add New Team', 'wp-athletes'),
        'edit_item'                  => __('Edit Team', 'wp-athletes'),
        'update_item'                => __('Update Team', 'wp-athletes'),
        'view_item'                  => __('View Team', 'wp-athletes'),
        'separate_items_with_commas' => __('Separate teams with commas', 'wp-athletes'),
        'add_or_remove_items'        => __('Add or remove teams', 'wp-athletes'),
        'choose_from_most_used'      => __('Choose from the most used', 'wp-athletes'),
        'popular_items'              => __('Popular Teams', 'wp-athletes'),
        'search_items'               => __('Search Teams', 'wp-athletes'),
        'not_found'                  => __('Not Found', 'wp-athletes'),
        'no_terms'                   => __('No teams', 'wp-athletes'),
        'items_list'                 => __('Teams list', 'wp-athletes'),
        'items_list_navigation'      => __('Teams list navigation', 'wp-athletes'),
    ];
    $args = [
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true, // Important for Gutenberg editor support
    ];
    register_taxonomy('team', ['athlete'], $args);
}

function wp_athletes_register_discipline_taxonomy() {
    $labels = [
        'name'                       => _x('Disciplines', 'Taxonomy General Name', 'wp-athletes'),
        'singular_name'              => _x('Discipline', 'Taxonomy Singular Name', 'wp-athletes'),
        'menu_name'                  => __('Disciplines', 'wp-athletes'),
        'all_items'                  => __('All Disciplines', 'wp-athletes'),
        'parent_item'                => __('Parent Discipline', 'wp-athletes'),
        'parent_item_colon'          => __('Parent Discipline:', 'wp-athletes'),
        'new_item_name'              => __('New Discipline Name', 'wp-athletes'),
        'add_new_item'               => __('Add New Discipline', 'wp-athletes'),
        'edit_item'                  => __('Edit Discipline', 'wp-athletes'),
        'update_item'                => __('Update Discipline', 'wp-athletes'),
        'view_item'                  => __('View Discipline', 'wp-athletes'),
        'separate_items_with_commas' => __('Separate disciplines with commas', 'wp-athletes'),
        'add_or_remove_items'        => __('Add or remove disciplines', 'wp-athletes'),
        'choose_from_most_used'      => __('Choose from the most used', 'wp-athletes'),
        'popular_items'              => __('Popular Disciplines', 'wp-athletes'),
        'search_items'               => __('Search Disciplines', 'wp-athletes'),
        'not_found'                  => __('Not Found', 'wp-athletes'),
        'no_terms'                   => __('No disciplines', 'wp-athletes'),
        'items_list'                 => __('Disciplines list', 'wp-athletes'),
        'items_list_navigation'      => __('Disciplines list navigation', 'wp-athletes'),
    ];
    $args = [
        'labels'            => $labels,
        'hierarchical'      => false,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true, // Important for Gutenberg editor support
    ];
    register_taxonomy('discipline', ['athlete'], $args);
}

add_action('init', 'wp_athletes_register_team_taxonomy');
add_action('init', 'wp_athletes_register_discipline_taxonomy');
