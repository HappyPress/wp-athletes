<?php
/**
 * Import and Export functionality for athletes.
 * Path: wp-athletes-plugin/includes/import-export.php
 * Description: Provides CSV import and export functionality for athlete data.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function wp_athletes_import_export_menu() {
    add_submenu_page(
        'edit.php?post_type=athlete',
        'Import/Export',
        'Import/Export',
        'manage_options',
        'wp-athletes-import-export',
        'wp_athletes_import_export_page'
    );
}
add_action('admin_menu', 'wp_athletes_import_export_menu');

function wp_athletes_import_export_page() {
    ?>
    <div class="wrap">
        <h1>Import/Export Athletes</h1>
        <h2>Import Athletes</h2>
        <form method="post" enctype="multipart/form-data" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="wp_athletes_import_csv">
            <input type="file" name="wp_athletes_import_csv" required>
            <?php submit_button('Import CSV'); ?>
        </form>

        <h2>Export Athletes</h2>
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="wp_athletes_export_csv">
            <?php submit_button('Export CSV'); ?>
        </form>
    </div>
    <?php
}

function wp_athletes_handle_import() {
    if (isset($_FILES['wp_athletes_import_csv']) && current_user_can('manage_options')) {
        // Handle CSV import logic here
        // Parse CSV, validate data, map to custom fields, and import

        // Example feedback
        wp_redirect(admin_url('edit.php?post_type=athlete&page=wp-athletes-import-export&imported=1'));
        exit;
    }
}
add_action('admin_post_wp_athletes_import_csv', 'wp_athletes_handle_import');

function wp_athletes_handle_export() {
    if (current_user_can('manage_options')) {
        // Handle CSV export logic here
        // Query athletes, format data, and export as CSV

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="athletes.csv"');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('First Name', 'Last Name', 'Profile Picture', 'Year of Birth', 'Olympic Medal Count', 'Olympic Medal Type', 'Games Participation', 'First Olympic Game'));

        $args = array('post_type' => 'athlete', 'posts_per_page' => -1);
        $athletes = new WP_Query($args);

        if ($athletes->have_posts()) {
            while ($athletes->have_posts()) {
                $athletes->the_post();
                $data = array(
                    get_field('first_name'),
                    get_field('last_name'),
                    wp_get_attachment_url(get_post_thumbnail_id()),
                    get_field('year_of_birth'),
                    get_field('olympic_medal_count'),
                    get_field('olympic_medal_type'),
                    get_field('games_participation'),
                    get_field('first_olympic_game')
                );
                fputcsv($output, $data);
            }
        }
        fclose($output);
        exit;
    }
}
add_action('admin_post_wp_athletes_export_csv', 'wp_athletes_handle_export');
