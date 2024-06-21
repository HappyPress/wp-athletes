<?php
/**
 * Athlete Search Form Template.
 * Path: wp-athletes-plugin/templates/athlete-search-form.php
 * Description: Provides a search form for filtering athletes by team, discipline, birth year, and more, enhancing user interaction and accessibility.
 */

// Ensure this file is being included in a WordPress environment
defined('ABSPATH') or die('Direct script access disallowed.');

// Get the values from query variables to maintain state across searches
$team = get_query_var('team', '');
$discipline = get_query_var('discipline', '');
$birth_year = get_query_var('birth_year', '');

?>
<form action="<?php echo get_post_type_archive_link('athlete'); ?>" method="get" class="athlete-search-form">
    <div class="form-field">
        <label for="team">Team</label>
        <select name="team" id="team">
            <option value="">Select a Team</option>
            <?php 
            $teams = get_terms(array('taxonomy' => 'team', 'hide_empty' => false));
            foreach ($teams as $t) {
                echo '<option value="' . esc_attr($t->slug) . '"' . selected($team, $t->slug, false) . '>' . esc_html($t->name) . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-field">
        <label for="discipline">Discipline</label>
        <select name="discipline" id="discipline">
            <option value="">Select a Discipline</option>
            <?php 
            $disciplines = get_terms(array('taxonomy' => 'discipline', 'hide_empty' => false));
            foreach ($disciplines as $d) {
                echo '<option value="' . esc_attr($d->slug) . '"' . selected($discipline, $d->slug, false) . '>' . esc_html($d->name) . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-field">
        <label for="birth_year">Birth Year</label>
        <input type="number" name="birth_year" id="birth_year" value="<?php echo esc_attr($birth_year); ?>">
    </div>
    <button type="submit" class="button">Search</button>
</form>
