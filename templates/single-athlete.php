<?php
get_header();
if (have_posts()) :
    while (have_posts()) : the_post(); ?>

        <div class="athlete-profile">
            <h1><?php the_title(); ?></h1>
            <p><strong>Sport:</strong> <?php the_field('sport'); ?></p>
            <p><strong>Age:</strong> <?php the_field('age'); ?></p>
            <p><strong>Country:</strong> <?php the_field('country'); ?></p>
            <!-- Add more fields as needed -->
        </div>

    <?php endwhile;
endif;
get_footer();
?>
