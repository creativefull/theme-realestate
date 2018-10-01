<?php

/*
 * My_Home_Compare class
 *
 * Prepare 'compare estates' module
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'My_Home_Compare' ) ) :

	class My_Home_Compare {

		/*
		 * show
		 *
		 * Setup CompareEstates module
		 */
		public function show() {
			if ( My_Home_Theme()->settings->get( 'compare' ) ) {
				ob_start();
				?>
				<div>
					<compare-area id="myhome-compare-area"></compare-area>
				</div>
				<?php
				echo ob_get_clean();
			}
		}

	}

endif;
