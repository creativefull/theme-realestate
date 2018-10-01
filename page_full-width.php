<?php
/**
 * Template Name: Full Width Page
 */

get_header(); ?>
<div class="mh-layout">
    <?php
    while ( have_posts() ) : the_post();

        get_template_part( 'templates/content', 'page' );

        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile;
    ?>
</div>
<?php get_footer();
