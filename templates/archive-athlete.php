<?php
/**
 * Athlete Archive Template.
 * Path: wp-athletes-plugin/templates/archive-athlete.php
 * Description: Displays a comprehensive list of athletes with search and filter options, allowing users to easily find athletes based on specific criteria.
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <!-- Include the search form from a separate template file -->
        <?php include(locate_template('athlete-search-form.php')); ?>

        <?php if ( have_posts() ) : ?>
            <header class="page-header">
                <h1 class="page-title">All Athletes</h1>
            </header>

            <div class="athlete-list">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                </a>
                            <?php endif; ?>
                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        </header>
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php the_posts_navigation(); ?>

        <?php else : ?>
            <p><?php _e('No athletes found.', 'wp-athletes-plugin'); ?></p>
        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
