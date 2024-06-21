<?php
/**
 * Athlete Archive Template.
 * Path: wp-athletes-plugin/templates/archive-athlete.php
 * Description: Displays a list of all athletes with search and filter options.
 */

get_header(); ?>

<div class="athlete-archive">
    <h1><?php post_type_archive_title(); ?></h1>

    <?php echo do_shortcode('[athlete_search_form]'); ?>

    <?php if (have_posts()) : ?>
        <ul class="athletes-list">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p><?php _e('No athletes found.', 'wp-athletes'); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
