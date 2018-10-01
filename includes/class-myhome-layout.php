<?php

/*
 * My_Home_Layout class
 *
 * Manage theme layout
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'My_Home_Layout' ) ) :

	class My_Home_Layout {

		/*
		 * top_title_show
		 *
		 * Check if top_title should be displayed
		 */
		public function top_title_show() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			return intval( My_Home_Theme()->settings->get( 'top-title-show' ) );
		}


		/*
		 * top_title_style
		 *
		 * Get top_title style
		 */
		public function top_title_style() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return true;
			}

			return My_Home_Theme()->settings->get( 'top-title-style' );
		}

		/*
		 * top_title_background_image_parallax
		 *
		 * Check if blog parallax image should be displayed
		 */
		public function top_title_background_image_parallax() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			return intval( My_Home_Theme()->settings->get( 'top-title-background-image-parallax' ) );
		}

		/*
		 * get_top_title_background_image_url
		 *
		 * Get image for blog parallax
		 */
		public function get_top_title_background_image_url() {
			return My_Home_Theme()->settings->get( 'top-title-background-image-url', 'id' );
		}

		/*
		 * has_logo
		 *
		 * Check if logo is set
		 */
		public function has_logo() {
			$mega_main_menu_options = get_option( 'mega_main_menu_options' );
			if ( isset( $mega_main_menu_options['logo_src'] ) && ! empty( $mega_main_menu_options['logo_src'] ) ) {
				$logo = $mega_main_menu_options['logo_src'];
			} else {
				$logo = My_Home_Theme()->settings->get( 'logo', 'url' );
			}

			return ! empty( $logo );
		}

		/*
		 * get_logo
		 *
		 * Get logo
		 */
		public function get_logo() {
			$mega_main_menu_options = get_option( 'mega_main_menu_options' );
			if ( isset( $mega_main_menu_options['logo_src'] ) && ! empty( $mega_main_menu_options['logo_src'] ) ) {
				return $mega_main_menu_options['logo_src'];
			} else {
				return My_Home_Theme()->settings->get( 'logo', 'url' );
			}
		}

		public function is_mega_main_menu_active() {
			return class_exists( 'mega_main_init' );
		}

		/*
		 * get_archive_style
		 *
		 * Get archive style
		 */
		public function get_archive_style() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return 'vertical';
			}

			return My_Home_Theme()->settings->get( 'blog-archive-style' );
		}

		/*
		 * top_header_style
		 *
		 * Get top header style
		 */
		public function top_header_style() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return 'none';
			}

			$header_style = My_Home_Theme()->settings->get( 'top-header-style' );

			return $header_style;
		}

		/*
		 * top_wide
		 *
		 * Get top header style
		 */
		public function top_wide() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return 'none';
			}

			$top_wide = My_Home_Theme()->settings->get( 'top-wide' );

			return $top_wide;
		}

		/*
		 * sticky_menu
		 *
		 * Get sticky menu
		 */
		public function sticky_menu() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return 'none';
			}

			$sticky_menu = My_Home_Theme()->settings->get( 'sticky-menu' );

			return $sticky_menu;
		}

		/*
		 * sticky_menu_transparent
		 *
		 * Get sticky menu
		 */
		public function sticky_menu_transparent() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return 'none';
			}

			$sticky_menu = My_Home_Theme()->settings->get( 'sticky-menu-transparent' );

			return $sticky_menu;
		}

		/*
		 * menu_primary
		 *
		 * Get top header style
		 */
		public function menu_primary() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return 'none';
			}

			$menu_primary = My_Home_Theme()->settings->get( 'menu-primary' );

			return $menu_primary;
		}

		/*
		 * has_big_top_logo
		 *
		 * Check if header big top bar logo is set
		 */
		public function has_big_top_logo() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$footer_logo = My_Home_Theme()->settings->get( 'logo-top-bar' );

			return empty( $footer_logo ) ? false : true;
		}

		/*
		 * get_big_top_logo
		 *
		 * Get header big top bar logo
		 */
		public function get_big_top_logo() {
			return My_Home_Theme()->settings->get( 'logo-top-bar', 'url' );
		}

		/*
		 * footer_style
		 *
		 * Get footer style
		 */
		public function footer_style() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return 'dark';
			}

			$footer_style = My_Home_Theme()->settings->get( 'footer-style' );

			return $footer_style;
		}

		/*
		 * has_footer_background_image
		 *
		 * Check if footer background image should be displayed
		 */
		public function has_footer_background_image() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$footer_background_image = My_Home_Theme()->settings->get( 'footer-background-image' );

			return empty( $footer_background_image ) ? false : true;
		}

		/*
		 * has_footer_background_image_url
		 *
		 * Check if footer background image is set
		 */
		public function has_footer_background_image_url() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$footer_background_image_url = My_Home_Theme()->settings->get( 'footer-background-image-url' );

			return empty( $footer_background_image_url ) ? false : true;
		}

		/*
		 * get_footer_background_image_url
		 *
		 * Get background image for footer
		 */
		public function get_footer_background_image_url() {
			return My_Home_Theme()->settings->get( 'footer-background-image-url', 'url' );
		}

		/*
		 * has_footer_background_image_parallax
		 *
		 * Check if footer parallax image is set
		 */
		public function has_footer_background_image_parallax() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$footer_background_image_paralax = My_Home_Theme()->settings->get( 'footer-background-image-parallax' );

			return empty( $footer_background_image_paralax ) ? false : true;
		}

		/*
		 * has_footer_widget_area_footer_information
		 *
		 * Check if footer widget area is set
		 */
		public function has_footer_widget_area_footer_information() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$footer_widget_area_footer_information = My_Home_Theme()->settings->get( 'footer-widget-area-footer-information' );

			return empty( $footer_widget_area_footer_information ) ? false : true;
		}

		/*
		 * Check if footer logo is set
		 */
		public function has_footer_logo() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$footer_logo = My_Home_Theme()->settings->get( 'footer-logo' );

			return empty( $footer_logo ) ? false : true;
		}

		/*
		 * get_footer_logo
		 *
		 * Get footer logo
		 */
		public function get_footer_logo() {
			return My_Home_Theme()->settings->get( 'footer-logo', 'url' );
		}

		/*
		 * has_footer_text
		 *
		 * Check if footer text is set
		 */
		public function has_footer_text() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$footer_text = My_Home_Theme()->settings->get( 'footer-text' );

			return empty( $footer_text ) ? false : true;
		}

		/*
		 * get_footer_text
		 *
		 * Get footer text
		 */
		public function get_footer_text() {
			return apply_filters(
				'wpml_translate_single_string',
				My_Home_Theme()->settings->get( 'footer-text' ),
				'MyHome Settings',
				'mh-footer-text'
			);
		}

		/*
		 * has_footer_address
		 *
		 * Check if footer address is set
		 */
		public function has_footer_address() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$footer_address = My_Home_Theme()->settings->get( 'footer-address' );

			return empty( $footer_address ) ? false : true;
		}

		/*
		 * get_footer_address
		 *
		 * Get footer address
		 */
		public function get_footer_address() {
			$footer_address = My_Home_Theme()->settings->get( 'footer-address' );

			if ( class_exists( 'MyHomeCore\Core' ) && ! empty( \MyHomeCore\My_Home_Core()->current_language ) ) {
				$footer_address = apply_filters(
					'wpml_translate_single_string',
					$footer_address,
					'MyHome Settings',
					'mh-footer-address'
				);
			}


			return $footer_address;
		}

		/*
		 * has_footer_phone
		 *
		 * Check if footer_phone is set
		 */
		public function has_footer_phone() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$footer_phone = My_Home_Theme()->settings->get( 'footer-phone' );

			return ! empty( $footer_phone );
		}

		/*
		 * get_footer_phone
		 *
		 * Get footer phone
		 */
		public function get_footer_phone() {
			$footer_phone = My_Home_Theme()->settings->get( 'footer-phone' );

			if ( class_exists( 'MyHomeCore\Core' ) && ! empty( \MyHomeCore\My_Home_Core()->current_language ) ) {
				$footer_phone = apply_filters(
					'wpml_translate_single_string',
					$footer_phone,
					'MyHome Settings',
					'mh-footer-phone'
				);
			}

			return $footer_phone;
		}

		/*
		 * get_footer_phone_href
		 *
		 * Get footer phone (remove spaces)
		 */
		public function get_footer_phone_href() {
			return str_replace( array( ' ', '-', '(', ')' ), '', $this->get_footer_phone() );
		}

		/*
		 * has_footer_email
		 *
		 * Check if footer email is set
		 */
		public function has_footer_email() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$footer_email = My_Home_Theme()->settings->get( 'footer-email' );

			return empty( $footer_email ) ? false : true;
		}

		/*
		 * get_footer_email
		 *
		 * Get footer email
		 */
		public function get_footer_email() {
			$footer_email = My_Home_Theme()->settings->get( 'footer-email' );

			if ( class_exists( 'MyHomeCore\Core' ) && ! empty( \MyHomeCore\My_Home_Core()->current_language ) ) {
				$footer_email = apply_filters(
					'wpml_translate_single_string',
					$footer_email,
					'MyHome Settings',
					'mh-footer-email'
				);
			}

			return $footer_email;
		}

		/*
		 * has_header_address
		 *
		 * Check if header address is set
		 */
		public function has_header_address() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$header_address = My_Home_Theme()->settings->get( 'header-address' );

			return empty( $header_address ) ? false : true;
		}

		/*
		 * get_header_address
		 *
		 * Get header address
		 */
		public function get_header_address() {
			$header_address = My_Home_Theme()->settings->get( 'header-address' );
			if ( class_exists( 'MyHomeCore\Core' ) && ! empty( \MyHomeCore\My_Home_Core()->current_language ) ) {
				$header_address = apply_filters(
					'wpml_translate_single_string',
					$header_address,
					'MyHome Settings',
					'mh-header-address'
				);
			}

			return $header_address;
		}

		/*
		 * has_header_phone
		 *
		 * Check if header_phone is set
		 */
		public function has_header_phone() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$header_phone = My_Home_Theme()->settings->get( 'header-phone' );

			return empty( $header_phone ) ? false : true;
		}

		/*
		 * get_header_phone
		 *
		 * Get header phone
		 */
		public function get_header_phone() {
			$header_phone = My_Home_Theme()->settings->get( 'header-phone' );

			if ( class_exists( 'MyHomeCore\Core' ) && ! empty( \MyHomeCore\My_Home_Core()->current_language ) ) {
				$header_phone = apply_filters(
					'wpml_translate_single_string',
					$header_phone,
					'MyHome Settings',
					'mh-header-phone'
				);
			}

			return $header_phone;
		}

		/*
		 * get_header_phone_href
		 *
		 * Get header phone (remove spaces)
		 */
		public function get_header_phone_href() {
			return str_replace( array( ' ', '-', '(', ')' ), '', $this->get_header_phone() );
		}

		/*
		 * has_header_email
		 *
		 * Check if header email is set
		 */
		public function has_header_email() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$header_email = My_Home_Theme()->settings->get( 'header-email' );

			return ! empty( $header_email );
		}

		/*
		 * get_header_email
		 *
		 * Get header email
		 */
		public function get_header_email() {
			$header_email = My_Home_Theme()->settings->get( 'header-email' );

			return apply_filters(
				'wpml_translate_single_string',
				$header_email,
				'MyHome Settings',
				'mh-header-email'
			);
		}

		/*
		 * has_header_social_icons
		 *
		 * check if any social icons are set for header
		 */
		public function has_header_social_icons() {
			$facebook  = My_Home_Theme()->settings->get( 'header-facebook' );
			$twitter   = My_Home_Theme()->settings->get( 'header-twitter' );
			$instagram = My_Home_Theme()->settings->get( 'header-instagram' );
			$linkedin  = My_Home_Theme()->settings->get( 'header-linkedin' );
			if ( ! empty( $facebook ) || ! empty( $twitter ) || ! empty( $instagram ) || ! empty( $linkedin ) ) {
				return true;
			} else {
				return false;
			}
		}

		/*
		 * has_header_facebook
		 *
		 * Check if header facebook link is set
		 */
		public function has_header_facebook() {
			$facebook = My_Home_Theme()->settings->get( 'header-facebook' );

			return ! empty( $facebook );
		}

		/*
		 * get_header_facebook
		 *
		 * Get header facebook link
		 */
		public function get_header_facebook() {
			$header_facebook = My_Home_Theme()->settings->get( 'header-facebook' );

			return apply_filters(
				'wpml_translate_single_string',
				$header_facebook,
				'MyHome Settings',
				'mh-header-facebook'
			);
		}

		/*
		 * has_header_twitter
		 *
		 * Check if header twitter link is set
		 */
		public function has_header_twitter() {
			$twitter = My_Home_Theme()->settings->get( 'header-twitter' );

			return ! empty( $twitter );
		}

		/*
		 * get_header_twitter
		 *
		 * Get header twitter link
		 */
		public function get_header_twitter() {
			$header_twitter = My_Home_Theme()->settings->get( 'header-twitter' );

			return apply_filters(
				'wpml_translate_single_string',
				$header_twitter,
				'MyHome Settings',
				'mh-header-twitter'
			);
		}

		/*
		 * has_header_linkedin
		 *
		 * Check if header linkedin link is set
		 */
		public function has_header_linkedin() {
			$linkedin = My_Home_Theme()->settings->get( 'header-linkedin' );

			return ! empty( $linkedin );
		}

		/*
		 * get_header_linkedin
		 *
		 * Get header linkedin link
		 */
		public function get_header_linkedin() {
			$header_linkedin = My_Home_Theme()->settings->get( 'header-linkedin' );

			return apply_filters(
				'wpml_translate_single_string',
				$header_linkedin,
				'MyHome Settings',
				'mh-header-linkedin'
			);
		}

		/*
		 * has_header_instagram
		 *
		 * Check if header instagram link is set
		 */
		public function has_header_instagram() {
			$instagram = My_Home_Theme()->settings->get( 'header-instagram' );

			return ! empty( $instagram );
		}

		/*
		 * get_header_instagram
		 *
		 * Get header instagram link
		 */
		public function get_header_instagram() {
			$header_instagram = My_Home_Theme()->settings->get( 'header-instagram' );

			return apply_filters(
				'wpml_translate_single_string',
				$header_instagram,
				'MyHome Settings',
				'mh-header-instagram'
			);
		}

		/*
		 * has_footer_copyright_area_show
		 *
		 * Check if copyright area should be displayed
		 */
		public function has_footer_copyright_area_show() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$footer_copyright_area_show = My_Home_Theme()->settings->get( 'footer-copyright-area-show' );

			return ! empty( $footer_copyright_area_show );
		}

		/*
		 * has_footer_widget_area_show
		 *
		 * Check if footer widget area should be displayed
		 */
		public function has_footer_widget_area_show() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return true;
			}

			$footer_copyright_area_show = My_Home_Theme()->settings->get( 'footer-widget-area-show' );

			return ! empty( $footer_copyright_area_show );
		}

		/*
		 * footer_copyright_style
		 *
		 * Get copyright style
		 */
		public function footer_copyright_style() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return true;
			}
			$footer_copyright_style = My_Home_Theme()->settings->get( 'footer-copyright-style' );

			return $footer_copyright_style;
		}

		/*
		 * has_footer_copyright_text
		 *
		 * Check if copyright text is set
		 */
		public function has_footer_copyright_text() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$footer_copyright_text = My_Home_Theme()->settings->get( 'footer-copyright-text' );

			return ! empty( $footer_copyright_text );
		}

		/*
		 * get_footer_copyright_text
		 *
		 * Get copyright text
		 */
		public function get_footer_copyright_text() {
			$footer_copyright_text = My_Home_Theme()->settings->get( 'footer-copyright-text' );

			return apply_filters(
				'wpml_translate_single_string',
				$footer_copyright_text,
				'MyHome Settings',
				'mh-footer-copyright-text'
			);
		}

		/*
		 * has_404_heading
		 *
		 * Check if 404 heading is set
		 */
		public function has_404_heading() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$e404_heading = My_Home_Theme()->settings->get( '404-heading' );

			return ! empty( $e404_heading );
		}

		/*
		 * get_404_heading
		 *
		 * Get 404 heading
		 */
		public function get_404_heading() {
			$heading = My_Home_Theme()->settings->get( '404-heading' );

			return apply_filters(
				'wpml_translate_single_string',
				$heading,
				'MyHome Settings',
				'mh-404-heading'
			);
		}

		/*
		 * has_404_text
		 *
		 * Check if 404 text is set
		 */
		public function has_404_text() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			$e404_text = My_Home_Theme()->settings->get( '404-text' );

			return ! empty( $e404_text );
		}

		/*
		 * get_404_text
		 *
		 * Get 404 text
		 */
		public function get_404_text() {
			$text = My_Home_Theme()->settings->get( '404-text' );

			return apply_filters(
				'wpml_translate_single_string',
				$text,
				'MyHome Settings',
				'mh-404-text'
			);
		}

		/*
		 * get_sidebar_position
		 *
		 * Get sidebar position
		 */
		public function get_sidebar_position() {
			$default_value = 'right';
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return $default_value;
			}

			$sidebar_position = My_Home_Theme()->settings->get( 'blog-sidebar-position' );
			if ( empty ( $sidebar_position ) ) {
				return $default_value;
			} else {
				return $sidebar_position;
			}
		}

		/*
		 * show_comments
		 *
		 * Check if blog post comments should be displayed
		 */
		public function show_comments() {
			if ( ! ( comments_open() || get_comments_number() ) ) {
				return false;
			}

			if ( ! class_exists( 'ReduxFramework' ) ) {
				return true;
			}

			$show_comments = My_Home_Theme()->settings->get( 'blog-show-comments' );
			if ( $show_comments != '' ) {
				return $show_comments;
			} else {
				return true;
			}
		}

		/*
		 * show_nav
		 *
		 * Check if blog posts navigation should be displayed
		 */
		public function show_nav() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return true;
			}

			$show_nav = My_Home_Theme()->settings->get( 'blog-show-nav' );
			if ( $show_nav != '' ) {
				return $show_nav;
			} else {
				return true;
			}
		}

		/*
		 * show_tags
		 *
		 * Check if post tags should be displayed
		 */
		public function show_tags() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return true;
			}

			$show_tags = My_Home_Theme()->settings->get( 'blog-show-tags' );
			if ( $show_tags != '' ) {
				return $show_tags;
			} else {
				return true;
			}
		}

		/*
		 * show_author
		 *
		 * Check if author should be displayed for blog post
		 */
		public function show_author() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return true;
			}

			return intval( My_Home_Theme()->settings->get( 'blog-show-author' ) );
		}

		/*
		 * get_more_text
		 *
		 * Get label for read more button
		 */
		public function get_more_text() {
			$more_text = My_Home_Theme()->settings->get( 'blog-more' );
			if ( empty( $more_text ) ) {
				return esc_html__( 'Read more', 'myhome' );
			}

			return apply_filters(
				'wpml_translate_single_string',
				$more_text,
				'MyHome Settings',
				'mh-blog-more'
			);
		}

		/*
		 * main_class
		 *
		 * Set class for main container
		 */
		public function main_class() {
			$classes = array();

			array_push(
				$classes,
				$this->get_sidebar_position() == 'left' ? 'mh-layout__content-right' : 'mh-layout__content-left'
			);

			echo ' class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}

		/*
		 * show_related
		 *
		 * Check if related posts should be displayed
		 */
		public function show_related() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return false;
			}

			return intval( My_Home_Theme()->settings->get( 'blog-show-related' ) );
		}

		/*
		 * get_related
		 *
		 * Get related posts (by category)
		 */
		public function get_related() {
			global $post;
			$categories = '';

			foreach ( get_the_category( $post->ID ) as $key => $cat ) {
				$categories .= $key ? ',' . $cat->term_id : $cat->term_id;
			}

			$related_number = My_Home_Theme()->settings->get( 'blog-related-number' );
			$related_number = empty( $related_number ) ? 4 : $related_number;

			$posts = get_posts(
				array(
					'posts_per_page'      => $related_number,
					'category'            => $categories,
					'orderby'             => 'date',
					'order'               => 'DESC',
					'exclude'             => $post->ID,
					'post_type'           => 'post',
					'post_status'         => 'publish',
					'suppress_filters'    => true,
					'ignore_sticky_posts' => true
				)
			);

			return $posts;
		}

		/*
		 * tags
		 *
		 * Display post tags
		 */
		public function tags() {
			$tags = get_the_tags();

			if ( empty( $tags ) ) {
				return;
			}
			?>

			<div class="tagcloud">

				<?php foreach ( $tags as $tag ) : ?>
					<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"
					   title="<?php echo esc_attr( $tag->name ); ?>">
						<?php echo esc_html( $tag->name ); ?>
					</a>
				<?php endforeach; ?>

			</div>
			<?php
		}

		/*
		 * pagination
		 *
		 * Default pagination
		 */
		public function pagination() {
			echo paginate_links(
				array(
					'prev_text' => '',
					'next_text' => '',
				)
			);
		}

		/*
		 * compare
		 *
		 * Fire compare module
		 */
		public function compare() {
			$compare_estates = new My_Home_Compare();
			$compare_estates->show();
		}

		/*
		 * header_class
		 *
		 * Set classes for header, here we set if header is "dark"
		 */
		public function header_class() {
			$class = array( 'mh-header' );
			if ( is_page() ) {
				global $post;
				array_push( $class, get_post_meta( $post->ID, 'page_header', true ) );
			}

			if ( is_singular( 'estate' ) ) {
				$estate_slider = My_Home_Theme()->settings->get( 'estate_slider' );
				if ( $estate_slider == 'single-estate-slider' ) {
					array_push( $class, 'mh-header--transparent' );
				}
			}

			return implode( ' ', $class );
		}

		/*
		 * agent_mode
		 *
		 * Check if agent mode is on
		 */
		public function agent_mode() {
			$show_user_bar = My_Home_Theme()->settings->get( 'agent_show-user-bar' );

			return intval( My_Home_Theme()->settings->get( 'agent-panel' ) ) && ! empty( $show_user_bar );
		}

		/*
		 * get_agent_panel_link
		 *
		 * Get link to frontend agent panel
		 */
		public function get_agent_panel_link() {
			$panel_link = My_Home_Theme()->settings->get( 'agent-panel_link' );

			if ( class_exists( 'MyHomeCore\Core' ) && ! empty( \MyHomeCore\My_Home_Core()->current_language ) ) {
				$panel_link .= '?lang=' . \MyHomeCore\My_Home_Core()->current_language;
			}

			return $panel_link;
		}

		/*
		 * is_frontend_registration_open
		 *
		 * Check if frontend agent registration is open
		 */
		public function is_frontend_registration_open() {
			$agent_registration = My_Home_Theme()->settings->get( 'agent-registration' );
			if ( empty( $agent_registration ) ) {
				return 'false';
			} else {
				return 'true';
			}
		}

		/*
		 * get_related_posts_style_class
		 *
		 * Get related style
		 */
		public function get_related_posts_style_class() {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return 'mh-grid__1of2';
			}
			$style = My_Home_Theme()->settings->get( 'blog-related-style' );

			if ( $style == 'vertical' ) {
				return 'mh-grid__1of1';
			}

			if ( $style == 'vertical-3x' ) {
				return 'mh-grid__1of3';
			}

			if ( $style == 'vertical-4x' ) {
				return 'mh-grid__1of4';
			}

			return 'mh-grid__1of2';
		}

		/**
		 * @return bool
		 */
		public function is_compare_enabled() {
			$compare_enabled = My_Home_Theme()->settings->get( 'compare' );

			return ! empty( $compare_enabled );
		}

		/**
		 * @return bool
		 */
		public function is_agent_panel_enabled() {
			$agent_panel = My_Home_Theme()->settings->get( 'agent-panel' );

			return ! empty( $agent_panel );
		}

		/**
		 * @return bool
		 */
		public function show_language_switcher() {
			$show_language_switcher = My_Home_Theme()->settings->get( 'top-bar_show-language-switcher' );

			return ! empty( $show_language_switcher ) && function_exists( 'icl_object_id' );
		}

		/**
		 * @return array
		 */
		public function get_language_flags() {
			$languages = apply_filters( 'wpml_active_languages', '' );

			if ( empty( $languages ) ) {
				return array();
			}

			return $languages;
		}

		/**
		 * @return bool
		 */
		public function has_breadcrumbs() {
			$breadcrumbs = My_Home_Theme()->settings->get( 'breadcrumbs' );

			return ! empty( $breadcrumbs );
		}

		public function get_sticky_holder_height() {
			$menu_height = My_Home_Theme()->settings->get( 'menu-height' );
			if ( empty( $menu_height ) ) {
				return 80;
			}

			return $menu_height;
		}

		/**
		 * @return bool
		 */
		public function set_sticky_height() {
			if ( ! is_page() ) {
				return true;
			}

			global $post;
			$image = get_post_meta( $post->ID, 'page_header', true );

			return $image == 'default';
		}

		/**
		 * @return bool
		 */
		public function blog_custom_sidebar() {
			$options = get_option( 'myhome_redux' );

			return isset( $options['mh-blog-sidebar_other'] ) && ! empty( $options['mh-blog-sidebar_other'] );
		}

	}

endif;
