<?php
/**
 * Template Name: Right Sidebar Page
 */

get_header(); ?>

    <div class="mh-layout mh-top-title-offset">

        <div class="mh-layout__content-left">
            <?php
            while ( have_posts() ) : the_post();

                get_template_part( 'templates/content', 'page' );

                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile;
            ?>
        </div>

        <div class="mh-layout__sidebar-right">
            <?php get_template_part( 'templates/sidebar' ); ?>
        </div>

    </div>

<?php get_footer();

