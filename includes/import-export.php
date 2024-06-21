<?php
/**
 * Import and export functionality for WP Athletes Plugin.
 * Path: wp-athletes-plugin/includes/import-export.php
 * Description: Handles the import and export of athlete data via CSV, allowing for bulk updates and data management.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function wp_athletes_import_athletes_from_csv() {
    if (isset($_FILES['wp_athletes_csv_import']) && check_admin_referer('wp_athletes_csv_nonce', 'wp_athletes_csv_nonce')) {
        $csv = $_FILES['wp_athletes_csv_import']['tmp_name'];
        $file = fopen($csv, 'r');
        $first = true;

        while (($column = fgetcsv($file, 1000, ",")) !== FALSE) {
            if ($first) {
                $first = false; // Skip the header
                continue;
            }
            $post_id = wp_insert_post(array(
                'post_title'    => sanitize_text_field($column[0] . ' ' . $column[1]),
                'post_type'     => 'athlete',
                'post_status'   => 'publish'
            ));
            if ($post_id) {
                update_post_meta($post_id, 'first_name', sanitize_text_field($column[0]));
                update_post_meta($post_id, 'last_name', sanitize_text_field($column[1]));
                update_post_meta($post_id, 'year_of_birth', sanitize_text_field($column[2]));
                update_post_meta($post_id, 'olympic_medal_count', sanitize_text_field($column[3]));
                update_post_meta($post_id, 'olympic_medal_type', sanitize_text_field($column[4]));
                update_post_meta($post_id, 'games_participation', sanitize_text_field($column[5]));
                update_post_meta($post_id, 'first_olympic_game', sanitize_text_field($column[6]));
            }
        }
        fclose($file);
        add_action('admin_notices', 'wp_athletes_import_success_notice');
    }
}

function wp_athletes_export_athletes_to_csv() {
    $filename = 'athletes_' . date('Y-m-d') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv; ");

    $file = fopen('php://output', 'w');

    $header = array("First Name", "Last Name", "Year of Birth", "Olympic Medal Count", "Olympic Medal Type", "Games Participation", "First Olympic Game");
    fputcsv($file, $header);

    $args = array(
        'post_type' => 'athlete',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    );
    $athletes = get_posts($args);

    foreach ($athletes as $athlete) {
        $line = array(
            get_post_meta($athlete->ID, 'first_name', true),
            get_post_meta($athlete->ID, 'last_name', true),
            get_post_meta($athlete->ID, 'year_of_birth', true),
            get_post_meta($athlete->ID, 'olympic_medal_count', true),
            get_post_meta($athlete->ID, 'olympic_medal_type', true),
            get_post_meta($athlete->ID, 'games_participation', true),
            get_post_meta($athlete->ID, 'first_olympic_game', true)
        );
        fputcsv($file, $line);
    }

    fclose($file);
    exit;
}

function wp_athletes_import_success_notice() {
    echo '<div class="notice notice-success is-dismissible"><p>Import successful.</p></div>';
}

add_action('admin_post_wp_athletes_import_csv', 'wp_athletes_import_athletes_from_csv');
add_action('admin_post_wp_athletes_export_csv', 'wp_athletes_export_athletes_to_csv');
