<?php
/**
 * Check plugin dependencies.
 * Path: wp-athletes-plugin/includes/dependencies.php
 * Description: Ensures that all necessary plugins (Advanced Custom Fields and GamiPress) are active. If not, the plugin is deactivated to prevent errors.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function wp_athletes_check_dependencies() {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    $required_plugins = [
        'advanced-custom-fields/acf.php',  // Path to the main plugin file of ACF
        'gamipress/gamipress.php'          // Path to the main plugin file of GamiPress
    ];

    foreach ($required_plugins as $plugin) {
        if (!is_plugin_active($plugin)) {
            add_action('admin_notices', function() use ($plugin) {
                echo '<div class="error"><p>' . sprintf(__('WP Athletes Plugin requires %s to be installed and active.', 'wp-athletes-plugin'), $plugin) . '</p></div>';
            });
            deactivate_plugins(plugin_basename(__FILE__));  // Deactivates the plugin if dependencies are not met
            return;  // Stop the execution of further code
        }
    }
}

// Run the dependency check
add_action('plugins_loaded', 'wp_athletes_check_dependencies');
