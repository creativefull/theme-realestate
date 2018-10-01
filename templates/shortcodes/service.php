<?php
/* @var array $myhome_service */
global $myhome_service;
?>
<article class="mh-service <?php echo esc_attr( $myhome_service['class'] ); ?>">
	<?php if ( ! empty( $myhome_service['service_link'] ) ) : ?>
        <a href="<?php echo esc_url( $myhome_service['service_link'] ); ?>"
           title="<?php echo esc_attr( $myhome_service['title'] ); ?>"
           class="mh-service__image-wrapper">
			<?php
			if ( ! empty( $myhome_service['image_id'] ) ) :
				\MyHomeCore\Common\Image::the_image( $myhome_service['image_id'], 'standard', $myhome_service['title'] );
			else :
				echo esc_html( $myhome_service['title'] );
			endif;
			?>
        </a>
		<?php
	else :
		if ( ! empty( $myhome_service['image_id'] ) ) :
			\MyHomeCore\Common\Image::the_image( $myhome_service['image_id'], 'standard', $myhome_service['title'] );
		else :
			echo esc_html( $myhome_service['title'] );
		endif;
	endif
	?>
    <div class="mh-service__inner">
        <h3 class="mh-service__heading">
            <a href="<?php echo esc_url( $myhome_service['service_link'] ); ?>"
               title="<?php echo esc_attr( $myhome_service['title'] ); ?>">
				<?php echo esc_html( $myhome_service['title'] ); ?>
            </a>
        </h3>

        <div class="mh-service__content">
			<?php echo wp_kses_post( $myhome_service['content'] ); ?>
        </div>

		<?php if ( ! empty( $myhome_service['button_show'] ) ) : ?>
            <div class="mh-service__btn">
                <a href="<?php echo esc_url( $myhome_service['service_link'] ); ?>"
                   class="mdl-button mdl-js-button mdl-js-ripple-effect <?php echo esc_attr( $myhome_service['button_style'] ); ?>"
                   title="<?php echo esc_attr( $myhome_service['title'] ); ?>">
					<?php echo esc_html( $myhome_service['button_text'] ); ?>
                </a>
            </div>
		<?php endif; ?>

    </div>
</article>