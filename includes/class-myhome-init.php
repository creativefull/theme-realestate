<?php

/*
 * My_Home_Init class
 *
 * This class setup theme support and contain general purpose filters and actions
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'My_Home_Init' ) ) :

	class My_Home_Init {

		public function __construct() {
			add_action( 'tgmpa_register', array( My_Home_Theme()->plugins, 'register' ) );
			// add theme support
			add_action( 'after_setup_theme', array( $this, 'theme_support' ) );
			// add sidebars
			add_action( 'widgets_init', array( $this, 'add_sidebars' ) );
			// disable redux notices
			add_action( 'init', array( $this, 'disable_redux_notices' ) );
			// add google api key for ACF plugin
			add_filter( 'acf/fields/google_map/api', array( $this, 'acf_google_map_api' ) );
			// add wrapper for iframe
			add_filter( 'embed_oembed_html', array( $this, 'iframe_wrapper' ), 99, 4 );
			// set archive title
			add_filter( 'get_the_archive_title', array( $this, 'set_archive_title' ) );
			// add span for cat count
			add_filter( 'wp_list_categories', array( $this, 'cat_count_span' ) );
			// modify search form
			add_filter( 'get_search_form', array( $this, 'search_form' ), 100 );
			// limit cloud tags widget
			add_filter( 'widget_tag_cloud_args', array( $this, 'tag_widget_limit' ) );
			// remove some links from top admin bar
			add_filter( 'wp_before_admin_bar_render', array( $this, 'remove_admin_bar_links' ), 100 );
			// remove some menu elements (admin)
			add_action( 'admin_menu', array( $this, 'remove_menu_elements' ) );
			// password protected post
			add_filter( 'the_password_form', array( $this, 'password_form' ) );
			// remove mega main menu widget sidebar
			add_action( 'init', array( $this, 'remove_mmm_widgets' ), 201 );

			// google api key
			if ( is_admin() ) {
				$options = get_option( 'myhome_redux' );
				if ( class_exists( 'ReduxFramework' ) && empty( $options['mh-google-api-key'] ) ) {
					add_action( 'admin_notices', array( $this, 'google_api_key_notice' ) );
				}
			}

			// add additional body classes
			add_filter( 'body_class', array( $this, 'body_class' ) );
			// modify title placeholder for some custom post types
			add_filter( 'enter_title_here', array( $this, 'modify_title_placeholder' ) );

			add_action( 'admin_notices', array( $this, 'development_mode_notice' ) );

			add_action( 'admin_bar_menu', array( $this, 'admin_links' ), 41 );
		}

		public function admin_links( $wp_admin_bar ) {
			if ( class_exists( 'MyHomeCore\Core' ) ) {
				/* @var $wp_admin_bar WP_Admin_Bar */
				$wp_admin_bar->add_node( array(
					'id'    => 'myhome-panel',
					'title' => esc_html__( 'MyHome Panel', 'myhome' ),
					'href'  => admin_url( 'admin.php?page=myhome_attributes' )
				) );
				$wp_admin_bar->add_node( array(
					'parent' => 'site-name',
					'id'     => 'site-name-myhome-theme',
					'title'  => esc_html__( 'MyHome Theme', 'myhome' ),
					'href'   => esc_url( admin_url( 'admin.php?page=MyHome&tab=1' ) ),
					'meta'   => false
				) );
				$wp_admin_bar->add_node( array(
					'id'    => 'myhome-panel-add-property',
					'title' => esc_html__( 'Add Property', 'myhome' ),
					'href'  => admin_url( 'post-new.php?post_type=estate' )
				) );
			}

			if ( class_exists( 'ReduxFramework' ) ) {
				$wp_admin_bar->add_node( array(
					'parent' => 'site-name',
					'id'     => 'site-name-myhome-options',
					'title'  => esc_html__( 'MyHome Panel', 'myhome' ),
					'href'   => esc_url( admin_url( 'admin.php?page=myhome_attributes' ) ),
					'meta'   => false
				) );
			}
		}

		public function development_mode_notice() {
			$development_mode = My_Home_Theme()->settings->get( 'development' );
			if ( ! empty( $development_mode ) ) :
				?>
				<div class="notice notice-info">
					<p>
						<?php esc_html_e( 'Development Mode is enabled. Turn it OFF when your site is ready, it will make it much faster (MyHome Theme > General > Development mode)', 'myhome' ) ?>
					</p>
				</div>
			<?php
			endif;
		}

		public function modify_title_placeholder( $title ) {
			$screen    = get_current_screen();
			$post_type = $screen->post_type;
			if ( 'client' == $post_type ) {
				$title = esc_html__( 'Enter client name', 'myhome' );
			} elseif ( 'testimonial' == $post_type ) {
				$title = esc_html__( 'Enter testimonial name', 'myhome' );
			}

			return $title;
		}


		public function body_class( $classes ) {
			$mh_classes = array(
				'myhome-body',
				My_Home_Theme()->settings->get( 'top-header-mobile' ) ? 'mh-hide-top-bar-on-mobile' : '',
				My_Home_Theme()->settings->get( 'input_active_color' )
			);

			return array_merge( $classes, $mh_classes );
		}

		public function google_api_key_notice() {
			?>
			<div class="notice notice-error">
				<p>
					<?php esc_html_e( 'MyHome Theme - Google API Key is not set. Paste your Google Maps Api Key in your theme option to display map.', 'myhome' ); ?>
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=' . wp_get_theme()->get( 'Name' ) . '&tab=36' ) ); ?>">
						<?php esc_html_e( 'Set Google maps API Key', 'myhome' ); ?>
					</a>
				</p>
			</div>
			<?php
		}

		public function remove_mmm_widgets() {
			unregister_sidebar( 'mmm_menu_widgets_area_1' );
		}

		public function theme_support() {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'nav-menus' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'custom-background' );
			add_theme_support( 'custom-header' );
			add_theme_support(
				'html5', array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				)
			);
		}

		/*
		 * password_form
		 *
		 * Customize password protection form
		 */
		public function password_form() {
			global $post;
			$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
			ob_start();
			?>
			<div class="mh-post-single__password">
				<strong><?php esc_html_e( 'To view this protected post, enter the password below:', 'myhome' ); ?></strong>
				<form action="<?php echo esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ); ?>"
					  method="post">
					<label for="<?php echo esc_attr( $label ); ?>">
						<input name="post_password" type="password" id="<?php echo esc_attr( $label ); ?>">
						<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--primary mdl-button--lg"><?php esc_html_e( 'Submit', 'myhome' ); ?></button>
					</label>
				</form>
			</div>
			<?php
			return ob_get_clean();
		}

		public function remove_admin_bar_links() {
			global $wp_admin_bar;
			$wp_admin_bar->remove_menu( 'revslider' );
		}

		public function remove_menu_elements() {
			remove_menu_page( 'mega_main_menu_options' );
			remove_menu_page( 'edit.php?post_type=acf-field-group' );
		}

		public function disable_redux_notices() {
			if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
				remove_filter( 'plugin_row_meta', array(
					ReduxFrameworkPlugin::get_instance(),
					'plugin_metalinks'
				), 2 );
				remove_action( 'admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
			}
		}

		// Limit number of tags inside widget
		public function tag_widget_limit(
			$args
		) {
			$args['number'] = 10;

			return $args;
		}

		public function search_form() {
			ob_start();
			?>
			<form role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search-form">
				<label>
					<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'myhome' ); ?></span>
					<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search ...', 'myhome' ); ?>" name="s">
				</label>
				<button class="search-submit mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary">
					<i class="fa fa-search"></i>
				</button>
			</form>
			<?php
			return ob_get_clean();
		}

		public function acf_google_map_api(
			$api
		) {
			$api['key'] = My_Home_Theme()->settings->get( 'google-api-key' );

			return $api;
		}

		public function iframe_wrapper(
			$html, $url, $attr, $post_id
		) {
			return '<div class="iframe-wrapper">' . $html . '</div>';
		}

		public function set_archive_title(
			$title
		) {
			if ( is_category() ) {
				$title = single_cat_title( '', false );
			} elseif ( is_tag() ) {
				$title = single_tag_title( '', false );
			} elseif ( is_author() ) {
				$title = get_the_author();
			} elseif ( is_post_type_archive() ) {
				$title = post_type_archive_title( '', false );
			}

			return $title;
		}

		public function add_sidebars() {
			register_sidebar(
				array(
					'name'          => esc_html__( 'MH Sidebar', 'myhome' ),
					'id'            => 'mh-sidebar',
					'description'   => esc_html__( 'Add widgets here.', 'myhome' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<div class="mh-widget-title"><h3 class="mh-widget-title__text">',
					'after_title'   => '</h3></div>',
				)
			);
			if ( My_Home_Theme()->layout->blog_custom_sidebar() ) {
				register_sidebar(
					array(
						'name'          => esc_html__( 'MH Blog Sidebar', 'myhome' ),
						'id'            => 'mh-sidebar-blog',
						'description'   => esc_html__( 'Add widgets here.', 'myhome' ),
						'before_widget' => '<section id="%1$s" class="widget %2$s">',
						'after_widget'  => '</section>',
						'before_title'  => '<div class="mh-widget-title"><h3 class="mh-widget-title__text">',
						'after_title'   => '</h3></div>',
					)
				);
			}
			register_sidebar(
				array(
					'name'          => esc_html__( 'MH Property Page', 'myhome' ),
					'id'            => 'mh-property-sidebar',
					'description'   => esc_html__( 'Add widgets here.', 'myhome' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<div class="mh-widget-title"><h3 class="mh-widget-title__text">',
					'after_title'   => '</h3></div>',
				)
			);
			register_sidebar(
				array(
					'name'          => esc_html__( 'Sidebar v2', 'myhome' ),
					'id'            => 'mh-page-sidebar-2',
					'description'   => esc_html__( 'Add widgets here.', 'myhome' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<div class="mh-widget-title"><h3 class="mh-widget-title__text">',
					'after_title'   => '</h3></div>',
				)
			);
			register_sidebar(
				array(
					'name'          => esc_html__( 'MH Listing', 'myhome' ),
					'id'            => 'mh-listing-sidebar',
					'description'   => esc_html__( 'Add widgets here.', 'myhome' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<div class="mh-widget-title"><h3 class="mh-widget-title__text">',
					'after_title'   => '</h3></div>',
				)
			);

			$options = get_option( 'myhome_redux' );
			if ( isset( $options['mh-footer-widget-area-columns'] ) ) {
				$footer_columns = $options['mh-footer-widget-area-columns'];
			} else {
				$footer_columns = 'mh-footer__row__column--1of4';
			}
			register_sidebar(
				array(
					'name'          => esc_html__( 'MH Sidebar Footer', 'myhome' ),
					'id'            => 'mh-sidebar-footer',
					'description'   => esc_html__( 'Add widgets here.', 'myhome' ),
					'before_widget' => '<div class="mh-footer__row__column ' . $footer_columns . ' widget %2$s" id="%1$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="mh-footer__heading">',
					'after_title'   => '</h3>',
				)
			);
		}

		public function cat_count_span(
			$args
		) {
			$args = str_replace( '</a> (', '</a> <span>(', $args );
			$args = str_replace( ')', ')</span>', $args );

			return $args;
		}
	}

endif;