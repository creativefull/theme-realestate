<?php
if ( ! is_active_sidebar( 'mh-sidebar-blog' ) ) {
	return;
}
?>
<div class="widget-area">
	<?php dynamic_sidebar( 'mh-sidebar-blog' ); ?>
</div>