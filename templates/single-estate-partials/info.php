<?php
/* @var \MyHomeCore\Estates\Estate_Writer $myhome_estate */
global $myhome_estate;
?>
<div class="mh-estate__estate-info">
	<ul>
		<li>
			<span><?php esc_html_e( 'ID:', 'myhome' ) ?></span>
			<?php echo esc_html( $myhome_estate->get_ID() ); ?>
		</li>
		<?php if ( $myhome_estate->show_date() ) : ?>
			<li>
				<span><?php esc_html_e( 'Published:', 'myhome' ) ?></span>
				<?php echo esc_html( $myhome_estate->get_publish_date() ); ?>
			</li>
			<li>
				<span><?php esc_html_e( 'Last Update:', 'myhome' ) ?></span>
				<?php echo esc_html( $myhome_estate->get_modified_date() ); ?>
			</li>
		<?php endif; ?>
		<li>
			<span><?php esc_html_e( 'Views:', 'myhome' ) ?></span>
			<?php echo esc_html( $myhome_estate->get_views() ); ?>
		</li>
	</ul>
</div>