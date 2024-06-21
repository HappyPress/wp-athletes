<?php
/**
 * Discipline Taxonomy Archive Template.
 * Path: wp-athletes-plugin/templates/taxonomy-discipline.php
 * Description: Displays a list of athletes who are categorized under a specific discipline, using the discipline taxonomy.
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <header class="page-header">
            <h1 class="page-title"><?php single_term_title(); ?> Discipline</h1>
            <?php if ( term_description() ) : ?>
                <div class="taxonomy-description"><?php echo term_description(); ?></div>
            <?php endif; ?>
        </header>

        <?php if ( have_posts() ) : ?>
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
            <p><?php _e('No athletes found in this discipline.', 'wp-athletes-plugin'); ?></p>
        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
