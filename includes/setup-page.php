<?php
/**
 * Setup Page for WP Athletes Plugin.
 * Path: wp-athletes-plugin/includes/setup-page.php
 * Description: Provides the onboarding setup page for installing and activating required plugins.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function wp_athletes_setup_page($missing_plugins = []) {
    if (!current_user_can('manage_options')) {
        wp_die(__('Sorry, you are not allowed to access this page.'));
    }

    echo '<div class="wrap"><h1>Welcome to WP Athletes Plugin</h1>';
    foreach ($missing_plugins as $plugin) {
        $plugin_slug = dirname($plugin);
        $install_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=' . $plugin_slug), 'install-plugin_' . $plugin_slug);
        $activate_url = wp_nonce_url(admin_url('plugins.php?action=activate&plugin=' . $plugin . '&plugin_status=all&paged=1&s'), 'activate-plugin_' . $plugin);

        if (!file_exists(WP_PLUGIN_DIR . '/' . $plugin)) {
            echo '<p>' . sprintf(__('%s is not installed. <a href="%s">Click here to install.</a>', 'wp-athletes-plugin'), $plugin_slug, $install_url) . '</p>';
        } else if (!is_plugin_active($plugin)) {
            echo '<p>' . sprintf(__('%s is installed but not active. <a href="%s">Click here to activate.</a>', 'wp-athletes-plugin'), $plugin_slug, $activate_url) . '</p>';
        }
    }
    echo '</div>';
}
