<?php
/* @var array $myhome_simple_box */
global $myhome_simple_box;
?>
<div class="mh-simple-box-wrapper">
    <article class="mh-simple-box <?php echo esc_attr( $myhome_simple_box['class'] ); ?>">
        <div class="mh-icon-wrapper <?php echo esc_attr( $myhome_simple_box['icon_color'] ); ?>"
             style="<?php echo esc_attr( $myhome_simple_box['icon_style'] ); ?>">
            <i class="flaticon-<?php echo esc_attr( $myhome_simple_box['icon'] ); ?>"></i>
        </div>

        <div class="mh-simple-box__content">

            <h3 class="mh-simple-box__heading <?php echo esc_attr( $myhome_simple_box['title_color'] ); ?>"
                style="<?php echo esc_attr( $myhome_simple_box['heading_style'] ); ?>">
				<?php echo esc_html( $myhome_simple_box['title'] ); ?>
            </h3>

            <div class="mh-simple-box__text <?php echo esc_attr( $myhome_simple_box['text_color'] ); ?>"
                 style="<?php echo esc_attr( $myhome_simple_box['text_style'] ); ?>">
				<?php echo wp_kses_post( $myhome_simple_box['content'] ); ?>
            </div>

			<?php if ( ! empty( $myhome_simple_box['button_show'] ) ) : ?>
                <div class="mh-simple-box__btn">
                    <a href="<?php echo esc_url( $myhome_simple_box['button_url'] ); ?>"
                       title="<?php echo esc_attr( $myhome_simple_box['title'] ) ?>"
                       class="mdl-button mdl-js-button mdl-js-ripple-effect <?php echo esc_attr( $myhome_simple_box['btn_class'] ); ?>">
						<?php echo esc_html( $myhome_simple_box['button_text'] ); ?>
                    </a>
                </div>
			<?php endif; ?>
        </div>
    </article>
</div>
