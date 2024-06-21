<?php
/**
 * Taxonomy Archive Template for Discipline.
 * Path: wp-athletes-plugin/templates/taxonomy-discipline.php
 * Description: Displays a list of athletes categorized by discipline.
 */

get_header(); ?>

<div class="taxonomy-archive">
    <h1><?php single_term_title(); ?></h1>
    <?php if (have_posts()) : ?>
        <ul class="athletes-list">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p><?php _e('No athletes found in this discipline.', 'wp-athletes'); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
