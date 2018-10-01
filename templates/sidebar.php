<?php
if ( ! is_active_sidebar( 'mh-sidebar' ) ) {
	return;
}
?>
<div class="widget-area">
    <?php dynamic_sidebar( 'mh-sidebar' ); ?>
</div>