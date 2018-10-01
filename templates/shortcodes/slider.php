<?php
/* @var array $myhome_slider */
global $myhome_slider;
global $myhome_search;
?>

<div class="mh-rs-search mh-rs-search--middle <?php echo esc_attr( $myhome_search['class'] ); ?>">
    <style>
        #myhome-search-form-submit .mh-search--button {
            top:<?php echo esc_attr( $myhome_search['search_offset'] ); ?>px !important;
        }
        @media (max-width:778px) {
            #myhome-search-form-submit .mh-search--button {
                top: <?php echo esc_attr( $myhome_search['search_offset_mobile'] ); ?>px !important;
            }
        }
    </style>
	<?php
	if ( ! empty( $myhome_slider['slider'] ) && function_exists( 'putRevSlider' ) ) :
		putRevSlider( $myhome_slider['slider'] );
	endif;

	if ( ! empty( $myhome_slider['content'] ) ) : ?>
		<div>
			<?php echo $myhome_slider['content']; ?>
		</div>
	<?php endif; ?>
</div>

