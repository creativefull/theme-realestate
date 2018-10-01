<section id="post-<?php echo esc_attr( get_the_ID() ); ?>" class="mh-post"
         data-id="<?php echo esc_attr( get_the_ID() ); ?>">

    <header class="mh-post-single__header">
        <h1 class="mh-post-single__title"><?php echo esc_html( get_the_title() ); ?></h1>
        <ul class="mh-post-single__meta">
            <li>
                <?php echo esc_html( get_the_date( 'j F Y' ) ); ?>
            </li>
            <?php if ( My_Home_Theme()->layout->show_comments() ) : ?>
                <li>
                    <a href="#comments">
                        <?php My_Home_Theme()->comments->number_text(); ?>
                    </a>
                </li>
            <?php endif; ?>
            <li>
                <?php echo esc_html( get_the_author() ); ?>
            </li>
            <li>
                <span>
                    <?php esc_html_e( 'Category:', 'myhome' ); ?>
                </span>
                <?php the_category( ', ' ); ?>
            </li>
        </ul>
    </header>

    <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_post_thumbnail_url(); ?>"
           class="mh-post-single-main-image mh-popup"
           title="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail(); ?>
        </a>
    <?php endif; ?>

    <div class="post-content">
        <?php the_content(); ?>
    </div>

</section>
