<?php
// Import and export functionality

// Register admin post actions
add_action('admin_post_wp_athletes_import', 'wp_athletes_import');
add_action('admin_post_wp_athletes_export', 'wp_athletes_export');

/**
 * Import athletes from CSV
 */
function wp_athletes_import() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (!isset($_FILES['wp_athletes_import_csv']) || !wp_verify_nonce($_POST['_wpnonce'], 'wp_athletes_import')) {
        return;
    }

    $file = $_FILES['wp_athletes_import_csv']['tmp_name'];
    $csv_data = array_map('str_getcsv', file($file));

    if (!empty($csv_data)) {
        $headers = array_shift($csv_data);
        foreach ($csv_data as $row) {
            $athlete_data = array_combine($headers, $row);
            $post_id = wp_insert_post(array(
                'post_title' => $athlete_data['name'],
                'post_type' => 'athlete',
                'post_status' => 'publish',
            ));

            if ($post_id) {
                // Map CSV data to ACF fields
                foreach ($athlete_data as $key => $value) {
                    update_field($key, $value, $post_id);
                }
            }
        }
    }

    wp_redirect(admin_url('admin.php?page=wp_athletes&import=success'));
    exit;
}

/**
 * Export athletes to CSV
 */
function wp_athletes_export() {
    if (!current_user_can('manage_options')) {
        return;
    }

    // Fetch all athletes
    $athletes = get_posts(array(
        'post_type' => 'athlete',
        'numberposts' => -1
    ));

    if (empty($athletes)) {
        return;
    }

    // Prepare CSV headers
    $headers = array('name', 'sport', 'age', 'country'); // Add more fields as needed
    $csv_data = array($headers);

    // Prepare CSV rows
    foreach ($athletes as $athlete) {
        $athlete_data = array(
            get_the_title($athlete->ID),
            get_field('sport', $athlete->ID),
            get_field('age', $athlete->ID),
            get_field('country', $athlete->ID)
        );
        $csv_data[] = $athlete_data;
    }

    // Output CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="athletes.csv"');
    $output = fopen('php://output', 'w');
    foreach ($csv_data as $row) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}
?>
