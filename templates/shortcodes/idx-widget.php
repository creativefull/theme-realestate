<?php
global $myhome_idx_widget;
if ( $myhome_idx_widget['class'] == 'mh-idx-widget mh-idx-widget__carousel' ) {
	?>
	<style>
		@media (min-width: 768px) {

			#<?php echo $myhome_idx_widget['id']; ?> .IDX-carouselCell {
				min-width: <?php echo $myhome_idx_widget['carousel_width']; ?>px !important;
			}
		}

        #<?php echo $myhome_idx_widget['id']; ?> .IDX-carouselContainer {
			background-color: <?php echo $myhome_idx_widget['carousel_card_bg']; ?> !important;
		}
	</style>
	<?php
} elseif ( $myhome_idx_widget['class'] == 'mh-idx-widget mh-idx-widget__map' ) {
	?>
	<script type="text/javascript" src="//d1qfrurkpai25r.cloudfront.net/graphical/javascript/leaflet.js"></script>
	<script type="text/javascript" src="//d1qfrurkpai25r.cloudfront.net/graphical/frontend/javascript/maps/plugins/leaflet.draw.js"></script>
	<script type="text/javascript" src="//www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=Gmjtd%7Cluub2h0rn0%2Crx%3Do5-lz1nh"></script>
	<link rel="stylesheet" href="//d1qfrurkpai25r.cloudfront.net/graphical/css/leaflet-1.000.css" />
	<link rel="stylesheet" href="//d1qfrurkpai25r.cloudfront.net/graphical/css/leaflet.label.css" />
	<?php
}
?>
<section id="<?php echo esc_attr( $myhome_idx_widget['id'] ); ?>" class="<?php echo esc_attr( $myhome_idx_widget['class'] ); ?>">
	<script charset="UTF-8" type="text/javascript" src="<?php echo esc_url( $myhome_idx_widget['url'] ); ?>"></script>
</section>
