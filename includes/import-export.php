<?php
// Prevent direct file access
defined('ABSPATH') or die('Direct script access disallowed.');

/**
 * Handles importing of athlete data from a CSV file.
 */

 function wp_athletes_handle_import() {
    if (isset($_FILES['wp_athletes_import_csv'])) {
        $csv_file = $_FILES['wp_athletes_import_csv']['tmp_name'];
        if (is_uploaded_file($csv_file)) {
            $file_handle = fopen($csv_file, 'r');
            while (!feof($file_handle) ) {
                $athlete_data = fgetcsv($file_handle, 1000, ',');
                // Assume CSV columns are: Name, Birth Year, Discipline, Team, Medal Count
                $args = [
                    'post_title'   => $athlete_data[0],
                    'post_status'  => 'publish',
                    'post_type'    => 'athlete',
                    'meta_input'   => [
                        'full_name'   => $athlete_data[0],
                        'birth_year'  => $athlete_data[1],
                        'discipline'  => $athlete_data[2],
                        'team'        => $athlete_data[3],
                        'medal_count' => $athlete_data[4],
                    ]
                ];
                wp_insert_post($args);
            }
            fclose($file_handle);
            echo '<div class="notice notice-success is-dismissible"><p>Import successful.</p></div>';
        }
    }
}

// Add an action to handle file uploads
add_action('admin_post_wp_athletes_import', 'wp_athletes_handle_import');

/**
 * Handles exporting athlete data to a CSV file.
 */
function wp_athletes_handle_export() {
    $args = [
        'post_type'      => 'athlete',
        'posts_per_page' => -1,
    ];
    $athletes_query = new WP_Query($args);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="athletes.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Name', 'Birth Year', 'Discipline', 'Team', 'Medal Count']);

    if ($athletes_query->have_posts()) : while ($athletes_query->have_posts()) : $athletes_query->the_post();
        fputcsv($output, [
            get_the_title(),
            get_field('birth_year'),
            get_field('discipline'),
            get_field('team'),
            get_field('medal_count')
        ]);
    endwhile; endif;
    fclose($output);
    exit;
}

// Add an action for exporting data
add_action('admin_post_wp_athletes_export', 'wp_athletes_handle_export');


// These functions would typically be tied to admin actions or specific admin pages.



