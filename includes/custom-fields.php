<?php
/**
 * Register custom fields using ACF.
 * Path: wp-athletes-plugin/includes/custom-fields.php
 * Description: Sets up custom fields for the Athlete custom post type using Advanced Custom Fields (ACF).
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function wp_athletes_register_custom_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_athlete_details',
            'title' => 'Athlete Details',
            'fields' => array(
                array(
                    'key' => 'field_first_name',
                    'label' => 'First Name',
                    'name' => 'first_name',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_last_name',
                    'label' => 'Last Name',
                    'name' => 'last_name',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_profile_picture',
                    'label' => 'Profile Picture',
                    'name' => 'profile_picture',
                    'type' => 'image',
                ),
                array(
                    'key' => 'field_year_of_birth',
                    'label' => 'Year of Birth',
                    'name' => 'year_of_birth',
                    'type' => 'number',
                ),
                array(
                    'key' => 'field_olympic_medal_count',
                    'label' => 'Olympic Medal Count',
                    'name' => 'olympic_medal_count',
                    'type' => 'number',
                ),
                array(
                    'key' => 'field_olympic_medal_type',
                    'label' => 'Olympic Medal Type',
                    'name' => 'olympic_medal_type',
                    'type' => 'select',
                    'choices' => array(
                        'G' => 'Gold',
                        'S' => 'Silver',
                        'B' => 'Bronze',
                    ),
                ),
                array(
                    'key' => 'field_games_participation',
                    'label' => 'Games Participation',
                    'name' => 'games_participation',
                    'type' => 'number',
                ),
                array(
                    'key' => 'field_first_olympic_game',
                    'label' => 'First Olympic Game',
                    'name' => 'first_olympic_game',
                    'type' => 'text',
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
    }
}

add_action('acf/init', 'wp_athletes_register_custom_fields');
