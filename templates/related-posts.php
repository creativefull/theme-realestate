<?php
$myhome_related_posts = My_Home_Theme()->layout->get_related();
if ( count( $myhome_related_posts ) ) : ?>

<div>
    <h3 class="mh-post-single__section__heading"><?php esc_html_e( 'Related posts', 'myhome' ); ?></h3>
    <div class="mh-grid">
    <?php foreach ( My_Home_Theme()->layout->get_related() as $post ) : setup_postdata( $post ); ?>

        <div class="<?php echo esc_attr( My_Home_Theme()->layout->get_related_posts_style_class() ); ?>">
            <article id="post-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class( 'mh-post-grid' ); ?>>
                <a href="<?php the_permalink(); ?>" class="mh-post-grid__thumbnail">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php My_Home_Theme()->images->get( 'standard-xxxs', get_the_title(), '', null, true ); ?>
                        <div class="mh-caption">
                            <div class="mh-caption__inner">
                                <?php echo esc_html( get_the_date( 'j' ) . '.' .get_the_date( 'm' ) . '.' . get_the_date( 'Y' ) ); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </a>
                <div class="mh-post-grid__inner">
                    <h3 class="mh-post-grid__heading">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php echo esc_html( get_the_title() ); ?>
                        </a>
                    </h3>
                    <div class="mh-post-grid__excerpt">
                        <?php echo esc_html( wp_trim_words( get_the_excerpt() , 35, esc_html__( '...', 'myhome' ) ) ); ?>
                    </div>
                    <div class="mh-post-grid__btn-wrapper">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"
                           class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary-ghost">
                            <?php echo esc_html( My_Home_Theme()->layout->get_more_text() ); ?>
                        </a>
                    </div>
                </div>
            </article>
        </div>

    <?php endforeach; wp_reset_postdata(); ?>
    </div>
</div>

<?php endif;