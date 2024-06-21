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
    register_athlete_cpt();
    register_athlete_taxonomies();
    flush_rewrite_rules();
}

// Plugin deactivation hook
register_deactivation_hook(__FILE__, 'wp_athletes_deactivation');
function wp_athletes_deactivation() {
    flush_rewrite_rules();
}
