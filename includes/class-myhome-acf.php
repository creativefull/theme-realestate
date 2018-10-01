<?php

/*
 * My_Home_ACF class
 *
 * This class initiate general purpose custom fields.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'My_Home_ACF' ) ) :

	class My_Home_ACF {

		/**
		 * My_Home_ACF constructor.
		 */
		public function __construct() {
			$this->add_page_fields();
		}

		/*
		 * add_page_fields
		 *
		 * Setup page fields
		 */
		private function add_page_fields() {
			if ( ! function_exists( 'acf_add_local_field_group' ) ) {
				return;
			}

			acf_add_local_field_group(
				array(
					'key'      => 'myhome_page',
					'title'    => esc_html__( 'Page settings', 'myhome' ),
					'position' => 'side',
					'location' => array(
						array(
							array(
								'param'    => 'page_template',
								'operator' => '==',
								'value'    => 'page_full-width-with-top-title.php'
							)
						),
						array(
							array(
								'param'    => 'page_template',
								'operator' => '==',
								'value'    => 'page_left-sidebar-with-top-title.php'
							)
						),
						array(
							array(
								'param'    => 'page_template',
								'operator' => '==',
								'value'    => 'page_right-sidebar-with-top-title.php'
							)
						),
					),
					'fields'   => array(
						// Sidebar position
						array(
							'key'           => 'myhome_page_header',
							'label'         => esc_html__( 'Menu', 'myhome' ),
							'name'          => 'page_header',
							'type'          => 'select',
							'default_value' => 'right',
							'choices'       => array(
								'default'                                            => esc_html__( 'Default', 'myhome' ),
								'mh-header--transparent'                             => esc_html__( 'Transparent', 'myhome' ),
								'mh-header--transparent mh-header--transparent-dark' => esc_html__(
									'Transparent - dark gradient', 'myhome'
								)
							)
						),
						array(
							'key'          => 'myhome_term_image_wide',
							'label'        => esc_html__( 'Image wide', 'myhome' ),
							'instructions' => esc_html__( 'Recommended size 1920x500 px', 'myhome' ),
							'name'         => 'term_image_wide',
							'type'         => 'image'
						),
					)
				)
			);

			acf_add_local_field_group(
				array(
					'key'      => 'myhome_page_without_top_title',
					'title'    => esc_html__( 'Page settings', 'myhome' ),
					'position' => 'side',
					'location' => array(
						array(
							array(
								'param'    => 'page_template',
								'operator' => '==',
								'value'    => 'default'
							)
						),
						array(
							array(
								'param'    => 'page_template',
								'operator' => '==',
								'value'    => 'page_full-width.php'
							)
						),
						array(
							array(
								'param'    => 'page_template',
								'operator' => '==',
								'value'    => 'page_left-sidebar.php'
							)
						),
						array(
							array(
								'param'    => 'page_template',
								'operator' => '==',
								'value'    => 'page_right-sidebar.php'
							)
						),
					),
					'fields'   => array(
						// Sidebar position
						array(
							'key'           => 'myhome_page_header',
							'label'         => esc_html__( 'Menu', 'myhome' ),
							'name'          => 'page_header',
							'type'          => 'select',
							'default_value' => 'right',
							'choices'       => array(
								'default'                                            => esc_html__( 'Default', 'myhome' ),
								'mh-header--transparent'                             => esc_html__( 'Transparent', 'myhome' ),
								'mh-header--transparent mh-header--transparent-dark' => esc_html__(
									'Transparent - dark gradient', 'myhome'
								)
							)
						)
					)
				)
			);
		}

	}

endif;
