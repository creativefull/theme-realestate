<?php
/* @var array $myhome_heading */
global $myhome_heading;
?>
<div class="<?php echo esc_attr( $myhome_heading['heading_align'] ); ?> ">
	<?php if ( ! empty( $myhome_heading['heading_image_id'] ) ) : ?>
    <div class="mh-heading-background-wrapper mh-background-cover"
         style="background-image: url('<?php echo esc_url( wp_get_attachment_url( $myhome_heading['heading_image_id'] ) ); ?>');">
		<?php endif; ?>

        <div class="mh-heading-wrapper">
            <<?php echo esc_html( $myhome_heading['heading_tag'] ); ?>
            class="mh-heading <?php echo esc_attr( $myhome_heading['class'] ); ?>"
            style="<?php echo esc_attr( $myhome_heading['style'] ); ?>">
			<?php echo esc_html( $myhome_heading['heading_text'] ); ?>
        </<?php echo esc_html( $myhome_heading['heading_tag'] ); ?>>

		<?php if ( ! empty( $myhome_heading['heading_subheading'] ) ) :
			$myhome_subheading_style = '';
			$myhome_subheading_style .= ! empty( $myhome_heading['heading_subheading_color_other'] ) ? 'color:' . $myhome_heading['heading_subheading_color']
			                                                                                           . ';' : '';
			?>
            <div class="mh-subheading <?php echo esc_attr( $myhome_heading['heading_subheading_color'] ); ?>"
                 style="<?php echo esc_attr( $myhome_subheading_style ); ?>">
				<?php echo esc_html( $myhome_heading['heading_subheading'] ); ?>
            </div>
		<?php endif; ?>
    </div>

	<?php if ( ! empty( $myhome_heading['heading_image_id'] ) ) : ?>
</div>
<?php endif; ?>
</div>