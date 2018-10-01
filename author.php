<?php
global $myhome_agent;
$myhome_agent = \MyHomeCore\Users\User::get_user_by_id();

get_header();
get_template_part( 'templates/top-title' );

?>
	<div class="mh-layout mh-top-title-offset">
		<?php $myhome_agent->listing(); ?>
	</div>
<?php
get_footer();