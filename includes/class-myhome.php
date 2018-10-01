<?php

/*
 * MyHome Main class
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'My_Home' ) ) :

class My_Home {

    public static $instance = false;
	/**
	 * @var My_Home_Redux
	 */
    public $settings;
	public $comments;
	/**
	 * @var My_Home_Layout
	 */
	public $layout;
	public $scripts;
	public $acf;
	public $plugins;
	/**
	 * @var My_Home_Images
	 */
	public $images;
	public $menu;
	public $translation;
	public $init;
	public $version = '2.1.17';

    private function __construct(){}

    /*
     * init
     *
     * Initiate all necessary modules
     */
    public function init() {
	    $this->load_dependencies();

	    //
	    $this->plugins      = new My_Home_Plugins();
	    // load js and css files
	    $this->scripts      = new My_Home_Scripts();
	    // prepare generic custom fields
	    $this->acf          = new My_Home_ACF();
	    // set theme options
	    $this->settings     = new My_Home_Redux();
	    // initiate comments module
	    $this->comments     = new My_Home_Comments();
	    // initiate layout
	    $this->layout       = new My_Home_Layout();
	    // set images dimensions
	    $this->images       = new My_Home_Images();
	    // prepare menu
	    $this->menu         = new My_Home_Menu();
	    // setup theme
        $this->init         = new My_Home_Init();

        add_action( 'after_setup_theme', array( $this, 'load_textdomain' ) );
	}

    /*
     * load_textdomain
     *
     * Load theme textdomain for translations
     */
    public function load_textdomain(){
        load_theme_textdomain( 'myhome', get_template_directory() . '/languages' );
    }

    /**
     * load_dependencies
     *
     * Load all files required by theme
     */
    private function load_dependencies() {
	    require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';
	    require_once get_template_directory() . '/includes/class-myhome-init.php';
	    require_once get_template_directory() . '/includes/class-myhome-layout.php';
	    require_once get_template_directory() . '/includes/layout/class-myhome-footer.php';
	    require_once get_template_directory() . '/includes/class-myhome-comments.php';
	    require_once get_template_directory() . '/includes/class-myhome-plugins.php';
	    require_once get_template_directory() . '/includes/class-myhome-images.php';
	    require_once get_template_directory() . '/includes/class-myhome-scripts.php';
	    require_once get_template_directory() . '/includes/class-myhome-redux.php';
	    require_once get_template_directory() . '/includes/class-myhome-acf.php';
	    require_once get_template_directory() . '/includes/class-myhome-compare.php';
	    require_once get_template_directory() . '/includes/menu/class-myhome-menu.php';
	    require_once get_template_directory() . '/includes/libs/simple_html_dom.php';
    }

    /*
     * get_instance
     *
     * Get My_Home instance or create if doesn't exists
     */
    public static function get_instance() {
        if ( ! self::$instance ) {
            self::$instance = new My_Home();
        }
        return self::$instance;
    }

}

endif;
