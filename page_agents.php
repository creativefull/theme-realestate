<?php
/**
 * Template Name: Agent Frontend Panel
 */

get_header();

if ( My_Home_Theme()->layout->is_agent_panel_enabled() ) :
	?>
	<div id="myhome-user-panel" class="mh-user-panel-wrapper">
		<user-panel
			<?php if ( is_user_logged_in() ) : ?>
				:current-user="<?php echo esc_attr( json_encode( \MyHomeCore\Users\Users_Factory::get_current()->get_data() ) ); ?>"
			<?php endif; ?>
		>
		</user-panel>
	</div>
	<?php
else :
	?>
	<div class="mh-top-title">
		<div class="mh-layout">
			<h1 class="mh-top-title__heading"><?php esc_html_e( 'Agent panel is disabled', 'myhome' ); ?></h1>
		</div>
	</div>
	<?php
endif;
get_footer();