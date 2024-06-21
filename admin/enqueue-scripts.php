<?php
/**
 * Enqueue scripts and styles for WP Athletes Plugin.
 * Path: wp-athletes-plugin/admin/enqueue-scripts.php
 * Description: Handles loading of CSS and JavaScript files for both admin and front-end views, ensuring that all interactive elements of the plugin function correctly and are styled appropriately.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

/**
 * Enqueue admin scripts and styles.
 */
function wp_athletes_enqueue_admin_scripts($hook) {
    global $post_type;

    // Only enqueue these scripts on the Athlete post type pages
    if ('athlete' == $post_type) {
        wp_enqueue_style('wp-athletes-admin-style', WP_ATHLETES_PLUGIN_URL . 'assets/css/admin.css', array(), WP_ATHLETES_VERSION);
        wp_enqueue_script('wp-athletes-admin-script', WP_ATHLETES_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), WP_ATHLETES_VERSION, true);

        // Conditionally load scripts for settings page
        if ('athlete_page_wp_athletes_settings' == $hook) {
            wp_enqueue_script('wp-athletes-settings-script', WP_ATHLETES_PLUGIN_URL . 'assets/js/settings.js', array('jquery'), WP_ATHLETES_VERSION, true);
        }
    }
}
add_action('admin_enqueue_scripts', 'wp_athletes_enqueue_admin_scripts');

/**
 * Enqueue front-end scripts and styles.
 */
function wp_athletes_enqueue_front_scripts() {
    wp_enqueue_style('wp-athletes-style', WP_ATHLETES_PLUGIN_URL . 'assets/css/style.css', array(), WP_ATHLETES_VERSION);
    wp_enqueue_script('wp-athletes-script', WP_ATHLETES_PLUGIN_URL . 'assets/js/search.js', array('jquery'), WP_ATHLETES_VERSION, true);

    // Localize script for AJAX handling
    wp_localize_script('wp-athletes-script', 'wpAthletesAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'wp_athletes_enqueue_front_scripts');
