<?php
/**
 * Admin pages for WP Athletes Plugin.
 * Path: wp-athletes-plugin/admin/admin-pages.php
 * Description: Handles the creation and management of admin pages for configuring and managing the athlete profiles and import/export functionalities.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

/**
 * Adds custom admin pages under the Athlete post type menu.
 */
function wp_athletes_add_admin_pages() {
    add_submenu_page(
        'edit.php?post_type=athlete',  // Parent slug
        'Settings',                    // Page title
        'Settings',                    // Menu title
        'manage_options',              // Capability
        'wp_athletes_settings',        // Menu slug
        'wp_athletes_settings_page'    // Function to display the settings page
    );
}
add_action('admin_menu', 'wp_athletes_add_admin_pages');

/**
 * Displays the settings page for the WP Athletes plugin.
 */
function wp_athletes_settings_page() {
    ?>
    <div class="wrap">
        <h2>Athletes Plugin Settings</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('wp_athletes_options_group');
            do_settings_sections('wp_athletes_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

/**
 * Register settings, sections, and fields for the plugin settings page.
 */
function wp_athletes_register_settings() {
    register_setting('wp_athletes_options_group', 'wp_athletes_options');
    
    add_settings_section(
        'wp_athletes_section', 
        'General Settings', 
        'wp_athletes_section_callback', 
        'wp_athletes_settings'
    );

    add_settings_field(
        'wp_athletes_field_enable_search', 
        'Enable Search Feature', 
        'wp_athletes_field_enable_search_callback', 
        'wp_athletes_settings', 
        'wp_athletes_section'
    );
}

/**
 * Callback for the settings section description.
 */
function wp_athletes_section_callback() {
    echo '<p>Adjust general settings for the Athletes Plugin.</p>';
}

/**
 * Callback for the "enable search" setting field.
 */
function wp_athletes_field_enable_search_callback() {
    $options = get_option('wp_athletes_options');
    $checked = isset($options['enable_search']) ? 'checked' : '';
    echo '<input type="checkbox" id="enable_search" name="wp_athletes_options[enable_search]" ' . $checked . '>';
    echo '<label for="enable_search">Enable autocomplete search functionality on athlete archives.</label>';
}

add_action('admin_init', 'wp_athletes_register_settings');
