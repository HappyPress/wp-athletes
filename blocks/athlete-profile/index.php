<?php
/**
 * Athlete Profile Block.
 * Path: wp-athletes-plugin/blocks/athlete-profile/index.php
 * Description: Registers a Gutenberg block that displays detailed information about an individual athlete.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function wp_athletes_register_athlete_profile_block() {
    register_block_type(__DIR__, array(
        'render_callback' => 'wp_athletes_render_athlete_profile_block',
    ));
}

function wp_athletes_render_athlete_profile_block($attributes, $content) {
    ob_start();
    // Assume $attributes['athleteId'] is passed to the block to load specific athlete data
    $athlete_id = isset($attributes['athleteId']) ? $attributes['athleteId'] : 0;
    $athlete_post = get_post($athlete_id);

    if ($athlete_post && $athlete_post->post_type === 'athlete') {
        // Example of output, needs further implementation based on actual field setup
        echo '<div class="athlete-profile-block">';
        echo '<h3>' . get_the_title($athlete_post) . '</h3>';
        echo '<p>' . get_the_excerpt($athlete_post) . '</p>';
        echo '</div>';
    }

    return ob_get_clean();
}

add_action('init', 'wp_athletes_register_athlete_profile_block');
