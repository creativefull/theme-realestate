<?php
get_header();

?>
    <div class="mh-404">
        <div class="mh-404__content">
            <?php if ( class_exists( 'ReduxFramework' ) ) : ?>
                <?php if ( My_Home_Theme()->layout->has_404_heading() ) : ?>
                    <h1 class="mh-404__title">
                        <?php echo esc_html( My_Home_Theme()->layout->get_404_heading() ); ?>
                    </h1>
                <?php endif;
                if ( My_Home_Theme()->layout->has_404_text() ) : ?>
                    <div class="mh-404__text">
                        <?php echo esc_html( My_Home_Theme()->layout->get_404_text() ); ?>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <h1 class="mh-404__title"><?php esc_html_e( '404', 'myhome' ); ?></h1>
                <div class="mh-404__text"><?php esc_html_e( 'Page not found', 'myhome' ); ?></div>
            <?php endif; ?>
        </div>
    </div>
<?php

get_footer();