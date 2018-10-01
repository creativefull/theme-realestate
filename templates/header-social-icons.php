<?php if ( My_Home_Theme()->layout->has_header_facebook() ) : ?>
    <span>
        <a href="<?php echo esc_url( My_Home_Theme()->layout->get_header_facebook() ); ?>" target="_blank">
            <i class="fa fa-facebook mh-top-header-big__element__icon-big"></i>
        </a>
    </span>
<?php endif; ?>

<?php if ( My_Home_Theme()->layout->has_header_twitter() ) : ?>
    <span>
        <a href="<?php echo esc_url( My_Home_Theme()->layout->get_header_twitter() ); ?>" target="_blank">
            <i class="fa fa-twitter mh-top-header-big__element__icon-big"></i>
        </a>
    </span>
<?php endif; ?>

<?php if ( My_Home_Theme()->layout->has_header_instagram() ) : ?>
    <span>
        <a href="<?php echo esc_url( My_Home_Theme()->layout->get_header_instagram() ); ?>" target="_blank">
            <i class="fa fa-instagram mh-top-header-big__element__icon-big"></i>
        </a>
    </span>
<?php endif; ?>

<?php if ( My_Home_Theme()->layout->has_header_linkedin() ) : ?>
    <span>
        <a href="<?php echo esc_url( My_Home_Theme()->layout->get_header_linkedin() ) ?>" target="_blank">
            <i class="fa fa-linkedin mh-top-header-big__element__icon-big"></i>
        </a>
    </span>
<?php endif; ?>