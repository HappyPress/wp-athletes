<?php
/**
 * Define custom fields for the Athlete post type using Advanced Custom Fields (ACF).
 * Path: wp-athletes-plugin/includes/custom-fields.php
 * Description: Configures custom fields to enrich the Athlete post type with additional information such as first and last names, Olympic medal counts, participation details, etc.
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function wp_athletes_register_custom_fields() {
    if (function_exists('acf_add_local_field_group')):

    acf_add_local_field_group(array(
        'key' => 'wp_athletes_athlete_details',
        'title' => 'Athlete Details',
        'fields' => array(
            array(
                'key' => 'wp_athletes_first_name',
                'label' => 'First Name',
                'name' => 'first_name',
                'type' => 'text',
                'instructions' => 'Enter the first name of the athlete.',
                'required' => 1,
            ),
            array(
                'key' => 'wp_athletes_last_name',
                'label' => 'Last Name',
                'name' => 'last_name',
                'type' => 'text',
                'instructions' => 'Enter the last name of the athlete.',
                'required' => 1,
            ),
            array(
                'key' => 'wp_athletes_birth_year',
                'label' => 'Year of Birth',
                'name' => 'year_of_birth',
                'type' => 'number',
                'instructions' => 'Enter the birth year of the athlete.',
                'required' => 0,
            ),
            array(
                'key' => 'wp_athletes_medal_count',
                'label' => 'Olympic Medal Count',
                'name' => 'olympic_medal_count',
                'type' => 'number',
                'instructions' => 'Enter the total number of Olympic medals won by the athlete.',
                'required' => 0,
            ),
            array(
                'key' => 'wp_athletes_medal_type',
                'label' => 'Olympic Medal Type',
                'name' => 'olympic_medal_type',
                'type' => 'select',
                'choices' => array(
                    'G' => 'Gold',
                    'S' => 'Silver',
                    'B' => 'Bronze'
                ),
                'instructions' => 'Select the highest medal type won by the athlete.',
                'required' => 0,
            ),
            array(
                'key' => 'wp_athletes_games_participation',
                'label' => 'Games Participation',
                'name' => 'games_participation',
                'type' => 'number',
                'instructions' => 'Enter the number of Olympic Games the athlete has participated in.',
                'required' => 0,
            ),
            array(
                'key' => 'wp_athletes_first_olympic',
                'label' => 'First Olympic Game',
                'name' => 'first_olympic_game',
                'type' => 'text',
                'instructions' => 'Enter the year of the first Olympic game the athlete participated in.',
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
        'options' => array(
            'position' => 'acf_after_title',
            'layout' => 'no_box',
            'hide_on_screen' => array(
                0 => 'the_content',
            ),
        ),
        'menu_order' => 0,
    ));

    endif;
}

add_action('acf/init', 'wp_athletes_register_custom_fields');
