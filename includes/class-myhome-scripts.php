<?php

/*
 * My_Home_Scripts
 *
 * Enqueue js and css files
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'My_Home_Scripts' ) ) :

	class My_Home_Scripts {

		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_scripts' ) );
		}

		/*
		 * load_admin_scripts
		 *
		 * Load js and css files for admin user
		 */
		public function load_admin_scripts() {
			$assets_js = get_template_directory_uri() . '/assets/js/';
			wp_enqueue_style( 'myhome-admin', get_template_directory_uri() . '/assets/css/mh-admin.css', array(), My_Home_Theme()->version );
			wp_enqueue_style( 'myhome-animate', get_template_directory_uri() . '/assets/css/animate.min.css', array(), My_Home_Theme()->version );
			wp_enqueue_style( 'myhome-backend', get_template_directory_uri() . '/assets/css/backend.css', array(), My_Home_Theme()->version );
			wp_enqueue_style( 'myhome-font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '10.0' );
			wp_enqueue_script( 'myhome-admin', $assets_js . 'admin.js', array(
				'selectize',
				'jquery',
				'myhome-icon-picker'
			), My_Home_Theme()->version, true );

			wp_localize_script( 'myhome-admin', 'MyHomeAdmin', array(
				'disable_map_autocomplete' => esc_html__( 'Disable address autocomplete when marker position is changed (please click ENTER after typing text)', 'myhome' )
			) );

			wp_enqueue_script( 'material-admin', $assets_js . 'material.min.js', array(), My_Home_Theme()->version, true );
			wp_enqueue_script( 'lazy-sizes', get_template_directory_uri() . '/assets/js/lazysizes.min.js', array(), My_Home_Theme()->version, true );
			wp_enqueue_script( 'selectize', get_template_directory_uri() . '/assets/js/selectize.min.js', array( 'jquery' ), My_Home_Theme()->version, true );
			wp_enqueue_style( 'selectize', get_template_directory_uri() . '/assets/css/selectize.css', array(), My_Home_Theme()->version );
			wp_enqueue_style( 'myhome-icon-picker', get_template_directory_uri() . '/assets/css/icon-picker.min.css', array(), My_Home_Theme()->version );
			wp_register_script( 'myhome-icon-picker', get_template_directory_uri() . '/assets/js/icon-picker.min.js', array(), My_Home_Theme()->version );

			if ( ( strpos( $_SERVER['REQUEST_URI'], 'myhome_attributes' ) !== false ) && is_user_logged_in() ) {
				wp_enqueue_style( 'sweetalert2', get_template_directory_uri() . '/assets/css/sweetalert2.min.css', array(), My_Home_Theme()->version );

				$google_api_key = My_Home_Theme()->settings->get( 'google-api-key' );
				wp_register_script(
					'google-maps-api-admin',
					'//maps.googleapis.com/maps/api/js?libraries=places&key=' . $google_api_key,
					array( 'jquery' ),
					false,
					false
				);
				wp_enqueue_style( 'material-css', get_template_directory_uri() . '/assets/css/material.min.css', array(), My_Home_Theme()->version );
				wp_enqueue_style( 'material-icons', get_template_directory_uri() . '/assets/css/material-icon.css', array(), My_Home_Theme()->version );
				wp_enqueue_script(
					'myhome-backend', $assets_js . 'backend.js', array(
					'material-admin',
					'google-maps-api-admin',
					'myhome-icon-picker'
				), My_Home_Theme()->version, true
				);

				wp_localize_script(
					'jquery', 'MyHomePanelSettings', array(
						'translations' => \MyHomeCore\Common\Translations::get_backend(),
						'nonce'        => wp_create_nonce( 'myhome_backend_panel_' . get_current_user_id() ),
						'requestUrl'   => admin_url( 'admin-post.php' ),
						'primaryColor' => My_Home_Theme()->settings->get( 'color-primary', 'color' ),
					)
				);
			}
		}

		/*
		 * load_scripts
		 *
		 * Load all required js and css files
		 */
		public function load_scripts() {
			/*
			 * CSS Files
			 */
			wp_deregister_style( 'font-awesome' );

			$rtl_support     = My_Home_Theme()->settings->get( 'typography-rtl' );
			$css_performance = My_Home_Theme()->settings->get( 'performance_css' );
			if ( ! empty( $css_performance ) ) {
				if ( ! empty( $rtl_support ) || is_rtl() ) {
					wp_enqueue_style( 'myhome-style', get_template_directory_uri() . '/style-rtl.min.css', array(), My_Home_Theme()->version );
				} else {
					wp_enqueue_style( 'myhome-style', get_template_directory_uri() . '/style.min.css', array(), My_Home_Theme()->version );
				}
			} else {
				wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/css/normalize.css', array(), My_Home_Theme()->version );
				wp_enqueue_style( 'myhome-frontend', get_template_directory_uri() . '/assets/css/frontend.css', array(), My_Home_Theme()->version );
				wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper.min.css', array(), My_Home_Theme()->version );
				wp_enqueue_style( 'selectize', get_template_directory_uri() . '/assets/css/selectize.css', array(), My_Home_Theme()->version );
				wp_enqueue_style(
					'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), My_Home_Theme()->version
				);

				if ( ! empty( $rtl_support ) || is_rtl() ) {
					wp_enqueue_style( 'myhome-style', get_template_directory_uri() . '/style-rtl.css', array(), My_Home_Theme()->version );
					wp_enqueue_style( 'myhome-style-rtl-fix', get_template_directory_uri() . '/assets/css/rtl/fix.css', array( 'myhome-style' ), My_Home_Theme()->version );
				} else {
					wp_enqueue_style( 'myhome-style', get_stylesheet_uri(), array(), My_Home_Theme()->version );
				}
			}
			/*
			 * JS Files
			 */

			$this->load_js();

			$options = get_option( 'myhome_redux' );

			if ( is_page_template( 'page_panel.php' ) && class_exists( 'Frontend_Panel\User' ) ) {
				wp_enqueue_style( 'dropzonejs', get_template_directory_uri() . '/assets/css/dropzone.css' );
				wp_enqueue_script( 'dropzonejs', get_template_directory_uri() . '/assets/js/dropzone.js' );
				wp_add_inline_script( 'dropzonejs', 'Dropzone.autoDiscover = false;' );

				$register   = My_Home_Theme()->settings->get( 'agent-registration' );
				$active_tab = My_Home_Theme()->settings->get( 'agent-panel_active_tab' );
				if ( empty( $active_tab ) ) {
					$active_tab = 'login';
				}

				$captcha_enabled = ! empty( $options['mh-agent-captcha'] );
				if ( $captcha_enabled ) {
					wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js', array(), true );
				}

				wp_enqueue_style( 'vue-animate', get_template_directory_uri() . '/assets/css/vue-animate.min.css' );
				wp_enqueue_script( 'myhome-panel-2', get_template_directory_uri() . '/assets/js/panel2.js', array(), false, true );
				wp_localize_script( 'myhome-panel-2', 'MyHomePanel', array(
					'user'             => is_user_logged_in() ? \Frontend_Panel\User::get_current()->get_data() : 'false',
					'registration'     => ! empty( $register ) ? 'true' : 'false',
					'translations'     => \MyHomeCore\Common\Translations::get_panel(),
					'active_tab'       => $active_tab,
					'request_url'      => admin_url( 'admin-ajax.php' ),
					'nonce'            => wp_create_nonce( 'myhome_user_panel' . ( is_user_logged_in() ? '_' . get_current_user_id() : '' ) ),
					'captcha_enabled'  => $captcha_enabled,
					'captcha_site_key' => My_Home_Theme()->settings->get( 'agent_captcha_site-key' ),
				) );
			}

			if ( is_page_template( 'page_agents.php' ) ) {
				wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js', array(), true );
				wp_enqueue_style( 'dropzonejs', get_template_directory_uri() . '/assets/css/dropzone.css' );
				wp_enqueue_script( 'dropzonejs', get_template_directory_uri() . '/assets/js/dropzone.js' );
				wp_add_inline_script( 'dropzonejs', 'Dropzone.autoDiscover = false;' );
				wp_enqueue_style( 'sweetalert2', get_template_directory_uri() . '/assets/css/sweetalert2.min.css', array(), My_Home_Theme()->version );
				wp_enqueue_script( 'myhome-panel' );

				$active_tab = My_Home_Theme()->settings->get( 'agent-panel_active_tab' );
				if ( empty( $active_tab ) ) {
					$active_tab = 'login';
				}

				$register     = My_Home_Theme()->settings->get( 'agent-registration' );
				$myhome_panel = array(
					'translations'     => \MyHomeCore\Common\Translations::get_panel(),
					'nonce'            => wp_create_nonce( 'myhome_user_panel' . ( is_user_logged_in() ? '_' . get_current_user_id() : '' ) ),
					'requestUrl'       => admin_url( 'admin-ajax.php' ),
					'fields'           => \MyHomeCore\Panel\Panel_Fields::get_current(),
					'payment'          => ! empty( $options['mh-payment'] ),
					'registration'     => ! empty( $register ),
					'languages'        => ! empty( \MyHomeCore\My_Home_Core()->languages ) ? \MyHomeCore\My_Home_Core()->languages : array(),
					'current_language' => ! empty( \MyHomeCore\My_Home_Core()->current_language ) ? \MyHomeCore\My_Home_Core()->current_language : '',
					'current_url'      => get_page_link(),
					'captcha_enabled'  => ! empty( $options['mh-agent-captcha'] ),
					'captcha_site_key' => My_Home_Theme()->settings->get( 'agent_captcha_site-key' ),
					'active_tab'       => $active_tab
				);

				if ( ! empty( $options['mh-payment'] ) && ! empty( $options['mh-payment-stripe'] ) ) {
					wp_enqueue_script( 'stripe-checkout', 'https://checkout.stripe.com/checkout.js' );

					$myhome_panel['stripe'] = array(
						'name'        => get_bloginfo( 'name' ),
						'description' => esc_html__( '1 property listing', 'myhome' ),
						'key'         => $options['mh-payment-stripe-key'],
						'cost'        => empty( $options['mh-payment-stripe-cost'] ) ? '' : $options['mh-payment-stripe-cost'],
						'currency'    => $options['mh-payment-stripe-currency']
					);
				}

				if ( ! empty( $options['mh-payment'] ) && ! empty( $options['mh-payment-paypal'] ) ) {
					wp_enqueue_script( 'paypal-checkout', 'https://www.paypalobjects.com/api/checkout.js' );

					$myhome_panel['paypal'] = array(
						'name'     => get_bloginfo( 'name' ),
						'key'      => $options['mh-payment-paypal-public_key'],
						'env'      => ! empty( $options['mh-payment-paypal-sandbox'] ) ? 'sandbox' : 'production',
						'locale'   => $options['mh-payment-paypal-locale'],
						'cost'     => empty( $options['mh-payment-paypal-cost'] ) ? '' : $options['mh-payment-paypal-cost'],
						'currency' => $options['mh-payment-paypal-currency']
					);
				}

				wp_localize_script( 'myhome-panel', 'MyHomePanel', $myhome_panel );
			}

			// load default fonts if redux options are not installed
			if ( ! class_exists( 'ReduxFramework' ) ) {
				wp_enqueue_style( 'myhome-fonts', $this->fonts_url(), array(), null );
			}

			$map_style = My_Home_Theme()->settings->get( 'map-style' );
			if ( empty( $map_style ) || $map_style == 'gray' ) {
				$map_style = '[{featureType:"administrative",elementType:"labels.text.fill",stylers:[{color:"#444444"}]},{featureType:"landscape",elementType:"all",stylers:[{color:"#f2f2f2"}]},{featureType:"poi",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"road",elementType:"all",stylers:[{saturation:-100},{lightness:45}]},{featureType:"road.highway",elementType:"all",stylers:[{visibility:"simplified"}]},{featureType:"road.arterial",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"transit",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"water",elementType:"all",stylers:[{color:"#d7e1f2"},{visibility:"on"}]}]';
			} else {
				$map_style = My_Home_Theme()->settings->get( 'map-style_custom' );
				ob_start();
				if ( ! empty( $map_style ) ) :
					?>
					window.MyHomeMapStyle = <?php echo wp_kses_post( $map_style ); ?>;
				<?php
				endif;
				$map_style_script = ob_get_clean();
				wp_add_inline_script( 'myhome-main', $map_style_script );
			}

			$map_type = My_Home_Theme()->settings->get( 'map-type' );
			if ( empty( $map_type ) ) {
				$map_type = 'roadmap';
			}

			$frontend_panel   = My_Home_Theme()->settings->get( 'agent-panel' );
			$is_register_open = My_Home_Theme()->settings->get( 'agent-registration' );
			$show_date        = My_Home_Theme()->settings->get( 'estate_show_date' );
			$panel_page       = My_Home_Theme()->settings->get( 'agent-panel_page' );

			if ( ! empty( $panel_page ) ) {
				$panel_link = get_permalink( $panel_page );
			} else {
				$panel_link = My_Home_Theme()->settings->get( 'agent-panel_link' );
			}


			$settings = array(
				'site'                  => site_url(),
				'compare'               => My_Home_Theme()->settings->get( 'compare' ),
				'api'                   => site_url() . '/wp-json/myhome/v1/estates',
				'panelUrl'              => $panel_link,
				'is_register_open'      => ! empty( $is_register_open ) && ! empty( $frontend_panel ),
				'requestUrl'            => admin_url( 'admin-ajax.php' ),
				'nonce'                 => wp_create_nonce( 'myhome_user_panel' . ( is_user_logged_in() ? '_' . get_current_user_id() : '' ) ),
				'mapStyle'              => $map_style,
				'mapType'               => $map_type,
				'contact_price_label'   => class_exists( '\MyHomeCore\Attributes\Price_Attribute_Options_Page' ) ? \MyHomeCore\Attributes\Price_Attribute_Options_Page::get_default_value() : '',
				'user_bar_label'        => apply_filters( 'wpml_translate_single_string', My_Home_Theme()->settings->get( 'agent_user-bar-text' ), 'myhome-core', 'User bar login / register text' ),
				'property_link_new_tab' => class_exists( '\MyHomeCore\Estates\Estate' ) && \MyHomeCore\Estates\Estate::is_new_tab(),
				'show_date'             => ! empty( $show_date ) ? 'true' : 'false',
			);

			if ( is_user_logged_in() && class_exists( '\MyHomeCore\Users\User' ) ) {
				$settings['user'] = \MyHomeCore\Users\User::get_user_by_id( get_current_user_id() )->get_data();
			}

			if ( class_exists( '\MyHomeCore\Common\Translations' ) ) {
				$settings['translations'] = \MyHomeCore\Common\Translations::get_frontend();
			}

			wp_localize_script( 'myhome-min', 'MyHome', $settings );

			/*
			 * Inline css
			 */
			$inline_css = '';

			$dropdown_width = My_Home_Theme()->settings->get( 'menu-drop-down-width' );

			if ( empty( $dropdown_width ) ) {
				$dropdown_width = 225;
			}

			ob_start();
			?>
			@media (min-width:1023px) {
			#mega_main_menu li.default_dropdown>.mega_dropdown {
			width:<?php echo esc_attr( $dropdown_width ); ?>px !important;
			}
			}
			<?php
			$inline_css .= ob_get_clean();

			$color_primary = My_Home_Theme()->settings->get( 'color-primary' );
			if ( ! empty( $color_primary['color'] ) ) {
				$color = $this->hex2rgb( $color_primary['color'] ) . ',0.05';
				ob_start();
				?>
				.mh-active-input-primary input[type=text]:focus,
				.mh-active-input-primary input[type=text]:active,
				.mh-active-input-primary input[type=search]:focus,
				.mh-active-input-primary input[type=search]:active,
				.mh-active-input-primary input[type=email]:focus,
				.mh-active-input-primary input[type=email]:active,
				.mh-active-input-primary input[type=password]:focus,
				.mh-active-input-primary input[type=password]:active,
				.mh-active-input-primary textarea:focus,
				.mh-active-input-primary textarea:active,
				.mh-active-input-primary .mh-active-input input,
				.mh-active-input-primary .mh-active-input input,
				.myhome-body.mh-active-input-primary .mh-active-input .bootstrap-select.btn-group > .btn {
				background: rgba(<?php echo esc_html( $color ); ?>)!important;
				}
				<?php
				$inline_css .= ob_get_clean();
			}

			$top_bar = My_Home_Theme()->settings->get( 'top-header-style' );
			ob_start();
			if ( $top_bar == 'big' ) {
				$logo_height     = My_Home_Theme()->settings->get( 'logo-top-bar_height' );
				$logo_margin_top = My_Home_Theme()->settings->get( 'logo-top-bar_margin_top' );

				if ( ! empty( $logo_height ) ) :
					?>
					@media (min-width: 1024px) {
					.mh-top-header-big__logo img {
					height: <?php echo esc_html( $logo_height ); ?>px!important;
					}
					}
				<?php
				endif;

				if ( ! empty( $logo_margin_top ) ) :
					?>
					@media (min-width: 1024px) {
					.mh-top-header-big__logo img {
					margin-top: <?php echo esc_html( $logo_margin_top ); ?>px;
					}
					}
				<?php
				endif;
			} else {
				$logo_height     = My_Home_Theme()->settings->get( 'logo-height' );
				$logo_margin_top = My_Home_Theme()->settings->get( 'logo-margin_top' );

				if ( ! empty( $logo_height ) ) :
					?>
					@media (min-width:1023px) {
					html body #mega_main_menu.mh-primary .nav_logo img {
					height: <?php echo esc_html( $logo_height ); ?>px!important;
					}
					}
				<?php
				endif;

				if ( ! empty( $logo_margin_top ) ) :
					?>
					@media (min-width:1023px) {
					html body #mega_main_menu.mh-primary .nav_logo img {
					margin-top: <?php echo esc_html( $logo_margin_top ); ?>px!important;
					}
					}
				<?php
				endif;
			}
			$inline_css .= ob_get_clean();

			ob_start(); ?>

			/* Menu */
			<?php if ( isset( $options['mh-color-menu-bg-color'] ) && ! empty( $options['mh-color-menu-bg-color']['rgba'] ) && $options['mh-color-menu-bg-color']['rgba'] != 'rgba(123,42,59,1)' ) { ?>
				div:not(.mh-header--transparent) #mega_main_menu.mh-primary > .menu_holder > .mmm_fullwidth_container {
				background: <?php echo esc_html( $options['mh-color-menu-bg-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color-menu-submenu-background'] ) && ! empty( $options['mh-color-menu-submenu-background']['rgba'] ) && $options['mh-color-menu-submenu-background']['rgba'] != 'rgba(248,197,140,1)' ) { ?>
				html body #mega_main_menu.mh-primary .mega_dropdown li:not(:hover).current-menu-item > .item_link,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.default_dropdown .mega_dropdown,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.multicolumn_dropdown > .mega_dropdown,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.tabs_dropdown > .mega_dropdown,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.widgets_dropdown > .mega_dropdown,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.post_type_dropdown > .mega_dropdown,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.post_type_dropdown > .mega_dropdown > li.post_item .post_details,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.grid_dropdown > .mega_dropdown,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.grid_dropdown > .mega_dropdown > li .post_details,
				#mega_main_menu.mh-primary li.default_dropdown .mega_dropdown > li > .item_link,
				#mega_main_menu.mh-primary li.widgets_dropdown .mega_dropdown > li > .item_link,
				#mega_main_menu.mh-primary li.multicolumn_dropdown .mega_dropdown > li > .item_link,
				#mega_main_menu.mh-primary li.grid_dropdown .mega_dropdown > li > .item_link {
				background: <?php echo esc_html( $options['mh-color-menu-submenu-background']['rgba'] ); ?>!important;
				}
			<?php } ?>


			<?php if ( isset( $options['mh-color-menu-border-bottom-color'] ) && ! empty( $options['mh-color-menu-border-bottom-color']['rgba'] ) && $options['mh-color-menu-border-bottom-color']['rgba'] != 'rgba(134,221,178,1)' ) { ?>
				#mega_main_menu.mh-primary > .menu_holder > .mmm_fullwidth_container {
				border-color: <?php echo esc_html( $options['mh-color-menu-border-bottom-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color-menu-first-level-font'] ) && ! empty( $options['mh-color-menu-first-level-font']['rgba'] ) && $options['mh-color-menu-first-level-font']['rgba'] != 'rgba(229,118,97,1)' ) { ?>
				html body.myhome-body div #mega_main_menu.mh-primary > .menu_holder > .menu_inner > ul > li:hover > a:after,
				html body.myhome-body #mega_main_menu.mh-primary > .menu_holder > .menu_inner > ul > li:hover > .item_link *,
				html body.myhome-body #mega_main_menu.mh-primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link *,
				html body.myhome-body #mega_main_menu.mh-primary > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle > .mobile_button,
				html body.myhome-body #mega_main_menu.mh-primary > .menu_holder > .menu_inner > ul > li > .item_link,
				html body.myhome-body #mega_main_menu.mh-primary > .menu_holder > .menu_inner > ul > li > .item_link *,
				html body.myhome-body #mega_main_menu.mh-primary > .menu_holder > .menu_inner > ul > li > .item_link:after {
				color: <?php echo esc_html( $options['mh-color-menu-first-level-font']['rgba'] ); ?>!important;
				}
			<?php } ?>


			<?php if ( isset( $options['mh-color-menu-submit-property-button'] ) && ! empty( $options['mh-color-menu-submit-property-button']['rgba'] ) && $options['mh-color-menu-submit-property-button']['rgba'] != 'rgba(134,221,178,1)' ) { ?>
				html body #mega_main_menu.mh-primary #mh-submit-button a,
				html body.myhome-body #mega_main_menu.mh-primary #mh-submit-button a i {
				color: <?php echo esc_html( $options['mh-color-menu-submit-property-button']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color-menu-submenu-background'] ) && ! empty( $options['mh-color-menu-submenu-background']['rgba'] ) && $options['mh-color-menu-submenu-background']['rgba'] != 'rgba(248,197,140,1)' ) { ?>
				html body #mega_main_menu.mh-primary .mega_dropdown li:not(:hover).current-menu-item > .item_link,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.default_dropdown .mega_dropdown,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.multicolumn_dropdown > .mega_dropdown,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.tabs_dropdown > .mega_dropdown,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.widgets_dropdown > .mega_dropdown,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.post_type_dropdown > .mega_dropdown,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.post_type_dropdown > .mega_dropdown > li.post_item .post_details,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.grid_dropdown > .mega_dropdown,
				html body #mega_main_menu.mh-primary.dropdowns_animation-anim_4 > .menu_holder li.grid_dropdown > .mega_dropdown > li .post_details,
				#mega_main_menu.mh-primary li.default_dropdown .mega_dropdown > li > .item_link,
				#mega_main_menu.mh-primary li.widgets_dropdown .mega_dropdown > li > .item_link,
				#mega_main_menu.mh-primary li.multicolumn_dropdown .mega_dropdown > li > .item_link,
				#mega_main_menu.mh-primary li.grid_dropdown .mega_dropdown > li > .item_link {
				background: <?php echo esc_html( $options['mh-color-menu-submenu-background']['rgba'] ); ?>!important;
				}
			<?php } ?>


			<?php if ( isset( $options['mh-color-menu-submenu-color-font'] ) && ! empty( $options['mh-color-menu-submenu-color-font']['rgba'] ) && $options['mh-color-menu-submenu-color-font']['rgba'] != 'rgba(123,42,59,1)' ) { ?>
				#mega_main_menu.mh-primary .mega_dropdown > li.current-menu-item > .item_link *,
				#mega_main_menu.mh-primary li .post_details > .post_icon > i,
				#mega_main_menu.mh-primary li .mega_dropdown .item_link *,
				#mega_main_menu.mh-primary li .mega_dropdown a,
				#mega_main_menu.mh-primary li .mega_dropdown a * {
				color: <?php echo esc_html( $options['mh-color-menu-submenu-color-font']['rgba'] ); ?>!important;
				}
				#mega_main_menu.mh-primary li.default_dropdown > .mega_dropdown > .menu-item > .item_link:before {
				border-color: <?php echo esc_html( $options['mh-color-menu-submenu-color-font']['rgba'] ); ?>;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color-menu-submenu-background-hover'] ) && ! empty( $options['mh-color-menu-submenu-background-hover']['rgba'] ) && $options['mh-color-menu-submenu-background-hover']['rgba'] != 'rgba(229,118,97,1)' ) { ?>
				#mega_main_menu.mh-primary ul .mega_dropdown > li.current-menu-item > .item_link,
				#mega_main_menu.mh-primary ul .mega_dropdown > li > .item_link:focus,
				#mega_main_menu.mh-primary ul .mega_dropdown > li > .item_link:hover,
				#mega_main_menu.mh-primary ul li.post_type_dropdown > .mega_dropdown > li > .processed_image:hover {
				background: <?php echo esc_html( $options['mh-color-menu-submenu-background-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color-menu-submenu-font-hover'] ) && ! empty( $options['mh-color-menu-submenu-font-hover']['rgba'] ) && $options['mh-color-menu-submenu-font-hover']['rgba'] != 'rgba(248,231,162,1)' ) { ?>
				#mega_main_menu.mh-primary .mega_dropdown > li.current-menu-item:hover > .item_link *,
				#mega_main_menu.mh-primary .mega_dropdown > li > .item_link:focus *,
				#mega_main_menu.mh-primary .mega_dropdown > li > .item_link:hover *,
				#mega_main_menu.mh-primary li.post_type_dropdown > .mega_dropdown > li > .processed_image:hover > .cover > a > i {
				color: <?php echo esc_html( $options['mh-color-menu-submenu-font-hover']['rgba'] ); ?>!important;
				}
				#mega_main_menu.mh-primary li.default_dropdown > .mega_dropdown > .menu-item.current-menu-item > .item_link:before,
				#mega_main_menu.mh-primary li.default_dropdown > .mega_dropdown > .menu-item > .item_link:focus:before,
				#mega_main_menu.mh-primary li.default_dropdown > .mega_dropdown > .menu-item > .item_link:hover:before {
				border-color: <?php echo esc_html( $options['mh-color-menu-submenu-font-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color-menu-flyout-border'] ) && ! empty( $options['mh-color-menu-flyout-border']['rgba'] ) && $options['mh-color-menu-flyout-border']['rgba'] != 'rgba(248,231,162,1)' ) { ?>
				html body #mega_main_menu.mh-primary .mega_dropdown li .mega_dropdown {
				border-color: <?php echo esc_html( $options['mh-color-menu-flyout-border']['rgba'] ); ?>!important;
				}
			<?php } ?>

			/* General */

			<?php if ( isset( $options['mh-color__body-bg'] ) && ! empty( $options['mh-color__body-bg']['rgba'] ) ) { ?>
				body,
				.mh-rs-search #myhome-listing-grid,
				.mh-slider__extra-content #myhome-listing-grid {
				background: <?php echo esc_html( $options['mh-color__body-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__body-color'] ) && ! empty( $options['mh-color__body-color']['rgba'] ) ) { ?>
				body {
				color: <?php echo esc_html( $options['mh-color__body-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__general-separator'] ) && ! empty( $options['mh-color__general-separator']['rgba'] ) ) { ?>
				.mh-heading--bottom-separator:after {
				background: <?php echo esc_html( $options['mh-color__general-separator']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__button-ghost-primary-color'] ) && ! empty( $options['mh-color__button-ghost-primary-color']['rgba'] ) ) { ?>
				.mdl-button.mdl-button--primary-ghost {
				border-color: <?php echo esc_html( $options['mh-color__button-ghost-primary-color']['rgba'] ); ?>!important;
				color: <?php echo esc_html( $options['mh-color__button-ghost-primary-color']['rgba'] ); ?>!important;
				}
				.mdl-button.mdl-button--primary-ghost:hover,
				.mdl-button.mdl-button--primary-ghost:active,
				.mdl-button.mdl-button--primary-ghost:focus {
				background: <?php echo esc_html( $options['mh-color__button-ghost-primary-color']['rgba'] ); ?>!important;
				color: #fff!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__button-ghost-primary-color-hover'] ) && ! empty( $options['mh-color__button-ghost-primary-color-hover']['rgba'] ) ) { ?>
				.mdl-button.mdl-button--primary-ghost:hover,
				.mdl-button.mdl-button--primary-ghost:active,
				.mdl-button.mdl-button--primary-ghost:focus {
				color: <?php echo esc_html( $options['mh-color__button-ghost-primary-color-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__button-primary-background'] ) && ! empty( $options['mh-color__button-primary-background']['rgba'] ) ) { ?>
				.mdl-button.mdl-button--primary {
				background: <?php echo esc_html( $options['mh-color__button-primary-background']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__button-primary-color'] ) && ! empty( $options['mh-color__button-primary-color']['rgba'] ) ) { ?>
				.mdl-button.mdl-button--primary {
				color: <?php echo esc_html( $options['mh-color__button-primary-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__owl-carousel-dot-active'] ) && ! empty( $options['mh-color__owl-carousel-dot-active']['rgba'] ) ) { ?>
				.owl-dots .owl-dot.active span {
				background: <?php echo esc_html( $options['mh-color__owl-carousel-dot-active']['rgba'] ); ?>!important;
				border-color: transparent!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__owl-carousel-dot'] ) && ! empty( $options['mh-color__owl-carousel-dot']['rgba'] ) ) { ?>
				.owl-dots .owl-dot span {
				background: <?php echo esc_html( $options['mh-color__owl-carousel-dot']['rgba'] ); ?>!important;
				border-color: transparent!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__slider-price-bg'] ) && ! empty( $options['mh-color__slider-price-bg']['rgba'] ) ) { ?>
				.mh-slider__card-default__price,
				.mh-slider__card-short__price {
				background: <?php echo esc_html( $options['mh-color__slider-price-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__slider-price-font'] ) && ! empty( $options['mh-color__slider-price-font']['rgba'] ) ) { ?>
				.mh-slider__card-default__price,
				.mh-slider__card-short__price {
				color: <?php echo esc_html( $options['mh-color__slider-price-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__slider-bg'] ) && ! empty( $options['mh-color__slider-bg']['rgba'] ) ) { ?>
				.mh-slider__card-default,
				.mh-slider__card-short {
				background: <?php echo esc_html( $options['mh-color__slider-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__slider-heading'] ) && ! empty( $options['mh-color__slider-heading']['rgba'] ) ) { ?>
				.mh-slider__card-default__heading,
				.mh-slider__card-short__heading {
				color: <?php echo esc_html( $options['mh-color__slider-heading']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__arrows-bg'] ) && ! empty( $options['mh-color__arrows-bg']['rgba'] ) ) { ?>
				#estate_slider_card .tparrows,
				#estate_slider_card_short .tparrows,
				#mh_rev_slider_single .tparrows,
				#mh_rev_gallery_single .tparrows,
				.mfp-arrow:after {
				background: <?php echo esc_html( $options['mh-color__arrows-bg']['rgba'] ); ?>!important;
				}
				.mfp-arrow {
				opacity:1!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__arrows-bg-hover'] ) && ! empty( $options['mh-color__arrows-bg-hover']['rgba'] ) ) { ?>
				#estate_slider_card .tparrows:hover:before,
				#estate_slider_card_short .tparrows:hover:before,
				#mh_rev_slider_single .tparrows:hover:before,
				#mh_rev_gallery_single .tparrows:hover:before,
				.mfp-arrow:hover:after {
				background: <?php echo esc_html( $options['mh-color__arrows-bg-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__arrows-color'] ) && ! empty( $options['mh-color__arrows-color']['rgba'] ) ) { ?>
				#estate_slider_card .tparrows:before,
				#estate_slider_card_short .tparrows:before,
				#mh_rev_slider_single .tparrows:before,
				#mh_rev_gallery_single .tparrows:before,
				.mfp-arrow:after {
				color: <?php echo esc_html( $options['mh-color__arrows-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__arrows-color-hover'] ) && ! empty( $options['mh-color__arrows-color-hover']['rgba'] ) ) { ?>
				#estate_slider_card .tparrows:hover:before,
				#estate_slider_card_short .tparrows:hover:before,
				#mh_rev_slider_single .tparrows:hover:before,
				#mh_rev_gallery_single .tparrows:hover:before,
				.mfp-arrow:hover:after {
				color: <?php echo esc_html( $options['mh-color__arrows-color-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__img-popup-close'] ) && ! empty( $options['mh-color__img-popup-close']['rgba'] ) ) { ?>
				.mfp-image-holder .mfp-close, .mfp-iframe-holder .mfp-close {
				color: <?php echo esc_html( $options['mh-color__img-popup-close']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__img-popup-counter'] ) && ! empty( $options['mh-color__img-popup-counter']['rgba'] ) ) { ?>
				.mfp-counter {
				color: <?php echo esc_html( $options['mh-color__img-popup-counter']['rgba'] ); ?>!important;
				}
			<?php } ?>


			/* Top Bar */
			<?php if ( isset( $options['mh-color__mh-top-header-bg'] ) && ! empty( $options['mh-color__mh-top-header-bg']['rgba'] ) ) { ?>
				.mh-top-header,
				.mh-top-header-big,
				.mh-top-header--primary .mh-top-bar-user-panel__user-info {
				background: <?php echo esc_html( $options['mh-color__mh-top-header-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-top-header-border'] ) && ! empty( $options['mh-color__mh-top-header-border']['rgba'] ) ) { ?>
				.mh-top-header {
				border-color: <?php echo esc_html( $options['mh-color__mh-top-header-border']['rgba'] ); ?>!important;
				}
				.mh-top-header-big {
				border-bottom: 1px solid <?php echo esc_html( $options['mh-color__mh-top-header-border']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-top-header-font'] ) && ! empty( $options['mh-color__mh-top-header-font']['rgba'] ) ) { ?>
				.mh-top-header,
				.mh-top-header-big__value,
				.mh-top-header-big__element .mh-top-header-big__element__icon-big,
				.mh-top-header-big__social-icons a {
				color: <?php echo esc_html( $options['mh-color__mh-top-header-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-top-header-font'] ) && ! empty( $options['mh-color__mh-top-header-font']['rgba'] ) ) { ?>
				.mh-top-header .mh-top-header__element--phone a,
				.mh-top-header .mh-top-header__element--mail a,
				.mh-top-header .mh-top-header__element--social-icons a,
				.mh-top-bar-user-panel__main-link {
				color: <?php echo esc_html( $options['mh-color__mh-top-header-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-top-header-separator'] ) && ! empty( $options['mh-color__mh-top-header-separator']['rgba'] ) ) { ?>
				.mh-top-header__element:after,
				.mh-top-header .mh-top-bar-user-panel__main-link:before {
				background: <?php echo esc_html( $options['mh-color__mh-top-header-separator']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__top-bar-panel-bg'] ) && ! empty( $options['mh-color__top-bar-panel-bg']['rgba'] ) ) { ?>
				.mh-top-bar-user-panel__user-menu a,
				.mh-top-bar-user-panel__user-menu button {
				background: <?php echo esc_html( $options['mh-color__top-bar-panel-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__top-bar-panel-font'] ) && ! empty( $options['mh-color__top-bar-panel-font']['rgba'] ) ) { ?>
				.mh-top-bar-user-panel__user-menu a,
				.mh-top-bar-user-panel__user-menu button {
				color: <?php echo esc_html( $options['mh-color__top-bar-panel-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__top-bar-panel-bg-hover'] ) && ! empty( $options['mh-color__top-bar-panel-bg-hover']['rgba'] ) ) { ?>
				.mh-top-bar-user-panel__user-menu a:hover,
				.mh-top-bar-user-panel__user-menu button:hover{
				background: <?php echo esc_html( $options['mh-color__top-bar-panel-bg-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__top-bar-panel-font-hover'] ) && ! empty( $options['mh-color__top-bar-panel-font-hover']['rgba'] ) ) { ?>
				.mh-top-bar-user-panel__user-menu a:hover,
				.mh-top-bar-user-panel__user-menu button:hover {
				color: <?php echo esc_html( $options['mh-color__top-bar-panel-font-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			/* Footer */
			<?php if ( isset( $options['mh-color__mh-footer-bg'] ) && ! empty( $options['mh-color__mh-footer-bg']['rgba'] ) ) { ?>
				.mh-footer-top {
				background: <?php echo esc_html( $options['mh-color__mh-footer-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-footer-color'] ) && ! empty( $options['mh-color__mh-footer-color']['rgba'] ) ) { ?>
				.mh-footer-top,
				.mh-footer-top .calendar_wrap table caption,
				.mh-footer-top .recentcomments .comment-author-link,
				.mh-footer-top .recentcomments a,
				.mh-footer-top .mh-footer__text,
				.mh-footer-top mh-footer__contact,
				.mh-footer-top .mh-footer__contact a,
				.mh-footer-top .widget_pages ul li a,
				.mh-footer-top .widget_meta ul li a,
				.mh-footer-top .widget_recent_entries ul li a,
				.mh-footer-top .widget_nav_menu ul li a,
				.mh-footer-top .widget_categories ul li a,
				.mh-footer-top .rsswidget,
				.mh-footer-top .calendar_wrap table tfoot a,
				.mh-footer-top .widget_archive ul li a {
				color: <?php echo esc_html( $options['mh-color__mh-footer-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-footer-widgets-border'] ) && ! empty( $options['mh-color__mh-footer-widgets-border']['rgba'] ) ) { ?>
				.mh-footer-top .widget_pages ul li a,
				.mh-footer-top .widget_meta ul li a,
				.mh-footer-top .widget_recent_entries ul li a,
				.mh-footer-top .widget_nav_menu ul li a,
				.mh-footer-top .widget_categories ul li a,
				.mh-footer-top .widget_archive ul li a,
				.mh-footer-top .widget_rss > ul > li,
				.mh-footer-top .recentcomments {
				border-color: <?php echo esc_html( $options['mh-color__mh-footer-widgets-border']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-footer-widgets-border'] ) && ! empty( $options['mh-color__mh-footer-widgets-border']['rgba'] ) ) { ?>
				.mh-footer-top .mh-menu ul li a:before,
				.mh-footer-top .widget_pages ul li a:before,
				.mh-footer-top .widget_meta ul li a:before,
				.mh-footer-top .widget_recent_entries ul li a:before,
				.mh-footer-top .widget_nav_menu ul li a:before,
				.mh-footer-top .widget_categories ul li a:before,
				.mh-footer-top .widget_archive ul li a:before {
				background: <?php echo esc_html( $options['mh-color__mh-footer-widgets-border']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-footer-tag-color'] ) && ! empty( $options['mh-color__mh-footer-tag-color']['rgba'] ) ) { ?>
				.mh-footer-top .tagcloud a {
				color: <?php echo esc_html( $options['mh-color__mh-footer-tag-color']['rgba'] ); ?>!important;
				border-color: <?php echo esc_html( $options['mh-color__mh-footer-tag-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-footer-tag-color'] ) && ! empty( $options['mh-color__mh-footer-tag-color']['rgba'] ) ) { ?>
				.mh-footer-top .tagcloud a:hover,
				.mh-footer-top .tagcloud a:active,
				.mh-footer-top .tagcloud a:focus {
				background: <?php echo esc_html( $options['mh-color__mh-footer-tag-color']['rgba'] ); ?>!important;
				color: #fff!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-footer-col-heading-color'] ) && ! empty( $options['mh-color__mh-footer-col-heading-color']['rgba'] ) ) { ?>
				.mh-footer__heading,
				.mh-footer__heading a {
				color: <?php echo esc_html( $options['mh-color__mh-footer-col-heading-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-footer-bottom-bg'] ) && ! empty( $options['mh-color__mh-footer-bottom-bg']['rgba'] ) ) { ?>
				.mh-footer-bottom {
				background: <?php echo esc_html( $options['mh-color__mh-footer-bottom-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-footer-bottom-color'] ) && ! empty( $options['mh-color__mh-footer-bottom-color']['rgba'] ) ) { ?>
				.mh-footer-bottom {
				color: <?php echo esc_html( $options['mh-color__mh-footer-bottom-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-footer-bottom-color'] ) && ! empty( $options['mh-color__mh-footer-bottom-color']['rgba'] ) ) { ?>
				.mh-footer-bottom a {
				color: <?php echo esc_html( $options['mh-color__mh-footer-bottom-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-footer-social-bg'] ) && ! empty( $options['mh-color__mh-footer-social-bg']['rgba'] ) ) { ?>
				.mh-footer-top .mh-social-icon {
				background: <?php echo esc_html( $options['mh-color__mh-footer-social-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-footer-social-border'] ) && ! empty( $options['mh-color__mh-footer-social-border']['rgba'] ) ) { ?>
				.mh-footer-top .mh-social-icon:after {
				border-color: <?php echo esc_html( $options['mh-color__mh-footer-social-border']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-footer-social-font'] ) && ! empty( $options['mh-color__mh-footer-social-font']['rgba'] ) ) { ?>
				.mh-footer-top .mh-social-icon i {
				color: <?php echo esc_html( $options['mh-color__mh-footer-social-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-footer-social-bg-hover'] ) && ! empty( $options['mh-color__mh-footer-social-bg-hover']['rgba'] ) ) { ?>
				.mh-footer-top .mh-social-icon:hover {
				background: <?php echo esc_html( $options['mh-color__mh-footer-social-bg-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-footer-social-border-hover'] ) && ! empty( $options['mh-color__mh-footer-social-border-hover']['rgba'] ) ) { ?>
				.mh-footer-top .mh-social-icon:hover:after {
				border-color: <?php echo esc_html( $options['mh-color__mh-footer-social-border-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-footer-social-font-hover'] ) && ! empty( $options['mh-color__mh-footer-social-font-hover']['rgba'] ) ) { ?>
				.mh-footer-top .mh-social-icon:hover i {
				color: <?php echo esc_html( $options['mh-color__mh-footer-social-font-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			/* Top Title */
			<?php if ( isset( $options['mh-color__mh-page-title-bg'] ) && ! empty( $options['mh-color__mh-page-title-bg']['rgba'] ) ) { ?>
				.mh-top-title {
				background-color: <?php echo esc_html( $options['mh-color__mh-page-title-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-page-title-heading-color'] ) && ! empty( $options['mh-color__mh-page-title-heading-color']['rgba'] ) ) { ?>
				.mh-top-title h1 {
				color: <?php echo esc_html( $options['mh-color__mh-page-title-heading-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-page-title-other-color'] ) && ! empty( $options['mh-color__mh-page-title-other-color']['rgba'] ) ) { ?>
				.mh-top-title * {
				color: <?php echo esc_html( $options['mh-color__mh-page-title-other-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			/* Breadcrumbs */
			<?php if ( isset( $options['mh-color__breadcrumbs-bg'] ) && ! empty( $options['mh-color__breadcrumbs-bg']['rgba'] ) ) { ?>
				.mh-breadcrumbs-wrapper {
				background: <?php echo esc_html( $options['mh-color__breadcrumbs-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__breadcrumbs-color'] ) && ! empty( $options['mh-color__breadcrumbs-color']['rgba'] ) ) { ?>
				.mh-breadcrumbs-wrapper {
				color: <?php echo esc_html( $options['mh-color__breadcrumbs-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__breadcrumbs-border'] ) && ! empty( $options['mh-color__breadcrumbs-border']['rgba'] ) ) { ?>
				.mh-breadcrumbs-wrapper {
				border-color: <?php echo esc_html( $options['mh-color__breadcrumbs-border']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__breadcrumbs-link-color'] ) && ! empty( $options['mh-color__breadcrumbs-link-color']['rgba'] ) ) { ?>
				.mh-breadcrumbs-wrapper a {
				color: <?php echo esc_html( $options['mh-color__breadcrumbs-link-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__breadcrumbs-separator-color'] ) && ! empty( $options['mh-color__breadcrumbs-separator-color']['rgba'] ) ) { ?>
				.mh-breadcrumbs-wrapper i {
				color: <?php echo esc_html( $options['mh-color__breadcrumbs-separator-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__breadcrumbs-separator-color'] ) && ! empty( $options['mh-color__breadcrumbs-separator-color']['rgba'] ) ) { ?>
				.mh-breadcrumbs__back:after {
				background: <?php echo esc_html( $options['mh-color__breadcrumbs-separator-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			/* Single Property Page */
			<?php if ( isset( $options['mh-color__single-property-page-bg'] ) && ! empty( $options['mh-color__single-property-page-bg']['rgba'] ) ) { ?>
				.single-estate article[id*="post-"] {
				background: <?php echo esc_html( $options['mh-color__single-property-page-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__single-property-page-section-bg'] ) && ! empty( $options['mh-color__single-property-page-section-bg']['rgba'] ) ) { ?>
				.mh-estate__section {
				background: <?php echo esc_html( $options['mh-color__single-property-page-section-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__single-property-page-heading-color'] ) && ! empty( $options['mh-color__single-property-page-heading-color']['rgba'] ) ) { ?>
				.mh-estate__section__heading {
				color: <?php echo esc_html( $options['mh-color__single-property-page-heading-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__single-property-page-heading-sep'] ) && ! empty( $options['mh-color__single-property-page-heading-sep']['rgba'] ) ) { ?>
				.mh-estate__section__heading:after {
				background: <?php echo esc_html( $options['mh-color__single-property-page-heading-sep']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__single-property-page-dot'] ) && ! empty( $options['mh-color__single-property-page-dot']['rgba'] ) ) { ?>
				.mh-estate__list__element--dot:before {
				background: <?php echo esc_html( $options['mh-color__single-property-page-dot']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__single-property-price-bg'] ) && ! empty( $options['mh-color__single-property-price-bg']['rgba'] ) ) { ?>
				.mh-estate__details__price {
				background: <?php echo esc_html( $options['mh-color__single-property-price-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__single-property-price-color'] ) && ! empty( $options['mh-color__single-property-price-color']['rgba'] ) ) { ?>
				.mh-estate__details__price {
				color: <?php echo esc_html( $options['mh-color__single-property-price-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__single-property-details-bg'] ) && ! empty( $options['mh-color__single-property-details-bg']['rgba'] ) ) { ?>
				.mh-estate__details__map,
				.mh-estate__details__phone {
				background: <?php echo esc_html( $options['mh-color__single-property-details-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__single-property-details-color'] ) && ! empty( $options['mh-color__single-property-details-color']['rgba'] ) ) { ?>
				.mh-estate__details__map a,
				.mh-estate__details__phone a {
				color: <?php echo esc_html( $options['mh-color__single-property-details-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__property-card-heading-color'] ) && ! empty( $options['mh-color__property-card-heading-color']['rgba'] ) ) { ?>
				.mh-estate-vertical__heading,
				.mh-estate-vertical__heading a {
				color: <?php echo esc_html( $options['mh-color__property-card-heading-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__single-property-sidebar-heading-color'] ) && ! empty( $options['mh-color__single-property-sidebar-heading-color']['rgba'] ) ) { ?>
				.mh-widget-title__text,
				.mh-widget-title__text a {
				color: <?php echo esc_html( $options['mh-color__single-property-sidebar-heading-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__single-property-sidebar-heading-sep'] ) && ! empty( $options['mh-color__single-property-sidebar-heading-sep']['rgba'] ) ) { ?>
				.mh-widget-title__text:before {
				background: <?php echo esc_html( $options['mh-color__single-property-sidebar-heading-sep']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__single-property-contact-send-bg'] ) && ! empty( $options['mh-color__single-property-contact-send-bg']['rgba'] ) ) { ?>
				.single-estate .mh-form-container .mdl-button--primary,
				.single-estate .wpcf7-form .wpcf7-form-control.wpcf7-submit {
				background: <?php echo esc_html( $options['mh-color__single-property-contact-send-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__single-property-contact-send-font'] ) && ! empty( $options['mh-color__single-property-contact-send-font']['rgba'] ) ) { ?>
				.single-estate .mh-form-container .mdl-button--primary,
				.single-estate .wpcf7-form .wpcf7-form-control.wpcf7-submit {
				color:<?php echo esc_html( $options['mh-color__single-property-contact-send-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			/* Property card */
			<?php if ( isset( $options['mh-color__property-card-background'] ) && ! empty( $options['mh-color__property-card-background']['rgba'] ) ) { ?>
				.mh-estate-vertical,
				.mh-estate-horizontal {
				background: <?php echo esc_html( $options['mh-color__property-card-background']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__property-card-address-color'] ) && ! empty( $options['mh-color__property-card-address-color']['rgba'] ) ) { ?>
				.mh-estate-vertical__heading,
				.mh-estate-horizontal__heading {
				color: <?php echo esc_html( $options['mh-color__property-card-address-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__property-card-address-color'] ) && ! empty( $options['mh-color__property-card-address-color']['rgba'] ) ) { ?>
				.mh-estate-vertical__subheading,
				.mh-estate-horizontal__subheading {
				color: <?php echo esc_html( $options['mh-color__property-card-address-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__property-card-price-color'] ) && ! empty( $options['mh-color__property-card-price-color']['rgba'] ) ) { ?>
				.mh-estate-vertical__primary div,
                .mh-estate-horizontal__primary div {
				color: <?php echo esc_html( $options['mh-color__property-card-price-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__property-card-info-color'] ) && ! empty( $options['mh-color__property-card-info-color']['rgba'] ) ) { ?>
				.mh-estate-vertical__more-info,
				.mh-estate-horizontal__more-info {
				color: <?php echo esc_html( $options['mh-color__property-card-info-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__property-card-date-color'] ) && ! empty( $options['mh-color__property-card-date-color']['rgba'] ) ) { ?>
				.mh-estate-vertical__date,
				.mh-estate-horizontal__date {
				color: <?php echo esc_html( $options['mh-color__property-card-date-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__details-button-ghost-primary-color'] ) && ! empty( $options['mh-color__details-button-ghost-primary-color']['rgba'] ) ) { ?>
				.mh-estate-vertical .mdl-button.mdl-button--primary-ghost,
				.mh-estate-horizontal .mdl-button.mdl-button--primary-ghost {
				border-color: <?php echo esc_html( $options['mh-color__details-button-ghost-primary-color']['rgba'] ); ?>!important;
				color: <?php echo esc_html( $options['mh-color__details-button-ghost-primary-color']['rgba'] ); ?>!important;
				}
				.mh-estate-vertical .mdl-button.mdl-button--primary-ghost:hover,
				.mh-estate-vertical .mdl-button.mdl-button--primary-ghost:active,
				.mh-estate-vertical .mdl-button.mdl-button--primary-ghost:focus,
				.mh-estate-horizontal .mdl-button.mdl-button--primary-ghost:hover,
				.mh-estate-horizontal .mdl-button.mdl-button--primary-ghost:active,
				.mh-estate-horizontal .mdl-button.mdl-button--primary-ghost:focus{
				background: <?php echo esc_html( $options['mh-color__details-button-ghost-primary-color']['rgba'] ); ?>!important;
				color: #fff!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__details-button-ghost-primary-color-hover'] ) && ! empty( $options['mh-color__details-button-ghost-primary-color-hover']['rgba'] ) ) { ?>
				.mh-estate-vertical .mdl-button.mdl-button--primary-ghost:hover,
				.mh-estate-vertical .mdl-button.mdl-button--primary-ghost:active,
				.mh-estate-vertical .mdl-button.mdl-button--primary-ghost:focus,
				.mh-estate-horizontal .mdl-button.mdl-button--primary-ghost:hover,
				.mh-estate-horizontal .mdl-button.mdl-button--primary-ghost:active,
				.mh-estate-horizontal .mdl-button.mdl-button--primary-ghost:focus{
				color: <?php echo esc_html( $options['mh-color__details-button-ghost-primary-color-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__property-card-compare-color'] ) && ! empty( $options['mh-color__property-card-compare-color']['rgba'] ) ) { ?>
				.mh-estate-vertical__buttons__single .mdl-button:not(.mdl-button--primary-ghost),
				.mh-estate-horizontal__buttons__single .mdl-button:not(.mdl-button--primary-ghost) {
				color: <?php echo esc_html( $options['mh-color__property-card-compare-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__property-card-compare-active-background'] ) && ! empty( $options['mh-color__property-card-compare-active-background']['rgba'] ) ) { ?>
				.myhome-body .mdl-button.mdl-button--compare-active {
				background: <?php echo esc_html( $options['mh-color__property-card-compare-active-background']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__property-card-compare-active-color'] ) && ! empty( $options['mh-color__property-card-compare-active-color']['rgba'] ) ) { ?>
				.myhome-body .mdl-button.mdl-button--compare-active {
				color: <?php echo esc_html( $options['mh-color__property-card-compare-active-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__compare-column-separators'] ) && ! empty( $options['mh-color__compare-column-separators']['rgba'] ) ) { ?>
				.mh-compare__title:after,
				.mh-compare__heading__text:after {
				background: <?php echo esc_html( $options['mh-color__compare-column-separators']['rgba'] ); ?>!important;
				}
				.mh-compare__date {
				border-color: <?php echo esc_html( $options['mh-color__compare-column-separators']['rgba'] ); ?>!important;
				}
			<?php } ?>

			/* Search Form */
			<?php if ( isset( $options['mh-color__filters-bg'] ) && ! empty( $options['mh-color__filters-bg']['rgba'] ) ) { ?>
				.mh-filters {
				background: <?php echo esc_html( $options['mh-color__filters-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__filters-sort-by-label'] ) && ! empty( $options['mh-color__filters-sort-by-label']['rgba'] ) ) { ?>
				.mh-filters {
				color: <?php echo esc_html( $options['mh-color__filters-sort-by-label']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__filters-sort'] ) && ! empty( $options['mh-color__filters-sort']['rgba'] ) ) { ?>
				.mh-filters__button {
				color: <?php echo esc_html( $options['mh-color__filters-sort']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__filters-sort-active'] ) && ! empty( $options['mh-color__filters-sort-active']['rgba'] ) ) { ?>
				.mh-filters__buttons .mh-filters__button.mh-filters__button--active {
				color: <?php echo esc_html( $options['mh-color__filters-sort-active']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__filters-grid-icon'] ) && ! empty( $options['mh-color__filters-grid-icon']['rgba'] ) ) { ?>
				.mh-filters__right button:not(.mh-filters__right__button--active) {
				color: <?php echo esc_html( $options['mh-color__filters-grid-icon']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__filters-grid-icon-active'] ) && ! empty( $options['mh-color__filters-grid-icon-active']['rgba'] ) ) { ?>
				.mh-filters__right button.mh-filters__right__button--active {
				color: <?php echo esc_html( $options['mh-color__filters-grid-icon-active']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__search-results'] ) && ! empty( $options['mh-color__search-results']['rgba'] ) ) { ?>
				.mh-search__results,
				.mh-search__end {
				color: <?php echo esc_html( $options['mh-color__search-results']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__search-horizontal-background'] ) && ! empty( $options['mh-color__search-horizontal-background']['rgba'] ) ) { ?>
				.mh-search-horizontal {
				background: <?php echo esc_html( $options['mh-color__search-horizontal-background']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__search-horizontal-border'] ) && ! empty( $options['mh-color__search-horizontal-border']['rgba'] ) ) { ?>
				.mh-search-horizontal {
				border-color: <?php echo esc_html( $options['mh-color__search-horizontal-border']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__search-horizontal-label'] ) && ! empty( $options['mh-color__search-horizontal-label']['rgba'] ) ) { ?>
				.mh-search-horizontal .mh-search__label {
				color: <?php echo esc_html( $options['mh-color__search-horizontal-label']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__search-load-more-color'] ) && ! empty( $options['mh-color__search-load-more-color']['rgba'] ) ) { ?>
				.mh-search__more .mdl-button {
				background: <?php echo esc_html( $options['mh-color__search-load-more-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__search-load-more-background'] ) && ! empty( $options['mh-color__search-load-more-background']['rgba'] ) ) { ?>
				.mh-search__more .mdl-button {
				color: <?php echo esc_html( $options['mh-color__search-load-more-background']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__search-vertical-label'] ) && ! empty( $options['mh-color__search-vertical-label']['rgba'] ) ) { ?>
				#myhome-listing-grid .mh-layout__sidebar-left .mh-search__label,
				#myhome-listing-grid .mh-layout__sidebar-right .mh-search__label {
				color: <?php echo esc_html( $options['mh-color__search-vertical-label']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__search-horizontal-button-advanced'] ) && ! empty( $options['mh-color__search-horizontal-button-advanced']['rgba'] ) ) { ?>
				.mh-search-horizontal .mh-search__buttons .mdl-button--advanced {
				background: <?php echo esc_html( $options['mh-color__search-horizontal-button-advanced']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__search-horizontal-button-advanced'] ) && ! empty( $options['mh-color__search-horizontal-button-advanced']['rgba'] ) ) { ?>
				.mh-search-horizontal .mh-search__buttons .mdl-button--advanced {
				background: <?php echo esc_html( $options['mh-color__search-horizontal-button-advanced']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__search-horizontal-button-advanced-font'] ) && ! empty( $options['mh-color__search-horizontal-button-advanced-font']['rgba'] ) ) { ?>
				.mh-search-horizontal .mh-search__buttons .mdl-button--advanced {
				color: <?php echo esc_html( $options['mh-color__search-horizontal-button-advanced-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__search-horizontal-button-clear'] ) && ! empty( $options['mh-color__search-horizontal-button-clear']['rgba'] ) ) { ?>
				.mh-search-horizontal .mh-search__buttons .mdl-button--clear {
				border-color: <?php echo esc_html( $options['mh-color__search-horizontal-button-clear']['rgba'] ); ?>!important;
				color: <?php echo esc_html( $options['mh-color__search-horizontal-button-clear']['rgba'] ); ?>!important;
				}
				.myhome-body .mh-search-horizontal .mdl-button.mdl-button--primary-ghost.mdl-button--clear:hover {
				background: <?php echo esc_html( $options['mh-color__search-horizontal-button-clear']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__search-horizontal-button-clear-hover'] ) && ! empty( $options['mh-color__search-horizontal-button-clear-hover']['rgba'] ) ) { ?>
				.myhome-body .mh-search-horizontal .mdl-button.mdl-button--primary-ghost.mdl-button--clear:hover {
				color: <?php echo esc_html( $options['mh-color__search-horizontal-button-clear-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__search-filters-color'] ) && ! empty( $options['mh-color__search-filters-color']['rgba'] ) ) { ?>
				.mh-search__results-filters span {
				color: <?php echo esc_html( $options['mh-color__search-filters-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__search-end-border'] ) && ! empty( $options['mh-color__search-end-border']['rgba'] ) ) { ?>
				.mh-search__end {
				border-color: <?php echo esc_html( $options['mh-color__search-end-border']['rgba'] ); ?>!important;
				}
			<?php } ?>

			/* Agent Carousel / List */
			<?php if ( isset( $options['mh-color__user-background'] ) && ! empty( $options['mh-color__user-background']['rgba'] ) ) { ?>
				.mh-agent {
				background: <?php echo esc_html( $options['mh-color__user-background']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__user-name'] ) && ! empty( $options['mh-color__user-name']['rgba'] ) ) { ?>
				.mh-agent__heading a {
				color: <?php echo esc_html( $options['mh-color__user-name']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__user-text'] ) && ! empty( $options['mh-color__user-text']['rgba'] ) ) { ?>
				.mh-agent__text {
				color: <?php echo esc_html( $options['mh-color__user-text']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__user-card-info'] ) && ! empty( $options['mh-color__user-card-info']['rgba'] ) ) { ?>
				.mh-agent .mh-agent__additional-fields__item,
				.mh-agent .mh-agent-contact__element a {
				color: <?php echo esc_html( $options['mh-color__user-card-info']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__user-social-icons'] ) && ! empty( $options['mh-color__user-social-icons']['rgba'] ) ) { ?>
				.mh-agent__social a {
				color: <?php echo esc_html( $options['mh-color__user-social-icons']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__agent-button-ghost-primary-color'] ) && ! empty( $options['mh-color__agent-button-ghost-primary-color']['rgba'] ) ) { ?>
				.mh-agent .mdl-button.mdl-button--primary-ghost {
				border-color: <?php echo esc_html( $options['mh-color__agent-button-ghost-primary-color']['rgba'] ); ?>!important;
				color: <?php echo esc_html( $options['mh-color__agent-button-ghost-primary-color']['rgba'] ); ?>!important;
				}
				.mh-agent .mdl-button.mdl-button--primary-ghost:hover,
				.mh-agent .mdl-button.mdl-button--primary-ghost:active,
				.mh-agent .mdl-button.mdl-button--primary-ghost:focus {
				background: <?php echo esc_html( $options['mh-color__agent-button-ghost-primary-color']['rgba'] ); ?>!important;
				color: #fff!important;
				}
			<?php } ?>


			<?php if ( isset( $options['mh-color__agent-button-ghost-primary-color-hover'] ) && ! empty( $options['mh-color__agent-button-ghost-primary-color-hover']['rgba'] ) ) { ?>
				.mh-agent .mdl-button.mdl-button--primary-ghost:hover,
				.mh-agent .mdl-button.mdl-button--primary-ghost:active,
				.mh-agent .mdl-button.mdl-button--primary-ghost:focus {
				color: <?php echo esc_html( $options['mh-color__agent-button-ghost-primary-color-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			/* Blog */

			<?php if ( isset( $options['mh-color__post-title'] ) && ! empty( $options['mh-color__post-title']['rgba'] ) ) { ?>
				.mh-post-single__title {
				color: <?php echo esc_html( $options['mh-color__post-title']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__post-meta'] ) && ! empty( $options['mh-color__post-meta']['rgba'] ) ) { ?>
				.mh-post-single__meta,
				.mh-post-single__meta a {
				color: <?php echo esc_html( $options['mh-color__post-meta']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__post-meta-hover'] ) && ! empty( $options['mh-color__post-meta-hover']['rgba'] ) ) { ?>
				.mh-post-single__meta a:hover {
				color: <?php echo esc_html( $options['mh-color__post-meta-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__post-meta-separators'] ) && ! empty( $options['mh-color__post-meta-separators']['rgba'] ) ) { ?>
				.mh-post-single__meta li:after {
				background: <?php echo esc_html( $options['mh-color__post-meta-separators']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__post-color'] ) && ! empty( $options['mh-color__post-color']['rgba'] ) ) { ?>
				.post-content {
				color: <?php echo esc_html( $options['mh-color__post-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__tag-general-color'] ) && ! empty( $options['mh-color__tag-general-color']['rgba'] ) ) { ?>
				.tagcloud a {
				color: <?php echo esc_html( $options['mh-color__tag-general-color']['rgba'] ); ?>!important;
				border-color: <?php echo esc_html( $options['mh-color__tag-general-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__tag-general-color'] ) && ! empty( $options['mh-color__tag-general-color']['rgba'] ) ) { ?>
				.tagcloud a:hover {
				background: <?php echo esc_html( $options['mh-color__tag-general-color']['rgba'] ); ?>!important;
				color: #fff!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__nav-border-top-color'] ) && ! empty( $options['mh-color__nav-border-top-color']['rgba'] ) ) { ?>
				.mh-post-single__nav {
				border-color: <?php echo esc_html( $options['mh-color__nav-border-top-color']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__nav-link-hover-box'] ) && ! empty( $options['mh-color__nav-link-hover-box']['rgba'] ) ) { ?>
				.mh-post-single__nav__prev:before,
				.mh-post-single__nav__next:before {
				background: <?php echo esc_html( $options['mh-color__nav-link-hover-box']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__nav-link'] ) && ! empty( $options['mh-color__nav-link']['rgba'] ) ) { ?>
				.mh-post-single__nav__next a,
				.mh-post-single__nav__prev a {
				color: <?php echo esc_html( $options['mh-color__nav-link']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__nav-link-span'] ) && ! empty( $options['mh-color__nav-link-span']['rgba'] ) ) { ?>
				.mh-post-single__nav__next a span,
				.mh-post-single__nav__prev a span {
				color: <?php echo esc_html( $options['mh-color__nav-link-span']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__blog-author-card-bg'] ) && ! empty( $options['mh-color__blog-author-card-bg']['rgba'] ) ) { ?>
				.mh-author {
				background: <?php echo esc_html( $options['mh-color__blog-author-card-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__blog-author-card-label'] ) && ! empty( $options['mh-color__blog-author-card-label']['rgba'] ) ) { ?>
				.mh-author__label {
				color: <?php echo esc_html( $options['mh-color__blog-author-card-label']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__blog-author-card-name'] ) && ! empty( $options['mh-color__blog-author-card-name']['rgba'] ) ) { ?>
				.mh-author__name {
				color: <?php echo esc_html( $options['mh-color__blog-author-card-name']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__blog-author-card-par'] ) && ! empty( $options['mh-color__blog-author-card-par']['rgba'] ) ) { ?>
				.mh-author__content__inner p {
				color: <?php echo esc_html( $options['mh-color__blog-author-card-par']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__blog-section-headings'] ) && ! empty( $options['mh-color__blog-section-headings']['rgba'] ) ) { ?>
				.mh-post-single__section__heading,
				.comment-reply-title {
				color: <?php echo esc_html( $options['mh-color__blog-section-headings']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__blog-comment-author'] ) && ! empty( $options['mh-color__blog-comment-author']['rgba'] ) ) { ?>
				.mh-comment__author {
				color: <?php echo esc_html( $options['mh-color__blog-comment-author']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__blog-comment-date'] ) && ! empty( $options['mh-color__blog-comment-date']['rgba'] ) ) { ?>
				.mh-comment__date {
				color: <?php echo esc_html( $options['mh-color__blog-comment-date']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__blog-comment-edit-link'] ) && ! empty( $options['mh-color__blog-comment-edit-link']['rgba'] ) ) { ?>
				.comment-edit-link {
				color: <?php echo esc_html( $options['mh-color__blog-comment-edit-link']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__blog-comment-text'] ) && ! empty( $options['mh-color__blog-comment-text']['rgba'] ) ) { ?>
				.mh-comment__text {
				color: <?php echo esc_html( $options['mh-color__blog-comment-text']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__blog-comment-reply'] ) && ! empty( $options['mh-color__blog-comment-reply']['rgba'] ) ) { ?>
				.comment-reply-link {
				color: <?php echo esc_html( $options['mh-color__blog-comment-reply']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__blog-comment-border'] ) && ! empty( $options['mh-color__blog-comment-border']['rgba'] ) ) { ?>
				.mh-comment,
				.mh-comment .mh-comment {
				border-color: <?php echo esc_html( $options['mh-color__blog-comment-border']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__blog-comment-log-info'] ) && ! empty( $options['mh-color__blog-comment-log-info']['rgba'] ) ) { ?>
				.comments-logged,
				.comments-logged a {
				color: <?php echo esc_html( $options['mh-color__blog-comment-log-info']['rgba'] ); ?>!important;
				}
			<?php } ?>


			/* Sidebar */
			<?php if ( isset( $options['mh-color__mh-sidebar-title-separator'] ) && ! empty( $options['mh-color__mh-sidebar-title-separator']['rgba'] ) ) { ?>
				.mh-widget-title__text:before {
				background:<?php echo esc_html( $options['mh-color__mh-sidebar-title-separator']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-sidebar-title'] ) && ! empty( $options['mh-color__mh-sidebar-title']['rgba'] ) ) { ?>
				.mh-widget-title__text {
				color:<?php echo esc_html( $options['mh-color__mh-sidebar-title']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-sidebar-infobox-text'] ) && ! empty( $options['mh-color__mh-sidebar-infobox-text']['rgba'] ) ) { ?>
				.widget-infobox__text {
				color:<?php echo esc_html( $options['mh-color__mh-sidebar-infobox-text']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-sidebar-link-colors'] ) && ! empty( $options['mh-color__mh-sidebar-link-colors']['rgba'] ) ) { ?>
				.mh-menu ul li a,
				.widget_pages ul li a,
				.widget_meta ul li a,
				.widget_recent_entries ul li a,
				.widget_nav_menu ul li a,
				.widget_categories ul li a,
				.widget_archive ul li a,
				.comment-author-link,
				.comment-author-link a,
				.recentcomments,
				.recentcomments a {
				color:<?php echo esc_html( $options['mh-color__mh-sidebar-menu-border']['rgba'] ); ?>!important;
				}
			<?php } ?>


			<?php if ( isset( $options['mh-color__mh-sidebar-menu-border'] ) && ! empty( $options['mh-color__mh-sidebar-menu-border']['rgba'] ) ) { ?>
				.mh-menu ul li a:before,
				.widget_pages ul li a:before,
				.widget_meta ul li a:before,
				.widget_recent_entries ul li a:before,
				.widget_nav_menu ul li a:before,
				.widget_categories ul li a:before,
				.widget_archive ul li a:before {
				background:<?php echo esc_html( $options['mh-color__mh-sidebar-menu-border']['rgba'] ); ?>!important;
				}
				.mh-menu ul li a,
				.widget_pages ul li a,
				.widget_meta ul li a,
				.widget_recent_entries ul li a,
				.widget_nav_menu ul li a,
				.widget_categories ul li a,
				.widget_archive ul li a,
				.recentcomments {
				border-color: <?php echo esc_html( $options['mh-color__mh-sidebar-menu-border']['rgba'] ); ?>!important;
				}
			<?php } ?>


			<?php if ( isset( $options['mh-color__mh-sidebar-social-bg'] ) && ! empty( $options['mh-color__mh-sidebar-social-bg']['rgba'] ) ) { ?>
				div:not(.mh-footer-top) .mh-social-icon {
				background: <?php echo esc_html( $options['mh-color__mh-sidebar-social-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-sidebar-social-border'] ) && ! empty( $options['mh-color__mh-sidebar-social-border']['rgba'] ) ) { ?>
				div:not(.mh-footer-top) .mh-social-icon:after {
				border-color: <?php echo esc_html( $options['mh-color__mh-sidebar-social-border']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-sidebar-social-font'] ) && ! empty( $options['mh-color__mh-sidebar-social-font']['rgba'] ) ) { ?>
				div:not(.mh-footer-top) .mh-social-icon i {
				color: <?php echo esc_html( $options['mh-color__mh-sidebar-social-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-sidebar-social-bg-hover'] ) && ! empty( $options['mh-color__mh-sidebar-social-bg-hover']['rgba'] ) ) { ?>
				div:not(.mh-footer-top) .mh-social-icon:hover  {
				background: <?php echo esc_html( $options['mh-color__mh-sidebar-social-bg-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-sidebar-social-border-hover'] ) && ! empty( $options['mh-color__mh-sidebar-social-border-hover']['rgba'] ) ) { ?>
				div:not(.mh-footer-top) .mh-social-icon:hover:after {
				border-color: <?php echo esc_html( $options['mh-color__mh-sidebar-social-border-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__mh-sidebar-social-font-hover'] ) && ! empty( $options['mh-color__mh-sidebar-social-font-hover']['rgba'] ) ) { ?>
				div:not(.mh-footer-top) .mh-social-icon:hover i {
				color: <?php echo esc_html( $options['mh-color__mh-sidebar-social-font-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			/* Post Card */
			<?php if ( isset( $options['mh-color__post-card-background'] ) && ! empty( $options['mh-color__post-card-background']['rgba'] ) ) { ?>
				.mh-post-grid {
				background: <?php echo esc_html( $options['mh-color__post-card-background']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__post-card-title'] ) && ! empty( $options['mh-color__post-card-title']['rgba'] ) ) { ?>
				.mh-post-grid__heading a {
				color: <?php echo esc_html( $options['mh-color__post-card-title']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__post-card-decription'] ) && ! empty( $options['mh-color__post-card-decription']['rgba'] ) ) { ?>
				.mh-post-grid__excerpt {
				color: <?php echo esc_html( $options['mh-color__post-card-decription']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__post-card-date-font'] ) && ! empty( $options['mh-color__post-card-date-font']['rgba'] ) ) { ?>
				.mh-post-grid .mh-caption__inner {
				color: <?php echo esc_html( $options['mh-color__post-card-date-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__post-card-date-bg'] ) && ! empty( $options['mh-color__post-card-date-bg']['rgba'] ) ) { ?>
				.mh-post-grid .mh-caption__inner {
				background: <?php echo esc_html( $options['mh-color__post-card-date-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__post-button-ghost-primary-color'] ) && ! empty( $options['mh-color__post-button-ghost-primary-color']['rgba'] ) ) { ?>
				.mh-post-grid .mdl-button.mdl-button--primary-ghost {
				border-color: <?php echo esc_html( $options['mh-color__post-button-ghost-primary-color']['rgba'] ); ?>!important;
				color: <?php echo esc_html( $options['mh-color__post-button-ghost-primary-color']['rgba'] ); ?>!important;
				}
				.mh-post-grid .mdl-button.mdl-button--primary-ghost:hover,
				.mh-post-grid .mdl-button.mdl-button--primary-ghost:active,
				.mh-post-grid .mdl-button.mdl-button--primary-ghost:focus {
				background: <?php echo esc_html( $options['mh-color__post-button-ghost-primary-color']['rgba'] ); ?>!important;
				color: #fff!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__post-button-ghost-primary-color-hover'] ) && ! empty( $options['mh-color__post-button-ghost-primary-color-hover']['rgba'] ) ) { ?>
				.mh-post-grid .mdl-button.mdl-button--primary-ghost:hover,
				.mh-post-grid .mdl-button.mdl-button--primary-ghost:active,
				.mh-post-grid .mdl-button.mdl-button--primary-ghost:focus {
				color: <?php echo esc_html( $options['mh-color__post-button-ghost-primary-color-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			/* Map */
			<?php if ( isset( $options['mh-color__map-property-pin'] ) && ! empty( $options['mh-color__map-property-pin']['rgba'] ) ) { ?>
				.mh-map-pin i {
				color: <?php echo esc_html( $options['mh-color__map-property-pin']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__map-panel-background'] ) && ! empty( $options['mh-color__map-panel-background']['rgba'] ) ) { ?>
				.mh-map-panel,
				.mh-map-zoom__element {
				background: <?php echo esc_html( $options['mh-color__map-panel-background']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__map-panel-border'] ) && ! empty( $options['mh-color__map-panel-border']['rgba'] ) ) { ?>
				.mh-map-zoom,
				.mh-map-panel {
				border-color: <?php echo esc_html( $options['mh-color__map-panel-border']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__map-panel-font'] ) && ! empty( $options['mh-color__map-panel-font']['rgba'] ) ) { ?>
				.mh-map-panel__element button,
				.mh-map-zoom__element {
				background: <?php echo esc_html( $options['mh-color__map-panel-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__map-panel-button-active'] ) && ! empty( $options['mh-color__map-panel-button-active']['rgba'] ) ) { ?>
				.mh-map-panel .mh-button--active,
				.mh-map-panel__element button:hover,
				.mh-map-zoom__element button:hover {
				background: <?php echo esc_html( $options['mh-color__map-panel-button-active']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__map-panel-button-active-font'] ) && ! empty( $options['mh-color__map-panel-button-active-font']['rgba'] ) ) { ?>
				.mh-map-panel .mh-button--active,
				.mh-map-panel__element button:hover,
				.mh-map-zoom__element button:hover {
				color: <?php echo esc_html( $options['mh-color__map-panel-button-active-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__map-property-background'] ) && ! empty( $options['mh-color__map-property-background']['rgba'] ) ) { ?>
				.mh-map-infobox__img-wrapper {
				border-color: <?php echo esc_html( $options['mh-color__map-property-background']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__map-property-background'] ) && ! empty( $options['mh-color__map-property-background']['rgba'] ) ) { ?>
				.mh-map-infobox {
				background: <?php echo esc_html( $options['mh-color__map-property-background']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__map-property-background'] ) && ! empty( $options['mh-color__map-property-background']['rgba'] ) ) { ?>
				.mh-map-infobox:after {
				border-top-color: <?php echo esc_html( $options['mh-color__map-property-background']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__map-property-name'] ) && ! empty( $options['mh-color__map-property-name']['rgba'] ) ) { ?>
				.mh-map-infobox__name {
				color: <?php echo esc_html( $options['mh-color__map-property-name']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__map-property-price'] ) && ! empty( $options['mh-color__map-property-price']['rgba'] ) ) { ?>
				.mh-map-infobox__price {
				color: <?php echo esc_html( $options['mh-color__map-property-price']['rgba'] ); ?>!important;
				}
			<?php } ?>

			/* Compare Bar */
			<?php if ( isset( $options['mh-color__compare-bg'] ) && ! empty( $options['mh-color__compare-bg']['rgba'] ) ) { ?>
				.mh-compare {
				background: <?php echo esc_html( $options['mh-color__compare-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__compare-border'] ) && ! empty( $options['mh-color__compare-border']['rgba'] ) ) { ?>
				.mh-compare {
				border-color: <?php echo esc_html( $options['mh-color__compare-border']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__compare-font-one'] ) && ! empty( $options['mh-color__compare-font-one']['rgba'] ) ) { ?>
				.mh-compare .mh-compare__container__inner,
				.mh-compare .mdl-button.mdl-button--dark-font {
				color: <?php echo esc_html( $options['mh-color__compare-font-one']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__compare-font-two'] ) && ! empty( $options['mh-color__compare-font-two']['rgba'] ) ) { ?>
				.mh-compare .mdl-button.mdl-button--primary-font {
				color: <?php echo esc_html( $options['mh-color__compare-font-two']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__compare-column-bg'] ) && ! empty( $options['mh-color__compare-column-bg']['rgba'] ) ) { ?>
				.mh-compare__column {
				background: <?php echo esc_html( $options['mh-color__compare-column-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__compare-column-price-bg'] ) && ! empty( $options['mh-color__compare-column-price-bg']['rgba'] ) ) { ?>
				.mh-compare__price {
				background: <?php echo esc_html( $options['mh-color__compare-column-price-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__compare-column-price-font'] ) && ! empty( $options['mh-color__compare-column-price-font']['rgba'] ) ) { ?>
				.mh-compare__price {
				color: <?php echo esc_html( $options['mh-color__compare-column-price-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__compare-column-title'] ) && ! empty( $options['mh-color__compare-column-title']['rgba'] ) ) { ?>
				.mh-compare__title a {
				color: <?php echo esc_html( $options['mh-color__compare-column-title']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__compare-column-address'] ) && ! empty( $options['mh-color__compare-column-address']['rgba'] ) ) { ?>
				.mh-compare__address {
				color: <?php echo esc_html( $options['mh-color__compare-column-address']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__compare-column-other-text'] ) && ! empty( $options['mh-color__compare-column-other-text']['rgba'] ) ) { ?>
				.mh-compare__list__element,
				.mh-compare__list__element a,
				.mh-compare__description,
				.mh-compare__heading__text a,
				.mh-compare__date {
				color: <?php echo esc_html( $options['mh-color__compare-column-other-text']['rgba'] ); ?>!important;
				}
			<?php } ?>

			/* User panel */

			<?php if ( isset( $options['mh-color__user-panel-menu-header-bg'] ) && ! empty( $options['mh-color__user-panel-menu-header-bg']['rgba'] ) ) { ?>
				.mh-user-panel__user {
				background: <?php echo esc_html( $options['mh-color__user-panel-menu-header-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__user-panel-menu-header-font'] ) && ! empty( $options['mh-color__user-panel-menu-header-font']['rgba'] ) ) { ?>
				.mh-user-panel__user__content span {
				color: <?php echo esc_html( $options['mh-color__user-panel-menu-header-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__user-panel-menu-element-bg-hover'] ) && ! empty( $options['mh-color__user-panel-menu-element-bg-hover']['rgba'] ) ) { ?>
				.mh-user-panel__menu ul li:hover button,
				.mh-user-panel__menu ul li:hover a {
				background: <?php echo esc_html( $options['mh-color__user-panel-menu-element-bg-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__user-panel-menu-element-font-hover'] ) && ! empty( $options['mh-color__user-panel-menu-element-font-hover']['rgba'] ) ) { ?>
				.mh-user-panel__menu ul li:hover button,
				.mh-user-panel__menu ul li:hover a {
				color: <?php echo esc_html( $options['mh-color__user-panel-menu-element-font-hover']['rgba'] ); ?>!important;
				}
			<?php } ?>


			<?php if ( isset( $options['mh-color__user-panel-menu-element-active-font'] ) && ! empty( $options['mh-color__user-panel-menu-element-active-font']['rgba'] ) ) { ?>
				.mh-user-panel__menu ul li.mh-user-panel__menu__li--active button,
				.mh-user-panel__menu ul li.mh-user-panel__menu__li--active a {
				color: <?php echo esc_html( $options['mh-color__user-panel-menu-element-active-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__user-panel-menu-element-active-background'] ) && ! empty( $options['mh-color__user-panel-menu-element-active-background']['rgba'] ) ) { ?>
				.mh-user-panel__menu ul li.mh-user-panel__menu__li--active button,
				.mh-user-panel__menu ul li.mh-user-panel__menu__li--active a {
				background: <?php echo esc_html( $options['mh-color__user-panel-menu-element-active-background']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__user-panel-menu-element-bg'] ) && ! empty( $options['mh-color__user-panel-menu-element-bg']['rgba'] ) ) { ?>
				.mh-user-panel__menu ul li button,
				.mh-user-panel__menu ul li a {
				background: <?php echo esc_html( $options['mh-color__user-panel-menu-element-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__user-panel-menu-element-font'] ) && ! empty( $options['mh-color__user-panel-menu-element-font']['rgba'] ) ) { ?>
				.mh-user-panel__menu ul li button,
				.mh-user-panel__menu ul li a {
				color: <?php echo esc_html( $options['mh-color__user-panel-menu-element-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__user-panel-h1'] ) && ! empty( $options['mh-color__user-panel-h1']['rgba'] ) ) { ?>
				.mh-user-panel__title {
				color: <?php echo esc_html( $options['mh-color__user-panel-h1']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__user-panel-h1-separator'] ) && ! empty( $options['mh-color__user-panel-h1-separator']['rgba'] ) ) { ?>
				.mh-heading--bottom-separator:after {
				background: <?php echo esc_html( $options['mh-color__user-panel-h1-separator']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__user-panel-property-form-label'] ) && ! empty( $options['mh-color__user-panel-property-form-label']['rgba'] ) ) { ?>
				.mh-user-panel__label-submit {
				color: <?php echo esc_html( $options['mh-color__user-panel-property-form-label']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__input-select-background'] ) && ! empty( $options['mh-color__input-select-background']['rgba'] ) ) { ?>
				.bootstrap-select.btn-group > .btn,
				input[type=text],
				input[type=password],
				input[type=email],
				input[type=date],
				input[type=number],
				input[type=tel],
				input[type=search]:not(#media-search-input),
				textarea {
				background: <?php echo esc_html( $options['mh-color__input-select-background']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__input-select-border'] ) && ! empty( $options['mh-color__input-select-border']['rgba'] ) ) { ?>
				.bootstrap-select.btn-group > .btn,
				input[type=text],
				input[type=password],
				input[type=email],
				input[type=date],
				input[type=number],
				input[type=tel],
				input[type=search]:not(#media-search-input),
				textarea {
				border-color: <?php echo esc_html( $options['mh-color__input-select-border']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__input-select-font-initial'] ) && ! empty( $options['mh-color__input-select-font-initial']['rgba'] ) ) { ?>
				.bootstrap-select.btn-group > .btn,
				.filter-option {
				color: <?php echo esc_html( $options['mh-color__input-select-font-initial']['rgba'] ); ?>!important;
				}

				input::-webkit-input-placeholder, textarea::-webkit-input-placeholder {
				color:  <?php echo esc_html( $options['mh-color__input-select-font-initial']['rgba'] ); ?>!important;
				}

				input::-moz-placeholder, textarea::-moz-placeholder {
				color:  <?php echo esc_html( $options['mh-color__input-select-font-initial']['rgba'] ); ?>!important;
				}

				input:-moz-placeholder, textarea:-moz-placeholder {
				color:  <?php echo esc_html( $options['mh-color__input-select-font-initial']['rgba'] ); ?>!important;
				}

				input:-ms-input-placeholder, textarea:-ms-input-placeholder {
				color: <?php echo esc_html( $options['mh-color__input-select-font-initial']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__input-select-active-bg'] ) && ! empty( $options['mh-color__input-select-active-bg']['rgba'] ) ) { ?>
				.mh-active-input-primary input[type=text]:focus,
				.mh-active-input-primary input[type=text]:active,
				.mh-active-input-primary input[type=search]:focus,
				.mh-active-input-primary input[type=search]:active,
				.mh-active-input-primary input[type=email]:focus,
				.mh-active-input-primary input[type=email]:active,
				.mh-active-input-primary input[type=password]:focus,
				.mh-active-input-primary input[type=password]:active,
				.mh-active-input-primary textarea:focus,
				.mh-active-input-primary textarea:active,
				.mh-active-input-primary .mh-active-input input,
				.mh-active-input-primary .mh-active-input input,
				.myhome-body.mh-active-input-primary .mh-active-input .bootstrap-select.btn-group > .btn {
				background: <?php echo esc_html( $options['mh-color__input-select-active-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__input-select-active-border'] ) && ! empty( $options['mh-color__input-select-active-border']['rgba'] ) ) { ?>
				.mh-active-input-primary input[type=text]:focus,
				.mh-active-input-primary input[type=text]:active,
				.mh-active-input-primary input[type=search]:focus,
				.mh-active-input-primary input[type=search]:active,
				.mh-active-input-primary input[type=email]:focus,
				.mh-active-input-primary input[type=email]:active,
				.mh-active-input-primary input[type=password]:focus,
				.mh-active-input-primary input[type=password]:active,
				.mh-active-input-primary textarea:focus,
				.mh-active-input-primary textarea:active,
				.mh-active-input-primary .mh-active-input input,
				.mh-active-input-primary .mh-active-input input,
				.myhome-body.mh-active-input-primary .mh-active-input .bootstrap-select.btn-group > .btn {
				border-color: <?php echo esc_html( $options['mh-color__input-select-active-border']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__input-select-active-font'] ) && ! empty( $options['mh-color__input-select-active-font']['rgba'] ) ) { ?>
				.mh-search__panel.mh-active-input .filter-option,
				.mh-active-input-primary input[type=text]:focus,
				.mh-active-input-primary input[type=text]:active,
				.mh-active-input-primary input[type=search]:focus,
				.mh-active-input-primary input[type=search]:active,
				.mh-active-input-primary input[type=email]:focus,
				.mh-active-input-primary input[type=email]:active,
				.mh-active-input-primary input[type=password]:focus,
				.mh-active-input-primary input[type=password]:active,
				.mh-active-input-primary textarea:focus,
				.mh-active-input-primary textarea:active,
				.mh-active-input-primary .mh-active-input input,
				.mh-active-input-primary .mh-active-input input,
				.myhome-body.mh-active-input-primary .mh-active-input .bootstrap-select.btn-group > .btn,
				.mh-active-input-primary .mh-active-input .bootstrap-select.btn-group .dropdown-toggle .filter-option {
				color: <?php echo esc_html( $options['mh-color__input-select-active-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__input-select-dropdown-bg'] ) && ! empty( $options['mh-color__input-select-dropdown-bg']['rgba'] ) ) { ?>
				.dropdown-menu {
				background: <?php echo esc_html( $options['mh-color__input-select-dropdown-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__input-select-dropdown-border'] ) && ! empty( $options['mh-color__input-select-dropdown-border']['rgba'] ) ) { ?>
				.dropdown-menu {
				border-color: <?php echo esc_html( $options['mh-color__input-select-dropdown-border']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__input-select-dropdown-active-bg'] ) && ! empty( $options['mh-color__input-select-dropdown-active-bg']['rgba'] ) ) { ?>
				.dropdown-menu > li.selected a  {
				background: <?php echo esc_html( $options['mh-color__input-select-dropdown-active-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__input-select-dropdown-active-font'] ) && ! empty( $options['mh-color__input-select-dropdown-active-font']['rgba'] ) ) { ?>
				.dropdown-menu > li.selected a  {
				color: <?php echo esc_html( $options['mh-color__input-select-dropdown-active-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__input-select-dropdown-hover-font'] ) && ! empty( $options['mh-color__input-select-dropdown-hover-font']['rgba'] ) ) { ?>
				.dropdown-menu > li:not(.selected) > a:hover {
				color: <?php echo esc_html( $options['mh-color__input-select-dropdown-hover-font']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__input-select-dropdown-hover-bg'] ) && ! empty( $options['mh-color__input-select-dropdown-hover-bg']['rgba'] ) ) { ?>
				.dropdown-menu > li:not(.selected) > a:hover {
				background: <?php echo esc_html( $options['mh-color__input-select-dropdown-hover-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>
			<?php if ( isset( $options['mh-color__checkbox-outline'] ) && ! empty( $options['mh-color__checkbox-outline']['rgba'] ) ) { ?>
				.mdl-checkbox .mdl-checkbox__box-outline,
				.mdl-radio__outer-circle {
				border-color: <?php echo esc_html( $options['mh-color__checkbox-outline']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__checkbox-outline-bg'] ) && ! empty( $options['mh-color__checkbox-outline-bg']['rgba'] ) ) { ?>
				.mdl-checkbox.is-checked .mdl-checkbox__tick-outline,
				.mdl-radio.is-checked .mdl-radio__inner-circle {
				background-color: <?php echo esc_html( $options['mh-color__checkbox-outline-bg']['rgba'] ); ?>!important;
				}
			<?php } ?>

			<?php if ( isset( $options['mh-color__checkbox-label'] ) && ! empty( $options['mh-color__checkbox-label']['rgba'] ) ) { ?>
				.mdl-checkbox__label,
				.mdl-radio__label {
				color: <?php echo esc_html( $options['mh-color__checkbox-label']['rgba'] ); ?>!important;
				}
			<?php } ?>


			.mdl-checkbox__label, .mdl-radio__label {

			}

			.mh-user-panel__instruction {

			}


			<?php
			$inline_css .= ob_get_clean();

			wp_add_inline_style( 'myhome-style', $inline_css );
		}

		public function load_js() {
			if ( class_exists( 'MyHomeCore\Core' ) && is_page_template( 'page_agents.php' ) ) {
				\MyHomeCore\My_Home_Core()->currency = 'any';
			}

			wp_enqueue_script( 'lazy-sizes', get_template_directory_uri() . '/assets/js/lazysizes.min.js', array(), My_Home_Theme()->version, true );
			ob_start();
			?>
			window.lazySizesConfig = window.lazySizesConfig || {};
			window.lazySizesConfig.loadMode = 1;
			<?php
			wp_add_inline_script( 'lazy-sizes', ob_get_clean(), 'before' );
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			$myhome_dependencies = array( 'jquery' );
			if ( is_singular( 'estate' ) ) {
				$myhome_dependencies[] = 'jquery-ui-accordion';
			}

			wp_enqueue_script( 'myhome-min', get_template_directory_uri() . '/assets/js/myhome.min.js', $myhome_dependencies, My_Home_Theme()->version, true );

			$google_api_key = My_Home_Theme()->settings->get( 'google-api-key' );
			if ( ! empty( $google_api_key ) ) {
				wp_register_script(
					'google-maps-api',
					'//maps.googleapis.com/maps/api/js?key=' . $google_api_key . '&libraries=places',
					array( 'jquery' ),
					null,
					true
				);
				wp_register_script(
					'myhome-map',
					get_template_directory_uri() . '/assets/js/myhome-map.min.js',
					array( 'google-maps-api' ),
					My_Home_Theme()->version,
					true
				);
				$load_map_api = My_Home_Theme()->settings->get( 'google-map-api-all' );
				if ( ! empty( $load_map_api ) ) {
					wp_enqueue_script( 'myhome-map' );
				}

				wp_register_script(
					'myhome-panel',
					get_template_directory_uri() . '/assets/js/panel.js', array(
					'jquery',
					'google-maps-api',
					'recaptcha'
				),
					My_Home_Theme()->version, true
				);
			} else {
				wp_register_script(
					'myhome-panel',
					get_template_directory_uri() . '/assets/js/panel.js', array(
					'jquery',
					'recaptcha'
				),
					My_Home_Theme()->version, true
				);
			}

			if ( is_singular( 'estate' ) ) {
				if ( ! empty( $google_api_key ) ) {
					wp_enqueue_script( 'myhome-map' );
				}

				$gallery_type = My_Home_Theme()->settings->get( 'estate_slider' );
				if ( $gallery_type == 'single-estate-gallery' ) {
					wp_enqueue_script(
						'myhome-estate-gallery', get_template_directory_uri() . '/assets/js/sliders/gallery.js',
						array( 'jquery' ), My_Home_Theme()->version, true
					);
				} elseif ( $gallery_type == 'single-estate-slider' ) {
					wp_enqueue_script(
						'myhome-estate-slider', get_template_directory_uri() . '/assets/js/sliders/slider.js',
						array( 'jquery' ), My_Home_Theme()->version, true
					);
				} elseif ( $gallery_type == 'single-estate-gallery-auto-height' ) {
					wp_enqueue_script(
						'myhome-estate-slider', get_template_directory_uri() . '/assets/js/sliders/gallery-auto-height.js',
						array( 'jquery' ), My_Home_Theme()->version, true
					);
				}
			}
		}

		private function hex2rgb( $hex ) {
			$hex = str_replace( '#', '', $hex );

			if ( strlen( $hex ) == 3 ) {
				$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
				$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
				$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
			} else {
				$r = hexdec( substr( $hex, 0, 2 ) );
				$g = hexdec( substr( $hex, 2, 2 ) );
				$b = hexdec( substr( $hex, 4, 2 ) );
			}
			$rgb = array( $r, $g, $b );

			return implode( ',', $rgb );
		}

		public function fonts_url() {
			$fonts_url = '';
			$fonts     = array();
			$subsets   = 'latin,latin-ext';

			if ( 'off' !== esc_html_x( 'on', 'Lato font: on or off', 'myhome' ) ) {
				array_push( $fonts, 'Lato:400italic,300,400,700' );
			}

			if ( 'off' !== esc_html_x( 'on', 'Play font: on or off', 'myhome' ) ) {
				array_push( $fonts, 'Play:400,700' );
			}

			if ( $fonts ) {
				$fonts_url = add_query_arg(
					array(
						'family' => urlencode( implode( '|', $fonts ) ),
						'subset' => urlencode( $subsets ),
					), 'https://fonts.googleapis.com/css'
				);
			}

			return $fonts_url;
		}

	}

endif;
