<?php
/**
 * Admin pages for WP Athletes Plugin.
 * Path: wp-athletes-plugin/admin/admin-pages.php
 * Description: Provides additional admin pages for managing the WP Athletes Plugin.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function wp_athletes_admin_pages() {
    add_menu_page('WP Athletes', 'WP Athletes', 'manage_options', 'wp-athletes', 'wp_athletes_settings_page', 'dashicons-admin-generic');
}
add_action('admin_menu', 'wp_athletes_admin_pages');

function wp_athletes_settings_page() {
    ?>
    <div class="wrap">
        <h1>WP Athletes Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('wp_athletes_options');
            do_settings_sections('wp_athletes');
            submit_button('Save Changes');
            ?>
        </form>
    </div>
    <?php
}
