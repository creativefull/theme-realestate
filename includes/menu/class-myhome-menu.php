<?php

/*
 * My_Home_Menu class
 *
 * Theme includes Mega Main Menu and should be activated right after installation.
 * This class setup configuration for this plugin and register menu location.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'My_Home_Menu' ) ) :

	class My_Home_Menu {

		public function __construct() {
			// register menu
			add_action( 'after_setup_theme', array( $this, 'register_menu' ) );
			// mega menu config
			add_filter( 'mmm_set_configuration', array( $this, 'mega_menu_config' ) );
			// add classes to mega main menu wrapper
			add_filter( 'mmm_container_class', array( $this, 'add_class' ) );
			// add submit estate button
			add_filter( 'wp_nav_menu_items', array( $this, 'add_elements' ), 10, 2 );
			// set logo (logo set in mega main menu plugin has higher priority but we suggest using theme options)
			add_filter( 'wp_nav_menu', array( $this, 'set_logo' ), 10 );
			// load initial config for mega main menu plugin
			add_filter( 'mmm_set_configuration', array( $this, 'mmm_config' ) );
			// update mmm settings based on redux options
			add_action( 'redux/options/myhome_redux/saved', array( $this, 'update_mmm_config' ) );
			add_action( 'redux/options/myhome_redux/reset', array( $this, 'update_mmm_config' ) );
		}

		/*
		 * mmm_config
		 *
		 * Load initial mega main menu plugin config. Used right after plugin activation.
		 */
		public function mmm_config() {
			$saved_configuration = get_option( 'mega_main_menu_options', array() );
			// check if config already exists
			if ( ( $saved_configuration === false ) || empty( $saved_configuration ) ) {
				$settings                    = '{"last_modified":"1488876057","mega_menu_locations":["is_checkbox","mh-primary"],"mh-primary_included_components":["is_checkbox","company_logo"],"mh-primary_first_level_item_height":"80","mh-primary_primary_style":"flat","mh-primary_first_level_button_height":"30","mh-primary_first_level_item_align":"center","mh-primary_first_level_icons_position":"left","mh-primary_first_level_separator":"none","mh-primary_corners_rounding":"0","mh-primary_dropdowns_trigger":"hover","mh-primary_dropdowns_animation":"anim_4","mh-primary_mobile_minimized":["is_checkbox","true"],"mh-primary_mobile_label":" ","mh-primary_direction":"horizontal","mh-primary_fullwidth_container":["is_checkbox"],"mh-primary_first_level_item_height_sticky":"65","mh-primary_sticky_status":["is_checkbox"],"mh-primary_sticky_offset":"0","mh-primary_pushing_content":["is_checkbox"],"logo_src":"","logo_height":"100","mh-primary_menu_bg_gradient":{"color1":"rgba(255,255,255,1)","start":"0","color2":"rgba(255,255,255,1)","end":"100","orientation":"top"},"mh-primary_menu_bg_image":{"background_image":"","background_repeat":"repeat","background_attachment":"scroll","background_position":"center","background_size":"auto"},"mh-primary_menu_first_level_link_font":{"font_family":"Inherit","font_size":"14","font_weight":"400"},"mh-primary_menu_first_level_link_color":"#4d4d4d","mh-primary_menu_first_level_icon_font":"16","mh-primary_menu_first_level_link_bg":{"color1":"rgba(255,255,255,0)","start":"","color2":"rgba(255,255,255,0)","end":"","orientation":"top"},"mh-primary_menu_first_level_link_color_hover":"#4d4d4d","mh-primary_menu_first_level_link_bg_hover":{"color1":"rgba(255,255,255,0)","start":"","color2":"rgba(255,255,255,0)","end":"","orientation":"top"},"mh-primary_menu_search_bg":"rgba(255,255,255,0)","mh-primary_menu_search_color":"rgba(255,255,255,0)","mh-primary_menu_dropdown_wrapper_gradient":{"color1":"#666666","start":"0","color2":"#666666","end":"100","orientation":"top"},"mh-primary_menu_dropdown_link_font":{"font_family":"Inherit","font_size":"12","font_weight":"400"},"mh-primary_menu_dropdown_link_color":"#ffffff","mh-primary_menu_dropdown_icon_font":"0","mh-primary_menu_dropdown_link_bg":{"color1":"#666666","start":"0","color2":"#666666","end":"100","orientation":"top"},"mh-primary_menu_dropdown_link_border_color":"rgba(255,255,255,0)","mh-primary_menu_dropdown_link_color_hover":"#ffffff","mh-primary_menu_dropdown_link_bg_hover":{"color1":"#999999","start":"0","color2":"#999999","end":"100","orientation":"top"},"mh-primary_menu_dropdown_plain_text_color":"#231e2e","custom_css":"","responsive_styles":["is_checkbox","true"],"responsive_resolution":"1024","icon_sets":["is_checkbox"],"coercive_styles":["is_checkbox"],"indefinite_location_mode":["is_checkbox"],"number_of_widgets":"1","language_direction":"ltr","item_descr":["is_checkbox","disable"],"item_style":["is_checkbox","disable"],"item_visibility":["is_checkbox","disable"],"item_icon":["is_checkbox"],"disable_text":["is_checkbox","disable"],"disable_link":["is_checkbox","disable"],"pull_to_other_side":["is_checkbox","disable"],"submenu_type":["is_checkbox"],"submenu_drops_side":["is_checkbox"],"submenu_columns":["is_checkbox"],"submenu_enable_full_width":["is_checkbox"],"submenu_bg_image":["is_checkbox","disable"],"purchase_code":""}';
				$myhome_custom_configuration = json_decode( $settings, true );
				add_option( 'mega_main_menu_options', $myhome_custom_configuration );
				$options                  = get_option( 'mega_main_menu_options' );
				$options['last_modified'] = time();
				update_option( 'mega_main_menu_options', $options );
			} else {
				return false;
			}
		}

		/*
		 * update_mmm_config
		 *
		 * Update MMM plugin config based on redux settings
		 */
		public function update_mmm_config() {
			$settings                    = '{"last_modified":"1488876057","mega_menu_locations":["is_checkbox","mh-primary"],"mh-primary_included_components":["is_checkbox","company_logo"],"mh-primary_first_level_item_height":"80","mh-primary_primary_style":"flat","mh-primary_first_level_button_height":"30","mh-primary_first_level_item_align":"center","mh-primary_first_level_icons_position":"left","mh-primary_first_level_separator":"none","mh-primary_corners_rounding":"0","mh-primary_dropdowns_trigger":"hover","mh-primary_dropdowns_animation":"anim_4","mh-primary_mobile_minimized":["is_checkbox","true"],"mh-primary_mobile_label":" ","mh-primary_direction":"horizontal","mh-primary_fullwidth_container":["is_checkbox"],"mh-primary_first_level_item_height_sticky":"65","mh-primary_sticky_status":["is_checkbox"],"mh-primary_sticky_offset":"0","mh-primary_pushing_content":["is_checkbox"],"logo_src":"","logo_height":"100","mh-primary_menu_bg_gradient":{"color1":"rgba(255,255,255,1)","start":"0","color2":"rgba(255,255,255,1)","end":"100","orientation":"top"},"mh-primary_menu_bg_image":{"background_image":"","background_repeat":"repeat","background_attachment":"scroll","background_position":"center","background_size":"auto"},"mh-primary_menu_first_level_link_font":{"font_family":"Inherit","font_size":"14","font_weight":"400"},"mh-primary_menu_first_level_link_color":"#4d4d4d","mh-primary_menu_first_level_icon_font":"16","mh-primary_menu_first_level_link_bg":{"color1":"rgba(255,255,255,0)","start":"","color2":"rgba(255,255,255,0)","end":"","orientation":"top"},"mh-primary_menu_first_level_link_color_hover":"#4d4d4d","mh-primary_menu_first_level_link_bg_hover":{"color1":"rgba(255,255,255,0)","start":"","color2":"rgba(255,255,255,0)","end":"","orientation":"top"},"mh-primary_menu_search_bg":"rgba(255,255,255,0)","mh-primary_menu_search_color":"rgba(255,255,255,0)","mh-primary_menu_dropdown_wrapper_gradient":{"color1":"#666666","start":"0","color2":"#666666","end":"100","orientation":"top"},"mh-primary_menu_dropdown_link_font":{"font_family":"Inherit","font_size":"12","font_weight":"400"},"mh-primary_menu_dropdown_link_color":"#ffffff","mh-primary_menu_dropdown_icon_font":"0","mh-primary_menu_dropdown_link_bg":{"color1":"#666666","start":"0","color2":"#666666","end":"100","orientation":"top"},"mh-primary_menu_dropdown_link_border_color":"rgba(255,255,255,0)","mh-primary_menu_dropdown_link_color_hover":"#ffffff","mh-primary_menu_dropdown_link_bg_hover":{"color1":"#999999","start":"0","color2":"#999999","end":"100","orientation":"top"},"mh-primary_menu_dropdown_plain_text_color":"#231e2e","custom_css":"","responsive_styles":["is_checkbox","true"],"responsive_resolution":"1024","icon_sets":["is_checkbox"],"coercive_styles":["is_checkbox"],"indefinite_location_mode":["is_checkbox"],"number_of_widgets":"1","language_direction":"ltr","item_descr":["is_checkbox","disable"],"item_style":["is_checkbox","disable"],"item_visibility":["is_checkbox","disable"],"item_icon":["is_checkbox"],"disable_text":["is_checkbox","disable"],"disable_link":["is_checkbox","disable"],"pull_to_other_side":["is_checkbox","disable"],"submenu_type":["is_checkbox"],"submenu_drops_side":["is_checkbox"],"submenu_columns":["is_checkbox"],"submenu_enable_full_width":["is_checkbox"],"submenu_bg_image":["is_checkbox","disable"],"purchase_code":""}';
			$myhome_custom_configuration = json_decode( $settings, true );
			update_option( 'mega_main_menu_options', $myhome_custom_configuration );
			$mmm_config                                                       = get_option( 'mega_main_menu_options' );
			$mmm_config['mh-primary_first_level_item_height']                 = My_Home_Theme()->settings->get( 'menu-height' );
			$mmm_config['mh-primary_first_level_item_align']                  = My_Home_Theme()->settings->get( 'menu-first-level-item-align' );
			$mmm_config['mh-primary_menu_first_level_link_font']['font_size'] = My_Home_Theme()->settings->get( 'menu-first-level-item-size' );
			$mmm_config['mh-primary_menu_dropdown_link_font']['font_size']    = My_Home_Theme()->settings->get( 'menu-dropdown-item-height' );
			$mmm_config['last_modified']                                      = time();
			$rtl_support                                                      = My_Home_Theme()->settings->get( 'typography-rtl' );
			if ( ! empty( $rtl_support ) && $rtl_support ) {
				$mmm_config['language_direction '] = 'rtl';
			} else {
				$mmm_config['language_direction '] = 'ltr';
			}
			// set options
			update_option( 'mega_main_menu_options', $mmm_config );
		}

		/*
		 * register_menu
		 *
		 * Register menu location
		 */
		public function register_menu() {
			register_nav_menus(
				array(
					'mh-primary' => esc_html__( 'MH Primary', 'myhome' ),
				)
			);
		}

		/*
		 * add_class
		 *
		 * Add wrapper class for mega main menu based on selected header style.
		 */
		public function add_class( $default_classes ) {
			$menu_style = My_Home_Theme()->settings->get( 'top-header-style' );
			if ( $menu_style == 'big' ) {
				array_push( $default_classes, 'mh-primary--no-logo' );
			}

			return implode( ' ', $default_classes );
		}

		/*
		 * set_logo
		 *
		 * Mega_main_menu 'set logo' option is overwritten here, so its possible to switch logo for dark and light header.
		 */
		public function set_logo( $nav_menu ) {
			if ( ! class_exists( 'mega_main_init' ) || ! has_nav_menu( 'mh-primary' ) ) {
				return $nav_menu;
			}
			$logo          = '';
			$estate_slider = My_Home_Theme()->settings->get( 'estate_slider' );

			if ( is_singular( 'estate' ) && $estate_slider == 'single-estate-slider' ) {
				$logo      = My_Home_Theme()->settings->get( 'logo-dark', 'url' );
				$logo_when = My_Home_Theme()->settings->get( 'logo', 'url' );
			} elseif ( is_page() ) {
				global $post;
				$image = get_post_meta( $post->ID, 'page_header', true );
				if ( $image == 'mh-header--transparent mh-header--transparent-dark' ) {
					$logo      = My_Home_Theme()->settings->get( 'logo-dark', 'url' );
					$logo_when = My_Home_Theme()->settings->get( 'logo', 'url' );
				} elseif ( $image == 'mh-header--transparent' ) {
					$logo      = My_Home_Theme()->settings->get( 'logo-dark', 'url' );
					$logo_when = My_Home_Theme()->settings->get( 'logo', 'url' );
				}
			}

			if ( empty( $logo ) ) {
				$logo = My_Home_Theme()->settings->get( 'logo', 'url' );
			}
			$homepage_url = apply_filters( 'wpml_home_url', home_url() );

			ob_start();
			?>
			<span class="nav_logo">
            <a class="mobile_toggle">
                <span class="mobile_button">
                    <span class="symbol_menu"><i class="fa fa-bars"></i></span>
                    <span class="symbol_cross"><i class="fa fa-times"></i></span>
                </span>
            </a>
				<?php if ( ! empty( $logo ) ) : ?>
					<a class="logo_link" href="<?php echo esc_url( $homepage_url ); ?>"
					   title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                    <img
						src="<?php echo esc_url( $logo ); ?>"
						data-logo="<?php echo esc_url( $logo ); ?>"
	                    <?php if ( ! empty( $logo_when ) ) : ?>
							data-logo-switch="<?php echo esc_url( $logo_when ); ?>"
	                    <?php endif; ?>
						alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
					>
                </a>
				<?php endif; ?>
        </span>
			<?php

			$logo     = ob_get_clean();
			$html     = str_get_html( $nav_menu );
			$nav_logo = $html->find( '.nav_logo', 0 );
			if ( ! empty( $nav_logo ) ) {
				$nav_logo->outertext = '';
			}
			$menu_inner = $html->find( '.menu_inner', 0 );
			if ( ! empty( $menu_inner ) && is_object( $menu_inner ) ) {
				$menu_inner->innertext = $logo . $menu_inner->innertext;
			}

			return $html->outertext;
		}

		/*
		 * add_elements
		 *
		 * Add additional menu elements
		 */
		public function add_elements( $items, $args ) {
			$agent_submit_property = My_Home_Theme()->settings->get( 'agent-submit_property' );
			if ( empty( $agent_submit_property ) ) {
				return $items;
			}

			$panel = intval( My_Home_Theme()->settings->get( 'agent-panel' ) );
			if ( ! empty( $panel ) && $panel ) {
				$panel_page = My_Home_Theme()->settings->get( 'agent-panel_page' );
				$panel_link = My_Home_Theme()->settings->get( 'agent-panel_link' );
				if ( empty( $panel_link ) && empty( $panel_page ) ) {
					return $items;
				}

				if ( ! empty( $panel_page ) ) {
					$panel_link = apply_filters( 'wpml_permalink', get_page_link( $panel_page ) );
				}

				ob_start();
				?>
				<li id="mh-submit-button">
                <span class="item_link">
                    <span class="link_content">
                        <a
	                        <?php if ( is_page_template( 'page_agents.php' ) ) : ?>
								onclick="location.reload()"
	                        <?php endif; ?>
							id="myhome-submit-property"
							href="<?php echo esc_url( $panel_link ); ?>#submit-property"
							title="<?php echo esc_attr( 'Submit property', 'myhome' ); ?>"
						>
                            <?php esc_html_e( 'Submit property', 'myhome' ); ?>
							<i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </a>
                    </span>
                </span>
				</li>
				<?php
				$items .= ob_get_clean();
			}

			return $items;
		}

		/*
		 * mega_menu_config
		 *
		 * Base configuration for Mega Main Menu Plugin, used right after plugin activation
		 */
		public function mega_menu_config( $default_configuration ) {

		}

	}

endif;