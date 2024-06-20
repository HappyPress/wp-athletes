<?php
// Prevent direct file access
defined('ABSPATH') or die('Direct script access disallowed.');

/**
 * Define custom fields for the Athlete post type using Advanced Custom Fields (ACF).
 */
function wp_athletes_register_custom_fields() {
    if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_1',
        'title' => 'Athlete Details',
        'fields' => array(
            array(
                'key' => 'field_1',
                'label' => 'Full Name',
                'name' => 'full_name',
                'type' => 'text',
                'instructions' => 'Enter the full name of the athlete.',
                'required' => 1,
            ),
            array(
                'key' => 'field_2',
                'label' => 'Birth Year',
                'name' => 'birth_year',
                'type' => 'number',
                'instructions' => 'Enter the birth year of the athlete.',
                'required' => 1,
            ),
            array(
                'key' => 'field_3',
                'label' => 'Discipline',
                'name' => 'discipline',
                'type' => 'taxonomy',
                'taxonomy' => 'discipline',
                'field_type' => 'select',
                'allow_null' => 0,
                'add_term' => 1,
                'save_terms' => 1,
                'load_terms' => 1,
                'return_format' => 'id',
            ),
            array(
                'key' => 'field_4',
                'label' => 'Team',
                'name' => 'team',
                'type' => 'taxonomy',
                'taxonomy' => 'team',
                'field_type' => 'select',
                'allow_null' => 0,
                'add_term' => 1,
                'save_terms' => 1,
                'load_terms' => 1,
                'return_format' => 'id',
            ),
            array(
                'key' => 'field_5',
                'label' => 'Medal Count',
                'name' => 'medal_count',
                'type' => 'number',
                'instructions' => 'Enter the total number of medals won.',
                'required' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'athlete',
                ),
            ),
        ),
    ));

    endif;
}

add_action('acf/init', 'wp_athletes_register_custom_fields');
