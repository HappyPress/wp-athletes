<?php
/**
 * Search functionalities for WP Athletes Plugin.
 * Path: wp-athletes-plugin/includes/search-functions.php
 * Description: Provides AJAX-based search functionality for athletes, with filters for team, discipline, and birth year.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function wp_athletes_register_search_actions() {
    add_action('wp_ajax_nopriv_athlete_search', 'wp_athletes_handle_search_request');
    add_action('wp_ajax_athlete_search', 'wp_athletes_handle_search_request');
}

function wp_athletes_handle_search_request() {
    // Ensure we have the required parameters to perform a search
    if (isset($_POST['search_terms'])) {
        $search_terms = sanitize_text_field($_POST['search_terms']);
        $query_args = array(
            'post_type' => 'athlete',
            'posts_per_page' => 10,
            's' => $search_terms, // Basic search query
            // Add more query parameters as needed
        );

        $query = new WP_Query($query_args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                // Output the format of search results, e.g., athlete name and a link to the profile
                echo '<div><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>';
            }
        } else {
            echo 'No athletes found.';
        }
        wp_reset_postdata();
    }
    wp_die(); // Always include wp_die() at the end of AJAX handlers
}

function wp_athletes_enqueue_search_scripts() {
    wp_enqueue_script('wp-athletes-search', WP_ATHLETES_PLUGIN_URL . 'assets/js/search.js', array('jquery'), null, true);
    wp_localize_script('wp-athletes-search', 'wpAthletes', array('ajaxurl' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'wp_athletes_enqueue_search_scripts');
add_action('init', 'wp_athletes_register_search_actions');
