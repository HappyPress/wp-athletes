<?php
/**
 * Single Athlete Template.
 * Path: wp-athletes-plugin/templates/single-athlete.php
 * Description: Displays detailed information about an individual athlete, integrating custom fields and taxonomies.
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        while ( have_posts() ) : the_post();

            // Display featured image if it exists
            if ( has_post_thumbnail() ) {
                echo '<div class="athlete-featured-image">';
                the_post_thumbnail('full');
                echo '</div>';
            }

            echo '<div class="athlete-content">';
            echo '<h1 class="entry-title">' . get_the_title() . '</h1>';

            // Display custom fields associated with the athlete
            echo '<div class="athlete-details">';
            echo '<p><strong>First Name:</strong> ' . get_field('first_name') . '</p>';
            echo '<p><strong>Last Name:</strong> ' . get_field('last_name') . '</p>';
            echo '<p><strong>Year of Birth:</strong> ' . get_field('year_of_birth') . '</p>';
            echo '<p><strong>Olympic Medals:</strong> ' . get_field('olympic_medal_count') . '</p>';
            echo '<p><strong>Top Medal Type:</strong> ' . get_field('olympic_medal_type') . '</p>';
            echo '<p><strong>Games Participated:</strong> ' . get_field('games_participation') . '</p>';
            echo '</div>';

            // Display content if any
            if ( get_the_content() ) {
                echo '<div class="athlete-bio">';
                the_content();
                echo '</div>';
            }

            echo '</div>';

            // Link back to the archive page
            echo '<p><a href="' . get_post_type_archive_link('athlete') . '">Back to Athletes</a></p>';

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
