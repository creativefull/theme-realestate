<?php

/**
 * Class My_Home_Footer
 */
class My_Home_Footer {

	private $default_options = array(
		'has_widget_area' => true,
		'footer_style'    => 'dark',
		'has_information' => false,
		'has_logo'        => false,
		'has_text'        => false,
		'has_address'     => false,
		'has_email'       => false,
		'has_phone'       => false,
		'has_copyrights'  => false
	);

	private $footer_style;
	private $background_image;

	/**
	 * My_Home_Footer constructor.
	 */
	public function __construct() {
		if ( class_exists( 'ReduxFramework' ) ) {
			$this->footer_style = My_Home_Theme()->settings->get( 'footer-style' );
		} else {
			$this->footer_style = $this->default_options['footer_style'];
		}
		$this->background_image = My_Home_Theme()->settings->get( 'footer-background-image-url', 'url' );
	}

	/**
	 * @return string
	 */
	public function get_class() {
		$class = array();

		if ( $this->has_background_image() && $this->is_background_parallax() ) {
			$class[] = 'mh-background-fixed';
		}

		if ( $this->has_background_image() ) {
			$class[] = ' lazyload';
		}

		if ( $this->footer_style == 'dark' || $this->footer_style == 'image' ) {
			$class[] = 'mh-footer-top--dark';
		}

		return implode( ' ', $class );
	}

	/**
	 * @return string
	 */
	public function get_bottom_class() {
		$bottom_class = array();

		if ( $this->footer_style == 'image' ) {
			$bottom_class[] = 'mh-footer-bottom--transparent';
		}

		return implode( ' ', $bottom_class );
	}

	/**
	 * @return string
	 */
	public function get_style() {
		$style = '';

//		if ( $this->has_background_image() ) {
//			$style .= 'background-image:url(' . esc_url( $this->background_image ) . ');';
//		}

		return $style;
	}

	/**
	 * @return string
	 */
	public function get_background_image_id() {
		return My_Home_Theme()->settings->get( 'footer-background-image-url', 'id' );
	}

	/**
	 * @return bool
	 */
	public function has_background_image() {
		return $this->footer_style == 'image' && ! empty( $this->background_image );
	}

	/**
	 * @return bool
	 */
	public function is_background_parallax() {
		$is_background_parallax = My_Home_Theme()->settings->get( 'footer-background-image-parallax' );

		return ! empty( $is_background_parallax );
	}

	/**
	 * @return bool
	 */
	public function has_widget_area() {
		if ( ! class_exists( 'ReduxFramework' ) ) {
			return true;
		}

		$has_widget_area = My_Home_Theme()->settings->get( 'footer-widget-area-show' );

		return ! empty( $has_widget_area );
	}

	/**
	 * @return bool
	 */
	public function has_copyrights() {
		if ( ! class_exists( 'ReduxFramework' ) ) {
			return $this->default_options['has_copyrights'];
		}

		$copyrights = $this->get_copyrights();

		return ! empty( $copyrights );
	}

	/**
	 * @return string
	 */
	public function get_copyrights() {
		$copyrights = My_Home_Theme()->settings->get( 'footer-copyright-text' );

		return apply_filters(
			'wpml_translate_single_string',
			$copyrights,
			'MyHome Settings',
			'mh-footer-copyright-text'
		);
	}

	/**
	 * @return bool
	 */
	public function is_compare_enabled() {
		$is_compare_enabled = My_Home_Theme()->settings->get( 'compare' );

		return ! empty( $is_compare_enabled );
	}

	/**
	 * @return bool
	 */
	public function has_information() {
		if ( ! class_exists( 'ReduxFramework' ) ) {
			return false;
		}

		$has_information = My_Home_Theme()->settings->get( 'footer-widget-area-footer-information' );

		return ! empty( $has_information );
	}


	/**
	 * @return bool
	 */
	public function has_logo() {
		if ( ! class_exists( 'ReduxFramework' ) ) {
			return $this->default_options['has_logo'];
		}

		$footer_logo = My_Home_Theme()->settings->get( 'footer-logo', 'url' );

		return ! empty( $footer_logo );
	}

	/**
	 * @return string
	 */
	public function get_logo() {
		return My_Home_Theme()->settings->get( 'footer-logo', 'url' );
	}

	/**
	 * @return bool
	 */
	public function has_text() {
		if ( ! class_exists( 'ReduxFramework' ) ) {
			return $this->default_options['has_text'];
		}

		$text = My_Home_Theme()->settings->get( 'footer-text' );

		return ! empty( $text );
	}

	/**
	 * @return string
	 */
	public function get_text() {
		$text = My_Home_Theme()->settings->get( 'footer-text' );

		return apply_filters(
			'wpml_translate_single_string',
			$text,
			'MyHome Settings',
			'mh-footer-text'
		);
	}

	/**
	 * @return bool
	 */
	public function has_phone() {
		if ( ! class_exists( 'ReduxFramework' ) ) {
			return $this->default_options['has_phone'];
		}

		$phone = My_Home_Theme()->settings->get( 'footer-phone' );

		return ! empty( $phone );
	}

	/**
	 * @return string
	 */
	public function get_phone() {
		$phone = My_Home_Theme()->settings->get( 'footer-phone' );

		return apply_filters(
			'wpml_translate_single_string',
			$phone,
			'MyHome Settings',
			'mh-footer-phone'
		);
	}

	/**
	 * @return string
	 */
	public function get_phone_href() {
		return str_replace( array( ' ', '-', '(', ')' ), '', $this->get_phone() );
	}

	/**
	 * @return bool
	 */
	public function has_email() {
		if ( ! class_exists( 'ReduxFramework' ) ) {
			return $this->default_options['has_email'];
		}

		$email = My_Home_Theme()->settings->get( 'footer-email' );

		return ! empty( $email );
	}

	/**
	 * @return string
	 */
	public function get_email() {
		$email = My_Home_Theme()->settings->get( 'footer-email' );

		return apply_filters(
			'wpml_translate_single_string',
			$email,
			'MyHome Settings',
			'mh-footer-email'
		);
	}

	/**
	 * @return bool
	 */
	public function has_address() {
		if ( ! class_exists( 'ReduxFramework' ) ) {
			return $this->default_options['has_address'];
		}

		$address = My_Home_Theme()->settings->get( 'footer-address' );

		return ! empty( $address );
	}

	/**
	 * @return string
	 */
	public function get_address() {
		$address = My_Home_Theme()->settings->get( 'footer-address' );

		return apply_filters(
			'wpml_translate_single_string',
			$address,
			'MyHome Settings',
			'mh-footer-address'
		);
	}

	/**
	 * @return string
	 */
	public function get_widget_class() {
		return My_Home_Theme()->settings->get( 'footer-widget-area-columns' );
	}

}