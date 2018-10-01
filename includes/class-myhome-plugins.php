<?php

/*
 * My_Home_Plugins class
 *
 * Manage plugins included with theme.
 * Without plugins set as required theme won't work.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'My_Home_Plugins' ) ) :

class My_Home_Plugins {

    /*
     * register
     *
     * Initiate tgmpa plugin
     */
	public function register() {
		tgmpa( $this->get_plugins(), $this->get_config() );
	}

	/*
	 * get_config
	 *
	 * Set config for tgmpa plugin
	 */
	private function get_config() {
		return array(
			'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                    // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);
	}

	/*
	 * get_plugins
	 *
	 * List of plugins included with MyHome theme
	 */
	private function get_plugins() {
		return array(
            // MyHome Core includes post types, taxonomies and other core modules
            array(
                'name'                  => esc_html__( 'MyHome Core', 'myhome' ),
                'slug'                  => 'myhome-core',
                'source'                => get_template_directory() . '/plugins/myhome-core.zip',
                'required'              => true,
                'version'               => '2.1.17',
                'force_activation'      => false,
                'force_deactivation'    => false,
            ),
            // MyHome IDX Broker
            array(
                'name'                  => esc_html__( 'MyHome IDX Broker', 'myhome' ),
                'slug'                  => 'myhome-idx-broker',
                'source'                => get_template_directory() . '/plugins/myhome-idx-broker.zip',
                'required'              => false,
                'version'               => '1.1',
                'force_activation'      => false,
                'force_deactivation'    => false,
            ),
            // ACF Pro Plugin - https://www.advancedcustomfields.com
            array(
                'name'                  => esc_html__( 'Advanced Custom Fields PRO', 'myhome' ),
                'slug'                  => 'advanced-custom-fields-pro',
                'source'                => get_template_directory() . '/plugins/advanced-custom-fields-pro.zip',
                'required'              => true,
                'version'               => '5.3.12',
                'force_activation'      => false,
                'force_deactivation'    => false,
            ),
            // WPBakery Visual Composer - https://vc.wpbakery.com/
            array(
                'name'                  => esc_html__( 'WPBakery Visual Composer', 'myhome' ),
                'slug'                  => 'js_composer',
                'source'                => get_template_directory() . '/plugins/js_composer.zip',
                'required'              => true,
                'version'               => '4.12',
                'force_activation'      => false,
                'force_deactivation'    => false,
            ),
            // Contact Form 7 - https://wordpress.org/plugins/contact-form-7/
            array(
                'name'                  => esc_html__( 'Contact Form 7', 'myhome' ),
                'slug'                  => 'contact-form-7',
                'required'              => false,
                'version'               => '4.7',
                'force_activation'      => false,
                'force_deactivation'    => false,
            ),
            // ReduxFramework - https://reduxframework.com/
            array(
                'name'                  => esc_html__( 'Redux Framework', 'myhome' ),
                'slug'                  => 'redux-framework',
                'source'                => get_template_directory() . '/plugins/redux-framework.zip',
                'required'              => true,
                'version'               => '3.6.7.11',
                'force_activation'      => false,
                'force_deactivation'    => false,
            ),
            // Revolution Slider - https://revolution.themepunch.com/
            array(
                'name'                  => esc_html__( 'Slider Revolution', 'myhome' ),
                'slug'                  => 'revslider',
                'source'                => get_template_directory() . '/plugins/slider-revolution.zip',
                'required'              => true,
                'version'               => '5.4.5.2',
                'force_activation'      => false,
                'force_deactivation'    => false,
            ),
            // Mega Main Menu - http://menu.megamain.com/
            array(
                'name'                  => esc_html__( 'Mega Main Menu', 'myhome' ),
                'slug'                  => 'mega_main_menu',
                'source'                => get_template_directory() . '/plugins/mega-main-menu.zip',
                'required'              => true,
                'version'               => '2.1.3',
                'force_activation'      => false,
                'force_deactivation'    => false,
            ),
            // Ultimate Addons for Visual Composer - https://ultimate.brainstormforce.com/
            array(
                'name'               => esc_html__( 'Ultimate Addons for Visual Composer', 'myhome' ),
                'slug'               => 'Ultimate_VC_Addons',
                'source'             => get_template_directory() . '/plugins/ultimate-addons-for-visual-composer.zip',
                'required'           => false,
                'version'            => '3.16.15',
                'force_activation'   => false,
                'force_deactivation' => false,
            ),
            // Easy Social Share Buttons - https://socialsharingplugin.com/
            array(
                'name'               => esc_html__( 'Easy Social Share Buttons', 'myhome' ),
                'slug'               => 'easy-social-share-buttons3',
                'source'             => get_template_directory() . '/plugins/easy-social-share-buttons.zip',
                'required'           => false,
                'version'            => '4.3.1',
                'force_activation'   => false,
                'force_deactivation' => false,
            ),
            // MyHome Demo Importer
            array(
                'name'               => esc_html__( 'MyHome Demo Importer', 'myhome' ),
                'slug'               => 'myhome-importer',
                'source'             => get_template_directory() . '/plugins/myhome-importer.zip',
                'required'           => false,
                'version'            => '3.0.2',
                'force_activation'   => false,
                'force_deactivation' => false,
            ),
		);
	}

}

endif;
