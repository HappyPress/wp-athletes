<?php
/**
 * Enqueue scripts and styles.
 * Path: wp-athletes-plugin/admin/enqueue-scripts.php
 * Description: Enqueues necessary CSS and JavaScript files for both admin and frontend.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function wp_athletes_enqueue_admin_scripts() {
    wp_enqueue_style('wp-athletes-admin-css', WP_ATHLETES_PLUGIN_URL . 'assets/css/admin.css');
    wp_enqueue_script('wp-athletes-admin-js', WP_ATHLETES_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), WP_ATHLETES_VERSION, true);
}
add_action('admin_enqueue_scripts', 'wp_athletes_enqueue_admin_scripts');

function wp_athletes_enqueue_frontend_scripts() {
    wp_enqueue_style('wp-athletes-frontend-css', WP_ATHLETES_PLUGIN_URL . 'assets/css/frontend.css');
    wp_enqueue_script('wp-athletes-frontend-js', WP_ATHLETES_PLUGIN_URL . 'assets/js/frontend.js', array('jquery'), WP_ATHLETES_VERSION, true);
}
add_action('wp_enqueue_scripts', 'wp_athletes_enqueue_frontend_scripts');
