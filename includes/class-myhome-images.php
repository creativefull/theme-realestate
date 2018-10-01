<?php
/*
 * My_Home_Images class
 *
 * Define all required image sizes
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'My_Home_Images' ) ) :

	class My_Home_Images {

		// prefix for image types
		private $prefix = 'myhome-';


		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'register_image_sizes' ) );
		}

		/*
		 * register_image_sizes
		 *
		 * Define image sizes
		 */
		public function register_image_sizes() {
			// standard
			add_image_size( $this->prefix . 'standard-l', 848, 530, true );
			add_image_size( $this->prefix . 'standard-m', 600, 375, true );
			add_image_size( $this->prefix . 'standard-s', 400, 250, true );
			add_image_size( $this->prefix . 'standard-xs', 224, 140, true );
			add_image_size( $this->prefix . 'standard-xxxs', 120, 75, true );

			// square
			add_image_size( $this->prefix . 'square-s', 400, 400, true );
			add_image_size( $this->prefix . 'square-xs', 200, 200, true );
			add_image_size( $this->prefix . 'square-xxxs', 100, 100, true );

			// wide
			add_image_size( $this->prefix . 'wide-m', 1440, 375, true );
			add_image_size( $this->prefix . 'wide-xs', 960, 250, true );

		}

		public function get( $thumbnail_type, $alt = '', $classes = '', $thumbnail_id = null, $wrapper = false, $echo = true ) {
			if ( $thumbnail_type == 'standard'
			     || $thumbnail_type == 'square'
			) {
				$image = $this->prefix . $thumbnail_type . '-xxxs';
			} else {
				$image = $this->prefix . $thumbnail_type;
			}

			$thumbnail_id     = is_null( $thumbnail_id ) ? get_post_thumbnail_id() : $thumbnail_id;
			$thumbnail_srcset = wp_get_attachment_image_srcset( $thumbnail_id );
			$lazy_load        = true;
			ob_start();
			$image_meta = wp_get_attachment_metadata( $thumbnail_id );

			if ( $wrapper ) {
				$wrapper_class = 'mh-thumbnail__inner';
				if ( ! isset( $image_meta['sizes'][ $image ] ) ) {
					if ( $image_meta['width'] > $image_meta['height'] ) {
						$wrapper_class .= ' mh-thumbnail__inner--horizontal';
					} elseif ( $image_meta['height'] > $image_meta['width'] ) {
						$wrapper_class .= ' mh-thumbnail__inner--vertical';
					} else {
						$wrapper_class .= ' mh-thumbnail__inner--square';
					}
					$lazy_load = false;
				}
				?>
				<div class="<?php echo esc_attr( $wrapper_class ); ?>">
			<?php }
			if ( $lazy_load ) : ?>
				<img
					data-srcset="<?php echo esc_attr( $thumbnail_srcset ); ?>"
					data-sizes="auto" class="lazyload <?php echo esc_attr( $classes ); ?>"
					style="max-width: <?php echo esc_attr( $image_meta['width'] ); ?>px"
					alt="<?php echo esc_attr( $alt ); ?>"
				>
			<?php else : ?>
				<img
					src="<?php echo esc_url( wp_get_attachment_url( $thumbnail_id ) ); ?>"
					class="<?php echo esc_attr( $classes ); ?>"
					alt="<?php echo esc_attr( $alt ); ?>"
				>
			<?php endif;

			if ( $wrapper ) { ?>
				</div>
			<?php }

			if ( $echo ) {
				echo ob_get_clean();
			} else {
				return ob_get_clean();
			}
		}

	}

endif;
