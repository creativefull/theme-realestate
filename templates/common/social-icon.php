<?php
global $myhome_social_icon;
if ( empty( $myhome_social_icon ) || ! $myhome_social_icon instanceof \MyHomeCore\Common\Social_Icon ) {
	return;
}

if ( $myhome_social_icon->has_link() ) :
	?>
    <a href="<?php echo esc_url( $myhome_social_icon->get_link() ); ?>"
       target="_blank">
        <i class="fa <?php echo esc_attr( $myhome_social_icon->get_css_class() ); ?>"></i>
    </a>
<?php else : ?>
    <i class="fa <?php echo esc_attr( $myhome_social_icon->get_css_class() ); ?>"></i>
	<?php
endif;
