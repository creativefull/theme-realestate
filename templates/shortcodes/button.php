<?php
/* @var stdClass $myhome_button */
global $myhome_button;
?>
<div style="<?php echo esc_attr( $myhome_button['align'] ); ?>"
     class="<?php echo esc_attr( $myhome_button['class'] ); ?>">
    <a href="<?php echo esc_url( $myhome_button['url'] ); ?>"
       class="mdl-button mdl-js-button mdl-js-ripple-effect <?php echo esc_attr( $myhome_button['style'] ); ?>"
       title="<?php echo esc_attr( $myhome_button['text'] ); ?>">
		<?php echo esc_html( $myhome_button['text'] ); ?>
    </a>
</div>