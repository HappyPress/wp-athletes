<?php
/**
 * Check plugin dependencies.
 * Path: wp-athletes-plugin/includes/dependencies.php
 * Description: Ensures that all necessary plugins (Advanced Custom Fields and GamiPress) are active. If not, redirects to the onboarding screen to assist with installation and activation.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function wp_athletes_check_dependencies() {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    $required_plugins = [
        'advanced-custom-fields/acf.php',  // Path to the main plugin file of ACF
        'gamipress/gamipress.php'          // Path to the main plugin file of GamiPress
    ];

    $missing_plugins = [];
    foreach ($required_plugins as $plugin) {
        if (!is_plugin_active($plugin)) {
            $missing_plugins[] = $plugin;
        }
    }

    if (!empty($missing_plugins)) {
        add_action('admin_notices', function() use ($missing_plugins) {
            foreach ($missing_plugins as $plugin) {
                echo '<div class="error"><p>' . sprintf(__('WP Athletes Plugin requires %s to be installed and active.', 'wp-athletes-plugin'), $plugin) . '</p></div>';
            }
        });

        add_action('admin_init', function() {
            if (current_user_can('manage_options')) {
                $onboarding_page = admin_url('admin.php?page=wp-athletes-setup');
                wp_redirect($onboarding_page);
                exit;
            }
        });
    }
}

// Run the dependency check
add_action('plugins_loaded', 'wp_athletes_check_dependencies');
