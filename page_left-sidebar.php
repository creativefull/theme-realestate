<?php
/**
 * Template Name: Left Sidebar Page
 */

get_header();
?>

<div class="mh-layout mh-top-title-offset">
    <aside class="mh-layout__sidebar-left">
        <?php get_template_part( 'templates/sidebar' ); ?>
    </aside>

    <div class="mh-layout__content-right">
        <?php
        while ( have_posts() ) : the_post();

            get_template_part( 'templates/content', 'page' );

            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile;
        ?>
    </div>

</div>
<?php get_footer();


