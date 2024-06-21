<?php
/**
 * Plugin Name: WP Athletes Plugin
 * Plugin URI: http://sportsbuddy.me/
 * Description: A plugin to manage athletes profiles, including import/export functionality and gamification features.
 * Version: 0.2
 * Author: patilswapnilv
 * Author URI: http://sportsbuddy.me
 * Text Domain: wp-athletes-plugin
 * Domain Path: /languages
 */

/**
 * Main Plugin File for WP Athletes Plugin
 * Path: wp-athletes-plugin/wp-athletes-plugin.php
 * Description: Initializes the WP Athletes Plugin, including custom post types, taxonomies, and includes necessary files for additional functionalities.
 * Version: 0.2
 */

defined('ABSPATH') or die('Direct script access disallowed.');

// Define plugin constants for easy access to plugin paths and versioning
define('WP_ATHLETES_VERSION', '0.2');
define('WP_ATHLETES_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WP_ATHLETES_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include the dependencies checker
require_once(WP_ATHLETES_PLUGIN_DIR . 'includes/dependencies.php');

// Include the file handling custom post types
require_once(WP_ATHLETES_PLUGIN_DIR . 'includes/custom-post-types.php');

// Include the file handling custom taxonomies
require_once(WP_ATHLETES_PLUGIN_DIR . 'includes/custom-taxonomies.php');

// Include the file handling custom fields
require_once(WP_ATHLETES_PLUGIN_DIR . 'includes/custom-fields.php');

// Include the file handling import-export functionalities
require_once(WP_ATHLETES_PLUGIN_DIR . 'includes/import-export.php');

// Include the file handling admin pages
require_once(WP_ATHLETES_PLUGIN_DIR . 'admin/admin-pages.php');

// Include the file handling admin and front-end scripts/styles enqueue
require_once(WP_ATHLETES_PLUGIN_DIR . 'admin/enqueue-scripts.php');

// Include the search functionalities
require_once(WP_ATHLETES_PLUGIN_DIR . 'includes/search-functions.php');

// Plugin activation hook
register_activation_hook(__FILE__, 'wp_athletes_activation');
function wp_athletes_activation() {
    wp_athletes_register_post_type();
    wp_athletes_register_team_taxonomy();
    wp_athletes_register_discipline_taxonomy();
    flush_rewrite_rules();
}

// Plugin deactivation hook
register_deactivation_hook(__FILE__, 'wp_athletes_deactivation');
function wp_athletes_deactivation() {
    flush_rewrite_rules();
}

// Onboarding Page Setup
function wp_athletes_admin_menu() {
    add_menu_page('WP Athletes Setup', 'WP Athletes Setup', 'manage_options', 'wp-athletes-setup', 'wp_athletes_setup_page', 'dashicons-admin-generic');
}
add_action('admin_menu', 'wp_athletes_admin_menu');

function wp_athletes_setup_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('Sorry, you are not allowed to access this page.'));
    }
    
    echo '<div class="wrap"><h1>Welcome to WP Athletes Plugin</h1>';
    $plugin_slug = 'advanced-custom-fields/acf.php';
    $install_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=advanced-custom-fields'), 'install-plugin_advanced-custom-fields');
    $activate_url = wp_nonce_url(admin_url('plugins.php?action=activate&plugin=' . $plugin_slug . '&plugin_status=all&paged=1&s'), 'activate-plugin_' . $plugin_slug);

    if (!file_exists(WP_PLUGIN_DIR . '/advanced-custom-fields/acf.php')) {
        echo '<p>Advanced Custom Fields is not installed. <a href="' . $install_url . '">Click here to install ACF.</a></p>';
    } else if (!is_plugin_active($plugin_slug)) {
        echo '<p>Advanced Custom Fields is installed but not active. <a href="' . $activate_url . '">Click here to activate ACF.</a></p>';
    } else {
        echo '<p>All required plugins are installed and active.</p>';
    }

    $plugin_slug = 'gamipress/gamipress.php';
    $install_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=gamipress'), 'install-plugin_gamipress');
    $activate_url = wp_nonce_url(admin_url('plugins.php?action=activate&plugin=' . $plugin_slug . '&plugin_status=all&paged=1&s'), 'activate-plugin_' . $plugin_slug);

    if (!file_exists(WP_PLUGIN_DIR . '/gamipress/gamipress.php')) {
        echo '<p>GamiPress is not installed. <a href="' . $install_url . '">Click here to install GamiPress.</a></p>';
    } else if (!is_plugin_active($plugin_slug)) {
        echo '<p>GamiPress is installed but not active. <a href="' . $activate_url . '">Click here to activate GamiPress.</a></p>';
    } else {
        echo '<p>All required plugins are installed and active.</p>';
    }

    echo '</div>';
}

// Debugging: Check user capabilities on plugin load
add_action('admin_init', function() {
    if (current_user_can('manage_options')) {
        error_log('User has manage_options capability.');
    } else {
        error_log('User does NOT have manage_options capability.');
    }
});
