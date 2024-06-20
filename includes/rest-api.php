<?php
// Prevent direct file access
defined('ABSPATH') or die('Direct script access disallowed.');

/**
 * Register REST API fields for the Athlete custom post type.
 */
function wp_athletes_register_rest_fields() {
    register_rest_field('athlete', 'athlete_details', [
        'get_callback'    => 'wp_athletes_get_athlete_details',
        'schema'          => null,
    ]);
}

/**
 * Callback for getting the athlete details.
 */
function wp_athletes_get_athlete_details($object, $field_name, $request) {
    return [
        'full_name'    => get_field('full_name', $object['id']),
        'birth_year'   => get_field('birth_year', $object['id']),
        'discipline'   => get_field('discipline', $object['id']),
        'team'         => get_field('team', $object['id']),
        'medal_count'  => get_field('medal_count', $object['id'])
    ];
}

add_action('rest_api_init', 'wp_athletes_register_rest_fields');
