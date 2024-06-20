<?php
// Prevent direct file access
defined('ABSPATH') or die('Direct script access disallowed.');

/**
 * Add admin menu item for WP Athletes plugin.
 */
function wp_athletes_add_admin_menu() {
    add_menu_page(
        'WP Athletes',
        'WP Athletes',
        'manage_options',
        'wp_athletes',
        'wp_athletes_admin_page',
        'dashicons-admin-generic',
        6
    );
}

/**
 * Display the admin page for the WP Athletes plugin.
 */
function wp_athletes_admin_page() {
    ?>
    <div class="wrap">
        <h2>WP Athletes - Import/Export Athletes</h2>
        
        <h3>Import Athletes</h3>
        <form id="wp_athletes_import_form" method="post" action="<?php echo admin_url('admin-post.php'); ?>" enctype="multipart/form-data">
            <input type="hidden" name="action" value="wp_athletes_import">
            <input type="file" name="wp_athletes_import_csv" id="wp_athletes_import_csv" required>
            <button type="submit" class="button button-primary">Import CSV</button>
        </form>
        <div id="csv_preview"></div>
        <div id="import_progress" style="display:none;">
            <h4>Importing...</h4>
            <progress id="import_progress_bar" value="0" max="100"></progress>
        </div>
        
        <h3>Export Athletes</h3>
        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
            <input type="hidden" name="action" value="wp_athletes_export">
            <button type="submit" class="button button-primary">Export to CSV</button>
        </form>
    </div>
    <?php
}


add_action('admin_menu', 'wp_athletes_add_admin_menu');
