<?php
/**
 * Athlete List Block.
 * Path: wp-athletes-plugin/blocks/athlete-list/index.php
 * Description: Registers a Gutenberg block that lists athletes based on specific criteria such as team or discipline.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function wp_athletes_register_athlete_list_block() {
    register_block_type(__DIR__, array(
        'render_callback' => 'wp_athletes_render_athlete_list_block',
    ));
}

function wp_athletes_render_athlete_list_block($attributes, $content) {
    ob_start();
    // Example logic to fetch and display a list of athletes
    $args = array(
        'post_type' => 'athlete',
        'posts_per_page' => isset($attributes['numberOfItems']) ? $attributes['numberOfItems'] : 10,
        'tax_query' => array()
    );

    if (!empty($attributes['team'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'team',
            'field' => 'slug',
            'terms' => $attributes['team']
        );
    }

    if (!empty($attributes['discipline'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'discipline',
            'field' => 'slug',
            'terms' => $attributes['discipline']
        );
    }

    $query = new WP_Query($args);
    if ($query->have_posts()) {
        echo '<div class="athlete-list-block">';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<h4>' . get_the_title() . '</h4>';
            // Add more detailed display or links as necessary
        }
        echo '</div>';
    } else {
        echo '<p>No athletes found.</p>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}

add_action('init', 'wp_athletes_register_athlete_list_block');
