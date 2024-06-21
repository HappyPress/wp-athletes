<?php
/**
 * Single Athlete Template.
 * Path: wp-athletes-plugin/templates/single-athlete.php
 * Description: Displays detailed information about a single athlete.
 */

get_header();

while (have_posts()) : the_post(); ?>
    <div class="athlete-profile">
        <h1><?php the_title(); ?></h1>
        <div class="athlete-details">
            <div class="profile-picture">
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail('full');
                } else {
                    echo '<img src="' . esc_url(WP_ATHLETES_PLUGIN_URL . 'assets/images/default-profile.png') . '" alt="Default Profile Picture">';
                } ?>
            </div>
            <div class="athlete-info">
                <p><strong>First Name:</strong> <?php echo esc_html(get_field('first_name')); ?></p>
                <p><strong>Last Name:</strong> <?php echo esc_html(get_field('last_name')); ?></p>
                <p><strong>Year of Birth:</strong> <?php echo esc_html(get_field('year_of_birth')); ?></p>
                <p><strong>Olympic Medal Count:</strong> <?php echo esc_html(get_field('olympic_medal_count')); ?></p>
                <p><strong>Olympic Medal Type:</strong> <?php echo esc_html(get_field('olympic_medal_type')); ?></p>
                <p><strong>Games Participation:</strong> <?php echo esc_html(get_field('games_participation')); ?></p>
                <p><strong>First Olympic Game:</strong> <?php echo esc_html(get_field('first_olympic_game')); ?></p>
            </div>
        </div>
    </div>
<?php endwhile;

get_footer();
