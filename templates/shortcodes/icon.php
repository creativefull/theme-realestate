<?php
/* @var array $myhome_icon */
global $myhome_icon;

if ( ! empty( $myhome_icon['shape'] ) ) : ?>

    <div class="mh-icon-wrapper <?php echo esc_attr( $myhome_icon['class'] ); ?>" style="<?php echo esc_attr( $myhome_icon['wrapper_style'] ); ?>">
        <div class="mh-icon-container <?php echo esc_attr( $myhome_icon['icon_container_class'] ); ?>"
             style="<?php echo esc_attr( $myhome_icon['icon_container_style'] ); ?>">
            <i class="flaticon-<?php echo esc_attr( $myhome_icon['icon_class'] ); ?>"
               style="<?php echo esc_attr( $myhome_icon['icon_style'] ); ?>"></i>
        </div>
    </div>

<?php else : ?>

    <div class="<?php echo esc_attr( $myhome_icon['class'] ); ?>"
         style="<?php echo esc_attr( $myhome_icon['wrapper_style'] ); ?>">
        <i class="flaticon-<?php echo esc_attr( $myhome_icon['icon_class'] ); ?>"
           style="<?php echo esc_attr( $myhome_icon['icon_style'] ); ?>"></i>
    </div>

<?php endif;